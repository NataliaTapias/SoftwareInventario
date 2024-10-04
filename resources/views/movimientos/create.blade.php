@extends('layouts.app')

@section('title', 'Crear Movimiento')

@section('content')

<style>
    .search-result {
        cursor: pointer;
        padding: 5px;
        border: 1px solid #ccc;
        margin: 2px 0;
    }
    .search-result:hover {
        background-color: #BFF7DC;
    }
    .required {
        color: red; /* Color rojo para el asterisco */
    }   
</style>

<div class="container-fluid">
    <div class="d-flex align-items-center mb-4" style="gap: 1rem;">
        <a href="{{ route('movimientos.index') }}" class="icon-link" title="Atrás">
            <i class="fa-solid fa-circle-left"></i>
        </a>
        <h1>Crear Movimiento</h1>
    </div>

    <form method="POST" action="{{ route('movimientos.store') }}" class="px-5">
        @csrf
        @if(session('success'))
            <div class="alert alert-success fade show" role="alert" id="success-alert">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger fade show" role="alert" id="error-alert">
                {{ session('error') }}
            </div>
        @endif
        <input type="hidden" id="usuarios_id" name="usuarios_id" value="{{ Auth::id() }}">
        <div class="row g-3 mt-4"> <!-- Utiliza g-3 para ajustar los espacios entre columnas -->
            <div class="col-md-2 my-2">
                <label for="fecha">Fecha <span class="required">*</span></label>
                <input type="datetime-local" class="form-control" id="fecha" name="fecha" value="{{ old('fecha') }}" required>
            </div>
            <div class="col-md-4 my-2">
                <label for="tipoMovimientos_id">Tipo de Movimiento <span class="required">*</span></label>
                <select class="form-control" id="tipoMovimientos_id" name="tipoMovimientos_id" required>
                    <option value="">Seleccione un tipo de movimiento</option>
                    @foreach($tiposMovimientos as $tipoMovimiento)
                    <option value="{{ $tipoMovimiento->idTipomovimiento }}">{{ $tipoMovimiento->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 my-2">
                <label for="cantidad">Cantidad <span class="required">*</span></label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{ old('cantidad') }}" required>
            </div>
            <div class="col-md-3 my-2">
                <label for="solicitud-search">Solicitud</label>
                <input type="text" id="solicitud-search" class="form-control" placeholder="Buscar por Descripción Falla...">
                <input type="hidden" id="solicitudes_id" name="solicitudes_id" value="">
                <div id="solicitud-results-container"></div>
            </div>
            <div class="col-md-6 my-2">
                <label for="item-search">Item <span class="required">*</span></label>
                <input type="text" id="item-search" class="form-control" placeholder="Buscar item..." required>
                <input type="hidden" id="items_id" name="items_id" value="">
                <div id="results-container"></div>
            </div>
            <div class="col-md-3 my-2">
                <label for="precio">Precio</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="{{ old('precio') }}">
            </div>
            <div class="col-md-3 my-2">
                <label for="total">Total</label>
                <input type="number" step="0.01" class="form-control" id="total" name="total" value="{{ old('total') }}" readonly>
            </div>
            <div class="col-md-4 my-2">
                <label for="numRemisionProveedor">Num Remisión Proveedor</label>
                <input type="text" class="form-control" id="numRemisionProveedor" name="numRemisionProveedor" value="{{ old('numRemisionProveedor') }}">
            </div>
            <div class="col-md-4 my-2">
                <label for="colaborador">Colaborador</label>
                <input type="text" class="form-control" id="colaborador" name="colaborador" value="{{ old('colaborador') }}" >
            </div>
            <div class="col-md-4 my-2">
                <label for="proveedor">Proveedor</label>
                <input type="text" class="form-control" id="proveedor" name="proveedor" value="{{ old('proveedor') }}" >
            </div>
        </div>

        <div class="form-group mb-4 my-2">
            <label for="observacion">Observación</label>
            <textarea class="form-control" id="observacion" name="observacion">{{ old('observacion') }}</textarea>
        </div>

        <div class="text-center mt-3">
            <button type="submit" class="btn btn-success px-5 py-2">Guardar</button>
        </div>
    </form>
</div>

@endsection

@section('scripts')

<script>
    // Espera 5 segundos antes de ocultar la alerta
    setTimeout(function() {
        // Obtén las alertas
        let successAlert = document.getElementById('success-alert');
        let errorAlert = document.getElementById('error-alert');
        
        // Si hay una alerta de éxito, agrega la clase de fade out y se remueve
        if (successAlert) {
            successAlert.classList.remove('show'); // Oculta la alerta suavemente
            successAlert.classList.add('fade'); // Agrega clase fade
            successAlert.addEventListener('transitionend', function() {
                successAlert.remove(); // Remueve la alerta del DOM
            });
        }

        // Si hay una alerta de error, agrega la clase de fade out y se remueve
        if (errorAlert) {
            errorAlert.classList.remove('show'); // Oculta la alerta suavemente
            errorAlert.classList.add('fade'); // Agrega clase fade
            errorAlert.addEventListener('transitionend', function() {
                errorAlert.remove(); // Remueve la alerta del DOM
            });
        }
    }, 5000);
    document.addEventListener('DOMContentLoaded', function () {
        const itemInput = document.getElementById('item-search');
        const itemResultsContainer = document.getElementById('results-container');

        const solicitudInput = document.getElementById('solicitud-search');
        const solicitudResultsContainer = document.getElementById('solicitud-results-container');

        const cantidadInput = document.getElementById('cantidad');
        const precioInput = document.getElementById('precio');
        const totalInput = document.getElementById('total');

        function updateTotal() {
            const cantidad = parseFloat(cantidadInput.value) || 0;
            const precio = parseFloat(precioInput.value) || 0;
            totalInput.value = (cantidad * precio).toFixed(2);
        }

        cantidadInput.addEventListener('input', updateTotal);
        precioInput.addEventListener('input', updateTotal);

        itemInput.addEventListener('input', function () {
            const query = itemInput.value;

            if (query.length > 1) {
                fetch(`/items/${1}?query=${query}&subcategoria=logistica`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        itemResultsContainer.innerHTML = '';
                        if (data.length === 0) {
                            const div = document.createElement('div');
                            div.textContent = 'No se encontraron resultados';
                            div.classList.add('required');
                            div.classList.add('pt-1');
                            itemResultsContainer.appendChild(div);
                        } else {
                            data.forEach(item => {
                                const div = document.createElement('div');
                                div.textContent = item.nombre;
                                div.classList.add('search-result');
                                div.dataset.itemId = item.idItem;
                                div.addEventListener('click', () => {
                                    itemInput.value = item.nombre;
                                    document.getElementById('items_id').value = item.idItem;
                                    itemResultsContainer.innerHTML = '';
                                });
                                itemResultsContainer.appendChild(div);
                            });
                        }
                    })
                    .catch(error => console.error('Error fetching data:', error));
            } else {
                itemResultsContainer.innerHTML = '';
            }
        });

        solicitudInput.addEventListener('input', function () {
            const query = solicitudInput.value;

            if (query.length > 1) {
                fetch(`/solicitudes/search?query=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        solicitudResultsContainer.innerHTML = '';
                        if (data.length === 0) {
                            const div = document.createElement('div');
                            div.textContent = 'No se encontraron resultados';
                            div.classList.add('required');
                            div.classList.add('pt-1');
                            solicitudResultsContainer.appendChild(div);
                        } else {
                            data.forEach(solicitud => {
                                const div = document.createElement('div');
                                div.textContent = solicitud.descripcionFalla;
                                div.classList.add('search-result');
                                div.dataset.solicitudId = solicitud.idSolicitud;
                                div.addEventListener('click', () => {
                                    solicitudInput.value = solicitud.descripcionFalla;
                                    document.getElementById('solicitudes_id').value = solicitud.idSolicitud;
                                    solicitudResultsContainer.innerHTML = '';
                                });
                                solicitudResultsContainer.appendChild(div);
                            });
                        }
                    })
                    .catch(error => console.error('Error fetching data:', error));
            } else {
                solicitudResultsContainer.innerHTML = '';
            }
        });
    });
</script>

@endsection
