<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // Roles
        // balie
        $role = Role::create(['name' => 'balie']);
        $permission = Permission::create(['name' => 'bestellingen afhandelen']);
        $role->givePermissionTo($permission);
        // bereiding
        $role = Role::create(['name' => 'bereiding']);
        $permission = Permission::create(['name' => 'keuken activiteiten']);
        $role->givePermissionTo($permission);
        // bezorger
        $role = Role::create(['name' => 'bezorger']);
        $permission = Permission::create(['name' => 'bezorgen']);
        $role->givePermissionTo($permission);
        // klant
        $role = Role::create(['name' => 'klant']);
        $permission = Permission::create(['name' => 'bestellen']);
        $role->givePermissionTo($permission);
        // management
        $role = Role::create(['name' => 'management']);
        $permission = Permission::create(['name' => 'management activiteiten']);
        $role->givePermissionTo($permission);


        User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        Person::factory(['first_name' => 'tester', 'last_name' => 'test', 'id' => $user->id])->create();
        // kies klant role (voorbeeld)
        // $role = Role::where('name', 'klant')->first();
        // test user is klant
        $user->assignRole('klant');

        $this->call([
            PersonSeeder::class,
            PizzaPointSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            StatusSeeder::class,
        ]);
    }
}
