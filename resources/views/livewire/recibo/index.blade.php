<section class="w-full bg-gradient-to-b from-indigo-50 to-white">
    <section class="w-full">
        <x-page-header title="Gestión de Recibos" subtitle="Listado completo de recibos" color="indigo">
            <div class="flex items-center gap-2 bg-indigo-100 px-4 py-2 rounded-full">
                <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-medium text-indigo-800">{{ $cantidad }} recibos registrados</span>
            </div>
        </x-page-header>


    </section>
    <livewire:component.table-plus
    :model-class="\App\Models\Profesional::class"
    :columns="$columnsProfesional"
    add-route="{{ route('profesionals.create') }}" title="Lista de Profesionales"
    routeShow="profesionals.show"
    routeEdit="profesionals.edit"
    :delete="false"
    :showExportExcel="true"
    :showExportPdf="true"

/>

    <livewire:component.table-plus
    :model-class="\App\Models\Paciente::class"
    :columns="$columnsPaciente"
    add-route="{{ route('pacientes.create') }}" title="Lista de Pacientes"
    routeShow="pacientes.show"
    routeEdit="pacientes.edit"
    :delete="false"
    :showExportExcel="true"
    :showExportPdf="true"

/>

    <livewire:component.table-plus
    :model-class="\App\Models\Recibo::class"
    :columns="$columnsRecibo"
    add-route="{{ route('recibos.create') }}" title="Recibos de Clientes"
    routeShow="recibos.show"
    routeEdit="recibos.edit"
    :delete="false"
/>
<livewire:component.table-plus
    :model-class="\App\Models\Factura::class"
    :columns="$columnsFactura"
    add-route="{{ route('facturas.create') }}" title="Lista de Facturas"
    :delete="false"
    :showExportExcel="true"
    :showExportPdf="true"

/>
</section>
