<?php

namespace Database\Seeders;

use App\Enums\Role as EnumsRole;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
  public function run()
  {
    Permission::firstOrCreate(['name' => 'crear citas']);
    Permission::firstOrCreate(['name' => 'cambiar estado citas']);
    Permission::firstOrCreate(['name' => 'ver citas']);
    Permission::firstOrCreate(['name' => 'descargar citas']);
    Permission::firstOrCreate(['name' => 'editar especialidad']);
    Permission::firstOrCreate(['name' => 'registrar especialista']);
    Permission::firstOrCreate(['name' => 'editar especialista']);
    Permission::firstOrCreate(['name' => 'eliminar especialista']);
    Permission::firstOrCreate(['name' => 'ver especialista']);
    Permission::firstOrCreate(['name' => 'registrar secretaria']);
    Permission::firstOrCreate(['name' => 'editar secretaria']);
    Permission::firstOrCreate(['name' => 'eliminar secretaria']);
    Permission::firstOrCreate(['name' => 'ver secretaria']);
    Permission::firstOrCreate(['name' => 'registrar representante']);
    Permission::firstOrCreate(['name' => 'editar representante']);
    Permission::firstOrCreate(['name' => 'eliminar representante']);
    Permission::firstOrCreate(['name' => 'ver representante']);
    Permission::firstOrCreate(['name' => 'registrar paciente']);
    Permission::firstOrCreate(['name' => 'editar paciente']);
    Permission::firstOrCreate(['name' => 'eliminar paciente']);
    Permission::firstOrCreate(['name' => 'ver paciente']);
    Permission::firstOrCreate(['name' => 'crear historia']);
    Permission::firstOrCreate(['name' => 'eliminar historia']);
    Permission::firstOrCreate(['name' => 'descargar historia']);
    Permission::firstOrCreate(['name' => 'editar historia']);
    Permission::firstOrCreate(['name' => 'registrar prueba']);
    Permission::firstOrCreate(['name' => 'editar prueba']);
    Permission::firstOrCreate(['name' => 'eliminar prueba']);
    Permission::firstOrCreate(['name' => 'descargar prueba']);
    Permission::firstOrCreate(['name' => 'ver prueba']);
    Permission::firstOrCreate(['name' => 'aplicar prueba']);
    Permission::firstOrCreate(['name' => 'descargar informe']);
    Permission::firstOrCreate(['name' => 'pruebas']);
    Permission::firstOrCreate(['name' => 'bitacora']);
    Permission::firstOrCreate(['name' => 'generar informes']);
    Permission::firstOrCreate(['name' => 'usuarios']);
    Permission::firstOrCreate(['name' => 'ver informes']);
    Permission::firstOrCreate(['name' => 'eliminar informes']);
    // Referencia 
    Permission::firstOrCreate(['name' => 'crear referencia']);
    Permission::firstOrCreate(['name' => 'eliminar referencia']);
    Permission::firstOrCreate(['name' => 'descargar referencia']);

    $admin = Role::where('name', EnumsRole::ADMIN)->first();
    $secretaria = Role::where('name', EnumsRole::SECRETARIA)->first();
    $especialista = Role::where('name', EnumsRole::ESPECIALISTA)->first();

    if ($admin) {
      $admin->givePermissionTo([
        'crear citas',
        'cambiar estado citas',
        'ver citas',
        'descargar citas',
        'editar especialidad',
        'registrar especialista',
        'editar especialista',
        'eliminar especialista',
        'ver especialista',
        'registrar secretaria',
        'editar secretaria',
        'eliminar secretaria',
        'ver secretaria',
        'registrar representante',
        'editar representante',
        'eliminar representante',
        'ver representante',
        'registrar paciente',
        'editar paciente',
        'eliminar paciente',
        'ver paciente',
        'crear historia',
        'eliminar historia',
        'descargar historia',
        'editar historia',
        'descargar informe',
        'bitacora',
        'usuarios',
        'ver informes',
        'eliminar informes',
        // Referencia
        'descargar referencia'
      ]);
    }

    if ($secretaria) {
      $secretaria->givePermissionTo([
        'crear citas',
        'ver citas',
        'descargar citas',
        'cambiar estado citas',
        'editar especialista',
        'ver especialista',
        'registrar representante',
        'editar representante',
        'ver representante',
        'eliminar representante',
        'registrar paciente',
        'editar paciente',
        'eliminar paciente',
        'ver paciente',
        'descargar historia',
        'descargar informe',
        // Referencia
        'descargar referencia'
      ]);
    }

    if ($especialista) {
      $especialista->givePermissionTo([
        'ver citas',
        'descargar citas',
        'cambiar estado citas',
        'ver representante',
        'ver paciente',
        'crear historia',
        'descargar historia',
        'editar historia',
        'registrar prueba',
        'editar prueba',
        'eliminar prueba',
        'descargar prueba',
        'ver prueba',
        'aplicar prueba',
        'descargar informe',
        'pruebas',
        'generar informes',
        'ver informes',
        'eliminar informes',
        // Referencia 
        'crear referencia',
        'eliminar referencia',
        'descargar referencia'
      ]);
    }
  }
}
