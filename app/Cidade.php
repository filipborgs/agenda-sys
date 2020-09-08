<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    //
    protected $fillable = [
        'nome', 'uf'
    ];

    public function setNomeAttribute($valor)
    {
        $this->attributes['nome'] = $valor;
    }

    public function setUfAttribute($valor)
    {
        if (strlen($valor) === 2) {
            $this->attributes['uf'] = $valor;
        } else {
            throw new \Exception('UF invalido');
        }
    }

    public function bairro()
    {
        return $this->belongsTo(Bairro::class, 'cidade', 'id');
    }


    // public function set($data)
    // {
    //     foreach ($data as $key => $value) {
    //         $this->{$key} = $value;
    //     }
    // }
}
