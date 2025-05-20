<?php

namespace App\Livewire\Users;

use App\Livewire\Forms\UserForm;
use App\Models\Clinica;
use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    public UserForm $form;
    public $roles;
    public $role;
    public $clinicas;

    public function mount()
    {
        $this->roles = Role::all();
        $this->clinicas = Clinica::all();
    }

    public function save()
    {
        $this->authorize('create users');
        $this->form->role = $this->role;
        $this->form->persist();

        return $this->redirectRoute('users.index', navigate: true);
    }

    public function render()
    {
        $this->authorize('create users');
        return view('livewire.user.create');
    }
}
