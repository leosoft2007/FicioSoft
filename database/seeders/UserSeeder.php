<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = Permission::firstOrCreate(['name' => 'acceder al sistema', 'description' => 'Acceder al sistema']);
        $usuario = Role::create(['name' => 'Nuevo']);
        Role::create(['name' => 'Usuario']);
        $admin = Role::create(['name' => 'Administrador']);
        $admin->givePermissionTo($permission);
        
        $administrador = User::create([
            'name' => 'Leosoft',
            'email' => 'leosoft2007@gmail.com',
            'password' => Hash::make('Leo__28041'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'clinica_id' => 1,
            
        ]);   
        $usu = User::create([
            'name' => 'Juan Perez',
            'email' => 'juan@gmail.com',
            'password' => Hash::make('Leo__28041'),
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
            Permission::create(['name' => "create $modelName" , 'description' => 'Crear ' . $modelName])->assignRole($admin);
            Permission::create(['name' => "edit $modelName", 'description' => 'Editar ' . $modelName])->assignRole($admin);
            Permission::create(['name' => "delete $modelName", 'description' => 'Eliminar ' . $modelName])->assignRole($admin);
            Permission::create(['name' => "view $modelName", 'description' => 'Ver ' . $modelName])->assignRole($admin);

        

        
        }
        User::factory(5)->create();
        
    }
}