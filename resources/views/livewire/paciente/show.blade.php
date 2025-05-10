<section class="w-full">
    <x-page-header 
    title="Paciente" 
    subtitle=""
    color="green"/>

    
    <dl class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="p-4 border rounded-lg bg-gray-50">
            <dt class="text-sm font-medium text-gray-900">Nombre</dt>
            <dd class="mt-1 text-sm text-gray-700">{{ $paciente->nombre }}</dd>
        </div>
        <div class="p-4 border rounded-lg bg-gray-50">
            <dt class="text-sm font-medium text-gray-900">Apellido</dt>
            <dd class="mt-1 text-sm text-gray-700">{{ $paciente->apellido }}</dd>
        </div>
        <div class="p-4 border rounded-lg bg-gray-50">
            <dt class="text-sm font-medium text-gray-900">Email</dt>
            <dd class="mt-1 text-sm text-gray-700">{{ $paciente->email }}</dd>
        </div>
        <div class="p-4 border rounded-lg bg-gray-50">
            <dt class="text-sm font-medium text-gray-900">Telefono</dt>
            <dd class="mt-1 text-sm text-gray-700">{{ $paciente->telefono }}</dd>
        </div>
        <div class="p-4 border rounded-lg bg-gray-50">
            <dt class="text-sm font-medium text-gray-900">Fecha Nacimiento</dt>
            <dd class="mt-1 text-sm text-gray-700">{{ $paciente->fecha_nacimiento }}</dd>
        </div>
        <div class="p-4 border rounded-lg bg-gray-50">
            <dt class="text-sm font-medium text-gray-900">Direccion</dt>
            <dd class="mt-1 text-sm text-gray-700">{{ $paciente->direccion }}</dd>
        </div>
        <div class="p-4 border rounded-lg bg-gray-50">
            <dt class="text-sm font-medium text-gray-900">Ciudad</dt>
            <dd class="mt-1 text-sm text-gray-700">{{ $paciente->ciudad }}</dd>
        </div>
        <div class="p-4 border rounded-lg bg-gray-50">
            <dt class="text-sm font-medium text-gray-900">Estado</dt>
            <dd class="mt-1 text-sm text-gray-700">{{ $paciente->estado }}</dd>
        </div>
        <div class="p-4 border rounded-lg bg-gray-50">
            <dt class="text-sm font-medium text-gray-900">Codigo Postal</dt>
            <dd class="mt-1 text-sm text-gray-700">{{ $paciente->codigo_postal }}</dd>
        </div>
        <div class="p-4 border rounded-lg bg-gray-50">
            <dt class="text-sm font-medium text-gray-900">Pais</dt>
            <dd class="mt-1 text-sm text-gray-700">{{ $paciente->pais }}</dd>
        </div>
        <div class="p-4 border rounded-lg bg-gray-50">
            <dt class="text-sm font-medium text-gray-900">Genero</dt>
            <dd class="mt-1 text-sm text-gray-700">{{ $paciente->genero }}</dd>
        </div>
        <div class="p-4 border rounded-lg bg-gray-50">
            <dt class="text-sm font-medium text-gray-900">Estado Civil</dt>
            <dd class="mt-1 text-sm text-gray-700">{{ $paciente->estado_civil }}</dd>
        </div>
        <div class="p-4 border rounded-lg bg-gray-50">
            <dt class="text-sm font-medium text-gray-900">Ocupacion</dt>
            <dd class="mt-1 text-sm text-gray-700">{{ $paciente->ocupacion }}</dd>
        </div>
        <div class="p-4 border rounded-lg bg-gray-50">
            <dt class="text-sm font-medium text-gray-900">Nacionalidad</dt>
            <dd class="mt-1 text-sm text-gray-700">{{ $paciente->nacionalidad }}</dd>
        </div>
        <div class="p-4 border rounded-lg bg-gray-50">
            <dt class="text-sm font-medium text-gray-900">Tipo Documento</dt>
            <dd class="mt-1 text-sm text-gray-700">{{ $paciente->tipo_documento }}</dd>
        </div>
        <div class="p-4 border rounded-lg bg-gray-50">
            <dt class="text-sm font-medium text-gray-900">Numero Documento</dt>
            <dd class="mt-1 text-sm text-gray-700">{{ $paciente->numero_documento }}</dd>
        </div>
        <div class="p-4 border rounded-lg bg-gray-50">
            <dt class="text-sm font-medium text-gray-900">Telefono Emergencia</dt>
            <dd class="mt-1 text-sm text-gray-700">{{ $paciente->telefono_emergencia }}</dd>
        </div>
        <div class="p-4 border rounded-lg bg-gray-50">
            <dt class="text-sm font-medium text-gray-900">Nombre Contacto Emergencia</dt>
            <dd class="mt-1 text-sm text-gray-700">{{ $paciente->nombre_contacto_emergencia }}</dd>
        </div>
        <div class="p-4 border rounded-lg bg-gray-50">
            <dt class="text-sm font-medium text-gray-900">Alergias</dt>
            <dd class="mt-1 text-sm text-gray-700">{{ $paciente->alergias }}</dd>
        </div>
        <div class="p-4 border rounded-lg bg-gray-50">
            <dt class="text-sm font-medium text-gray-900">Medicamentos</dt>
            <dd class="mt-1 text-sm text-gray-700">{{ $paciente->medicamentos }}</dd>
        </div>
        <div class="p-4 border rounded-lg bg-gray-50">
            <dt class="text-sm font-medium text-gray-900">Historial Medico</dt>
            <dd class="mt-1 text-sm text-gray-700">{{ $paciente->historial_medico }}</dd>
        </div>
        <div class="p-4 border rounded-lg bg-gray-50">
            <dt class="text-sm font-medium text-gray-900">Notas</dt>
            <dd class="mt-1 text-sm text-gray-700">{{ $paciente->notas }}</dd>
        </div>
        <div class="p-4 border rounded-lg bg-gray-50">
            <dt class="text-sm font-medium text-gray-900">Foto</dt>
            <dd class="mt-1 text-sm text-gray-700">{{ $paciente->foto }}</dd>
        </div>
        <div class="p-4 border rounded-lg bg-gray-50">
            <dt class="text-sm font-medium text-gray-900">Estado Paciente</dt>
            <dd class="mt-1 text-sm text-gray-700">{{ $paciente->estado_paciente }}</dd>
        </div>
        <div class="p-4 border rounded-lg bg-gray-50">
            <dt class="text-sm font-medium text-gray-900">Tipo Paciente</dt>
            <dd class="mt-1 text-sm text-gray-700">{{ $paciente->tipo_paciente }}</dd>
        </div>
        <div class="p-4 border rounded-lg bg-gray-50">
            <dt class="text-sm font-medium text-gray-900">Referido Por</dt>
            <dd class="mt-1 text-sm text-gray-700">{{ $paciente->referido_por }}</dd>
        </div>
        <div class="p-4 border rounded-lg bg-gray-50">
            <dt class="text-sm font-medium text-gray-900">Clinica Id</dt>
            <dd class="mt-1 text-sm text-gray-700">{{ $paciente->clinica_id }}</dd>
        </div>
    </dl>
    


    <div class="mt-6 bg-gray-50 p-4 rounded-md shadow-sm">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Firmar Consentimiento</h3>
    
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-center">
            <div>
                <label for="consentimiento" class="block text-sm font-medium text-gray-700 mb-1">Selecciona Consentimiento</label>
                <select wire:model.live="consentimientoSeleccionado" id="consentimiento" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                    <option value="0">-- Seleccionar --</option>
                    @foreach ($consentimientos as $consentimiento)
                        <option value="{{ $consentimiento->id }}">{{ $consentimiento->titulo }}</option>
                    @endforeach
                </select>
            </div>
    
            <div>
                <button 
                    wire:click="firmarConsentimiento" 
                    class="w-full bg-green-600 text-white py-2 px-4 rounded-md shadow hover:bg-green-700 disabled:bg-gray-300"
                    @disabled($consentimientoSeleccionado == 0)
                >
                    Firmar Consentimiento
                </button>
            </div>
        </div>
    </div>
    <div class="mt-10 bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Consentimientos Firmados</h3>
    
        @if(count($listaConsentimientos) > 0)
            <ul class="divide-y divide-gray-200">
                @foreach($listaConsentimientos as $consentimiento)
                    <li class="py-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-700">{{ $consentimiento->titulo }}</span>
                            <span class="text-xs text-green-600">Firmado</span>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-sm text-gray-500">Este paciente no ha firmado ningún consentimiento aún.</p>
        @endif
    </div>
    

    
</section>