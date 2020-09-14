<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'                 => 1,
                'name'               => 'Admin',
                'email'              => 'admin@admin.com',
                'password'           => '$2y$10$bYTH1JAYBL/EIxCZZtsC8eW4ynCcx.w/KfBlKvmUY.q.MZW9njfEi',
                'remember_token'     => null,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2019-10-24 19:38:02',
                'phone'              => '',
                'verification_token' => '',
            ],
        ];

        User::insert($users);
    }
}
