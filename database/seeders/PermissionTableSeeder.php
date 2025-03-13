<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
  
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'admin-list',
           'admin-show',
           'admin-approve',
           'user-list',
           'user-create',
           'user-delete',
           'user-edit',
           'user-show',
           'event-list',
           'event-create',
           'event-delete',
           'event-edit',
           'event-show',
           'comment-store',
           'comment-destroy',
           'topic-list',
           'topic-create',
           'topic-delete',
           'topic-edit',
           'relawan-daftar',
           'item-list',
           'item-create',
           'item-delete',
           'item-edit',
           'item-show'
           
        ];
        
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
