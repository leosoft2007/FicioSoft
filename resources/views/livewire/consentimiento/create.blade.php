<section class="w-full">


    <x-page-header
    title="{{ __('Consentimientos') }}"
    subtitle="Nuevo {{ __('Consentimiento') }}"
    color="pink"
    :clickable="true"
    badge="Nuevo"
    icon="check"
    footer="Texto de pie"
    wire:key="factura-filtros"
    >
    </x-page-header>

    <livewire:component.form-plus
    mode="create"
    :model-class="\App\Models\Consentimiento::class"
    :fields="$fields"
    :id="$consentimiento->id ?? null"
    :columns="1"
    redirect-route="consentimientos.index"
    header-color="indigo"
    :validation-messages="$validationMessages"
    />

</section>



