<?php

namespace App\Http\Controllers;

use App\Bairro;
use App\Cidade;
use App\Cliente;
use App\Contato;
use App\Endereco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($pesquisa = '')
    {
        // $clientes = Cliente::simplePaginate(15);
        // return $clientes;
        // $cliente = Cliente::where('id', 1)->first();

        // $end = $cliente->endereco()->first();
        // var_dump($end);

        // $users = DB::table('clientes')
        //     ->join('contatos', 'clientes.id', '=', 'contatos.cliente')
        //     ->groupBy('clientes.id')->simplePaginate(15);

        $clientes = DB::table('clientes')
            ->join('contatos', 'clientes.id', '=', 'contatos.cliente')->select('clientes.*', 'contatos.telefone', 'contatos.ddd')->whereRaw('nome like ? or telefone like ?', ["%{$pesquisa}%", "%{$pesquisa}%"])->groupBy('cliente')
            ->paginate(1);

        return $clientes;
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

        $cliente = new Cliente();
        $cliente->nome = $json->nome;
        $cliente->cpfCnpj = $json->cpfCnpj;
        $cliente->email = $json->email;
        $cliente->tipoPessoa = $json->tipoPessoa;
        $cliente->save();

        $endereco = new Endereco();
        $endereco->bairro = $bairro->id;
        $endereco->cliente = $cliente->id;
        $endereco->cep = $json->endereco->cep;
        $endereco->logadouro = $json->endereco->logadouro;
        $endereco->numero = $json->endereco->numero;
        $endereco->complemento = $json->endereco->complemento;
        $endereco->save();

        foreach ($json->contatos as &$contatoForm) {
            $contato = new Contato();
            $contato->ddd = $contatoForm->ddd;
            $contato->telefone = $contatoForm->telefone;
            $contato->cliente = $cliente->id;
            $contato->save();
        }

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
        echo '200';
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
