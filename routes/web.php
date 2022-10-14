<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\SolicitacaoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginSocialController;
use App\Http\Controllers\SuapController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('site.home');
})->name('home');
Route::get('/curso', function () {
    return view('site.curso');
})->name('curso');
Route::get('/sobre', function () {
    return view('site.sobre');
})->name('sobre');
Route::get('/login/{provider}', [LoginSocialController::class, 'redirectToProvider'])
                ->name('social.login');
Route::get('/login/{provider}/callback', [LoginSocialController::class, 'handleProviderCallback'])
                ->name('social.callback');
// painel de controle para qualquer usuário
Route::post('/user/restore/{id}', [UserController::class, 'restore'])->name('user.restore');
Route::resource('/user', UserController::class);

// Route::get('/dashboard', function () {
//     return view('usuarios.dashboard');
// })->middleware(['auth']);

// Route::get('/meusposts', function () {
//     return view('meus-posts');
// });

// painel de controle usuário admin

Route::post('/admin/solicitacoes', [SolicitacaoController::class, 'store'])->name('solicitacaos.store');

Route::get('/admin/solicitacoes', [SolicitacaoController::class, 'index'])->name('solicitacoes.usuarios');

Route::get('/admin/cadastrados', [AdminController::class, 'cadastrados'])->name('users.cadastrados');

Route::resource('/admin', AdminController::class);


// Route::get('/admin', function () {
//     return view('usuarios.admin.admin');
// })->middleware(['auth']);

// Route::get('/publicados', function () {
//     return view('posts.post-publicado');
// });

// Route::get('/verpost', function () {
//     return view('posts.ver-post');
// });


//Route::get('/login',[UsersController::class,'login'])->name('login');
//Route::get('/register',[UsersController::class,'register'])->name('register');
//Route::post('/store', [UsersController::class,'store'])->name('store');

require __DIR__."/auth.php";
require __DIR__.'/suap.php';