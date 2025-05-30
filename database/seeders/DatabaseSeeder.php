<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    // \App\Models\User::factory(10)->create();

    $this->call(RoleSeeder::class);
    $this->call(SecurityQuestionSeeder::class);
    $this->call(UserSeeder::class);
    $this->call(PermissionSeeder::class);
    $this->call(EstadoTableSeeder::class);
    $this->call(MunicipioTableSeeder::class);
    $this->call(ParroquiaTableSeeder::class);
    $this->call(GeneroTableSeeder::class);
    $this->call(PruebaTableSeeder::class);
    $this->call(SubEscalaSeeder::class);
    $this->call(ItemSeeder::class);
    $this->call(BaremosSeeder::class);
  }
}
