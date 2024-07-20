<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();

        User::factory(10)->create()->each(function ($user) use ($adminRole, $userRole) {
            // ユーザーIDが1の場合は管理者権限を付与
            if ($user->id == 1) {
                $user->roles()->attach($adminRole);
                return;
            }
            $user->roles()->attach($userRole);
        });
    }
}
