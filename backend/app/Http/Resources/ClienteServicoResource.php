<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClienteServicoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Numero do serviço' => $this->id,

            'Agendamento'=>[
                'agenda_n'=>$this->agendamento->id,
                'Data'=>Carbon::parse($this->agendamento->data)->format('d/m/Y '),
                'Hora'=>Carbon::parse($this->agendamento->hora)->format('H:i:s '),
                'status_pagamento' => $this->agendamento->status ? 'Pago' : 'Não Pagou',
                
            ],
            'Cliente'=>[
                'Cliente'=> $this->cliente->nome,
                'Contato' => $this->cliente->telefone,
            ],
            'Servico'=>[
                'tipo_servico'=>$this->servico->tipo,
                'duraco'=>Carbon::parse($this->servico->duracao)->format('H:i'),
                'valor'=>'R$ '. number_format($this->servico->preco, 2, ',', '.'),
            ],

        ];
    }
}
