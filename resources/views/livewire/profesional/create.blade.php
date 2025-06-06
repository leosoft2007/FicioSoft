<section class="w-full">
    <x-page-header
    title="{{ __('Profesional') }}"
    subtitle="Agregar nuevo {{ __('Profesional') }}"
    color="blue"/>

    <livewire:component.form-plus
    mode="create"
    :model-class="\App\Models\Profesional::class"
    :fields="$fields"
    :id="$profesional->id ?? null"
    :columns="2"
    redirect-route="profesionals.index"
    header-color="red"
    :validation-messages="$validationMessages"
    />

</section>
