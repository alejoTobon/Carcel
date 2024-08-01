@extends('layouts.app')

@section('content')
<h1>Historial de Visitas de {{ $prisionero->nombre_completo }}</h1>

<table>
    <thead>
        <tr>
            <th>Visitante</th>
            <th>Fecha/Hora de Visita</th>
            <th>Guardia</th>
        </tr>
    </thead>
    <tbody>
        @foreach($prisionero->visitas as $visita)
        <tr>
            <td>{{ $visita->visitante->nombre_completo }}</td>
            <td>{{ $visita->fecha_hora_inicio }}</td>
            <td>{{ $visita->guardia->nombre_completo }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
