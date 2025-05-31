<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura {{ $factura->numero_factura }}</title>

        <div>
          <!--  <img src="{{ url('storage/logos/mi_logo.png') }}" class="logo"> -->
        </div>



    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #333;
            margin: 20px;
        }

        h2 {
            text-align: center;
            color: #0d47a1;
        }

        .section {
            margin-bottom: 20px;
        }

        .info-box {
            background-color: #e3f2fd;
            border: 1px solid #90caf9;
            padding: 10px;
            border-radius: 6px;
            width: 45%;
            float: left;
            box-sizing: border-box;
        }
        .infobox2 {
            background-color: #e3f2fd;
            border: 1px solid #90caf9;
            padding: 10px;
            border-radius: 6px;
            width: 96%;
            float: center;
            margin-top: 10px;
            box-sizing: border-box;
        }

        .info-box:nth-child(2) {
            float: right;
        }

        .clearfix {
            clear: both;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 11px;
            border-radius: 4px;
        }

        th {
            background-color: #1976d2;
            color: #fff;
            padding: 8px;
            text-align: left;
        }

        td {
            border: 1px solid #ccc;
            padding: 6px;
        }

        .text-right {
            text-align: right;
        }

        .total-row {
            background-color: #e3f2fd;
            font-weight: bold;
        }

        .summary {
            margin-top: 20px;
            float: right;
            width: 50%;
        }

        .summary table td {
            border: none;
            padding: 4px 8px;
        }
    </style>
</head>
<body>
    <div>
    <h2>Factura #{{ $factura->numero_factura }}</h2>
    </div>

    {{-- Información --}}
    <div class="section">
        <div class="info-box">
            <strong>Paciente:</strong><br>
            {{ $factura->paciente->nombre }} {{ $factura->paciente->apellido ?? '' }}<br>
            Fecha: {{ $factura->fecha }}<br>
            Método de Pago: {{ ucfirst($factura->metodo_pago) }}
        </div>

        <div class="info-box">
            <strong>Clínica:</strong><br>
            {{ $factura->clinica->nombre }}<br>
            NIF: {{ $factura->clinica->nif ?? 'N/A' }}<br>
        </div>

        <div class="clearfix"></div>
    </div>

    {{-- Tabla de servicios --}}
    <table>
        <thead>
            <tr>
                <th class="text-right">Cantidad</th>
                <th>Descripción</th>
                <th class="text-right">Precio Unitario</th>
                <th class="text-right">IVA</th>
                <th class="text-right">Subtotal</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $subtotal = 0;
                $ivaTotal = 0;
            @endphp

            @foreach($factura->detalles as $item)
                @php
                    $subtotal += $item->subtotal;
                    $ivaTotal += $item->iva;
                @endphp
                <tr>
                    <td class="text-right">{{ $item->cantidad }}</td>
                    <td>{{ $item->descripcion }}</td>
                    <td class="text-right">€{{ number_format($item->precio_unitario, 2) }}</td>
                    <td class="text-right">€{{ number_format($item->iva, 2) }}</td>
                    <td class="text-right">€{{ number_format($item->subtotal, 2) }}</td>
                    <td class="text-right">€{{ number_format($item->total, 2) }}</td>
                </tr>
            @endforeach

            <tr class="total-row">
                <td colspan="4" class="text-right">Subtotal sin IVA:</td>
                <td colspan="2" class="text-right">€{{ number_format($subtotal, 2) }}</td>
            </tr>
            <tr class="total-row">
                <td colspan="4" class="text-right">Total IVA:</td>
                <td colspan="2" class="text-right">€{{ number_format($ivaTotal, 2) }}</td>
            </tr>
            <tr class="total-row">
                <td colspan="4" class="text-right">Total con IVA:</td>
                <td colspan="2" class="text-right">€{{ number_format($subtotal + $ivaTotal, 2) }}</td>
            </tr>
        </tbody>
    </table>
    <div class="infobox2">
        <strong>Comentarios:</strong><br>
        {{ $factura->descripcion }}<br>
    </div>


    <div style="text-align: center; margin-top: 70px;">
        {{-- Inserta el SVG inline --}}
        <img src="data:image/svg+xml;base64,{{ $qrSvg }}"
             alt="QR Factura"
             style="width: 120px; height: 120px;" />

    </div>
</body>
</html>

