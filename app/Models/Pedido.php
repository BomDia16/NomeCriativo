<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'ingresso_id', 'ingresso_qtd', 'total'
    ];

    protected $table = 'pedidos';

    public function inserir($dados, $preco, $sexo) {
        $preco = $preco->preco+$sexo;
        $total = $preco*$dados['ingresso_qtd'];
        $pedido = $this->create([
            'user_id'           => auth()->user()->id,
            'ingresso_id'       => $dados['ingresso_id'],
            'ingresso_qtd'      => $dados['ingresso_qtd'],
            'total'             => $total,
        ]);

        if($pedido){
            return [
                'success' => true,
                'message' => 'Sucesso ao fazer o seu pedido, o total ficou R${{ $total }},00!'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Falha ao fazer o seu pedido!',
            ];
        }
    }
}
