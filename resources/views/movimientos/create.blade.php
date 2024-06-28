@extends('layouts.app')

@section('title', 'Crear Movimiento')

@section('content')
<div class="container">
    <h1 class="my-4">Crear Movimiento</h1>

    <form method="POST" action="{{ route('movimientos.store') }}">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <div class="col">
                        <label for="fecha">Fecha</label>
                        <input type="datetime-local" class="form-control" id="fecha" name="fecha" value="{{ old('fecha') }}" required>
                    </div>
                    <div class="col">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{ old('cantidad') }}" required>
                    </div>
                    <div class="col">
                        <label for="precio">Precio</label>
                        <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="{{ old('precio') }}" required>
                    </div>
                    <div class="col">
                        <label for="numRemisionProveedor">Num Remisión Proveedor</label>
                        <input type="text" class="form-control" id="numRemisionProveedor" name="numRemisionProveedor" value="{{ old('numRemisionProveedor') }}">
                    </div>
                </div>
            </div>
        </div>    

        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <div class="col">
                        <label for="firma">Firma</label>
                        <input type="text" class="form-control" id="firma" name="firma" value="{{ old('firma') }}" required>
                    </div>
                    <div class="col">
                        <label for="colaborador">Colaborador</label>
                        <input type="text" class="form-control" id="colaborador" name="colaborador" value="{{ old('colaborador') }}" required>
                    </div>
                    <div class="col">
                        <label for="solicitudes_id">Solicitud</label>
                        <select class="form-control" id="solicitudes_id" name="solicitudes_id" required>
                            <option value="">Seleccione una solicitud</option>
                            @foreach($solicitudes as $solicitud)
                                <option value="{{ $solicitud->idSolicitud }}">{{ $solicitud->descripcionFalla }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="items_id">Item</label>
            <input type="text" class="form-control" id="item-search" placeholder="Buscar ítem...">
            <input type="hidden" id="items_id" name="items_id">
            <div id="item-results" style="display: none;">
                <ul class="list-group" id="item-list"></ul>
            </div>
        </div>
        <div class="form-group">
            <label for="tipoMovimientos_id">Tipo de Movimiento</label>
            <select class="form-control" id="tipoMovimientos_id" name="tipoMovimientos_id" required>
                <option value="">Seleccione un tipo de movimiento</option>
                @foreach($tiposMovimientos as $tipoMovimiento)
                    <option value="{{ $tipoMovimiento->idTipomovimiento }}">{{ $tipoMovimiento->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="observacion">Observación</label>
            <textarea class="form-control" id="observacion" name="observacion">{{ old('observacion') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('movimientos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const itemSearch = document.getElementById('item-search');
        const itemList = document.getElementById('item-list');

        itemSearch.addEventListener('keyup', function () {
            const query = itemSearch.value;
            console.log('Query:', query);  // Verifica el valor de búsqueda
            if (query !== '') {
                fetch('/items/search?query=' + encodeURIComponent(query))
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok ' + response.statusText);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Respuesta del servidor:', data);  // Verifica la respuesta del servidor
                        let results = '';
                        data.forEach(item => {
                            results += '<li class="list-group-item" data-id="' + item.idItem + '">' + item.nombre + '</li>';
                        });
                        itemList.innerHTML = results;
                        itemList.style.display = 'block';
                    })
                    .catch(error => {
                        console.error('Error en la solicitud Fetch:', error);  // Verifica los errores
                    });
            } else {
                itemList.style.display = 'none';
            }
        });

        itemList.addEventListener('click', function (event) {
            if (event.target && event.target.matches('li.list-group-item')) {
                const itemName = event.target.textContent;
                const itemId = event.target.getAttribute('data-id');
                itemSearch.value = itemName;
                document.getElementById('items_id').value = itemId;
                itemList.style.display = 'none';
            }
        });
    });
</script>
@endsection
