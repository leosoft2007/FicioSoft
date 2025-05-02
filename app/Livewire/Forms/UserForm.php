<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Form;

class UserForm extends Form
{
    
    public ?User $userModel = null;

    public $name = '';
    public $email = '';
    public $role = '';
    public $clinica_id = '';
    

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
           'email' => 'required|email|max:255|unique:users,email,' . optional($this->userModel)->id,
           // 'email' => 'required|email|max:255|unique:users,email,',

            'role' => 'required|exists:roles,id',
            'clinica_id' => 'required|exists:clinicas,id',
        ];
    }

    public function setUserModel(User $userModel): void
    {
        $this->userModel = $userModel;
       
        $this->name = $userModel->name;
        $this->email = $userModel->email;
        $this->clinica_id = $userModel->clinica_id;
        $this->role = optional($userModel->roles->first())->id;
    }

    public function persist(): void
    {
      

        $validated = $this->validate();
        
      
        $user = $this->userModel ?? new User();

        $user->name = $this->name;
        $user->email = $this->email;
        $user->clinica_id = $this->clinica_id;
        $user->save();

        $this->userModel = $user;

        // Asignación de rol (se espera que $this->role contenga el ID del rol)
        $user->syncRoles([$this->getRoleName()]);

        $this->reset();
    }

    protected function getRoleName(): string
    {
        return \Spatie\Permission\Models\Role::findOrFail($this->role)->name;
    }
}
