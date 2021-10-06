<?php

namespace App\Http\Controllers\Api;

use App\Models\Produto;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use Validator;
use App\Http\Resources\Produto as ProductResource;

class ProdutoController extends BaseController
{
    private $produtoModel;

    public function __construct(Produto $produtoModel)
    {
        $this->produtoModel = $produtoModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::paginate();

        return $this->sendResponse($produtos, 'Produtos Obtivos com Sucesso.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $produto = Produto::create($input);
        return $this->sendResponse($produto, 'Produto Criado com Sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = Produto::find($id);

        if (is_null($produto)) {
            return $this->sendError('Product not found.');
        }

        return $this->sendResponse($produto, 'Produto Obtivo com Sucesso.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        $input = $request->all();

        $produto->nome = $input['nome'];
        $produto->valor = $input['valor'];
        $produto->ativo = $input['ativo'];
        $produto->save();

        return $this->sendResponse($produto, 'Produto Atualizado com Sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();

        return $this->sendResponse([], 'Produto Deletado com Sucesso.');
    }
}
