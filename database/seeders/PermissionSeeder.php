<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'user-index',
            'user-create',
            'user-edit',
            'user-delete',

            'role-index',
            'role-create',
            'role-edit',
            'role-delete',

            'todo-index',
            'todo-create',
            'todo-edit',
            'todo-delete'
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
