<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firma Digital</title>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <title>@yield('title', 'Aplicación')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <style>
        .signature-container {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        #firmaCanvas {
            transition: all 0.3s ease;
        }
        #firmaCanvas:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Firma Digital</h1>
            <p class="text-gray-600">Por favor firme en el área designada</p>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg">
            <!-- Canvas Container -->
            <div class="signature-container p-6 border-b border-gray-200">
                <div class="mb-4 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-700">Área de Firma</h2>
                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">Tamaño completo</span>
                </div>
                
                <div class="relative">
                    <canvas 
                        id="firmaCanvas"
                        class="w-full h-64 bg-white border-2 border-dashed border-gray-300 rounded-lg cursor-crosshair"
                    ></canvas>
                    <div id="placeholder" class="absolute inset-0 flex items-center justify-center pointer-events-none">
                        <p class="text-gray-400 italic">Dibuje su firma aquí</p>
                    </div>
                </div>
            </div>

            <!-- Actions Panel -->
            <div class="bg-gray-50 px-6 py-4">
                <form action="{{ route('consentimiento.store', [$paciente, $consentimientos]) }}" method="POST" id="firmaForm">
                    @csrf
                    <input type="hidden" name="firma" id="firmaSVGInput">
                    <input type="hidden" name="firma_png" id="firmaPNGInput">
                    
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div class="flex gap-2">
                            <button type="button" id="btnLimpiar" 
                                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                Limpiar
                            </button>
                        </div>
                        
                        <button type="submit" id="btnGuardar" 
                                class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2 shadow-md hover:shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Guardar Firma
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Firmas Guardadas -->
        @if(isset($firmas) && count($firmas) > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Firmas Registradas
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($firmas as $firma)
                <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow">
                    <div class="p-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="font-medium text-gray-700">Firma #{{ $loop->iteration }}</h3>
                        <p class="text-sm text-gray-500">{{ $firma->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="p-4 flex justify-center">
                        @if($firma->firma_png)
                            <img src="{{ $firma->firma_png }}" alt="Firma en PNG" class="max-w-xs">
                        @else
                            <div class="svg-container max-w-xs">
                                {!! $firma->firma !!}
                            </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const canvas = document.getElementById('firmaCanvas');
            
            // Configuración optimizada del SignaturePad
            const signaturePad = new SignaturePad(canvas, {
                backgroundColor: 'rgba(255, 255, 255, 0)',
                penColor: '#374151',
                minWidth: 0.5,
                maxWidth: 1.5,
                velocityFilterWeight: 0.7,
                throttle: 20,
                minDistance: 3
            });

            // Placeholder management
            const placeholder = document.getElementById('placeholder');
            canvas.addEventListener('pointerdown', () => {
                placeholder.classList.add('hidden');
            });

            // Responsive canvas
            function resizeCanvas() {
                const ratio = Math.max(window.devicePixelRatio || 1, 1);
                const width = canvas.offsetWidth;
                const height = canvas.offsetHeight;
                
                canvas.width = width * ratio;
                canvas.height = height * ratio;
                canvas.getContext('2d').scale(ratio, ratio);
                signaturePad.clear();
            }
            window.addEventListener('resize', resizeCanvas);
            resizeCanvas();

            // Clear button
            document.getElementById('btnLimpiar').addEventListener('click', () => {
                signaturePad.clear();
                placeholder.classList.remove('hidden');
            });

            // Smooth path function
            function smoothPath(points, tension = 0.5) {
                if (points.length < 3) return points;

                let d = `M ${points[0].x},${points[0].y} `;

                for (let i = 1; i < points.length - 1; i++) {
                    const p0 = points[i - 1];
                    const p1 = points[i];
                    const p2 = points[i + 1];

                    const controlX = p1.x + (p2.x - p0.x) * tension / 6;
                    const controlY = p1.y + (p2.y - p0.y) * tension / 6;

                    d += `Q ${controlX},${controlY} ${p2.x},${p2.y} `;
                }

                return d.trim();
            }

            // Form submission - Generación de SVG y PNG
            document.getElementById('firmaForm').addEventListener('submit', async (e) => {
                if (signaturePad.isEmpty()) {
                    e.preventDefault();
                    alert('Por favor dibuje su firma primero');
                    return;
                }

                // Generar SVG
                const signatureData = signaturePad.toData();
                let svgPaths = '';
                
                signatureData.forEach(stroke => {
                    if (stroke.points.length === 0) return;
                    let path = smoothPath(stroke.points, 0.5);
                    const strokeWidth = stroke.penWidth || 1.5;
                    svgPaths += `<path d="${path}" fill="none" stroke="#374151" stroke-width="${strokeWidth}" stroke-linecap="round" stroke-linejoin="round"/>`;
                });

                const svg = `
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         width="${canvas.offsetWidth}" 
                         height="${canvas.offsetHeight}"
                         viewBox="0 0 ${canvas.width} ${canvas.height}">
                        ${svgPaths}
                    </svg>
                `;
                
                document.getElementById('firmaSVGInput').value = svg;

                // Generar PNG
                const pngData = await canvasToPNG(canvas);
                document.getElementById('firmaPNGInput').value = pngData;
            });

            // Función para convertir canvas a PNG (base64)
            function canvasToPNG(canvasElement) {
                return new Promise((resolve) => {
                    // Crear un canvas temporal para limpiar el fondo
                    const tempCanvas = document.createElement('canvas');
                    tempCanvas.width = canvasElement.width;
                    tempCanvas.height = canvasElement.height;
                    const ctx = tempCanvas.getContext('2d');
                    
                    // Rellenar con fondo blanco
                    ctx.fillStyle = '#ffffff';
                    ctx.fillRect(0, 0, tempCanvas.width, tempCanvas.height);
                    
                    // Dibujar la firma
                    ctx.drawImage(canvasElement, 0, 0);
                    
                    // Convertir a PNG
                    const pngData = tempCanvas.toDataURL('image/png');
                    resolve(pngData);
                });
            }
        });
    </script>
</body>
</html>