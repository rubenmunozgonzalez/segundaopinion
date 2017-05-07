<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('users')->insert([
            'name'          => 'Sourav Aich',
            'username'      => 'sourav',
            'email'         => 'sourav@tech-novelty.com',
            'password'      => Hash::make('123456'),
            'nid'           => '90198818181777',
            'mobile'        => '01716342179',
            'biography'     =>'Sourav is the admin of Telemedicin',
            'role'          => 'admin',
            'status'        => '1',
            'mailconfiorm'  => '1'
        ]);
    }
}
