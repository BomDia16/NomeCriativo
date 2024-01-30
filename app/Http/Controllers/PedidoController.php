<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompraIngressoRequest;
use App\Models\Ingresso;
use App\Models\Pedido;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    private $pedido;

    public function __construct(Pedido $pedido)
    {
        $this->pedido = $pedido;
    }

    private $totalPage = 5;

    public function list()
    {
        $pedidos = $this->pedido->orderBy('id', 'ASC')->paginate($this->totalPage);
        
        if (Auth::guard('admin')->check()) {
            return view('admin/list-pedidos',
                compact('pedidos')
            );
        }
        
        return redirect()->route('view.login-admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $pedidos = $this->pedido->where('user_id', '=', auth()->user()->id)->paginate($this->totalPage);
            return view('user.pedidos', compact('pedidos'));
        }
        
        return redirect()->route('view.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompraIngressoRequest $request)
    {
        if (Auth::check()) {
            $dados = $request->all();
            $preco = Ingresso::find($dados['ingresso_id']);
            if($dados['sexo'] == 1){
                $sexo = 2;
            }
            else{
                $sexo = 0;
            }

            $inserir = $this->pedido->inserir($dados, $preco, $sexo);
            if($inserir['success']) {
                return redirect()->back()
                                ->with('success', $inserir['message']);;
            }
            return redirect()
                    ->back()
                    ->withErrors($inserir['message']);
        }
        
        return redirect()->route('view.login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
