<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte de Asistencias</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .header img { height: 80px; }
        .title { font-size: 18px; font-weight: bold; text-align: center; margin: 10px 0; }
        .info { margin-bottom: 15px; }
        .info table { width: 100%; border-collapse: collapse; }
        .info td { padding: 5px; border: 1px solid #ddd; }
        .info .label { font-weight: bold; width: 30%; background: #f5f5f5; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #3498db; color: white; }
        .footer { margin-top: 20px; text-align: center; font-size: 12px; color: #777; }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            border: none;
        }
        .header-table td {
            vertical-align: middle;
            padding: 5px;
            border: none;
            text-align: center;
            font-weight: bold;
        }
        .header-table img {
            max-height: 2cm;
            width: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <table class="header-table">
            <tr>
                <td style="width: 20%; text-align: left;">
                    <img src="{{ public_path('img/UNAM.png') }}" alt="Logo 1">
                </td>
                <td style="width: 60%; text-align: center;">
                    <h2>UNIVERSIDAD NACIONAL DE MOQUEGUA – UNAM</h2>
                    <h3>GIMNASIO</h3>
                </td>
                <td style="width: 20%; text-align: right;">
                    <img src="{{ public_path('img/GYM.png') }}" alt="Logo 2">
                </td>
            </tr>
        </table>
        <h3>Reporte de Asistencias</h3>
    </div>

    <div class="info">
        <table>
            <tr>
                <td class="label">Fecha de generación:</td>
                <td>{{ now()->format('d/m/Y H:i') }}</td>
            </tr>
            @if($estudiante)
            <tr>
                <td class="label">Estudiante:</td>
                <td>{{ $estudiante->nombre }} {{ $estudiante->apellido }}</td>
            </tr>
            @endif
            @if($escuela)
            <tr>
                <td class="label">Escuela:</td>
                <td>{{ $escuela->escuela }}</td>
            </tr>
            @endif
            @if($semestre)
            <tr>
                <td class="label">Semestre:</td>
                <td>{{ $semestre->semestre }}</td>
            </tr>
            @endif
            <tr>
                <td class="label">Periodo:</td>
                <td>
                    @if(count($meses) > 0)
                        {{ implode(', ', $meses) }} {{ count($años) > 0 ? implode(', ', $años) : '' }}
                    @else
                        Todas las fechas
                    @endif
                </td>
            </tr>
            <tr>
                <td class="label">Total registros:</td>
                <td>{{ count($movimientos) }}</td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Fecha y Hora</th>
                <th>Estudiante</th>
                <th>Escuela</th>
                <th>Semestre</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movimientos as $mov)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $mov->fecha_hora->format('d/m/Y H:i') }}</td>
                <td>{{ $mov->estudiante->nombre }} {{ $mov->estudiante->apellido }}</td>
                <td>{{ $mov->estudiante->escuela_profesional }}</td>
                <td>{{ $mov->semestre_academico }}</td>
                <td style="color: {{ $mov->tipo === 'entrada' ? 'green' : 'red' }};">
                    {{ ucfirst($mov->tipo) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Sistema de Gestión de Asistencias - UNAM &copy; {{ date('Y') }}</p>
    </div>
</body>
</html>