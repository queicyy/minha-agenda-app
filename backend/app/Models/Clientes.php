<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome', 'telefone', 'email', 'aniversario',
    ];

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);
    }
    public function servicos()
    {
        return $this->hasMany(Servico::class);
    }
}
