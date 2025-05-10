<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consentimiento Informado</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            color: #333;
            line-height: 1.6;
            margin: 40px;
        }
        h1, h3, h4 {
            color: #111;
            margin-bottom: 10px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .content {
            margin-bottom: 40px;
        }
        .firma-container {
            margin-top: 40px;
            border-top: 1px solid #000;
            padding-top: 20px;
            text-align: right;
                }
        .firma-svg-container {
            margin: 20px 0;
            min-height: 100px;
            border: 1px solid #ccc;
            padding: 10px;
        }
        .metadata {
            font-size: 13px;
            color: #444;
            margin-top: 40px;
            border-top: 1px dashed #ccc;
            padding-top: 20px;
        }
        .dispositivo-info {
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 5px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Consentimiento Informado</h1>
        <p><strong>ID Documento:</strong> {{ $id ?? 'N/A' }}</p>
        <p><strong>Fecha de firma:</strong> {{ $fecha }}</p>
    </div>

    <!-- Contenido del documento -->
    <div class="content">
        {!! $contenido !!}
    </div>

    <!-- Sección de firma -->
    <div class="firma-container">
        <h3>Firma del paciente</h3>
        
      
            <?php
                $base64Svg = base64_encode($firma);
            ?>
                <img src="data:image/svg+xml;base64,{{ $base64Svg }}" alt="Firma SVG" style="width: 300px" />
    </div>
         
            <div style="text-align: center; margin-top: 70px;">
                {{-- Inserta el SVG inline --}}
                <img src="data:image/svg+xml;base64,{{ $qrSvg }}" 
                     alt="QR Factura" 
                     style="width: 120px; height: 120px;" />
                    
            </div>
        

    

    <!-- Metadatos -->
    <div class="metadata">
        <h4>Datos del Paciente</h4>
        <p><strong>Nombre:</strong> {{ $paciente }} {{ $apellido }}</p>
        <p><strong>DNI:</strong> {{ $dni }}</p>
        <p><strong>Email:</strong> {{ $email }}</p>

    </div>

    {{-- JavaScript para convertir SVG a JPG --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const svgElement = document.querySelector(".firma-svg-container svg");
            if (svgElement) {
                function svgToJpg(svgElement, callback) {
                    const svgData = new XMLSerializer().serializeToString(svgElement);
                    const svgBlob = new Blob([svgData], {type: "image/svg+xml;charset=utf-8"});
                    const url = URL.createObjectURL(svgBlob);

                    const img = new Image();
                    img.onload = function () {
                        URL.revokeObjectURL(url);
                        const canvas = document.createElement("canvas");
                        canvas.width = img.width;
                        canvas.height = img.height;
                        const ctx = canvas.getContext("2d");

                        // Fondo blanco porque JPG no soporta transparencia
                        ctx.fillStyle = "#FFFFFF";
                        ctx.fillRect(0, 0, canvas.width, canvas.height);

                        // Dibujar la imagen SVG en el canvas
                        ctx.drawImage(img, 0, 0);

                        // Convertir a formato JPG (compresión ajustable)
                        const jpgData = canvas.toDataURL("image/jpeg", 0.9); // 90% calidad
                        callback(jpgData);
                    };
                    img.src = url;
                }

                svgToJpg(svgElement, function (jpgData) {
                    const imgElement = document.createElement("img");
                    imgElement.src = jpgData;
                    imgElement.alt = "Firma convertida a JPG";
                    imgElement.style.height = "150px";
                    svgElement.replaceWith(imgElement); // Sustitución del SVG por la imagen en la vista
                });
            }
        });
    </script>
</body>
</html>
