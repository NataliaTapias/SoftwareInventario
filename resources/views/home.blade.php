@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <h1 class="my-4">{{ $titulo }}</h1>
        <p>{{ $contenido }}</p>
    </div>
@endsection
