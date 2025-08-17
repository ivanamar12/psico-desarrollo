<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $User = User::create([
      "name" => "Ivana Galeno",
      "email" => "ivana@gmail.com",
      "password" => bcrypt("Admin123."),
    ])->assignRole(Role::ADMIN);
  }
}
