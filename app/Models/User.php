<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'usuário', 'email', 'cep', 'celular', 'password',
    ];

    protected $table = 'users';

    public function inserir($dados) {
        $cadastrar = $this->create([
            'name'          => $dados['name'],
            'usuário'       => $dados['usuario'],
            'email'         => $dados['email'],
            'cep'           => $dados['cep'],
            'celular'       => $dados['celular'],
            'password'      => bcrypt($dados['password']),
        ]);

        if($cadastrar){
            return [
                'status' => true,
                'message' => 'Sucesso ao cadastrar o usuário!'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Falha ao cadastrar o usuário!',
            ];
        }
    }

    public function login($dados) {
        $credenciais = [
            'usuário' => $dados['usuario'],
            'password' => $dados['password']
        ];
        return Auth::attempt($credenciais);
    }

    public function logout() {
        return Auth::logout();
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
