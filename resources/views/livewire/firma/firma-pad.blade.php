<div wire:ignore class="p-4">

    

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-4">Firma Digital</h2>
        
        <canvas 
            id="firmaCanvas"
            class="w-full border-2 border-gray-300 rounded-md bg-white"
            style="height: 250px; touch-action: none;">
        </canvas>
        
        <div class="mt-4 flex gap-2">
            <button id="btnGuardar" class="px-4 py-2 bg-blue-600 text-white rounded-md">
                Guardar Firma
            </button>
            <button id="btnLimpiar" class="px-4 py-2 bg-gray-500 text-white rounded-md">
                Limpiar
            </button>
            <div wire:key="firma-{{ time() }}">
    {!! $firmaSvg ?? '<p>No hay firma guardada</p>' !!}
</div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Configuración del canvas
    const canvas = document.getElementById('firmaCanvas');
    const ctx = canvas.getContext('2d');
    
    // 2. Ajustar tamaño real del canvas
    function resizeCanvas() {
        const ratio = window.devicePixelRatio || 1;
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        ctx.scale(ratio, ratio);
        ctx.lineWidth = 2;
        ctx.lineCap = 'round';
        ctx.strokeStyle = '#000000';
    }
    resizeCanvas();
    window.addEventListener('resize', resizeCanvas);

    // 3. Lógica de dibujo manual (sin dependencias)
    let isDrawing = false;
    let lastX = 0;
    let lastY = 0;

    canvas.addEventListener('mousedown', startDrawing);
    canvas.addEventListener('touchstart', handleTouchStart);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('touchmove', handleTouchMove);
    canvas.addEventListener('mouseup', stopDrawing);
    canvas.addEventListener('touchend', stopDrawing);
    canvas.addEventListener('mouseout', stopDrawing);

    function startDrawing(e) {
        isDrawing = true;
        [lastX, lastY] = getPosition(e);
    }

    function draw(e) {
        if (!isDrawing) return;
        const [x, y] = getPosition(e);
        
        ctx.beginPath();
        ctx.moveTo(lastX, lastY);
        ctx.lineTo(x, y);
        ctx.stroke();
        
        [lastX, lastY] = [x, y];
    }

    function stopDrawing() {
        isDrawing = false;
    }

    function handleTouchStart(e) {
        e.preventDefault();
        const touch = e.touches[0];
        startDrawing(touch);
    }

    function handleTouchMove(e) {
        e.preventDefault();
        const touch = e.touches[0];
        draw(touch);
    }

    function getPosition(e) {
        const rect = canvas.getBoundingClientRect();
        return [
            e.clientX - rect.left,
            e.clientY - rect.top
        ];
    }

    // 4. Botones funcionales
    document.getElementById('btnLimpiar').addEventListener('click', function() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    });

    document.getElementById('btnGuardar').addEventListener('click', function() {
        const dataUrl = canvas.toDataURL('image/png');
        const svg = `<svg xmlns="http://www.w3.org/2000/svg" width="${canvas.width}" height="${canvas.height}">
                        <image href="${dataUrl}" width="100%" height="100%"/>
                    </svg>`;
        
        // Enviar a Livewire
        console.log('Firma SVG:', svg);
        @this.set('firmaSvg', svg, true);
        // Opción 1 (Livewire 3):
    Livewire.dispatch('firma-guardada', {svg: svg});
    
    // Opción 2 (alternativa):
    @this.call('guardarFirma', svg);
    });
});
</script>