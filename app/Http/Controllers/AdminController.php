<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    private $totalPage = 6;
    // só pra por no github

    private $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function index_login()
    {
        return view('admin.login');
    }

    public function login(UserLoginRequest $request) {
        $dados = $request->all();
        $login = $this->admin->login($dados);
        if(!$login) {
            return back()
                    ->withInput()
                    ->withErrors([
                        'As credenciais fornecidas não correspondem aos nossos registros.'
                    ]);
        }
        return redirect()->intended(route('admin.index'));
    }

    public function logout() {
        $this->admin->logout();
        return redirect()->route('view.login-admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            return view('admin/index');
        }
        
        return redirect()->route('view.login-admin');
    }

    public function list()
    {
        $admins = $this->admin->orderBy('id', 'ASC')->paginate($this->totalPage);;
        if (Auth::guard('admin')->check()) {
            return view('admin/list',
                compact('admins')
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
            return view('admin/create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->all();
        
        $inserir = $this->admin->inserir($dados);
        if($inserir['status']) {
            return redirect()->route('admin.list');
        }
        return redirect()
                ->back()
                ->withErrors($inserir['message']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
