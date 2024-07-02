<?php

namespace Database\Factories;

use App\Models\Agendamento;
use App\Models\Clientes;
use App\Models\Servico;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClienteServicoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cliente_id' => Clientes::all()->random()->id,
            'servico_id' => Servico::all()->random()->id,
            'agendamento_id' => Agendamento::all()->random()->id,
           
        ];
    }
}
