<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    //
    protected $fillable = [
        'nome', 'uf'
    ];


    // public function set($data)
    // {
    //     foreach ($data as $key => $value) {
    //         $this->{$key} = $value;
    //     }
    // }
}
