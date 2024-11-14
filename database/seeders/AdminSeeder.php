<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin STIKES',
            'email' => 'adminstikes@gmail.com',
            'password' => bcrypt('1234567890'), 
        ]);

        // Menambahkan role Admin ke akun admin
        $adminRole = Role::where('name', 'Admin')->first();
        $admin->assignRole($adminRole);
    }
}
