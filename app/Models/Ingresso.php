<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingresso extends Model
{
    use HasFactory;

    protected $table = 'ingressos';

    protected $fillable = [
        'titulo', 'descricao', 'imagem', 'preco', 'tipoIngresso'
    ];

    public function inserir($dados) {
        $cadastrar = $this->create([
            'titulo'          => $dados['titulo'],
            'descricao'       => $dados['descricao'],
            'imagem'          => $dados['imagem'],
            'preco'           => $dados['preco'],
            'tipoIngresso'    => $dados['tipoIngresso'],
        ]);

        if($cadastrar){
            return [
                'status' => true,
                'message' => 'Sucesso ao inserir o ingresso!'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Falha ao inserir o ingresso!',
            ];
        }
    }
}
