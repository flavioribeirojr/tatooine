<?php

use Illuminate\Database\Seeder;
use App\Models\Security\User;

class UserAdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'usr_username' => 'admin',
            'usr_password' => bcrypt('123456'),
            'usr_email'    => 'admin@system.com',
            'usr_name'     => 'Admin'
        ]);
    }
}