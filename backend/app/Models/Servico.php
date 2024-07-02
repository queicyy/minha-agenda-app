<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;
    protected $fillable = [
       'id', 'tipo', 'preco', 'duracao',
    ];

    public function agendamentos()
    {
        return $this->belongsToMany(Agendamento::class, 'cliente_servico', 'servico_id', 'agendamento_id')
                    ->withPivot('id');
    }

    public function cliente()
    {
        return $this->belongsTo(Clientes::class);
    }
}
