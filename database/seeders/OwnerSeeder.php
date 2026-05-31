<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class OwnerSeeder extends Seeder
{
    public function run(): void
    {

        User::updateOrCreate(
            ['email' => 'usuario'],
            [
                'name'     => 'Administrador',
                'password' => Hash::make('usuario'),
            ]
        );
    }
}
