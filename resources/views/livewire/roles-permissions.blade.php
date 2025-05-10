<!-- resources/views/livewire/admin/role-permissions.blade.php -->

<div class="container mx-auto mt-8">

    <!-- Mensaje de éxito -->
    @if (session()->has('message'))
        <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Crear Rol -->
<x-page-header 
    title="Crear Rol"
    color="yellow" 
    :clickable="true" 
    badge="Nuevo" 
    icon="check" 
    footer="Texto de pie" 
>
        <form wire:submit.prevent="createRole">
            <div class="mb-4">
                <label for="roleName" class="block text-sm font-medium text-gray-600">Nombre del Rol</label>
                <input type="text" id="roleName" class="w-full p-3 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" wire:model="roleName">
                @error('roleName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <flux:button type="submit" variant="primary">Crear Rol</flux:button>
        </form>
    
</x-page-header>

    
<x-page-header 
title="Lista de Roles"
color="yellow" 
:clickable="true" 
badge="Nuevo" 
icon="check" 
footer="Texto de pie" 
>
    <!-- Lista de Roles -->
    
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">ID</th>
                    <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">Nombre</th>
                    <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr class="border-b">
                        <td class="py-2 px-4 text-sm text-gray-700">{{ $role->id }}</td>
                        <td class="py-2 px-4 text-sm text-gray-700">{{ $role->name }}</td>
                        <td class="py-2 px-4 text-sm">
                            <button wire:click="editRole({{ $role->id }})" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600">Editar</button>
                            <button wire:click="deleteRole({{ $role->id }})" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</x-page-header>
    

    
    <!-- Editar Rol -->
@if ($editing)
<x-page-header 
title="Editar Rol"
subtitle="{{ $roleName }}"
color="yellow" 
:clickable="true" 
badge="Nuevo" 
icon="check" 
footer="Texto de pie" 
>
    <form wire:submit.prevent="updateRole">
        <div class="mb-4">
            
            
            
            @error('roleName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <h4 class="text-lg font-semibold text-gray-700 mb-4">Permisos</h4>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($permissions as $model => $group)
        <div class="bg-gradient-to-br from-white to-gray-50 shadow-xl rounded-2xl p-6 mb-6 transition-all hover:shadow-2xl border border-gray-200">
        <h5 class="text-xl font-bold text-indigo-600 mb-4 capitalize border-b border-indigo-200 pb-2 tracking-wide flex items-center">
            <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M9 12l2 2l4 -4" />
                <path d="M12 22a10 10 0 1 1 0 -20a10 10 0 0 1 0 20z" />
            </svg>
            {{ ucfirst($model) }}
        </h5>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-4">
            @foreach ($group as $permission)
                <label class="flex items-center space-x-2 hover:bg-indigo-50 p-2 rounded transition">
                    <input 
                        type="checkbox" 
                        class="form-checkbox text-indigo-600 transition duration-150 ease-in-out"
                        value="{{ $permission['id'] }}"
                        wire:model="rolePermissions"
                        {{ in_array($permission['id'], $rolePermissions) ? 'checked' : '' }}
                    >
                    <span class="text-sm text-gray-700">{{ $permission['description'] }}</span>
                </label>
            @endforeach
        </div>
        </div>
    @endforeach

        
        
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 mt-4">Actualizar Rol</button>
    </form>
</x-page-header>
@endif

</div>
