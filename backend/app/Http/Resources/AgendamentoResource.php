<?php

namespace App\Http\Resources;

use App\Models\Clientes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AgendamentoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    private $pagamentos = ['C' => 'Credito', 'D' => 'Debito', 'P' => 'Pixe', 'Di' => 'Dinheiro'];

    public function toArray(Request $request): array
    {


        return [
            'nota_Fiscal' => $this->id,
            'cliente' => $this->cliente->nome,
            'Profissional' => $this->profissional->nome,
            'data' => Carbon::parse($this->data)->format('d/m/Y'),
            'horas' => Carbon::parse($this->hora)->format('H:i'),
            'status_pagamento' => $this->status ? 'Pago' : 'Não Pagou',
            'data_pagamento' => $this->status ? Carbon::parse($this->data_pagamento)->format('d/m/Y H:i:s') : null,
            'paymer' => $this->status ? Carbon::parse($this->data_pagamento)->diffForHumans() : null,

        ];
    }
}
