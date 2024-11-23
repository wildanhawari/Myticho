<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'manage categories',
            'manage bank',
            'manage jewelry',
            'manage transaction',
            'manage user',
            'checkout',
            'view orders',
        ];

        foreach($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission
            ]);
        }

        // Role Customer
        $customerRole = Role::firstOrCreate([
            'name' => 'customer'
        ]);

        $customerPermission = [
            'checkout',
            'view orders',
        ];

        $customerRole->syncPermissions($customerPermission);

        $customer = User::create([
            'name' => 'Wildan Hawari',
            'email' => 'wildanhawari@gmail.com',
            'phone_number' => '1234567',
            'avatar' => 'images/default-avatar.png',
            'password' => bcrypt('12345'),
        ]);

        $customer->assignRole($customerRole);

        // Role Admin
        $adminRole = Role::firstOrCreate([
            'name' => 'admin'
        ]);

        $admin = User::create([
            'name' => 'Mythico Jewelry',
            'email' => 'admin@mythico.com',
            'phone_number' => '0834612321',
            'avatar' => 'images/default-avatar.png',
            'password' => bcrypt('mythico'),
        ]);

        $admin->assignRole($adminRole);

    }
}
