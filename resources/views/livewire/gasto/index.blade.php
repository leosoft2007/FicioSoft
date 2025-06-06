<section class="w-full bg-white">
    <section class="w-full">
        <x-page-header title="Gestión de Gastos" subtitle="Listado completo de gastos" color="orange"></x-page-header>



        <livewire:component.table-plus
        :model-class="\App\Models\Gasto::class"
        :columns="$columnsGastos"
        add-route="{{ route('gastos.create') }}" title="Lista de Gastos"
        routeShow="gastos.show"
        routeEdit="gastos.edit"
        :delete="false"
        :showExportExcel="true"
        :showExportPdf="true"
        estilo="amarillo"

    />


    </section>
