<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Policies\UserPolicy;
use Auth, Gate, Image;

use App\Providers\RouteServiceProvider;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function index () {

        return Gate::allows('view admin page') ? view('usuarios.dashboard') : redirect()->intended(RouteServiceProvider::ADMIN);

        /* $response = Gate::inspect('admin-user');
        if($response->allowed()){
            return redirect()->intended(RouteServiceProvider::ADMIN);
        }else{
            return view('usuarios.dashboard');
        } */
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

    public function update (UserRequest $request, User $user) {
        Gate::authorize('ver-user', $user);

        $email = $request->post('email');
        $user->email= $email;
        $nascimento = $request->post('nascimento');
        $user->nascimento= $nascimento;
        $formacao = $request->post('formacao');
        $user->formacao= $formacao;

        if($request->hasFile('image')&& $request->file('image')->isValid()){

            $image = $request->file('image');
            $extension = $image->extension();
            $filename = md5($image->getClientOriginalName().strtotime('now')).".". $extension;
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(200,300);
            $image_resize->save(public_path('img/profiles/'. $filename));

            $user->image = $filename;
        }

        $user->save();
        
        return redirect()->to(route('user.show', ['user'=>$user]));
    }
    public function destroy(User $user)
    {
        User::findOrFail($user->id)->delete();
        return redirect()->to(route('users.cadastrados'));
    }
    public function restore($id)
    {
        User::withTrashed()->find($id)->restore();
        return redirect()->to(route('users.cadastrados'));
    }
}
