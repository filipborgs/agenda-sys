<?php

namespace App\Http\Controllers;

use App\Cidade;
use App\User;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        //
    }

    public function login(Request $rs)
    {
        $rs->headers->set('Content-Type', 'application/json');
        $uri =  $rs->getContent();
        $retorno = json_decode($uri);

        $newserials = json_decode(json_encode($uri));
        $newserials->save();

        $clientCollection = Cidade::hydrate([json_decode($uri, true)]);
        $cidade = $clientCollection->first();
        $cidade->save();

        // $data = json_decode($uri, true);
        // $client = new Cidade();
        // $client->set($data);
        // $client->save();

        // echo $uri;
        // $cidade->nome = "feira de santana";
        // $cidade->uf = "BA";
        echo 'sucesso';
    }
}
