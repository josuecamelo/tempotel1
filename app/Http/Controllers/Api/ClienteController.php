<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClienteCreateRequest;
use App\Http\Requests\ClienteUpdateRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends BaseController
{
    private $clienteModel;

    public function __construct(Cliente $clienteModel)
    {
        $this->clienteModel = $clienteModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::paginate();

        return $this->sendResponse($clientes, 'Produtos Obtivos com Sucesso.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteCreateRequest $request)
    {
        $input = $request->all();
        $cliente = Cliente::create($input);
        return $this->sendResponse($cliente, 'Cliente Criado com Sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);

        if (is_null($cliente)) {
            return $this->sendError('CLiente not found.');
        }

        return $this->sendResponse($cliente, 'Cliente Obtivo com Sucesso.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteUpdateRequest $request, Cliente $cliente)
    {
        $input = $request->all();

        $cliente->nome = $input['nome'];
        $cliente->telefone = $input['telefone'];
        $cliente->data_nascimento = $input['data_nascimento'];
        $cliente->ativo = $input['ativo'];
        $cliente->save();

        return $this->sendResponse($cliente, 'Cliente Atualizado com Sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return $this->sendResponse([], 'Cliente Deletado com Sucesso.');
    }
}
