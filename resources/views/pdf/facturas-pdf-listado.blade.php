<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Listado de Facturas</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .title { font-size: 18px; font-weight: bold; }
        .subtitle { font-size: 14px; margin-bottom: 10px; }
        .filters { margin-bottom: 20px; font-size: 12px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th { background-color: #f8f9fa; text-align: left; padding: 8px; border: 1px solid #dee2e6; }
        .table td { padding: 8px; border: 1px solid #dee2e6; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .footer { margin-top: 20px; font-size: 12px; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Listado de Facturas</div>
        <div class="subtitle">Clinica: {{ $clinica }}</div>
    </div>
    
    <div class="filters">
        <div><strong>Período:</strong> {{ $fechaInicio }} al {{ $fechaFin }}</div>
        @if($estado)
            <div><strong>Estado:</strong> {{ ucfirst($estado) }}</div>
        @endif
    </div>
    
    <table class="table">
        <thead>
            <tr>
                <th>N° Factura</th>
                <th>Paciente</th>
                <th>Fecha</th>
                <th class="text-right">Total</th>
                <th>Estado</th>
                <th>Método Pago</th>
            </tr>
        </thead>
        <tbody>
            @foreach($facturas as $factura)
                <tr>
                    <td>{{ $factura->numero_factura }}</td>
                    <td>{{ $factura->paciente->nombre }} {{ $factura->paciente->apellidos }}</td>
                    <td>{{ \Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') }}</td>
                    <td class="text-right">{{ number_format($factura->total, 2) }} €</td>
                    <td>{{ ucfirst($factura->estado) }}</td>
                    <td>{{ $factura->metodo_pago ? ucfirst($factura->metodo_pago) : 'No especificado' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="footer">
        Generado el {{ now()->format('d/m/Y H:i') }}
    </div>
</body>
</html>