<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    public function run()
    {
        // Pastikan role sudah ada
        if (!Role::where('name', 'user')->exists()) {
            Role::create(['name' => 'user']);
        }

        if (!Role::where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin']);
        }

        // Temukan pengguna dan role
        $user = User::find(2); // Ganti '1' dengan ID pengguna yang sesuai
        $roleUser = Role::findByName('admin'); // Ganti 'user' dengan nama role yang sesuai

        if ($user && $roleUser) {
            // Tambahkan role ke pengguna
            $user->assignRole($roleUser);
        } else {
            // Error handling jika pengguna atau role tidak ditemukan
            if (!$user) {
                $this->command->error('User not found!');
            }
            if (!$roleUser) {
                $this->command->error('Role not found!');
            }
        }
    }
}

