<!-- filepath: c:\xampp\htdocs\lara12\resources\views\livewire\especialidad\index.blade.php -->
<section class="w-full">
    <x-page-header
        title="Gestión de Especialidades"
        subtitle="Listado completo de especialidades médicas"
        color="purple"
    >
        <div class="flex items-center gap-2">
            <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
            </svg>
            <span class="font-medium">{{ $especialidads }} especialidades registradas</span>
        </div>
    </x-page-header>



    <livewire:component.table-plus
    :model-class="\App\Models\Especialidad::class"
    :columns="$columnsEspecialidad"
    add-route="{{ route('especialidads.create') }}" title="Lista de Especialidades"
    routeShow="especialidads.show"
    routeEdit="especialidads.edit"
    :delete="true"
    :showExportExcel="false"
    :showExportPdf="false"
    estilo="verde"

/>
</section>
