<?php

use Illuminate\Database\Seeder;

class UserSuperAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nama' => 'SuperAdmin',
            'id_jabatan' => '1',
            'no_telepon' => '0213',
            'email' => 'SIRS@rs.com',
            'password' => bcrypt('rootpassword'),
        ]);
    }
}
