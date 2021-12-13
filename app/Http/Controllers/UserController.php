<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index () {
        //retorna página do dashboard para o usuário

        //checar o tipo de usuário

        //retornar página normal, ou página admin
        return view('usuarios.dashboard');
    }

    public function show(User $user) {
        $response = Gate::inspect('ver-user', $user);
        if($response->allowed()){
            return view('usuarios.show', ['user'=>$user]);
        }else{
            return redirect()->to(route('user.show', [$user = Auth::user()]));
        }
    }

    public function edit (Request $request, User $user) {
        $response = Gate::inspect('ver-user', $user);
        if($response->allowed()){
            return view('usuarios.edit', ['user'=>$user]);
        }else{
            return redirect()->to(route('user.edit', [$user = Auth::user()]));
        }
    }

    public function update (Request $request, User $user) {
        Gate::authorize('ver-user', $user);

        $email = $request->post('email');
        $user->email= $email;
        $nascimento = $request->post('nascimento');
        $user->nascimento= $nascimento;
        $formacao = $request->post('formacao');
        $user->formacao= $formacao;

        $user->save();
        
        return redirect()->to(route('user.show', ['user'=>$user]));
    }

}
