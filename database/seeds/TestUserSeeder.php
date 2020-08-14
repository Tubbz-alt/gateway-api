<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'test_role',
        ]);

        DB::table('users')->insert([
            'name' => 'test_user',
            'role_id' => 1,
            'api_token' => 'A9QKUyb54amSM5EWj8wC9c6jmUKmaLjx',
        ]);

        DB::table('role_permissions')->insert([
            'role_id' => 1,
            'ability' => 'test_ability',
        ]);
    }
}
