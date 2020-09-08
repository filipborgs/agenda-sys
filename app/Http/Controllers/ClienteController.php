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
            ->paginate(5);

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
    public function show($id)
    {
        $cliente = Cliente::where('id', $id)->first();

        $cliente->contatos = $cliente->contatos()->get();

        $cliente->endereco = $cliente->endereco()->first();

        $cliente->endereco->bairro = $cliente->endereco->bairro()->first();

        $cliente->endereco->bairro->cidade = $cliente->endereco->bairro->cidade()->first();

        return $cliente;
        // $cliente = Cliente::find($id);

        // $cliente->contatos;
        // $cliente->endereco;
        // $cliente->endereco->bairro;
        // $cliente->endereco->bairro->cidade;

        // return $cliente;
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
    public function update(Request $request)
    {
        //json
        $request->headers->set('Content-Type', 'application/json');
        $uri =  $request->getContent();
        $json = json_decode($uri);

        //cliente
        $cliente = Cliente::find($json->id);
        $cliente->nome = $json->nome;
        $cliente->cpfCnpj = $json->cpfCnpj;
        $cliente->email = $json->email;
        $cliente->tipoPessoa = $json->tipoPessoa;
        $cliente->save();

        //endereco
        $cliente->endereco;
        $cliente->endereco->cep = $json->endereco->cep;
        $cliente->endereco->logadouro = $json->endereco->logadouro;
        $cliente->endereco->numero = $json->endereco->numero;
        $cliente->endereco->complemento = $json->endereco->complemento;
        $cliente->endereco->save();

        //bairro
        $cliente->endereco->bairro = $cliente->endereco->bairro()->first();
        $cliente->endereco->bairro->nome = $json->endereco->bairro->nome;
        $cliente->endereco->bairro->save();

        //cidade
        $cliente->endereco->bairro->cidade = $cliente->endereco->bairro->cidade()->first();
        $cliente->endereco->bairro->cidade->nome = $json->endereco->bairro->cidade->nome;
        $cliente->endereco->bairro->cidade->uf = $json->endereco->bairro->cidade->uf;
        $cliente->endereco->bairro->cidade->save();

        for ($i = 0; $i < sizeof($cliente->contatos); $i++) {
            //    if($cliente->contatos[$i]->id === $json->contatos[$i]->id)
            $cliente->contatos[$i]->ddd = $json->contatos[$i]->ddd;
            $cliente->contatos[$i]->telefone = $json->contatos[$i]->telefone;
            $cliente->contatos[$i]->save();
        }

        // foreach ($cliente->contatos as &$contato) {
        //     $contato->ddd = $contatoForm->ddd;
        //     $contato->telefone = $contatoForm->telefone;
        //     $contato->cliente = $cliente->id;
        //     $contato->save();
        // }

        return $cliente;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();
    }
}
