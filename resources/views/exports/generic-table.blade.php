<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte - {{ now()->format('d/m/Y') }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10px;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 10px;
        }

        .title {
            color: #2c3e50;
            font-size: 18px;
            font-weight: bold;
        }

        .info {
            text-align: right;
            font-size: 9px;
            color: #666;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        th {
            background-color: #3498db;
            color: white;
            text-align: left;
            padding: 8px 10px;
            font-weight: bold;
        }

        td {
            border: 1px solid #ddd;
            padding: 6px 10px;
            vertical-align: top;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 8px;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 5px;
        }

        .chart-container {
            margin: 15px 0;
            border: 1px solid #eee;
            padding: 10px;
            background: #f9f9f9;
        }

        .chart-title {
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #2c3e50;
        }
    </style>
</head>

<body>
    <div class="header">
        <div>
            <div class="title">Reporte de Listado</div>
            <div>Generado el: {{ now()->format('d/m/Y H:i') }}</div>
        </div>
        <div class="info">
            <svg width="80" height="40" viewBox="0 0 100 50" xmlns="http://www.w3.org/2000/svg">
                <rect x="5" y="5" width="90" height="40" rx="3" fill="#f8f9fa" stroke="#3498db"
                    stroke-width="1" />
                <path d="M15,15 L85,15 M15,25 L85,25 M15,35 L85,35" stroke="#3498db" stroke-width="1.5" />
                <circle cx="30" cy="15" r="3" fill="#e74c3c" />
                <circle cx="30" cy="25" r="3" fill="#2ecc71" />
                <circle cx="30" cy="35" r="3" fill="#3498db" />
                <text x="40" y="18" font-family="Arial" font-size="8" fill="#333">Total registros:
                    {{ count($data) }}</text>
                <text x="40" y="28" font-family="Arial" font-size="8" fill="#333">Fecha generación</text>
                <text x="40" y="38" font-family="Arial" font-size="8"
                    fill="#333">{{ now()->format('d/m/Y') }}</text>
            </svg>
        </div>
    </div>

    <!-- Gráfico SVG de resumen -->


    <table>
        <thead>
            <tr>
                @foreach ($columns as $column)
                    <th>{{ $column['label'] }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $item)
                <tr>
                    @foreach ($columns as $column)
                        @php
                            $value = data_get($item, $column['field']);
                        @endphp
                        <td>
                            @if($loop->first)
                                <span style="color: #3498db; font-weight: bold;">{{ $index + 1 }}.</span>
                            @endif

                            @if (($column['format'] ?? null) === 'date' && !empty($value))
                                {{ \Carbon\Carbon::parse($value)->format('d/m/Y') }}
                            @else
                                {{ $value }}
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <svg width="60" height="20" viewBox="0 0 100 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M10,15 Q25,5 40,15 T70,15" stroke="#3498db" stroke-width="1" fill="none" />
            <text x="50" y="18" text-anchor="middle" font-family="Arial" font-size="6" fill="#777">
                Página 1 de 1 • Generado con Sistema
            </text>
        </svg>
    </div>
</body>

</html>
