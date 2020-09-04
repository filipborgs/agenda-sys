<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
    protected $fillable = [
        'nome', 'cpfCnpj', 'email', 'tipoPessoa'
    ];

    public function endereco()
    {
        return $this->hasOne(Endereco::class, 'cliente', 'id');
    }

    public function contatos()
    {
        return $this->hasMany(Contato::class, 'cliente', 'id');
    }
}
