<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(array(
            'name' => 'Administrator'
        ));
        Role::create(array(
            'name' => 'Comptage'
        ));
        Role::create(array(
            'name' => 'Depouillement'
        ));
        Role::create(array(
            'name' => 'Voteur'
        ));
    }
}
