<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'list-user',
            'create-user',
            'edit-user',
            'delete-user',

            'list-role',
            'create-role',
            'edit-role',
            'delete-role',
            
            'list-surat',
            'create-surat',
            'edit-surat',
            'delete-surat',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Membuat role Admin
        $adminRole = Role::create(['name' => 'Admin']);
        $adminRole->syncPermissions($permissions);

        // Membuat role Koordinator Parkir
        $koordinatorRole = Role::create(['name' => 'Staff Administrasi']);
        $koordinatorRole->syncPermissions(['list-surat','create-surat','edit-surat']);
    }
}
