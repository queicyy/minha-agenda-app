<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteServico extends Model
{
    use HasFactory;
    protected $table = 'cliente_servico';

    protected $fillable = [
        'cliente_id', 'servico_id', 'agendamento_id',
    ];

    public function servico()
    {
        return $this->belongsTo(Servico::class);
    }
    public function agendamento()
    {
        return $this->belongsTo(Agendamento::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Clientes::class);
    }
}
