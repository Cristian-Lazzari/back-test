<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'      => 'Ceo',
                'email'     => 'amministrazioneristorantesushi@gmail.com',
                'password'  => Hash::make('mzamazesushi789!'),
            ]
        ];

        foreach ($users as $user_data) {
            User::create($user_data);
        }

    }
}
