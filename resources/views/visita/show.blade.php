@extends('layouts.app')

@section('template_title')
    {{ $visita->name ?? __('Show') . " " . __('Visita') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Visita</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('visitas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Prisionero Id:</strong>
                                    {{ $visita->prisionero_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Visitante Id:</strong>
                                    {{ $visita->visitante_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Guardia Id:</strong>
                                    {{ $visita->guardia_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Hora Inicio:</strong>
                                    {{ $visita->fecha_hora_inicio }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Hora Fin:</strong>
                                    {{ $visita->fecha_hora_fin }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
