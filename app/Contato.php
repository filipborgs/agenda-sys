<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    //
    protected $fillable = [
        'ddd', 'telefone'
    ];

    public function setDddAttribute($valor)
    {
        $this->attributes['ddd'] = $valor;
    }

    public function setTelefoneAttribute($valor)
    {
        $this->attributes['telefone'] = $valor;
    }
}
