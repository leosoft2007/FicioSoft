{{-- filepath: resources/views/components/layouts/app/sidebar/_nav_platform.blade.php --}}
<flux:navlist variant="outline">
    <flux:navlist.group :heading="__('Platform')" class="grid">
        <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
            {{ __('Dashboard') }}
        </flux:navlist.item>
        <flux:navlist.item icon="academic-cap" :href="route('especialidads.index')" :current="request()->routeIs('especialidads.*')" wire:navigate>
            {{ __('Especialidad') }}
        </flux:navlist.item>
        <flux:navlist.item icon="user-circle" :href="route('profesionals.index')" :current="request()->routeIs('profesionals.*')" wire:navigate>
            {{ __('Profesionales') }}
        </flux:navlist.item>
        <flux:navlist.item icon="user-group" :href="route('pacientes.index')" :current="request()->routeIs('pacientes.*')" wire:navigate>
            {{ __('Pacientes') }}
        </flux:navlist.item>
        <flux:navlist.item icon="pencil-square" :href="route('consentimientos.index')" :current="request()->routeIs('consentimientos.*')" wire:navigate>
            {{ __('Consentimiento') }}
        </flux:navlist.item>
    </flux:navlist.group>
</flux:navlist>
