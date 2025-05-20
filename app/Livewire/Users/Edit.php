<?php

namespace App\Livewire\Users;

use App\Livewire\Forms\UserForm;
use App\Models\Clinica;
use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    public User $user;
    public UserForm $form;
    public $roles;
    public $role;
    public $clinicas;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->form->setUserModel($user);


        $this->roles = Role::all();
        $this->role = optional($user->roles->first())->id;
        $this->clinicas = Clinica::all();
    }

    public function save()
    {
        $this->authorize('edit users');
        $this->form->role = $this->role;
        $this->form->persist();

        return $this->redirectRoute('users.index', navigate: true);
    }

    public function render()
    {
        $this->authorize('edit users');
        return view('livewire.user.edit');
    }
}
