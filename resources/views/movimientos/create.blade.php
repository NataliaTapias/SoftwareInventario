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
</style>

<div class="container-fluid">
    <div class="d-flex align-items-center" style="gap: 1rem;">
        <a href="{{ route('movimientos.index') }}" class="icon-link" title="Atrás">
            <i class="fa-solid fa-circle-left"></i> <!-- Ícono de Font Awesome -->
        </a>
        <h1>Crear Movimiento</h1>
    </div>

    <form method="POST" action="{{ route('movimientos.store') }}">
        @csrf
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="fecha">Fecha</label>
                <input type="datetime-local" class="form-control" id="fecha" name="fecha" value="{{ old('fecha') }}" required>
            </div>
            <div class="col-md-3">
                <label for="numRemisionProveedor">Num Remisión Proveedor</label>
                <input type="text" class="form-control" id="numRemisionProveedor" name="numRemisionProveedor" value="{{ old('numRemisionProveedor') }}">
            </div>
            <div class="col-md-3">
                <label for="firma">Firma</label>
                <input type="text" class="form-control" id="firma" name="firma" value="{{ old('firma') }}" required>
            </div>
            <div class="col-md-3">
                <label for="colaborador">Colaborador</label>
                <input type="text" class="form-control" id="colaborador" name="colaborador" value="{{ old('colaborador') }}" required>
            </div>
        </div>
        <input type="hidden" id="usuarios_id" name="usuarios_id" value="{{ Auth::id() }}">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="item-search">Item</label>
                <input type="text" id="item-search" class="form-control" placeholder="Buscar item..." required>
                <input type="hidden" id="items_id" name="items_id" value="">
                
                <div id="results-container"></div>
            </div>
            <div class="col-md-3">
                <label for="cantidad">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{ old('cantidad') }}" required>
            </div>
            <div class="col-md-3">
                <label for="precio">Precio</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="{{ old('precio') }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <label for="total">Total</label>
                <input type="number" step="0.01" class="form-control" id="total" name="total" value="{{ old('total') }}" readonly>
            </div>
            <div class="col-md-3">
                <label for="tipoMovimientos_id">Tipo de Movimiento</label>
                <select class="form-control" id="tipoMovimientos_id" name="tipoMovimientos_id" required>
                    <option value="">Seleccione un tipo de movimiento</option>
                    @foreach($tiposMovimientos as $tipoMovimiento)
                        <option value="{{ $tipoMovimiento->idTipomovimiento }}">{{ $tipoMovimiento->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="solicitud-search">Solicitud</label>
                <input type="text" id="solicitud-search" class="form-control" placeholder="Buscar por Descripción Falla...">
                <input type="hidden" id="solicitudes_id" name="solicitudes_id" value="">
                <div id="solicitud-results-container"></div>
            </div>
            <div class="col-md-3">
                <label for="proveedor">Proveedor</label>
                <input type="text" step="0.01" class="form-control" id="proveedor" name="proveedor" value="{{ old('proveedor') }}" required>
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="observacion">Observación</label>
            <textarea class="form-control" id="observacion" name="observacion">{{ old('observacion') }}</textarea>
        </div>

        <div class="text-center mt-3">
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')

<script>
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
