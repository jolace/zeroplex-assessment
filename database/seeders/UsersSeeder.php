<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'Admin')->first();
        $regularUserRole = Role::where('name', 'Regular User')->first();
        
        User::factory()->count(2)->create()->each(function ($user) use ($adminRole) {
            $user->assignRole($adminRole);
        });
        User::factory()->count(4)->create()->each(function ($user) use ($regularUserRole) {
            $user->assignRole($regularUserRole);
        });
    }
}
