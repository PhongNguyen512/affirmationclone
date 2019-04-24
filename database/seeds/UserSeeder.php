<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => 'sa@gmail.com',
            'role' => 'super_admin',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ]);        

        for ($i=0; $i < 3; $i++) { 
            DB::table('users')->insert([
                'name' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('123456'),
                'remember_token' => Str::random(10),
            ]);
        }
            
        
    }
}
