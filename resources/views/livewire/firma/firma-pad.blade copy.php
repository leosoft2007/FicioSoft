<div x-data="signaturePad()" x-init="init()" class="max-w-xl mx-auto p-4 border rounded shadow">
    <h2 class="text-xl font-bold mb-4">Dibuje su firma</h2>

    <canvas x-ref="canvas" class="w-full h-48 bg-white border rounded"></canvas>
    <input type="hidden" x-ref="input" />

    


    <button type="button"
        class="mt-4 px-4 py-2 bg-blue-600 text-white rounded"
        @click="submit()">
        Enviar
    </button>
@assets
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
@endassets
    @if (session()->has('mensaje'))
        <p class="mt-2 text-green-600">{{ session('mensaje') }}</p>
    @endif

 <script>
        function signaturePad() {
            return {
                signaturePadInstance: null,
                init() {
                    const canvas = this.$refs.canvas;
                    canvas.width = canvas.offsetWidth;
                    canvas.height = canvas.offsetHeight;
                    this.signaturePadInstance = new SignaturePad(canvas);
                },
                clear() {
                    this.signaturePadInstance.clear();
                    @this.set('firma', '');
                },
                saveToLivewire() {
                    if (!this.signaturePadInstance.isEmpty()) {
                        const canvas = this.$refs.canvas;
                        const tmpCanvas = document.createElement('canvas');
                        tmpCanvas.width = canvas.width;
                        tmpCanvas.height = canvas.height;
    
                        const tmpCtx = tmpCanvas.getContext('2d');
                        tmpCtx.fillStyle = '#FFFFFF';
                        tmpCtx.fillRect(0, 0, tmpCanvas.width, tmpCanvas.height);
                        tmpCtx.drawImage(canvas, 0, 0);
    
                        const base64 = tmpCanvas.toDataURL('image/jpeg');
                        @this.set('firma', base64);
                        alert('Firma guardada en memoria.');
                    } else {
                        alert('Por favor, dibuja la firma primero.');
                    }
                },
                submit() {
                    if (!this.signaturePadInstance.isEmpty()) {
                        const canvas = this.$refs.canvas;
                        const tmpCanvas = document.createElement('canvas');
                        tmpCanvas.width = canvas.width;
                        tmpCanvas.height = canvas.height;
    
                        const tmpCtx = tmpCanvas.getContext('2d');
                        tmpCtx.fillStyle = '#FFFFFF';
                        tmpCtx.fillRect(0, 0, tmpCanvas.width, tmpCanvas.height);
                        tmpCtx.drawImage(canvas, 0, 0);
    
                        const base64 = tmpCanvas.toDataURL('image/jpeg');
                        @this.set('firma', base64).then(() => {
                            Livewire.dispatch('guardarFirma');
                        });

                        const svg = this.signaturePadInstance.toSVG();
                        @this.set('firma', svg).then(() => {
                            Livewire.dispatch('guardarFirmaSvg');
                        });

                    } else {
                        alert('Por favor, dibuja la firma antes de enviar.');
                    }
                },
                saveToLivewireSvg() {
            if (!this.signaturePadInstance.isEmpty()) {
                const svg = this.signaturePadInstance.toSVG();
                @this.set('firma', svg);
                alert('Firma SVG guardada en memoria.');
            } else {
                alert('Por favor, dibuja la firma primero.');
            }
        }
    };
}

    </script>

    

    
</div>

