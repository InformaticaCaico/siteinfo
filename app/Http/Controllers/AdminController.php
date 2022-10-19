<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth, Gate;

use App\Providers\RouteServiceProvider;

class AdminController extends Controller
{
    use SoftDeletes;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index ()
    {

        return Gate::allows('view admin page') ? view('usuarios.admin.admin') : redirect()->intended(RouteServiceProvider::HOME);

        /* if ($response->allowed()) {

            return view('usuarios.admin.admin');

        } else {

            return redirect()->intended(RouteServiceProvider::HOME);

        } */

    }


    public function cadastrados()
    {
        $lista = User::where('id', '<>' ,[$user = Auth::user()->id])->withTrashed()->get();

        return view('usuarios.admin.users-cadastrados', ['users'=>$lista]);
    }

    // public function solicitacoes()
    // {
    //     $lista = User::all();

    //     return view('usuarios.admin.solicitacoes-internos',['users'=>$lista]);
    // }


    public function show(User $user, $id)
    {
        $usuario = User::find($id);

        return view('usuarios.admin.showUser', ['user' => $usuario]); 
    }
}
