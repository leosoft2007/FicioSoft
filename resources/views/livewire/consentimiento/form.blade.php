<div class="space-y-6">
    
    <div>
        <flux:input wire:model="form.titulo" :label="__('Titulo')" type="text"  autocomplete="form.titulo" placeholder="Titulo"/>
    </div>
    
    <div>
        <textarea 
            wire:model="form.contenido" 
            id="hidden-textarea" 
            style="display: none;"
        ></textarea>
        
        <div 
            id="editor" 
            contenteditable="true" 
            style="border: 1px solid #ccc; min-height: 200px; padding: 10px;"
        >@php echo $form->contenido ?? '¡Escribe aquí! <b>Texto en negrita</b>, <i>itálica</i>, etc.' @endphp</div>
    </div>
    
    <script>
        document.getElementById('editor').addEventListener('input', function(e) {
            document.getElementById('hidden-textarea').value = e.target.innerHTML;
            // Forzar actualización de Livewire
            @this.set('form.contenido', e.target.innerHTML);
        });
    </script>
    
    <div>
        <flux:input wire:model="form.tipo" :label="__('Tipo')" type="text"  autocomplete="form.tipo" placeholder="Tipo"/>
    </div>

    <div class="flex items-center gap-4">
        <flux:button variant="primary" type="submit">{{ __('Submit') }}</flux:button>
    </div>
</div>

