<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'title' => 'Retiro de Jovens 2026',
                'slug' => 'retiro-jovens-2026',
                'description' => '<p>Um final de semana transformador com louvor, ensino bÃ­blico e comunhÃ£o.</p><p>Inclui: hospedagem, alimentaÃ§Ã£o completa e materiais.</p>',
                'instructions' => 'Trazer: BÃ­blia, caderno, roupas confortÃ¡veis, roupa de banho e toalha.',
                'start_at' => now()->addDays(30),
                'end_at' => now()->addDays(32),
                'location_name' => 'SÃ­tio Recanto da Paz',
                'location_address' => 'Zona Rural, Garanhuns - PE',
                'capacity' => 50,
                'price_cents' => 15000,
                'registration_open_at' => now(),
                'registration_close_at' => now()->addDays(25),
                'status' => 'published',
            ],
            [
                'title' => 'ConferÃªncia Anual IAGUS',
                'slug' => 'conferencia-anual-2026',
                'description' => '<p>TrÃªs noites de ministraÃ§Ã£o poderosa com pregadores convidados.</p><p>Tema: "RenovaÃ§Ã£o e PropÃ³sito"</p>',
                'instructions' => 'Evento gratuito. Vagas limitadas. Chegue com antecedÃªncia.',
                'start_at' => now()->addDays(15),
                'end_at' => now()->addDays(17),
                'location_name' => 'Igreja Anglicana de Garanhuns',
                'location_address' => 'Rua exemplo, 123 - Centro, Garanhuns - PE',
                'capacity' => 200,
                'price_cents' => 0,
                'registration_open_at' => now(),
                'registration_close_at' => now()->addDays(14),
                'status' => 'published',
            ],
            [
                'title' => 'Curso de Discipulado',
                'slug' => 'curso-discipulado-2026',
                'description' => '<p>Curso intensivo de 8 semanas sobre fundamentos da fÃ© cristÃ£.</p>',
                'instructions' => 'Material incluso. Aulas Ã s quartas-feiras, 19h30.',
                'start_at' => now()->addDays(7),
                'end_at' => now()->addDays(63),
                'location_name' => 'Igreja Anglicana de Garanhuns',
                'location_address' => 'Rua exemplo, 123 - Centro, Garanhuns - PE',
                'capacity' => 30,
                'price_cents' => 5000,
                'registration_open_at' => now(),
                'registration_close_at' => now()->addDays(5),
                'status' => 'published',
            ],
            [
                'title' => 'Acampamento de FamÃ­lias',
                'slug' => 'acampamento-familias-2026',
                'description' => '<p>Final de semana especial para fortalecer laÃ§os familiares atravÃ©s da fÃ©.</p>',
                'instructions' => 'Evento para famÃ­lias completas. CrianÃ§as devem estar acompanhadas dos pais.',
                'start_at' => now()->addDays(60),
                'end_at' => now()->addDays(62),
                'location_name' => 'Camping Vale Verde',
                'location_address' => 'BR-423, Km 12 - Garanhuns - PE',
                'capacity' => 40,
                'price_cents' => 20000,
                'registration_open_at' => now()->addDays(10),
                'registration_close_at' => now()->addDays(55),
                'status' => 'draft',
            ],
        ];

        foreach ($events as $event) {
            Event::firstOrCreate(
                ['slug' => $event['slug']],
                $event
            );
        }
    }
}

