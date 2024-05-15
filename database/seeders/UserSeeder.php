<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'William Koerich',
            'email' => 'williamkoerich17@gmail.com',
            'password' => Hash::make('searchandstay') // Criptografa a senha
        ]);
    }
}
