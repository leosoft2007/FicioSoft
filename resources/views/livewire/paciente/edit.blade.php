<section class="w-full">
    <x-page-header title="Pacientes" subtitle="Actualizar paciente" color="green"/>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="sm:flex sm:items-center justify-between mb-6">
                    <div>
                        <flux:heading size="lg">Editar Paciente</flux:heading>
                    </div>
                    <div>
                        <flux:button variant="primary" :href="route('pacientes.index')">{{ __('Volver') }}</flux:button>
                    </div>
                </div>

                <div class="mt-6 max-w-4xl mx-auto">
                    <form method="POST" wire:submit="save" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        @include('livewire.paciente.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>