<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [1, 'administrator', 'Administrator']
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                [
                    'name' => $role[1],
                ],
                [
                    'level' => $role[0],
                    'name' => $role[1],
                    'description' => $role[2],
                    'guard_name' => 'api',
                ]
            );
        }
    }
}
