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
    $this->call(RoleSeeder::class);
    $this->call(SecurityQuestionSeeder::class);
    $this->call(UserSeeder::class);
    $this->call(PermissionSeeder::class);
    $this->call(EstadoSeeder::class);
    $this->call(MunicipioSeeder::class);
    $this->call(ParroquiaSeeder::class);
    $this->call(GeneroSeeder::class);
    $this->call(PruebaSeeder::class);
    $this->call(SubEscalaSeeder::class);
    $this->call(ItemSeeder::class);
    $this->call(BaremosSeeder::class);
    // Bender
    $this->call(BenderPruebaSeeder::class);
    $this->call(BenderSubescalasSeeder::class);
    $this->call(BenderItemsSeeder::class);
  }
}

