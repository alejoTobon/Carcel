@extends('layouts.app')

@section('template_title')
    {{ $prisionero->name ?? __('Show') . " " . __('Prisionero') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Prisionero</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('prisioneros.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre Completo:</strong>
                                    {{ $prisionero->nombre_completo }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Nacimiento:</strong>
                                    {{ $prisionero->fecha_nacimiento }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Ingreso:</strong>
                                    {{ $prisionero->fecha_ingreso }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Delito Cometido:</strong>
                                    {{ $prisionero->delito_cometido }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Celda Asignada:</strong>
                                    {{ $prisionero->celda_asignada }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
