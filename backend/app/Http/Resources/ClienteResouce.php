<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResouce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id'=>$this->id,
            'nome_completo'=>$this->nome,
            'telefone'=>$this->telefone,
            'email'=>$this->email,
            'aniversario'=>Carbon::parse($this->aniversario)->format('d/m/Y '),
            'services' => ServiceResourcee::collection($this->whenLoaded('servicos'))
        ];
    }
}
