<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::create(['name' => 'Admin']);
        $rolaPersona = Role::create(['name' => 'Persona']);

        //Boton Personal
        Permission::create(['name' => 'admin.personal',
                            'description' => 'Habilitar el boton Empleados'])->syncRoles([$roleAdmin]);
        
        //Boton Roles
        Permission::create(['name' => 'admin.roles',
                            'description' => 'Habilitar el boton Roles'])->syncRoles([$roleAdmin]);

        //Familias
        Permission::create(['name' => 'familias.inicio',
                            'description' => 'Acceder a la navegacion de Familias'])->syncRoles([$roleAdmin,$rolaPersona]);

        //Flujo de Cajas
        Permission::create(['name' => 'flujodecajas.inicio',
                            'description' => 'Acceder a la navegacion de Flujo de Cajas'])->syncRoles([$roleAdmin,$rolaPersona]);

        //Listas
        Permission::create(['name' => 'listas.inicio',
                            'description' => 'Acceder a la navegacion de Listas'])->syncRoles([$roleAdmin,$rolaPersona]);
        
        

        //Modelos e Insumos
        Permission::create(['name' => 'modeloseinsumos.inicio',
                            'description' => 'Acceder a la navegacion de Modelos e Insumos'])->syncRoles([$roleAdmin,$rolaPersona]);
        

        //Unidades de Medida de Conversion
        Permission::create(['name' => 'unidadesmedidaconversion.inicio',
                            'description' => 'Acceder a la navegacion de Lista Unidades de Conversion'])->syncRoles([$roleAdmin,$rolaPersona]);
        
        //Mano de Obra
        Permission::create(['name' => 'manoobra.inicio',
                            'description' => 'Acceder a la navegacion de Mano de Obra'])->syncRoles([$roleAdmin,$rolaPersona]);

        //Familia Materiales Materiales
        Permission::create(['name' => 'familiamaterialesmateriales.inicio',
                            'description' => 'Acceder a la navegacion de Materiales'])->syncRoles([$roleAdmin,$rolaPersona]);

        //DEP
        Permission::create(['name' => 'dep.inicio',
                            'description' => 'Acceder a la navegacion de DEP'])->syncRoles([$roleAdmin,$rolaPersona]);

        //GIF
        Permission::create(['name' => 'gif.inicio',
                            'description' => 'Acceder a la navegacion de GIF'])->syncRoles([$roleAdmin,$rolaPersona]);

        //GG
        Permission::create(['name' => 'gg.inicio',
                            'description' => 'Acceder a la navegacion de GG'])->syncRoles([$roleAdmin,$rolaPersona]);
    }
}
