@extends('layouts.app')

@section('content')
<div class="container-fluid" id="dynamicContent">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        @if(Auth::check() && Auth::user()->rol === 'administrador')
        <!-- Formulario para PDF -->
        <form action="{{ route('reportes.prisionero_pdf') }}" method="GET" class="form-inline">
            <div class="form-group mb-2">
                <label for="start_date" class="sr-only">Fecha de Inicio</label>
                <input type="date" name="start_date" id="start_date" class="form-control" placeholder="Fecha de Inicio" value="{{ old('start_date') }}" required>
                @error('start_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="end_date" class="sr-only">Fecha de Fin</label>
                <input type="date" name="end_date" id="end_date" class="form-control" placeholder="Fecha de Fin" value="{{ old('end_date') }}" required>
                @error('end_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mb-2">Generar Reporte PDF</button>
        </form>

        <!-- Formulario para Excel -->
        <form action="{{ route('reportes.prisionero_excel') }}" method="GET" class="form-inline mt-2">
            <div class="form-group mb-2">
                <label for="start_date_excel" class="sr-only">Fecha de Inicio</label>
                <input type="date" name="start_date" id="start_date_excel" class="form-control" placeholder="Fecha de Inicio" value="{{ old('start_date_excel') }}" required>
                @error('start_date_excel')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="end_date_excel" class="sr-only">Fecha de Fin</label>
                <input type="date" name="end_date" id="end_date_excel" class="form-control" placeholder="Fecha de Fin" value="{{ old('end_date_excel') }}" required>
                @error('end_date_excel')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success mb-2">Generar Reporte Excel</button>
        </form>
        @endif
    </div>

    <!-- Content Row -->
    <div class="row d-flex justify-content-center">
        <div class="col-8 mt-5">
            <h1 class="h1 text-center ">Bienvenido al sistema de gestión de El Redentor</h1>
            <p></p>
        </div>
    </div>

</div>
@endsection
