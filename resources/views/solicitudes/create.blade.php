@extends('layouts.app')

@section('title', 'Crear Solicitud')

@section('content')

<div class="d-flex align-items-center" style="gap: 1rem;">
        <a href="{{ route('solicitudes.index') }}" class="icon-link" title="Atrás">
            <i class="fa-solid fa-circle-left"></i>
        </a>
        <h1>Crear Solicitud</h1>
    </div>
    <!-- Barra de progreso -->
    <ul class="progressbar">
        <li class="active">Información Básica</li>
        <li>Repuestos Utilizados</li>
        <li>Asignar Trabajador</li>
    </ul>

    <form method="POST" action="{{ route('solicitudes.create') }}">
        @csrf

 <!-- Paso 1: Información Básica -->
 <div id="step-1" class="step row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="datetime-local" class="form-control" id="fecha" name="fecha" required>
        </div>
        <div class="form-group">
            <label for="tipoMantenimientos_id">Tipo de Mantenimiento</label>
            <select class="form-control" id="tipoMantenimientos_id" name="tipoMantenimientos_id" required>
                @foreach($tiposMantenimientos as $tipoMantenimiento)
                <option value="{{ $tipoMantenimiento->id }}">{{ $tipoMantenimiento->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="mantenimientoEficiente">Mantenimiento Eficiente</label>
            <select class="form-control" id="mantenimientoEficiente" name="mantenimientoEficiente">
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="tiempoEstimado">Tiempo Estimado</label>
            <input type="text" class="form-control" id="tiempoEstimado" name="tiempoEstimado">
        </div>
        <div class="form-group">
            <label for="fechaTermina">Fecha de Término</label>
            <input type="date" class="form-control" id="fechaTermina" name="fechaTermina">
        </div>
        <div class="form-group">
            <label for="totalHorasTrabajadas">Total de Horas Trabajadas</label>
            <input type="number" class="form-control" id="totalHorasTrabajadas" name="totalHorasTrabajadas" min="0">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tiempoParada">Tiempo de Parada</label>
            <input type="number" class="form-control" id="tiempoParada" name="tiempoParada" min="0">
        </div>
        <div class="form-group">
            <label for="firmaDirector">Firma del Director</label>
            <input type="text" class="form-control" id="firmaDirector" name="firmaDirector" maxlength="255">
        </div>
        <div class="form-group">
            <label for="firmaGerente">Firma del Gerente</label>
            <input type="text" class="form-control" id="firmaGerente" name="firmaGerente" maxlength="255">
        </div>
        <div class="form-group">
            <label for="firmaLider">Firma del Líder</label>
            <input type="text" class="form-control" id="firmaLider" name="firmaLider" maxlength="255">
        </div>
        <div class="form-group">
            <label for="estados_id">Estado</label>
            <select class="form-control" id="estados_id" name="estados_id" required>
                @foreach($estados as $estado)
                <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="areas_id">Área</label>
            <select class="form-control" id="areas_id" name="areas_id" required>
                @foreach($areas as $area)
                <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 text-center">
        <button type="button" class="btn btn-primary next-step">Siguiente</button>
    </div>
</div>


<!-- Paso 2: Repuestos Utilizados -->
<div id="step-2" class="step d-none">
    <div class="form-group search-container">
        <label for="repuestosUtilizados">Repuestos Utilizados</label>
        <div id="repuestos-container">
            <div class="input-group mb-3 repuesto-group">
                <input type="text" class="form-control repuesto-search" name="repuestosUtilizados[]" placeholder="Buscar repuesto...">
                <div class="results-container"></div> <!-- Aquí se mostrarán los resultados -->
                <div class="input-group-append">
                    <button type="button" class="btn btn-success add-repuesto"><i class="fa fa-plus"></i> Añadir</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 text-center">
        <button type="button" class="btn btn-primary prev-step">Anterior</button>
        <button type="button" class="btn btn-primary next-step">Siguiente</button>
    </div>
</div>


 <!-- Paso 3: Asignar Trabajador -->
<div id="step-3" class="step d-none">
    <div class="form-group">
        <label for="trabajadores">Asignar Trabajadores</label>
        <div id="trabajadores-container">
            <div class="input-group mb-3 trabajador-group">
                <input type="text" class="form-control trabajador-search" name="trabajadores[]" placeholder="Buscar trabajador...">
                <div class="results-container"></div>
                <div class="input-group-append">
                    <button type="button" class="btn btn-success add-trabajador"><i class="fa fa-plus"></i> Añadir</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 text-center">
        <button type="button" class="btn btn-primary prev-step">Anterior</button>
        <button type="submit" class="btn btn-primary">Finalizar</button>
    </div>
</div>


<script>
  document.addEventListener('DOMContentLoaded', function () {
    const steps = document.querySelectorAll('.step');
    const progressbar = document.querySelectorAll('.progressbar li');
    let currentStep = 0;

    function showStep(stepIndex) {
        steps.forEach((step, index) => {
            step.classList.toggle('d-none', index !== stepIndex);
            progressbar[index].classList.toggle('active', index === stepIndex);
        });
    }

    document.querySelectorAll('.next-step').forEach(button => {
        button.addEventListener('click', () => {
            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
        });
    });

    document.querySelectorAll('.prev-step').forEach(button => {
        button.addEventListener('click', () => {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        });
    });

    // Función para configurar la búsqueda de repuestos
    function setupRepuestoSearch(inputGroup) {
        const itemInput = inputGroup.querySelector('.repuesto-search');
        const itemResultsContainer = inputGroup.querySelector('.results-container');

        itemInput.addEventListener('input', function () {
            const query = itemInput.value;

            if (query.length > 1) {
                fetch(`/items/show?query=${query}`)
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
                                div.textContent = item.nombre; // Ajustar al nombre del campo correcto
                                div.classList.add('search-result');
                                div.dataset.itemId = item.idItem; // Ajustar al nombre del campo correcto
                                div.addEventListener('click', () => {
                                    itemInput.value = item.nombre; // Ajustar al nombre del campo correcto
                                    const hiddenInput = document.createElement('input');
                                    hiddenInput.type = 'hidden';
                                    hiddenInput.name = 'items_id[]'; // Ajustar al nombre del campo correcto
                                    hiddenInput.value = item.idItem; // Ajustar al nombre del campo correcto
                                    inputGroup.appendChild(hiddenInput);
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
    }

    // Función para configurar la búsqueda de trabajadores
    function setupTrabajadorSearch(inputGroup) {
        const trabajadorInput = inputGroup.querySelector('.trabajador-search');
        const trabajadorResultsContainer = inputGroup.querySelector('.results-container');

        trabajadorInput.addEventListener('input', function () {
            const query = trabajadorInput.value;

            if (query.length > 1) {
                fetch(`/trabajadores/show?query=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        trabajadorResultsContainer.innerHTML = '';
                        if (data.length === 0) {
                            const div = document.createElement('div');
                            div.textContent = 'No se encontraron resultados';
                            trabajadorResultsContainer.appendChild(div);
                        } else {
                            data.forEach(trabajador => {
                                const div = document.createElement('div');
                                div.textContent = trabajador.name; // Ajustar al nombre del campo correcto
                                div.classList.add('search-result');
                                div.dataset.trabajadorId = trabajador.idTrabajador; // Ajustar al nombre del campo correcto
                                div.addEventListener('click', () => {
                                    trabajadorInput.value = trabajador.name; // Ajustar al nombre del campo correcto
                                    const hiddenInput = document.createElement('input');
                                    hiddenInput.type = 'hidden';
                                    hiddenInput.name = 'trabajadores_id[]'; // Ajustar al nombre del campo correcto
                                    hiddenInput.value = trabajador.idTrabajador; // Ajustar al nombre del campo correcto
                                    inputGroup.appendChild(hiddenInput);
                                    trabajadorResultsContainer.innerHTML = '';
                                });
                                trabajadorResultsContainer.appendChild(div);
                            });
                        }
                    })
                    .catch(error => console.error('Error fetching data:', error));
            } else {
                trabajadorResultsContainer.innerHTML = '';
            }
        });
    }

    // Función para configurar botones de agregar y eliminar repuestos
    function setupAddRemoveRepuestoButtons() {
        document.querySelectorAll('.add-repuesto').forEach(button => {
            button.addEventListener('click', () => {
                const container = button.closest('.repuesto-group');
                const newInputGroup = container.cloneNode(true);
                const addButton = newInputGroup.querySelector('.add-repuesto');
                const itemInput = newInputGroup.querySelector('.repuesto-search');

                // Limpiar el valor y resultados del nuevo input
                itemInput.value = '';
                newInputGroup.querySelector('.results-container').innerHTML = '';

                // Cambiar el botón Añadir por Eliminar
                addButton.innerHTML = '<i class="fa fa-trash"></i> Eliminar';
                addButton.classList.replace('btn-success', 'btn-danger');
                addButton.classList.replace('add-repuesto', 'remove-repuesto');

                // Configurar búsqueda para el nuevo input
                setupRepuestoSearch(newInputGroup);

                // Añadir el nuevo grupo al contenedor
                container.parentNode.appendChild(newInputGroup);

                // Configurar el botón de eliminar para el nuevo grupo
                addButton.addEventListener('click', () => {
                    newInputGroup.remove();
                });
            });
        });

        document.querySelectorAll('.remove-repuesto').forEach(button => {
            button.addEventListener('click', () => {
                const inputGroup = button.closest('.repuesto-group');
                if (inputGroup.parentNode.children.length > 1) {
                    inputGroup.remove();
                }
            });
        });
    }

    // Función para configurar botones de agregar y eliminar trabajadores
    function setupAddRemoveTrabajadorButtons() {
        document.querySelectorAll('.add-trabajador').forEach(button => {
            button.addEventListener('click', () => {
                const container = button.closest('.trabajador-group');
                const newInputGroup = container.cloneNode(true);
                const addButton = newInputGroup.querySelector('.add-trabajador');
                const trabajadorInput = newInputGroup.querySelector('.trabajador-search');

                // Limpiar el valor y resultados del nuevo input
                trabajadorInput.value = '';
                newInputGroup.querySelector('.results-container').innerHTML = '';

                // Cambiar el botón Añadir por Eliminar
                addButton.innerHTML = '<i class="fa fa-trash"></i> Eliminar';
                addButton.classList.replace('btn-success', 'btn-danger');
                addButton.classList.replace('add-trabajador', 'remove-trabajador');

                // Configurar búsqueda para el nuevo input
                setupTrabajadorSearch(newInputGroup);

                // Añadir el nuevo grupo al contenedor
                container.parentNode.appendChild(newInputGroup);

                // Configurar el botón de eliminar para el nuevo grupo
                addButton.addEventListener('click', () => {
                    newInputGroup.remove();
                });
            });
        });

        document.querySelectorAll('.remove-trabajador').forEach(button => {
            button.addEventListener('click', () => {
                const inputGroup = button.closest('.trabajador-group');
                if (inputGroup.parentNode.children.length > 1) {
                    inputGroup.remove();
                }
            });
        });
    }

    // Inicializar búsqueda y botones para el primer input group de repuestos
    setupRepuestoSearch(document.querySelector('.repuesto-group'));
    setupAddRemoveRepuestoButtons();

    // Inicializar búsqueda y botones para el primer input group de trabajadores
    setupTrabajadorSearch(document.querySelector('.trabajador-group'));
    setupAddRemoveTrabajadorButtons();
});


</script>

<style>
    .progressbar {
        counter-reset: step;
        display: flex;
        justify-content: space-between;
        list-style: none;
        padding: 0;
    }

    .progressbar li {
        position: relative;
        flex: 1;
        text-align: center;
        text-transform: uppercase;
        font-size: 12px;
        color: #7d7d7d;
    }

    .progressbar li:before {
        counter-increment: step;
        content: counter(step);
        display: block;
        margin: 0 auto 10px;
        background: #7d7d7d;
        color: white;
        width: 24px;
        height: 24px;
        line-height: 24px;
        text-align: center;
        border-radius: 50%;
    }

    .progressbar li:after {
        content: '';
        position: absolute;
        top: 12px;
        left: -50%;
        width: 100%;
        height: 2px;
        background: #7d7d7d;
        z-index: -1;
    }

    .progressbar li:first-child:after {
        content: none;
    }

    .progressbar li.active {
        color: #000;
    }

    .progressbar li.active:before,
    .progressbar li.active:after {
        background: #28a745;
    }

    .search-container {
        position: relative; /* Contenedor relativo para alinear los resultados */
    }

    .results-container {
        position: absolute; /* Posición absoluta para los resultados */
        top: 100%; /* Mostrar debajo del campo de búsqueda */
        left: 0;
        width: 100%; /* Ancho completo del contenedor */
        max-height: 200px; /* Altura máxima de los resultados */
        overflow-y: auto; /* Scroll si hay muchos resultados */
        z-index: 1000; /* Asegura que esté sobre otros elementos */
        border: 1px solid #ccc;
        border-top: none; /* Elimina el borde superior */
        background-color: #fff;
    }

    .search-result {
        cursor: pointer;
        padding: 8px 12px;
        border-bottom: 1px solid #ccc; /* Borde inferior entre resultados */
    }

    .search-result:last-child {
        border-bottom: none; /* Elimina el borde inferior del último resultado */
    }

    .search-result:hover {
        background-color: #f0f0f0;
    }

    .form-control {
        width: 100%;
    }
</style>
@endsection
