<?php

namespace Database\Factories;

use App\Models\Clientes;
use App\Models\ClienteServico;
use App\Models\Profissional;
use App\Models\Servico;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agendamento>
 */
class AgendamentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   $status = $this->faker->boolean();
        return [
            'cliente_id' => \App\Models\Clientes::factory(),
            'profissional_id' => \App\Models\Profissional::factory(),
            'data' => $this->faker->date(),
            'hora' => $this->faker->time(),
            'status' => $this->faker->boolean(),
            'pagamento' => $this->faker->randomElement(['C', 'D', 'P', 'Di']),
            'preco' => $this->faker->randomFloat(2, 50, 500),
            'data_pagamento' => $this->faker->optional()->dateTime(),

        ];
    }
}
