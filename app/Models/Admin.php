<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admins';

    protected $fillable = [
        'name', 'usuário', 'email', 'celular', 'password'
    ];

    public function inserir($dados) {
        $cadastrar = $this->create([
            'name'          => $dados['nome'],
            'usuário'       => $dados['usuario'],
            'email'         => $dados['email'],
            'celular'       => $dados['celular'],
            'password'      => bcrypt($dados['senha']),
        ]);

        if($cadastrar){
            return [
                'status' => true,
                'message' => 'Sucesso ao cadastrar o admin!'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Falha ao cadastrar o admin!',
            ];
        }
    }

    public function getAuthPassword() {
        return $this->password;
    }

    public function login($dados) {
        $credenciais = [
            'usuário' => $dados['usuario'],
            'password' => $dados['password']
        ];
        return Auth::guard('admin')->attempt($credenciais);
    }

    public function logout() {
        return Auth::guard('admin')->logout();
    }
}
