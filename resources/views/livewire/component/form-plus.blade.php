{{-- resources/views/livewire/component/form-plus.blade.php --}}
<section class="w-full bg-gradient-to-br from-blue-50 to-indigo-100 py-8">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <!-- Encabezado con botón de volver -->
            <div class="px-6 py-5 bg-{{ $headerColor }}-600 flex justify-between items-center rounded-t-lg">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 text-white">
                    <path
                        d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.428 8.428a.75.75 0 0 0-.15.23l-.844 2.533a.75.75 0 0 0 .926.926l2.533-.844a.75.75 0 0 0 .23-.15L19.513 8.2Z" />
                </svg>
                <h3 class="text-lg font-medium text-white">
                    {{ $mode === 'edit'
                        ? __('Editar') . ' ' . class_basename($modelClass)
                        : __('Añadir nuevo') . ' ' . class_basename($modelClass) }}
                </h3>
                <a href="{{ route($redirectRoute ?? 'home') }}"
                    class="flex items-center border border-white text-white px-4 py-2 rounded hover:bg-white hover:text-indigo-600 transition">
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    {{ __('Volver al listado') }}
                </a>
            </div>

            <div class="py-6">
                <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                    <div class="p-6 bg-white rounded-lg shadow-md">
                        @if (session()->has('success'))
                            <div class="mb-4 text-green-700 bg-green-100 p-2 rounded">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form wire:submit.prevent="save" enctype="multipart/form-data">
                            @csrf
                            @if ($mode === 'edit')
                                @method('PATCH')
                            @endif
                            <div
                                class="grid gap-6 grid-cols-1 @if ($columns == 2) md:grid-cols-2 @endif @if ($columns == 3) md:grid-cols-2 lg:grid-cols-3 @endif ">
                                @foreach ($fields as $field)
                                    <div>
                                        <label class="block text-gray-700 font-semibold mb-2">
                                            {{ $field['label'] ?? ucfirst($field['name']) }}
                                        </label>
                                        @php
                                            $type = $field['type'] ?? 'text';
                                            $inputClass =
                                                'w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition';
                                        @endphp

                                        @if ($type === 'select')
                                            <select wire:model="formData.{{ $field['name'] }}"
                                                class="{{ $inputClass }} bg-white border px-3 py-2 text-gray-700 focus:outline-none">
                                                <option value="">{{ $field['placeholder'] ?? 'Seleccione' }}
                                                </option>
                                                @foreach ($field['options'] ?? [] as $key => $option)
                                                    <option value="{{ $key }}">{{ $option }}</option>
                                                @endforeach
                                            </select>
                                        @elseif ($type === 'textarea')
                                            <textarea wire:model="formData.{{ $field['name'] }}"
                                                class="{{ $inputClass }} border px-3 py-2 text-gray-700 min-h-[80px] resize-none focus:outline-none"></textarea>
                                        @elseif ($type === 'date')
                                            <input wire:model="formData.{{ $field['name'] }}" type="date"
                                                class="{{ $inputClass }} border px-3 py-2 text-blue-700 focus:outline-none" />
                                        @elseif ($type === 'time')
                                            <input wire:model="formData.{{ $field['name'] }}" type="time"
                                                class="{{ $inputClass }} border px-3 py-2 text-indigo-700 focus:outline-none" />
                                        @elseif ($type === 'number')
                                            <input wire:model="formData.{{ $field['name'] }}" type="number"
                                                class="{{ $inputClass }} border px-3 py-2 text-green-700 focus:outline-none" />
                                        @elseif ($type === 'email')
                                            <input wire:model="formData.{{ $field['name'] }}" type="email"
                                                class="{{ $inputClass }} border px-3 py-2 text-pink-700 focus:outline-none" />
                                        @elseif ($type === 'file')
                                            <input wire:model="formData.{{ $field['name'] }}" type="file"
                                                class="{{ $inputClass }} border px-3 py-2 text-gray-700 focus:outline-none" />
                                        @elseif ($type === 'color')
                                            <input wire:model="formData.{{ $field['name'] }}" type="color"
                                                class="{{ $inputClass }} border px-3 py-2 text-gray-700 focus:outline-none"
                                                style="border-width: 4px; border-color: {{ data_get($formData, $field['name']) ?? '#000' }}; height: 48px; width: 100%; padding: 0;" />
                                        @elseif ($type === 'html')
                                                <div>
                                                    <div class="mb-2 flex gap-2">
                                                        <button type="button" onclick="insertTag('{{ $field['name'] }}', '<b>', '</b>')"><b>B</b></button>
                                                        <button type="button" onclick="insertTag('{{ $field['name'] }}', '<i>', '</i>')"><i>I</i></button>
                                                        <button type="button" onclick="insertTag('{{ $field['name'] }}', '<u>', '</u>')"><u>U</u></button>
                                                        <button type="button" onclick="insertTag('{{ $field['name'] }}', '<ul><li>', '</li></ul>')">Lista</button>
                                                        <button type="button" onclick="insertTag('{{ $field['name'] }}', '<a href=\'\'>', '</a>')">Link</button>
                                                    </div>
                                                    <textarea id="html_{{ $field['name'] }}" wire:model.defer="formData.{{ $field['name'] }}"
                                                        class="{{ $inputClass }} border px-3 py-2 text-gray-700 min-h-[120px] resize-y focus:outline-none"></textarea>
                                                    <div class="mt-4 p-2 border rounded bg-gray-50">
                                                        <label class="block text-xs text-gray-500 mb-1">Vista previa:</label>
                                                        <div class="prose" id="preview_{{ $field['name'] }}">{!! $formData[$field['name']] ?? '' !!}</div>
                                                    </div>
                                                </div>
                                                @push('scripts')
                                                    <script>
                                                        function insertTag(field, openTag, closeTag) {
                                                            var textarea = document.getElementById('html_' + field);
                                                            var start = textarea.selectionStart;
                                                            var end = textarea.selectionEnd;
                                                            var text = textarea.value;
                                                            textarea.value = text.substring(0, start) + openTag + text.substring(start, end) + closeTag + text.substring(end);
                                                            textarea.focus();
                                                            textarea.selectionEnd = end + openTag.length + closeTag.length;
                                                            textarea.dispatchEvent(new Event('input'));
                                                        }
                                                    </script>
                                                @endpush

                                        @elseif ($type === 'select-busqueda')
                                            <div class="flex items-center relative w-full">
                                                <div class="flex-1">
                                                    <x-select-busqueda :options="$field['options'] ?? []" :selected-value="data_get($formData, $field['name'])"
                                                        :value-field="$field['valueField'] ?? 'id'" :label-field="$field['labelField'] ?? 'nombre'"
                                                        model="formData.{{ $field['name'] }}" :placeholder="$field['placeholder'] ?? 'Seleccione'"
                                                        :primary-color="$field['primaryColor'] ?? 'indigo-600'" :hover-color="$field['hoverColor'] ?? 'indigo-50'" class="w-full" />
                                                </div>
                                                @if (($field['creable'] ?? false) && isset($field['create_fields']))
                                                    <button type="button"
                                                        class="ml-2 p-2 rounded-full bg-green-100 hover:bg-green-200 text-green-700 shadow transition"
                                                        wire:click="openCreateModal('{{ $field['name'] }}')"
                                                        title="Añadir {{ $field['label'] }}">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            stroke-width="2" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M12 4v16m8-8H4" />
                                                        </svg>
                                                    </button>
                                                    {{-- MODAL DENTRO DEL MISMO DIV RELATIVE --}}
                                                    @if ($showModal[$field['name']] ?? false)
                                                        <div
                                                            class="absolute left-0 top-12 z-50 w-72 bg-white rounded-lg shadow-lg border border-green-200 p-6">
                                                            <h3 class="text-lg font-bold mb-4">Nuevo
                                                                {{ $field['label'] }}</h3>
                                                            @foreach ($field['create_fields'] as $f)
                                                                <div class="mb-4">
                                                                    <label
                                                                        class="block text-sm font-medium mb-1">{{ $f['label'] }}</label>
                                                                    <input type="text"
                                                                        wire:model.defer="newRelated.{{ $field['name'] }}.{{ $f['name'] }}"
                                                                        class="w-full border rounded px-2 py-1"
                                                                        placeholder="{{ $f['label'] }}">
                                                                    @error("newRelated.{$field['name']}.{$f['name']}")
                                                                        <span
                                                                            class="text-red-500 text-xs">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            @endforeach
                                                            <div class="flex justify-end space-x-2">
                                                                <button type="button"
                                                                    wire:click="closeCreateModal('{{ $field['name'] }}')"
                                                                    class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">Cancelar</button>
                                                                <button type="button"
                                                                    wire:click="saveNewRelated('{{ $field['name'] }}')"
                                                                    class="px-3 py-1 rounded bg-green-600 text-white hover:bg-green-700">Guardar</button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        @else
                                            <input wire:model="formData.{{ $field['name'] }}"
                                                type="{{ $type }}"
                                                class="{{ $inputClass }} border px-3 py-2 text-gray-700 focus:outline-none" />
                                        @endif

                                        @error('formData.' . $field['name'])
                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
                            <div class="pt-6">
                                <button type="submit"
                                    class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-4 py-2 rounded hover:from-blue-600 hover:to-indigo-700 transition">
                                    {{ $mode === 'edit' ? __('Actualizar') : __('Crear') }}
                                    {{ class_basename($modelClass) }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
