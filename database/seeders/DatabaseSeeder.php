<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        // User::factory(10)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        Order::truncate();
        Customer::truncate();
        Role::truncate();
        Permission::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
       $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
        ]);
        $cajero = User::factory()->create([
            'name' => 'cajero',
            'email' => 'cajero@example.com',
        ]);

        $roleAdmin = Role::create(['name' => 'admin']);
        $roleCajero = Role::create(['name' => 'cajero']);

        $admin->assignRole($roleAdmin);
        $cajero->assignRole($roleCajero);

        $permission = Permission::create(['name' => 'view orders']);
        $roleCajero->givePermissionTo($permission);

        Order::factory(1000)->create();

    }
}
