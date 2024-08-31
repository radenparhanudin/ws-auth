<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $administrator = User::whereUsername('administrator')->first();
        if (!$administrator) {
            $administrator = User::create([
                'name' => 'Administrator',
                'username' => 'administrator',
                'email' => 'administrator@mail.com',
                'password' => Hash::make('password')
            ]);
        }

        $administrator->syncRoles(['administrator']);
    }
}
