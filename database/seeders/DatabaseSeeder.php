<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Criar usuário admin
        User::firstOrCreate(
            ['email' => 'admin@iagus.org.br'],
            [
                'name' => 'Administrador IAGUS',
                'phone' => '87999999999',
                'password' => Hash::make('iagus2026'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Criar usuário de teste
        User::firstOrCreate(
            ['email' => 'joao@example.com'],
            [
                'name' => 'João Silva',
                'phone' => '87988888888',
                'password' => Hash::make('password'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]
        );

        // Chamar seeder de eventos
        $this->call([
            EventSeeder::class,
        ]);
    }
}
