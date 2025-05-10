<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermissions extends Component
{
  
    public $roles, $permissions, $selectedRole, $roleName, $rolePermissions = [];
    public $editing = false;
    
    
    public function mount()
    {
        $this->roles = Role::all();
        // Solo pasamos los datos necesarios para evitar problemas con getMorphClass
    $permissions = Permission::all()->map(function ($perm) {
        return [
            'id' => $perm->id,
            'name' => $perm->name,
            'description' => $perm->description,
        ];
    });

    // Agrupamos por la "segunda palabra" (el modelo)
    $this->permissions = $permissions->groupBy(function ($perm) {
        return explode(' ', $perm['name'])[1] ?? 'otros';
    });
        
    }

    // Método para crear un nuevo rol
    public function createRole()
    {
        $this->validate([
            'roleName' => 'required|unique:roles,name',
        ]);

        Role::create(['name' => $this->roleName]);
        $this->roles = Role::all();  // Actualizamos la lista de roles
        $this->reset('roleName'); // Limpiamos el campo de nombre

        Session::flash('message', 'El rol se creó con éxito');
    }

    // Método para seleccionar un rol y cargar sus permisos
    public function editRole($roleId)
    {
        $role = Role::find($roleId);
        $this->selectedRole = $roleId;
        $this->roleName = $role->name;
        $this->rolePermissions = $role->permissions->pluck('id')->toArray();
        $this->editing = true;
    }

    // Método para actualizar un rol y sus permisos
    public function updateRole()
    {
        $role = Role::find($this->selectedRole);

        $this->validate([
            'roleName' => 'required|unique:roles,name,' . $role->id,
            'rolePermissions' => 'array|required',
        ]);

        $role->update(['name' => $this->roleName]);
        $role->permissions()->sync($this->rolePermissions);

        Session::flash('message', 'El rol se actualizó con éxito');
        $this->reset(['editing', 'rolePermissions', 'roleName']);
    }

    // Método para eliminar un rol
    public function deleteRole($roleId)
    {
        $role = Role::find($roleId);
        $role->delete();
        $this->roles = Role::all();

        Session::flash('message', 'El rol se eliminó con éxito');
    }

   
    
    public function render()
    {
        return view('livewire.roles-permissions');
    }
}
