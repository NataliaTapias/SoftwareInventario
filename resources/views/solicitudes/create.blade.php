@extends('layouts.app')

@section('title', 'Crear Solicitud')

@section('content')

<style>
    .required {
        color: red; /* Color rojo para el asterisco */
    }

    .custom-file-input:lang(es) ~ .custom-file-label::after {
        content: "Browse";
    }
</style>

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

    <form method="POST" action="{{ route('solicitudes.store') }}" id="formCrearSolicitudes" enctype="multipart/form-data" class="px-5">
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

        <!-- Paso 1: Información Básica -->
        <div id="step-1" class="step row">
            <!-- Columna izquierda -->
            <div class="col-md-2">
                <div class="form-group">
                    <label for="fecha">Fecha <span class="required">*</span></label>
                    <input type="datetime-local" class="form-control" id="fecha" name="fecha" required>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="tipoMantenimientos_id">Tipo de Mantenimiento <span class="required">*</span></label>
                    <select class="form-control" id="tipoMantenimientos_id" name="tipoMantenimientos_id" required>
                        @foreach($tiposMantenimientos as $tipoMantenimiento)
                            <option value="{{ $tipoMantenimiento->idTipomantenimiento }}">{{ $tipoMantenimiento->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label>Mantenimiento Eficiente</label>
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="mantenimientoEficienteSi" name="mantenimientoEficiente" value="1" checked>
                                <label class="form-check-label" for="mantenimientoEficienteSi">Sí</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="mantenimientoEficienteNo" name="mantenimientoEficiente" value="0">
                                <label class="form-check-label" for="mantenimientoEficienteNo">No</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="estados_id">Estado <span class="required">*</span></label>
                    <select class="form-control" id="estados_id" name="estados_id" required>
                        @foreach($estados as $estado)
                            <option value="{{ $estado->idEstado }}">{{ $estado->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="areas_id">Área <span class="required">*</span></label>
                    <select class="form-control" id="areas_id" name="areas_id" required>
                        @foreach($areas as $area)
                            <option value="{{ $area->idArea }}">{{ $area->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="tiempoEstimado">Tiempo Estimado</label>
                    <input type="time" class="form-control" id="tiempoEstimado" name="tiempoEstimado">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="tiempoParada">Tiempo de Parada</label>
                    <input type="time" class="form-control" id="tiempoParada" name="tiempoParada" min="0">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="totalHorasTrabajadas">Total de Horas Trabajadas</label>
                    <input type="time" class="form-control" id="totalHorasTrabajadas" name="totalHorasTrabajadas" min="0">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="fechaInicio">Fecha de Inicio</label>
                    <input type="date" class="form-control" id="fechaInicio" name="fechaInicio">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="fechaTermina">Fecha de Término</label>
                    <input type="date" class="form-control" id="fechaTermina" name="fechaTermina">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="descripcionFalla">Descripcion de Falla</label>
                    <input type="text" class="form-control" id="descripcionFalla" name="descripcionFalla">
                </div>
            </div>

            <!-- Columna derecha -->
            <div class="col-md-3">
                <div class="form-group">
                    <label for="firmaDirector">Firma del Director</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="firmaDirector" name="firmaDirector" accept="image/*">
                        <label class="custom-file-label" for="firmaDirector">Seleccionar archivo</label>
                    </div>
                    <img id="previewFirmaDirector" class="mt-2" src="" alt="Previsualización de la firma del Director" style="max-width: 200px; max-height: 200px; display:none;">
                    <small class="form-text text-muted mt-1">Por favor, suba una imagen de la firma del Director.</small>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    <label for="firmaGerente">Firma del Gerente</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="firmaGerente" name="firmaGerente" accept="image/*">
                        <label class="custom-file-label" for="firmaGerente">Seleccionar archivo</label>
                    </div>
                    <img id="previewFirmaGerente" class="mt-2" src="" alt="Previsualización de la firma del Gerente" style="max-width: 200px; display:none;">
                    <small class="form-text text-muted mt-1">Por favor, suba una imagen de la firma del Gerente.</small>
                </div>
            </div> <!-- Aquí se corrigió el cierre del div -->

            <div class="col-md-3">
                <div class="form-group">
                    <label for="firmaLider">Firma del Líder</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="firmaLider" name="firmaLider" accept="image/*">
                        <label class="custom-file-label" for="firmaLider">Seleccionar archivo</label>
                    </div>
                    <img id="previewFirmaLider" class="mt-2" src="" alt="Previsualización de la firma del Líder" style="max-width: 200px; display:none;">
                    <small class="form-text text-muted mt-1">Por favor, suba una imagen de la firma del Líder.</small>
                </div>
            </div>

            <div class="col-12 text-center mt-4">
                <button type="button" class="btn btn-primary next-step px-5 py-2">Siguiente</button>
            </div>
        </div>



        <!-- Paso 2: Repuestos Utilizados -->
        <div id="step-2" class="step d-none">
            <div class="form-group search-container">
                <label for="repuestosUtilizados">Repuestos Utilizados</label>
                <div id="repuestos-container">
                    <div class="input-group mb-3 repuesto-group">
                        <input type="text" class="form-control repuesto-search" name="repuestosUtilizados" placeholder="Buscar repuesto...">
                        <input type="text" id="repuestosUtilizadosId" value="" hidden>
                        <div class="results-container"></div> <!-- Aquí se mostrarán los resultados -->
                        <div class="input-group-append">
                            <button type="button" class="btn btn-success add-repuesto"><i class="fa fa-plus"></i> Añadir</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center">
                <button type="button" class="btn btn-primary prev-step px-5 py-2">Anterior</button>
                <button type="button" class="btn btn-primary next-step px-5 py-2">Siguiente</button>
            </div>
        </div>



        <!-- Paso 3: Asignar Trabajador -->
        <div id="step-3" class="step d-none">
            <div class="form-group">
                <label for="trabajadores">Asignar Trabajadores</label>
                <div id="trabajadores-container">
                    <div class="input-group mb-3 trabajador-group">
                        <input type="text" class="form-control trabajador-search" name="trabajadores[]" placeholder="Buscar trabajador...">
                        <input type="text" id="trabajadoresUtilizadosId" value="" hidden>
                        <div class="results-container"></div>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-success add-trabajador"><i class="fa fa-plus"></i> Añadir</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center">
                <button type="button" class="btn btn-primary prev-step px-5 py-2">Anterior</button>
                <button type="button" class="btn btn-primary next-step px-5 py-2">Finalizar</button>
            </div>
        </div>
</form>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const steps = document.querySelectorAll('.step');
    const progressbar = document.querySelectorAll('.progressbar li');
    let currentStep = 0;

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

    document.getElementById('firmaDirector').addEventListener('change', function(event) {
        previewImage(event, 'previewFirmaDirector');
    });

    document.getElementById('firmaGerente').addEventListener('change', function(event) {
        previewImage(event, 'previewFirmaGerente');
    });

    document.getElementById('firmaLider').addEventListener('change', function(event) {
        previewImage(event, 'previewFirmaLider');
    });

    function previewImage(event, previewId) {
        const reader = new FileReader();
        const file = event.target.files[0];
        
        if (file) {
            reader.onload = function(e) {
                const preview = document.getElementById(previewId);
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }

    function showStep(stepIndex) {
        steps.forEach((step, index) => {
            step.classList.toggle('d-none', index !== stepIndex);
            progressbar[index].classList.toggle('active', index === stepIndex);
        });
    }

    document.querySelectorAll('.next-step').forEach(button => {
        button.addEventListener('click', () => {
            if (currentStep < steps.length) {
                if (currentStep == 0
                    && (document.getElementById('areas_id').value == ''
                    || document.getElementById('estados_id').value === ''
                    || document.getElementById('tipoMantenimientos_id').value == ''
                    || document.getElementById('fecha').value == '')) {
                    alert('Debe incluir los datos obligatorios');
                    return;
                }

                if (currentStep == 1) {
                    const inputRepuestosSeleccionados = document.querySelectorAll(`input[name="repuestosSeleccionados[]"]`);
                    const inputCantidadRepuestos = document.querySelectorAll(`input[name="cantidadRepuestos[]"]`);
        
                    // Verificar que el elemento no sea nulo y que exista al menos un input seleccionado
                    if (!inputRepuestosSeleccionados || inputRepuestosSeleccionados.length <= 0) {
                        alert('Debe seleccionar al menos un repuesto y su respectiva cantidad');
                        return;
                    }

                    // Recorrer los campos seleccionados y validar que no estén vacíos o nulos
                    for (let i = 0; i < inputRepuestosSeleccionados.length; i++) {
                        const cantidad = inputCantidadRepuestos[i].value;

                        // Validar que la cantidad sea un número válido y mayor que cero
                        if (!cantidad || isNaN(cantidad) || cantidad <= 0) {
                            alert(`El campo de cantidad debe contener un número válido mayor que cero.`);
                            return;
                        }
                    }
                }

                if (currentStep == 2) {
                const inputElement = document.querySelector(`input[name="trabajadoresSeleccionados[]"]`);
    
                    // Verificar que el elemento no sea nulo y que exista al menos un input seleccionado
                    if (!inputElement || inputElement.length <= 0) {
                        alert('Debe seleccionar al menos un trabajador');
                        return;
                    }
                    document.getElementById('formCrearSolicitudes').submit();
                }

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
                                // Comprobar si el input oculto ya existe
                                const existingInput = document.querySelector(`input[name="repuestosSeleccionados[]"][value="${item.idItem}"]`);

                                if (existingInput) {
                                    return;
                                }

                                // crea el elemento
                                const div = document.createElement('div');
                                div.textContent = item.nombre; // Ajustar al nombre del campo correcto
                                div.classList.add('search-result');
                                div.dataset.itemId = item.idItem; // Ajustar al nombre del campo correcto
                                div.addEventListener('click', () => {
                                    document.getElementById('repuestosUtilizadosId').value = item.idItem;
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
                                // Comprobar si el input oculto ya existe
                                const existingInput = document.querySelector(`input[name="trabajadoresSeleccionados[]"][value="${trabajador.id}"]`);
    
                                if (existingInput) {
                                    return;
                                }
    
                                // crea el elemento
                                const div = document.createElement('div');
                                div.textContent = trabajador.name; // Ajustar al nombre del campo correcto
                                div.classList.add('search-result');
                                div.dataset.trabajadorId = trabajador.id; // Ajustar al nombre del campo correcto
                                div.addEventListener('click', () => {
                                    document.getElementById('trabajadoresUtilizadosId').value = trabajador.id;
                                    trabajadorInput.value = trabajador.name; // Ajustar al nombre del campo correcto
                                    const hiddenInput = document.createElement('input');
                                    hiddenInput.type = 'hidden';
                                    hiddenInput.name = 'trabajadores_id[]'; // Ajustar al nombre del campo correcto
                                    hiddenInput.value = trabajador.id; // Ajustar al nombre del campo correcto
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

    function setupAddRemoveRepuestoButtons() {
        document.querySelectorAll('.add-repuesto').forEach(button => {
            button.addEventListener('click', () => {
                const itemId = document.getElementById('repuestosUtilizadosId').value;
                
                if (itemId == '')
                    return;
                
                const container = button.closest('.repuesto-group');
                const newInputGroup = container.cloneNode(true);
                const itemInput = newInputGroup.querySelector('.repuesto-search');

                // Crear un nuevo div que muestre el repuesto seleccionado
                const repuestosContainer = document.getElementById('repuestos-container');
                const newRepuestoDiv = document.createElement('div');
                newRepuestoDiv.classList.add('input-group', 'mb-1', 'repuesto-group');
                newRepuestoDiv.innerHTML = `
                    <div class="form-control disabled">${itemInput.value}</div>
                    <input type="text" id="repuestosSeleccionado_${itemId}" name="repuestosSeleccionados[]" value="${itemId}" hidden>
                    <input type="number" class="mx-2 border" id="cantidadRepuestos_${itemId}" name="cantidadRepuestos[]" placeholder="cantidad..." required>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger remove-repuesto"><i class="fa fa-trash"></i> Eliminar</button>
                    </div>`;

                // Agregar el nuevo div al contenedor de repuestos
                repuestosContainer.appendChild(newRepuestoDiv);

                // Agregar funcionalidad para eliminar el repuesto
                const removeButton = newRepuestoDiv.querySelector('.remove-repuesto');
                removeButton.addEventListener('click', () => {
                    newRepuestoDiv.remove();
                });
                document.getElementById('repuestosUtilizadosId').value = '';
                itemInput.value = '';
                itemInput.text = '';
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

    function setupAddRemoveTrabajadorButtons() {
        document.querySelectorAll('.add-trabajador').forEach(button => {
            button.addEventListener('click', () => {
                const itemId = document.getElementById('trabajadoresUtilizadosId').value;
                
                if (itemId == '')
                    return;
                
                const container = button.closest('.trabajador-group');
                const newInputGroup = container.cloneNode(true);
                const itemInput = newInputGroup.querySelector('.trabajador-search');

                // Crear un nuevo div que muestre el trabajador seleccionado
                const trabajadorsContainer = document.getElementById('trabajadores-container');
                const newtrabajadorDiv = document.createElement('div');
                newtrabajadorDiv.classList.add('input-group', 'mb-1', 'trabajador-group');
                newtrabajadorDiv.innerHTML = `
                    <div class="form-control disabled">${itemInput.value}</div>
                    <input type="text" id="trabajadoresSeleccionado_${itemId}" name="trabajadoresSeleccionados[]" value="${itemId}" hidden>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger remove-trabajador"><i class="fa fa-trash"></i> Eliminar</button>
                    </div>`;

                // Agregar el nuevo div al contenedor de trabajadors
                trabajadorsContainer.appendChild(newtrabajadorDiv);

                // Agregar funcionalidad para eliminar el trabajador
                const removeButton = newtrabajadorDiv.querySelector('.remove-trabajador');
                removeButton.addEventListener('click', () => {
                    newtrabajadorDiv.remove();
                });
                document.getElementById('trabajadoresUtilizadosId').value = '';
                itemInput.value = '';
                itemInput.text = '';
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

    document.querySelectorAll('.repuesto-group').forEach(setupRepuestoSearch);
    document.querySelectorAll('.trabajador-group').forEach(setupTrabajadorSearch);

    setupAddRemoveRepuestoButtons();
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
