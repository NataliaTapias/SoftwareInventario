@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center my-4">
                <h1 class="display-4">Bienvenido, {{ Auth::user()->nombre }}</h1>
                <p class="lead">Este es el panel principal de Quimint, donde puedes gestionar tus solicitudes, inventarios, y más.</p>
            </div>
        </div>
        <div class="row d-flex align-items-stretch justify-content-center">
            <!-- Cards Section -->

            @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('logisstica'))
                <div class="col-md-3 mb-4">
                    <div class="card text-white bg-info text-center h-100">
                        <div class="card-header"><i class="fas fa-box"></i> Inventario</div>
                        <div class="card-body">
                            <p class="card-text">Administra y consulta tu inventario de productos y materiales.</p>
                            <a href="{{ route('items.index') }}" class="btn btn-light">Ir a Inventario</a>
                        </div>
                    </div>
                </div>
            @endif

            @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('logistica') || Auth::user()->hasRole('mantenimiento'))
                <div class="col-md-3 mb-4">
                    <div class="card text-white bg-warning text-center h-100">
                        <div class="card-header"><i class="fas fa-envelope"></i> Solicitudes</div>
                        <div class="card-body">
                            <p class="card-text">Gestiona tus solicitudes de materiales y recursos.</p>
                            <a href="{{ route('solicitudes.index') }}" class="btn btn-light">Ir a Solicitudes</a>
                        </div>
                    </div>
                </div>
            @endif

            @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('logistica') || Auth::user()->hasRole('mantenimiento'))
                <div class="col-md-3 mb-4">
                    <div class="card text-center bg-secondary text-white h-100">
                        <div class="card-header"><i class="fas fa-exchange-alt fa"></i > Movimientos</div>
                        <div class="card-body">
                            <p class="card-text">Controla los movimientos de productos.</p>
                            <a href="{{ route('movimientos.index') }}" class="btn btn-light">Ver Movimientos</a>
                        </div>
                    </div>
                </div>
            @endif

            @if(Auth::user()->hasRole('admin'))
                <div class="col-md-3 mb-4">
                    <div class="card text-white bg-danger text-center h-100">
                        <div class="card-header"><i class="fas fa-users"></i> Trabajadores</div>
                        <div class="card-body">
                            <p class="card-text">Consulta y gestiona la información de los trabajadores.</p>
                            <a href="{{ route('trabajadores.index') }}" class="btn btn-light">Ir a Trabajadores</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
