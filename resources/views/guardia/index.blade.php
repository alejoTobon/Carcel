<!-- Incluye SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                                  {{ __('Crear nuevo guardia') }}
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
                                        <th>Nombre Completo</th>
                                        <th>Numero Identificacion</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($guardias as $guardia)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $guardia->nombre_completo }}</td>
                                            <td>{{ $guardia->numero_identificacion }}</td>
                                            <td>{{ $guardia->estado }}</td>
                                            <td>
                                                <form action="{{ route('guardias.toggleStatus', $guardia->id) }}" method="POST" class="toggle-status-form">
                                                    <a class="btn btn-sm btn-primary" href="{{ route('guardias.show', $guardia->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('guardias.edit', $guardia->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="button" class="btn  {{ $guardia->estado === 'Activo' ? 'btn-danger' : 'btn-warning' }} btn-sm toggle-status-btn">
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

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Añadir evento de SweetAlert al botón de cambio de estado
        const toggleButtons = document.querySelectorAll('.toggle-status-btn');

        toggleButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                const form = this.closest('form');
                const actionText = this.textContent.trim();

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: `¿Deseas ${actionText.toLowerCase()} este guardia?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, confirmar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection
