{{-- filepath: resources/views/components/layouts/app/sidebar/_nav_facturacion.blade.php --}}
<flux:dropdown>
    <flux:profile name="Facturación" icon-trailing="chevrons-up-down" />
    <flux:menu>
        <flux:menu.radio.group>
            <flux:navlist.item icon="document-currency-euro" :href="route('facturas.create')" :current="request()->routeIs('facturas.*')" wire:navigate>
                {{ __('Crear Factura') }}
            </flux:navlist.item>
            <flux:navlist.item icon="document-currency-euro" :href="route('facturas.index')" :current="request()->routeIs('facturas.*')" wire:navigate>
                {{ __('Lista de Facturas') }}
            </flux:navlist.item>
            <flux:navlist.item icon="document-currency-euro" :href="route('facturas.listado')" :current="request()->routeIs('facturas.*')" wire:navigate>
                {{ __('Listados') }}
            </flux:navlist.item>
            <flux:navlist.item icon="document-currency-euro" :href="route('servicios.index')" :current="request()->routeIs('servicios.*')" wire:navigate>
                {{ __('Servicios') }}
            </flux:navlist.item>
            <flux:navlist.item icon="document-currency-euro" :href="route('gastos.index')" :current="request()->routeIs('gastos.*')" wire:navigate>
                {{ __('Gastos') }}
            </flux:navlist.item>
            <flux:navlist.item icon="document-currency-euro" :href="route('recibos.index')" :current="request()->routeIs('recibos.*')" wire:navigate>
                {{ __('Recibos') }}
            </flux:navlist.item>
        </flux:menu.radio.group>
    </flux:menu>
</flux:dropdown>
