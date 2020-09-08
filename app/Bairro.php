<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bairro extends Model
{
    //
    protected $fillable = [
        'nome'
    ];

    public function setNomeAttribute($valor)
    {
        $this->attributes['nome'] = $valor;
    }

    public function cidade()
    {
        return $this->hasOne(Cidade::class, 'id', 'cidade');
    }

    public function endereco()
    {
        return $this->belongsTo(Endereco::class, 'bairro', 'id');
    }
}
