<section class="w-full">
    <x-page-header
        title="{{ __('Editar Profesional') }}"
        subtitle="Actualizar los datos del profesional"
        color="blue"
    />

    <livewire:component.form-plus
    mode="edit"
    :model-class="\App\Models\Profesional::class"
    :fields="$fields"
    :id="$profesional->id ?? null"
    :columns="2"
    redirect-route="profesionals.index"
    :validation-messages="$validationMessages"
    />
</section>
