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
        
        Permission::create(['name' => 'admin.users.roles.edit',
                            'description' => 'Actualizar un rol al Empleado'])->syncRoles([$roleAdmin]);                   

        Permission::create(['name' => 'admin.roles.create',
                            'description' => 'Crear un rol'])->syncRoles([$roleAdmin]);

        Permission::create(['name' => 'admin.roles.edit',
                            'description' => 'Actualizar un rol'])->syncRoles([$roleAdmin]);

        Permission::create(['name' => 'admin.roles.destroy',
                            'description' => 'Eliminar un rol'])->syncRoles([$roleAdmin]);

        //Familias
        Permission::create(['name' => 'familias.inicio',
                            'description' => 'Acceder a la navegacion de Familias'])->syncRoles([$roleAdmin,$rolaPersona]);
        Permission::create(['name' => 'familias.registrar',
                            'description' => 'Registrar un nuevo item en Familias'])->syncRoles([$roleAdmin,$rolaPersona]);
        Permission::create(['name' => 'familias.actualizar',
                            'description' => 'Actualizar un item en Familias'])->syncRoles([$roleAdmin]);

        //Flujo de Cajas
        Permission::create(['name' => 'flujodecajas.inicio',
                            'description' => 'Acceder a la navegacion de Flujo de Cajas'])->syncRoles([$roleAdmin,$rolaPersona]);
        Permission::create(['name' => 'flujodecajas.registrar',
                            'description' => 'Registrar un nuevo item en Flujo de Cajas'])->syncRoles([$roleAdmin,$rolaPersona]);
        Permission::create(['name' => 'flujodecajas.actualizar',
                            'description' => 'Actualizar un item en Flujo de Cajas'])->syncRoles([$roleAdmin]);

        //Listas
        Permission::create(['name' => 'listas.inicio',
                            'description' => 'Acceder a la navegacion de Listas'])->syncRoles([$roleAdmin,$rolaPersona]);
        
        //Listas -> lista de unidades de medida
        Permission::create(['name' => 'listas.registrarlistaUnidadMedidas',
                            'description' => 'Registrar un nuevo item en Lista de Unidad de Medidas'])->syncRoles([$roleAdmin,$rolaPersona]);
        Permission::create(['name' => 'listas.actualizarlistaUnidadMedidas',
                            'description' => 'Actualizar un item en Lista de Unidad de Medidas'])->syncRoles([$roleAdmin]);

        //Listas -> lista de procesos                 
        Permission::create(['name' => 'listas.registrarlistaProcesos',
                            'description' => 'Registrar un nuevo item en Lista de Procesos'])->syncRoles([$roleAdmin,$rolaPersona]);
        Permission::create(['name' => 'listas.actualizarlistaProcesos',
                            'description' => 'Actualizar un item en Lista de Procesos'])->syncRoles([$roleAdmin]);

        //Listas -> lista de clasificaciones                   
        Permission::create(['name' => 'listas.registrarclasificacions',
                            'description' => 'Registrar un nuevo item en Lista de Clasificaciones'])->syncRoles([$roleAdmin,$rolaPersona]);
        Permission::create(['name' => 'listas.actualizarclasificacions',
                            'description' => 'Actualizar un item en Lista de Clasificaciones'])->syncRoles([$roleAdmin]);

        //Listas -> lista de unidades de consumo
        Permission::create(['name' => 'listas.registrarlistaUnidadConsumo',
                            'description' => 'Registrar un nuevo item en Lista de Unidad de Consumo'])->syncRoles([$roleAdmin,$rolaPersona]);
        Permission::create(['name' => 'listas.actualizarlistaUnidadConsumo',
                            'description' => 'Actualizar un item en Lista de Unidad de Consumo'])->syncRoles([$roleAdmin]);

        //Listas -> lista de familias de materiales
        Permission::create(['name' => 'listas.registrarlistaFamiliasMateriales',
                            'description' => 'Registrar un nuevo item en Lista de Familias de Materiales'])->syncRoles([$roleAdmin,$rolaPersona]);
        Permission::create(['name' => 'listas.actualizarlistaFamiliasMateriales',
                            'description' => 'Actualizar un item en Lista de Familias de Materiales'])->syncRoles([$roleAdmin]);

        //Modelos e Insumos
        Permission::create(['name' => 'modeloseinsumos.inicio',
                            'description' => 'Acceder a la navegacion de Modelos e Insumos'])->syncRoles([$roleAdmin,$rolaPersona]);
        
        //Modelos e Insumos -> Modelos
        Permission::create(['name' => 'modeloseinsumos.registrarmodeloseinsumosmodelos',
                            'description' => 'Registrar un nuevo item en Modelos de Modelos e Insumos'])->syncRoles([$roleAdmin,$rolaPersona]);
        Permission::create(['name' => 'modeloseinsumos.actualizarmodeloseinsumosmodelos',
                            'description' => 'Actualizar un item en Modelos de Modelos e Insumos'])->syncRoles([$roleAdmin]);

        //Modelos e Insumos -> Insumos
        Permission::create(['name' => 'modeloseinsumos.registrarmodeloseinsumosinsumos',
                            'description' => 'Registrar un nuevo item en Insumos de Modelos e Insumos'])->syncRoles([$roleAdmin,$rolaPersona]);
        Permission::create(['name' => 'modeloseinsumos.actualizarmodeloseinsumosinsumos',
                            'description' => 'Actualizar un item en Insumos de Modelos e Insumos'])->syncRoles([$roleAdmin]);
        
        //Mano de Obra
        Permission::create(['name' => 'manoobra.inicio',
                            'description' => 'Acceder a la navegacion de Mano de Obra'])->syncRoles([$roleAdmin,$rolaPersona]);
        Permission::create(['name' => 'manoobra.registrarmanoobra',
                            'description' => 'Registrar un nuevo item en Mano de Obra'])->syncRoles([$roleAdmin,$rolaPersona]);
        Permission::create(['name' => 'manoobra.actualizarmanoobra',
                            'description' => 'Actualizar un item en Mano de Obra'])->syncRoles([$roleAdmin]);
    }
}
