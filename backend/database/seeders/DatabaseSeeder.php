<?php

namespace Database\Seeders;

use App\Models\Agendamento;
use App\Models\Clientes;
use App\Models\ClienteServico;
use App\Models\Profissional;
use App\Models\Servico;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         //\App\Models\User::factory(20)->create();
        //Clientes::factory(10)->create();
         //Profissional::factory(8)->create();
        // Servico::factory(5)->create();
      //  Agendamento::factory(5)->create();
      ClienteServico::factory(5)->create();

    //    $this->call([
    //     ServicoSeeder::class,
    //    ]);

    
    }
}
