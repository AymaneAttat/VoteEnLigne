<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(array(
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
            'name' => 'Aymane',
            'is_admin'=> 1,
            'role_id' => 1,
            'cin' => 'GA536711',
            'voted' => false
        ));
        User::create(array(
            'email' => 'comptage@gmail.com',
            'password' => Hash::make('comptage123'),
            'email_verified_at' => now(),
            'name' => 'comptage',
            'is_admin'=> 0,
            'role_id' => 2,
            'cin' => 'GZ965210',
            'voted' => false
        ));
        User::create(array(
            'email' => 'depouillement@gmail.com',
            'password' => Hash::make('depouillement123'),
            'email_verified_at' => now(),
            'name' => 'depouillement',
            'is_admin'=> 0,
            'role_id' => 3,
            'cin' => 'GD670144',
            'voted' => false
        ));
    }
}
