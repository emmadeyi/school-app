<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UserRole;
use App\Http\Helpers\AppHelper;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo 'seeding users...', PHP_EOL;

        $admin= User::create(
            [
                'name' => 'Mr. admin',
                'username' => 'admin',
                'email' => 'admin@sms.com',
                'password' => bcrypt('demo123'),
                'remember_token' => null,
            ]
        );

       UserRole::create(
           [
               'user_id' => $admin->id,
               'role_id' => AppHelper::USER_ADMIN
           ]
       );
        $developer= User::create(
            [
                'name' => 'Developer',
                'username' => 'developer',
                'email' => 'developer@sms.com',
                'password' => bcrypt('password'),
                'remember_token' => null,
            ]
        );

       UserRole::create(
           [
               'user_id' => $developer->id,
               'role_id' => AppHelper::USER_ADMIN
           ]
       );

    }
}
