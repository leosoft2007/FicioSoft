<!-- resources/views/livewire/admin/role-permissions.blade.php -->

<div class="container mx-auto mt-8">

    <!-- Mensaje de éxito -->
    @if (session()->has('message'))
        <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Crear Rol -->
    <div class="card p-6 bg-white shadow-lg rounded-lg mb-6">
        <div class="text-xl font-semibold text-gray-800 mb-4">Crear Rol</div>
        <form wire:submit.prevent="createRole">
            <div class="mb-4">
                <label for="roleName" class="block text-sm font-medium text-gray-600">Nombre del Rol</label>
                <input type="text" id="roleName" class="w-full p-3 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" wire:model="roleName">
                @error('roleName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-4">Crear Rol</button>
        </form>
    </div>

    <!-- Lista de Roles -->
    <div class="card p-6 bg-white shadow-lg rounded-lg">
        <div class="text-xl font-semibold text-gray-800 mb-4">Lista de Roles</div>
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
    </div>

    
    <!-- Editar Rol -->
@if ($editing)
<div class="card p-6 bg-white shadow-lg rounded-lg mt-6">
    <div class="text-xl font-semibold text-gray-800 mb-4">Editar Rol</div>
    <form wire:submit.prevent="updateRole">
        <div class="mb-4">
            <label for="roleName" class="block text-sm font-medium text-gray-600">Nombre del Rol</label>
            <input type="text" id="roleName" class="w-full p-3 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" wire:model="roleName">
            @error('roleName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <h4 class="text-lg font-semibold text-gray-700 mb-4">Permisos</h4>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($permissions as $permission)
                <div class="flex items-center">
                    <input 
                        type="checkbox" 
                        class="mr-2"
                        value="{{ $permission->id }}"
                        wire:model="rolePermissions"
                        {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                    >
                    <span class="text-sm text-gray-600">{{ $permission->description }}</span>
                </div>
            @endforeach
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 mt-4">Actualizar Rol</button>
    </form>
</div>
@endif

</div>
