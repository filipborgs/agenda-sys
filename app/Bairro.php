<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bairro extends Model
{
    //
    protected $fillable = [
        'nome'
    ];

    public function cidade()
    {
        return $this->hasOne(Cidade::class, 'cidade', 'id');
    }
}
