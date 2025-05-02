<div class="space-y-6 pl-1">
    
    <div>
        <flux:input wire:model="form.nombre" :label="__('Nombre')" type="text"  autocomplete="form.nombre" placeholder="Nombre"/>
    </div>
    <div>
        <flux:input wire:model="form.apellido" :label="__('Apellido')" type="text"  autocomplete="form.apellido" placeholder="Apellido"/>
    </div>
    <div>
        <flux:input wire:model="form.email" :label="__('Email')" type="text"  autocomplete="form.email" placeholder="Email"/>
    </div>
    <div>
        <flux:input wire:model="form.telefono" :label="__('Telefono')" type="text"  autocomplete="form.telefono" placeholder="Telefono"/>
    </div>
    <div>
        <flux:input wire:model="form.fecha_nacimiento" :label="__('Fecha Nacimiento')" type="text"  autocomplete="form.fecha_nacimiento" placeholder="Fecha Nacimiento"/>
    </div>
    <div>
        <flux:input wire:model="form.direccion" :label="__('Direccion')" type="text"  autocomplete="form.direccion" placeholder="Direccion"/>
    </div>
    <div>
        <flux:input wire:model="form.ciudad" :label="__('Ciudad')" type="text"  autocomplete="form.ciudad" placeholder="Ciudad"/>
    </div>
    <div>
        <flux:input wire:model="form.estado" :label="__('Estado')" type="text"  autocomplete="form.estado" placeholder="Estado"/>
    </div>
    <div>
        <flux:input wire:model="form.codigo_postal" :label="__('Codigo Postal')" type="text"  autocomplete="form.codigo_postal" placeholder="Codigo Postal"/>
    </div>
    <div>
        <flux:input wire:model="form.pais" :label="__('Pais')" type="text"  autocomplete="form.pais" placeholder="Pais"/>
    </div>
    <div>
        <flux:input wire:model="form.genero" :label="__('Genero')" type="text"  autocomplete="form.genero" placeholder="Genero"/>
    </div>
    <div>
        <flux:input wire:model="form.estado_civil" :label="__('Estado Civil')" type="text"  autocomplete="form.estado_civil" placeholder="Estado Civil"/>
    </div>
    <div>
        <flux:input wire:model="form.ocupacion" :label="__('Ocupacion')" type="text"  autocomplete="form.ocupacion" placeholder="Ocupacion"/>
    </div>
    <div>
        <flux:input wire:model="form.nacionalidad" :label="__('Nacionalidad')" type="text"  autocomplete="form.nacionalidad" placeholder="Nacionalidad"/>
    </div>
    <div>
        <flux:input wire:model="form.tipo_documento" :label="__('Tipo Documento')" type="text"  autocomplete="form.tipo_documento" placeholder="Tipo Documento"/>
    </div>
    <div>
        <flux:input wire:model="form.numero_documento" :label="__('Numero Documento')" type="text"  autocomplete="form.numero_documento" placeholder="Numero Documento"/>
    </div>
    <div>
        <flux:input wire:model="form.telefono_emergencia" :label="__('Telefono Emergencia')" type="text"  autocomplete="form.telefono_emergencia" placeholder="Telefono Emergencia"/>
    </div>
    <div>
        <flux:input wire:model="form.nombre_contacto_emergencia" :label="__('Nombre Contacto Emergencia')" type="text"  autocomplete="form.nombre_contacto_emergencia" placeholder="Nombre Contacto Emergencia"/>
    </div>
    <div>
        <flux:input wire:model="form.alergias" :label="__('Alergias')" type="text"  autocomplete="form.alergias" placeholder="Alergias"/>
    </div>
    <div>
        <flux:input wire:model="form.medicamentos" :label="__('Medicamentos')" type="text"  autocomplete="form.medicamentos" placeholder="Medicamentos"/>
    </div>
    <div>
        <flux:input wire:model="form.historial_medico" :label="__('Historial Medico')" type="text"  autocomplete="form.historial_medico" placeholder="Historial Medico"/>
    </div>
    <div>
        <flux:input wire:model="form.notas" :label="__('Notas')" type="text"  autocomplete="form.notas" placeholder="Notas"/>
    </div>
    <div>
        <flux:input wire:model="form.foto" :label="__('Foto')" type="text"  autocomplete="form.foto" placeholder="Foto"/>
    </div>
    <div>
        <flux:input wire:model="form.estado_paciente" :label="__('Estado Paciente')" type="text"  autocomplete="form.estado_paciente" placeholder="Estado Paciente"/>
    </div>
    <div>
        <flux:input wire:model="form.tipo_paciente" :label="__('Tipo Paciente')" type="text"  autocomplete="form.tipo_paciente" placeholder="Tipo Paciente"/>
    </div>
    <div>
        <flux:input wire:model="form.referido_por" :label="__('Referido Por')" type="text"  autocomplete="form.referido_por" placeholder="Referido Por"/>
    </div>
    

    <div class="flex items-center gap-4">
        <flux:button variant="primary" type="submit">{{ __('Submit') }}</flux:button>
    </div>
</div>