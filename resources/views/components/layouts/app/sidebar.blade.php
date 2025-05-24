<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')

</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
            <x-app-logo />
        </a>

        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Platform')" class="grid">
                <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')"
                    wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>

                <flux:navlist.item icon="academic-cap" :href="route('especialidads.index')"
                    :current="request()-> routeIs('especialidads.*')" wire:navigate>{{ __('Especialidad') }}
                </flux:navlist.item>

                <flux:navlist.item icon="user-circle" :href="route('profesionals.index')"
                    :current="request()-> routeIs('profesionals.*')" wire:navigate>{{ __('Profesionales') }}
                </flux:navlist.item>

                <flux:navlist.item icon="user-group" :href="route('pacientes.index')"
                    :current="request()-> routeIs('pacientes.*')" wire:navigate>{{ __('Pacientes') }}</flux:navlist.item>

                <flux:navlist.item icon="pencil-square" :href="route('consentimientos.index')"
                    :current="request()-> routeIs('consentimientos.*')" wire:navigate>{{ __('Concentimiento') }}
                </flux:navlist.item>

                <!-- <flux:navlist.item icon="document-currency-euro" :href="route('facturas.create')" :current="request()->routeIs('factura.*')" wire:navigate>{{ __('Facturas') }}</flux:navlist.item>

                    <flux:navlist.item icon="document-currency-euro" :href="route('facturas.index')" :current="request()->routeIs('factura.*')" wire:navigate>{{ __('Lista de Facturas') }}</flux:navlist.item>
                   -->






                   <flux:dropdown>
                    <flux:profile name="Facturación"  icon-trailing="chevrons-up-down" />
                    <flux:menu>
                        <flux:menu.radio.group>

                    <flux:navlist.item  icon="document-currency-euro" :href="route('facturas.create')"
                        :current="request()->routeIs('facturas.*')" wire:navigate>{{ __('Crear Factura') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="document-currency-euro" :href="route('facturas.index')"
                        :current="request()->routeIs('facturas.*')" wire:navigate>{{ __('Lista de Facturas') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="document-currency-euro" :href="route('facturas.listado')"
                        :current="request()->routeIs('facturas.*')" wire:navigate>{{ __('Listados') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="document-currency-euro" :href="route('servicios.index')"
                        :current="request()->routeIs('servicios.*')" wire:navigate>{{ __('Servicios') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="document-currency-euro" :href="route('gastos.index')"
                        :current="request()->routeIs('gastos.*')" wire:navigate>{{ __('Gastos') }}
                    </flux:navlist.item>
                </flux:menu.radio.group>
            </flux:menu>
        </flux:dropdown>


              <!--  <flux:menu.item icon="users" :href="route('agenda')" :current="request()->routeIs('cita.*')" wire:navigate>{{ __('Agenda Completa') }}</flux:menu.radio>-->
                    <flux:menu.item icon="document-text" :href="route('grupo')" :current="request()->routeIs('grupo')" wire:navigate>{{ __('Agenda') }} </flux:menu.radio>



                        <!--  <flux:navlist.item icon="shield-check" :href="route('roles-permissions')" :current="request()->routeIs('roles-permissions.*')" wire:navigate>{{ __('Roles & Permissions') }}</flux:navlist.item> -->
                        @role('Administrador')
                            <flux:dropdown>
                                <flux:profile name="Administrador"  icon-trailing="chevrons-up-down" />
                                <flux:menu>
                                    <flux:menu.radio.group>
                                        <flux:navlist.item icon="users" :href="route('users.index')"
                                            :current="request()->routeIs('users.*')" wire:navigate>{{ __('Users') }}
                                        </flux:navlist.item>
                                    </flux:menu.radio.group>
                                    <flux:menu.radio.group>
                                        <flux:navlist.item icon="users" :href="route('clinicas.index')"
                                            :current="request()->routeIs('clinicas.*')" wire:navigate>{{ __('Clinicas') }}
                                        </flux:navlist.item>
                                    </flux:menu.radio.group>
                                    <flux:menu.radio.group>
                                        <flux:navlist.item icon="shield-check" :href="route('roles-permissions')"
                                            :current="request()->routeIs('roles-permissions.*')" wire:navigate>
                                            {{ __('Roles & Permissions') }}</flux:navlist.item>
                                    </flux:menu.radio.group>
                                </flux:menu>
                            </flux:dropdown>
                        @endrole


            </flux:navlist.group>
        </flux:navlist>

    <flux:spacer/>

        <flux:navlist variant="outline">

        <!-- -- Settings -->

        </flux:navlist>

        <!-- Desktop User Menu -->
        <flux:dropdown position="bottom" align="start">
            <flux:profile :name="auth()->user()->name" :initials="auth()->user()->initials()"
                icon-trailing="chevrons-up-down" />

            <flux:menu class="w-[220px]">
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                        {{ __('Settings') }}</flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>

    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />



            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                        {{ __('Settings') }}</flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @fluxScripts
</body>

</html>
