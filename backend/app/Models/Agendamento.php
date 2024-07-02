<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'cliente_id',
        'profissional_id',
        
        'data',
        'hora',
        'status',
        'pagamento',
        'preco',
    ];

    public function cliente()
    {
        return $this->belongsTo(Clientes::class);
    }
    public function profissional()
    {
        return $this->belongsTo(Profissional::class);
    }



    public function servicos()
    {
        return $this->belongsToMany(Servico::class, 'cliente_servico', 'agendamento_id', 'servico_id')
                    ->withPivot('id');
    }
}
