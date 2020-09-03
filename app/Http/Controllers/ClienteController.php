<?php

namespace App\Http\Controllers;

use App\Bairro;
use App\Cidade;
use App\Cliente;
use App\Endereco;
use Illuminate\Http\Request;

class ClienteController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $rs)
    {
        //
        $rs->headers->set('Content-Type', 'application/json');
        $uri =  $rs->getContent();
        $json = json_decode($uri);

        $cidade = new Cidade();
        $cidade->nome = $json->endereco->bairro->cidade->nome;
        $cidade->uf = $json->endereco->bairro->cidade->uf;
        $cidade->save();

        $bairro = new Bairro();
        $bairro->nome = $json->endereco->bairro->nome;
        $bairro->cidade = $cidade->id;
        $bairro->save();

        $endereco = new Endereco();
        $endereco->bairro = $bairro->id;
        $endereco->cep = $json->endereco->cep;
        $endereco->logadouro = $json->endereco->logadouro;
        $endereco->numero = $json->endereco->numero;
        $endereco->complemento = $json->endereco->complemento;
        $endereco->save();

        $cliente = new Cliente();
        $cliente->endereco = $endereco->id;
        $cliente->nome = $json->nome;
        $cliente->cpfCnpj = $json->cpfCnpj;
        $cliente->email = $json->email;
        $cliente->tipoPessoa = $json->tipoPessoa;
        $cliente->save();

        // $clientCollection = Cidade::hydrate([json_decode($uri, true)]);
        // $cidade = $clientCollection->first();
        // $cidade->save();

        // $data = json_decode($uri, true);
        // $client = new Cidade();
        // $client->set($data);
        // $client->save();

        // echo $uri;
        // $cidade->nome = "feira de santana";
        // $cidade->uf = "BA";
        echo 'sucesso';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
