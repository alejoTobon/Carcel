<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Prisioneros</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        th, td {
            word-wrap: break-word; /* Ajusta el texto largo */
        }
    </style>
</head>
<body>
    <h1>Reporte de Prisioneros</h1>
    <p>Fecha de inicio: {{ $startDate }}</p>
    <p>Fecha de fin: {{ $endDate }}</p>
    
    <table>
        <thead>
            <tr>
                <th>ID Prisionero</th>
                <th>Nombre Completo Prisionero</th>
                <th>Nombre Visitante</th>
                <th>Fecha/Hora Visita</th>
                <th>Nombre Guardia</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prisioneros as $prisionero)
                @foreach ($prisionero->visitas as $visita)
                    <tr>
                        <td>{{ $prisionero->id }}</td>
                        <td>{{ $prisionero->nombre_completo }}</td>
                        <td>{{ $visita->visitante->nombre_completo }}</td>
                        <td>{{ $visita->fecha_hora_inicio }}</td>
                        <td>{{ $visita->guardia->nombre_completo }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>
</html>
