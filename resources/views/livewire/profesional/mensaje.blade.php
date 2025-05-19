<div>
    <!-- Mensaje Dinámico -->
    <div x-data="{ show: false }"
         x-init="$watch(() => $wire.mensaje, value => {
            if (value) {
                show = true;
                setTimeout(() => show = false, 4000);
            }
         })"
         x-show="show"
         x-transition
         class="fixed top-6 right-6 max-w-md w-auto px-6 py-4 rounded-xl shadow-2xl z-50"
         :class="{
            'bg-green-100 border-green-400 text-green-900': $wire.color === 'green',
            'bg-red-100 border-red-400 text-red-900': $wire.color === 'red',
            'bg-yellow-100 border-yellow-400 text-yellow-900': $wire.color === 'yellow',
         }">
        <span x-text="$wire.mensaje"></span>
    </div>
</div>
