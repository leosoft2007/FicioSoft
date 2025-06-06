<section class="w-full">


    <x-page-header
    title="{{ __('Consentimientos') }}"
    subtitle="Lista de  {{ __('Consentimientos') }}"
    color="blue"
    :clickable="true"
    badge="Nuevo"
    icon="check"
    footer="Texto de pie"
    wire:key="factura-filtros"
    >
    </x-page-header>


    <livewire:component.table-plus
    :model-class="\App\Models\Consentimiento::class"
    :columns="$columnsConsentimiento"
    add-route="{{ route('consentimientos.create') }}" title="Lista de Consentimientos"
    routeShow="consentimientos.show"
    routeEdit="consentimientos.edit"
    :delete="true"
    :showExportExcel="false"
    :showExportPdf="false"
    estilo="purple"

/>
</section>
