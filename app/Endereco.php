<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    //
    protected $fillable = [
        'cep', 'logadouro', 'numero', 'complemento'
    ];

    public function bairro()
    {
        return $this->hasOne(Bairro::class, 'bairro', 'id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente', 'id');
    }
}
