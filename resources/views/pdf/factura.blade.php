<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Factura {{ $factura->numero_factura }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 20px;
        }

        h2 {
            text-align: center;
            color: #0d47a1;
            margin-top: 0;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .logo {
            max-width: 150px;
        }

        /* Paciente y clínica alineados */
        .info-container {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }

        .info-box {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            background-color: #f5faff;
            border: 1px solid #d0e7ff;
            padding: 10px;
            border-radius: 6px;
            box-sizing: border-box;
            min-height: 90px;
        }

        /* Tabla servicios */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 11px;
        }

        th {
            background-color: #1976d2;
            color: white;
            padding: 8px;
            text-align: left;
        }

        td {
            border: 1px solid #ddd;
            padding: 6px;
        }

        .text-right {
            text-align: right;
        }

        .total-row {
            background-color: #e3f2fd;
            font-weight: bold;
        }

        /* Resumen IVA y Totales en la misma altura */
        .summary-container {
            display: table;
            width: 100%;
            margin-top: 30px;
            table-layout: fixed;
        }

        .iva-summary,
        .totals-summary {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 8px;
            background-color: #fafafa;
            box-sizing: border-box;
        }

        @media screen and (min-width: 768px) {

            .iva-summary,
            .totals-summary {
                width: calc(50% - 10px);
            }
        }

        .iva-summary h4,
        .totals-summary h4 {
            margin-top: 0;
            margin-bottom: 10px;
            color: #0d47a1;
        }

        .comments {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 6px;
            background-color: #f9f9f9;
            margin-top: 20px;
        }

        .footer-signature {
            margin-top: 80px;
            text-align: center;
            font-style: italic;
            color: #555;
        }

        /* QR */
        .qr-code {
            display: block;
            margin: 20px auto;
            width: 120px;
            height: 120px;
        }
    </style>
</head>

<body>

    <!-- Cabecera -->
    <div class="header">
        <h2>Factura #{{ $factura->numero_factura }}</h2>
        <div><strong>Fecha:</strong> {{ $factura->fecha }}</div>
    </div>

    <!-- Información del paciente y clínica -->
    <div class="info-container">
        <div class="info-box">
            <strong>Paciente:</strong><br>
            {{ $factura->paciente->nombre_completo }}<br>
            DNI: {{ $factura->paciente->dni ?? 'N/A' }}<br>
            Dirección: {{ $factura->paciente->direccion ?? 'N/A' }}
        </div>

        <div class="info-box">
            <strong>Clínica:</strong><br>
            {{ $factura->clinica->nombre }}<br>
            NIF: {{ $factura->clinica->nif ?? 'N/A' }}<br>
            Dirección: {{ $factura->clinica->direccion ?? 'N/A' }}
        </div>
    </div>

    <!-- Tabla de servicios -->
    <table>
        <thead>
            <tr>
                <th class="text-right">Cant.</th>
                <th>Descripción</th>
                <th class="text-right">Precio U.</th>
                <th class="text-right">IVA %</th>
                <th class="text-right">IVA €</th>
                <th class="text-right">Subtotal</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $subtotal = 0;
                $resumenIva = [
                    0 => ['base' => 0, 'importe' => 0],
                    4 => ['base' => 0, 'importe' => 0],
                    10 => ['base' => 0, 'importe' => 0],
                    21 => ['base' => 0, 'importe' => 0],
                ];
            @endphp

            @foreach ($factura->detalles as $item)
                @php
                    $subtotal += $item->subtotal;
                    $porcentajeIva = $item->iva_porcentaje;

                    if (!isset($resumenIva[$porcentajeIva])) {
                        $resumenIva[$porcentajeIva] = ['base' => 0, 'importe' => 0];
                    }

                    $resumenIva[$porcentajeIva]['base'] += $item->subtotal;
                    $resumenIva[$porcentajeIva]['importe'] += $item->iva;
                @endphp
                <tr>
                    <td class="text-right">{{ $item->cantidad }}</td>
                    <td>{{ $item->descripcion }}</td>
                    <td class="text-right">€{{ number_format($item->precio_unitario, 2) }}</td>
                    <td class="text-right">{{ number_format($porcentajeIva, 0) }}%</td>
                    <td class="text-right">€{{ number_format($item->iva, 2) }}</td>
                    <td class="text-right">€{{ number_format($item->subtotal, 2) }}</td>
                    <td class="text-right">€{{ number_format($item->total, 2) }}</td>
                </tr>
            @endforeach

            <tr class="total-row">
                <td colspan="5" class="text-right">Base Imponible:</td>
                <td colspan="2" class="text-right">€{{ number_format($subtotal, 2) }}</td>
            </tr>

            @php $totalIva = array_sum(array_column($resumenIva, 'importe')); @endphp

            <tr class="total-row">
                <td colspan="5" class="text-right">Total IVA:</td>
                <td colspan="2" class="text-right">€{{ number_format($totalIva, 2) }}</td>
            </tr>

            <tr class="total-row">
                <td colspan="5" class="text-right">Total a pagar:</td>
                <td colspan="2" class="text-right">€{{ number_format($subtotal + $totalIva, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Resumen inferior -->
    <div class="summary-container">
        <!-- Resumen de IVA -->
        <div class="iva-summary">
            <h4>Resumen de IVA</h4>
            <table>
                <tr>
                    <th>Tipo de IVA</th>
                    <th class="text-right">Base Imponible</th>
                    <th class="text-right">Importe IVA</th>
                </tr>
                @foreach ($resumenIva as $porcentaje => $data)
                    @if ($data['importe'] > 0)
                        <tr>
                            <td>{{ number_format($porcentaje) }}%</td>
                            <td class="text-right">€{{ number_format($data['base'], 2) }}</td>
                            <td class="text-right">€{{ number_format($data['importe'], 2) }}</td>
                        </tr>
                    @endif
                @endforeach
            </table>
        </div>

        <!-- Totales -->
        <div class="totals-summary">
            <h4>Totales</h4>
            <table style="width: 100%;">
                <tr>
                    <td>Base Imponible:</td>
                    <td class="text-right">€{{ number_format($subtotal, 2) }}</td>
                </tr>
                <tr>
                    <td>Total IVA:</td>
                    <td class="text-right">€{{ number_format($totalIva, 2) }}</td>
                </tr>
                <tr>
                    <td><strong>Total Factura:</strong></td>
                    <td class="text-right"><strong>€{{ number_format($subtotal + $totalIva, 2) }}</strong></td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Comentarios -->
    <div class="comments">
        <strong>Observaciones:</strong><br>
        {{ $factura->descripcion ?: 'Sin observaciones.' }}
    </div>

    <!-- Firma y QR -->
    

    <div style="text-align: center; margin-top: 20px;">
        <!-- QR en SVG inline -->
        <img src="data:image/svg+xml;base64,{{ $qrSvg }}" class="qr-code" alt="QR Factura" />
    </div>

</body>

</html>
