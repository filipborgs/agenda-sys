<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
    protected $fillable = [
        'nome', 'cpfCnpj', 'email', 'tipoPessoa'
    ];


    public function setNomeAttribute($valor)
    {
        $this->attributes['nome'] = $valor;
    }

    public function setCpfCnpjAttribute($valor)
    {
        $caracteres = array("-", ".", "/", "\\");
        $valor = str_replace($caracteres, "", $valor);

        $this->attributes['cpfCnpj'] = $valor;
    }

    public function setEmailAttribute($valor)
    {
        if (strpos($valor, '@')) {
            $this->attributes['email'] = $valor;
        } else {
            throw new \Exception('Email invalido');
        }
    }

    public function setTipoPessoaAttribute($valor)
    {
        if (strcasecmp('F', $valor) === 0 || strcasecmp('J', $valor) === 0) {
            $this->attributes['tipoPessoa'] = $valor;
        } else {
            throw new \Exception('Tipo invalido');
        }
    }

    public function endereco()
    {
        return $this->hasOne(Endereco::class, 'cliente', 'id');
    }

    public function contatos()
    {
        return $this->hasMany(Contato::class, 'cliente', 'id');
    }
}
