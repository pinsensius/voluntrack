<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Get all permissions for the admin
        $permissionsAdmin = Permission::all();
        $adminRole->syncPermissions($permissionsAdmin); // Assign all permissions to admin role

        // Create admin user if not already exists
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'username' => 'Admin',
                'password' => Hash::make('123456'),
            ]
        );
        $admin->assignRole($adminRole);

        // Define the permissions for the user role
        $permissionsUser = Permission::whereIn('name', [
            'role-list', 'role-show'
        ])->get();
        $userRole->syncPermissions($permissionsUser); // Assign specific permissions to user role

        // Create regular users
        $relawan = User::firstOrCreate(
            ['email' => 'relawan@gmail.com'],
            [
                'username' => 'Relawan',
                'password' => Hash::make('123456'),
            ]
        );
        $relawan->assignRole($userRole); // Assign 'user' role
    }
}
