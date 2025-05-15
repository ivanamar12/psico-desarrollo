<?php

namespace Database\Seeders;

use App\Enums\Role as EnumRole;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
  public function run()
  {
    Role::create(['name' => EnumRole::ADMIN]);
    Role::create(['name' => EnumRole::ESPECIALISTA]);
    Role::create(['name' => EnumRole::SECRETARIA]);
  }
}
