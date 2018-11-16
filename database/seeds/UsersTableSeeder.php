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
            'nome' => 'Super Admin',
            'usuario' => 'admin',
            'email' => 'admin@admin.com.br',
            'senha' => Hash::make('admin'),
        ]);
    }
}
