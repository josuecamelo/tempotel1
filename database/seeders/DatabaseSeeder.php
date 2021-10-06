<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\User::factory(1)->create();

        for($i=0; $i<=10; $i++){
            $produto = \App\Models\Produto::create([
                'nome' => 'Produto '.$i,
                'ativo' => ($i%2) == 0 ? 1: 0,
                'valor' => (float)rand(1,999)
            ]);

            $cliente = \App\Models\Cliente::create([
                'nome' => 'Cliente '.$i,
                'ativo' => (($i%2) == 0) ? 1: 0,
                'data_nascimento' => '01/05/1990',
                'telefone' => '6299999'.rand(1000,9999)
            ]);

            $pedido = \App\Models\Pedido::create([
                'cliente_id' => $cliente->id,
                'valor_total' => 0.00
            ]);

            $valor = 0.00;
            for($b=0; $b<=rand(1, 100); $b++){
                \App\Models\PedidoItem::create([
                    'pedido_id' => $pedido->id,
                    'produto_id' => $produto->id,
                    'quantidade' => rand(1,15),
                    'valor_unitario' => $produto->valor
                ]);

                $valor+= $produto->valor;
            }

            $pedido->valor_total = $valor;
            $pedido->save();
        }
    }
}
