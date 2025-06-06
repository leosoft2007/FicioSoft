<section class="w-full">


    <x-page-header
    title="{{ __('Especialidads') }}"
    subtitle="Actualizar {{ __('Especialidads') }} existente"
    color="purple"/>

    <livewire:component.form-plus
    mode="edit"
    :model-class="\App\Models\Especialidad::class"
    :fields="$fields"
    :id="$especialidad->id ?? null"
    :columns="1"
    redirect-route="especialidads.index"
    header-color="indigo"
    :validation-messages="$validationMessages"
    />
</section>
