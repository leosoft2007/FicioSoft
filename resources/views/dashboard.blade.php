<x-layouts.app :title="__('Dashboard')">


    

    <div class="py-6">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Primera fila: Tarjetas resumidas -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <livewire:card.card-citas-hoy />
                <livewire:card.card-facturacion-mensual />
                <livewire:card.card-pacientes-nuevos />
                <livewire:card.card-profesionales-activos />
            </div>

            <!-- Segunda fila: Gráficos y listados -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <livewire:card.card-citas-por-profesional />
                <livewire:card.card-facturacion-servicios />
            </div>

            <!-- Tercera fila: Próximas Citas -->
            <livewire:card.card-proximas-citas />
        </div>
    </div>
</x-layouts.app>