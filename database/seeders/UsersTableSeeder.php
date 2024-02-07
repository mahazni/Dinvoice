<?php

namespace Database\Seeders;

use Dinvoice\Models\Company;
use Illuminate\Database\Seeder;
use Dinvoice\Models\User;
use Dinvoice\Models\Setting;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email' => 'admin@devlopy.tn',
            'name' => 'Jane Doe',
            'role' => 'super admin',
            'password' => 'dinvoice@123'
        ]);

        $company = Company::create([
            'name' => 'xyz',
            'unique_hash' => str_random(20)
        ]);

        $user->company_id = $company->id;
        $user->save();

        Setting::setSetting('profile_complete', 0);
    }
}
