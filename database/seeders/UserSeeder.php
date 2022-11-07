<?php

namespace Database\Seeders;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = '$Password;';
        $users = [
            [
                'first_name'    => "Admin",
                'last_name'     => "System",
                'username'      => "admin",
                'phone'         => "2340000000000",
                'email'         => "admin@example.com",
                'password'      => $password,
                'password_confirmation' => $password,
            ]
        ];

        $account = new CreateNewUser();
        foreach ($users as $key => $user) {
            $account->create($user);
        }
    }
}
