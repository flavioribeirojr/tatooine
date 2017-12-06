<?php

use Illuminate\Database\Seeder;
use App\Models\Security\Profile;
use App\Models\Security\User;

class ProfileMasterSeeder extends Seeder
{
    public function run()
    {
        $master = Profile::create([
            'prf_name' => 'master'
        ]);

        $admin = User::where('usr_username', 'admin')->first();

        $master->users()->attach($admin->usr_id);
    }
}