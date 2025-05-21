<?php

namespace App\Http\Controllers;

use App\Models\Clinica;
use App\Http\Requests\StoreClinicaRequest;
use App\Http\Requests\UpdateClinicaRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class ClinicaController extends Controller
{


    public function init()
    {
            // Verificar si hay usuarios registrados
            if (User::count() > 0) {
                return; // Si ya hay usuarios, no ejecutar el código
            } else {

                $clinica = Clinica::create([
                    'nombre' => 'Laura Recio Jaime',
                    'nif' => '45670542F',
                    'direccion' => 'Av. Baronia de Polop Nº 4-5C, 03520 Polop',
                    'color' => '#fd7e14',
                    'email' => 'lalitabre@gmail.com',
                    'telefono' => '660269438',
                ]);
                $permission = Permission::firstOrCreate(['name' => 'acceder al sistema', 'description' => 'Acceder al sistema']);
                $usuario = Role::create(['name' => 'Nuevo']);
                Role::create(['name' => 'Usuario']);
                $admin = Role::create(['name' => 'Administrador']);
                $admin->givePermissionTo($permission);

                $administrador = User::create([
                    'name' => 'Leosoft',
                    'email' => 'leosoft2007@gmail.com',
                    'password' => Hash::make('Leo__2918'),
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                    'clinica_id' => 1,

                ]);
                $usu = User::create([
                    'name' => 'Juan Perez',
                    'email' => 'juan@gmail.com',
                    'password' => Hash::make('Leo__2918'),
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                    'clinica_id' => 1,

                ]);

                $usu->assignRole('Usuario');

                $administrador->givePermissionTo($permission);

                //  $administrador->assignRole('Administrador');
                $administrador->syncRoles(['Administrador']);

                // Lista de modelos en tu aplicación
                $models = [
                    'User',
                    'Clinica',
                       'Especialidad',
                       'Hora',
                       'Paciente',
                       'Profesional',
                       'Cita',
                       'Factura',
                       'Servicio',
                       'Disponible',
                       'Consentimiento',
                    // Agrega todos los modelos que quieras gestionar permisos
                ];

                // Crear permisos para cada modelo
                foreach ($models as $model) {
                    // Convertir a plural en caso de ser necesario
                    $modelName = Str::plural(Str::lower($model));

                    // Crear permisos comunes como "crear", "editar", "eliminar", "ver"
                    Permission::create(['name' => "create $modelName", 'description' => 'Crear ' . $modelName])->assignRole($admin);
                    Permission::create(['name' => "edit $modelName", 'description' => 'Editar ' . $modelName])->assignRole($admin);
                    Permission::create(['name' => "delete $modelName", 'description' => 'Eliminar ' . $modelName])->assignRole($admin);
                    Permission::create(['name' => "view $modelName", 'description' => 'Ver ' . $modelName])->assignRole($admin);
                }
            }

    }
    /**
     * Display a listing of the resource.
     */



    


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClinicaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Clinica $clinica)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clinica $clinica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClinicaRequest $request, Clinica $clinica)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clinica $clinica)
    {
        //
    }
}
