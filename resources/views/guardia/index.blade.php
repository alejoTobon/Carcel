@extends('layouts.app')

@section('template_title')
    Guardias
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Guardias') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('guardias.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
									<th >Nombre Completo</th>
									<th >Numero Identificacion</th>
                                    <th >Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($guardias as $guardia)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $guardia->nombre_completo }}</td>
										<td >{{ $guardia->numero_identificacion }}</td>
                                        <td >{{ $guardia->estado }}</td>
                                            <td>
                                                <form action="{{ route('guardias.toggleStatus', $guardia->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('guardias.show', $guardia->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('guardias.edit', $guardia->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn {{ $guardia->estado === 'Activo' ? 'btn-danger' : 'btn-warning' }}" onclick="return confirm('¿Estás seguro de que deseas cambiar el estado?');">
        {{ $guardia->estado === 'Activo' ? 'Desactivar' : 'Activar' }}
    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $guardias->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
