<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a user with role admin
        // admin
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'admin']);
        $role->givePermissionTo($permission);
        $name = "admin";
        $email = "admin@localhost";
        $user = User::factory(['name' => $name, 'email' => $email])->create();
        $user->assignRole('admin');
        Person::factory(['id' => $user->id])->create();

        $roles = ['balie', 'bereiding', 'bezorger', 'management'];

        for($i = 0; $i < 500; $i++) {
            $person = Person::factory()->create();
            // the role "klant" is the default role with 90% chance
            $role = fake()->optional($weight = 0.1, $default = 'klant')->randomElement($roles);
            $person->user()->first()->assignRole($role);
        }
    }
}
