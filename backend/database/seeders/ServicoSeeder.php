<?php

namespace Database\Seeders;

use App\Models\Servico;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = ['Coloração e Mechas', 'Corte de Cabelo', 'Alisamento e Relaxamento', 'Penteados e Estilização'];
        foreach ($tipos as $tipo) {
            Servico::factory()->create(['tipo' => $tipo]);
        }
    }
}
