<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    //
    protected $fillable = [
        'cep', 'logadouro', 'numero', 'complemento'
    ];

    public function setCepAttribute($valor)
    {
        $valor = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $valor);
        $this->attributes['cep'] = $valor;
    }

    public function setLogadouroAttribute($valor)
    {
        $this->attributes['logadouro'] = $valor;
    }

    public function setNumeroAttribute($valor)
    {
        $this->attributes['numero'] = $valor;
    }

    public function setComplementoAttribute($valor)
    {
        $this->attributes['complemento'] = $valor;
    }


    public function bairro()
    {
        return $this->hasOne(Bairro::class, 'id', 'bairro');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente', 'id');
    }
}
