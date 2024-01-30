<?php

namespace App\Http\Controllers;

use App\Models\Ingresso;
use App\Models\tipoIngresso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IngressoController extends Controller
{
    private $totalPage = 3;

    private $ingresso;

    public function __construct(Ingresso $ingresso)
    {
        $this->ingresso = $ingresso;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function list()
    {
        $ingressos = $this->ingresso->orderBy('id', 'ASC')->paginate($this->totalPage);
        if (Auth::guard('admin')->check()) {
            return view('admin/list-ingresso',
                compact('ingressos')
            );
        }
        
        return redirect()->route('view.login-admin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::guard('admin')->check()) {
            return view('admin/create-ingresso');
        }
        
        return redirect()->route('view.login-admin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->check()) {
            $dados = $request->all();
            
            $inserir = $this->ingresso->inserir($dados);
            if($inserir['status']) {
                return redirect()->route('ingresso.list');
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
        $ingresso = Ingresso::find($id);
        return view('user.ingresso', compact('ingresso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::guard('admin')->check()) {
            if (!$ingressos = $this->ingresso->find($id)) {          
                return redirect()->route('ingresso.list');
            }

            $tipoIngressos = tipoIngresso::orderBy('id', 'ASC')->get();

            return view('admin.ingresso-edit', compact('ingressos', 'tipoIngressos'));
        }

        return redirect()->route('view.login-admin');
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
        if (!$ingressos = $this->ingresso->find($id)) {          
            return redirect()->route('ingresso.list');
        }

        $dados = $request->all();

        $editando = $ingressos->update($dados);

        if($editando) {
            return redirect()->route('ingresso.list');
        }
        
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->ingresso->findOrFail($id)->delete();

        return redirect()->route('ingresso.list');
    }
}
