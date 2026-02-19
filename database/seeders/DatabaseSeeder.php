<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Criar/atualizar usuário admin padrão
        User::updateOrCreate(
            ['role' => 'admin'],
            [
                'name' => 'Administrador IAGUS',
                'email' => 'admin@iagus.com.br',
                'phone' => '87999999999',
                'password' => Hash::make('Iagus@26'),
                'email_verified_at' => now(),
            ]
        );

        // Chamar seeder de eventos
        $this->call([
            EventSeeder::class,
        ]);
    }
}
