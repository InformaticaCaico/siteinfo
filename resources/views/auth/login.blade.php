@extends('layouts.auth')

@section('titulo')
    Login
@endsection
@section('subtitulo')
    Login
@endsection

@section('mensagem')
    Bem-vindo de volta!
@endsection
@section('imagem')
<img src="./img/bg-img/36.png" alt="">
@endsection

@section('form')
<form class="user uza-contact-form" action="{{route('login')}}" method="post">
@csrf
<div class="row d-flex justify-content-center">
    <div class="col-lg-6 ">
        <input type="email" name="email" id="email" class="form-control mb-30" placeholder="Insira o endereço de email">
    </div>
    <div class="col-lg-6">
        <input type="password" id="password" name="password" placeholder="Senha" class="form-control mb-30">
    </div>
    <div class="col-12 row d-flex justify-content-center">
        <button type="submit" class="btn uza-btn btn-block btn-3 mt-15 float-right ">Entrar</button>
    </div>
    <div class="col-12 text-center">
        <br>
    <a href="{{route('social.login', ['provider' => 'google'])}}" class="btn uza-btn btn-block btn-2">
        <i class="fa fa-google "></i> Entrar com o Google
    </a>
    </div>
    <div class="col-12  text-center">
    <br>
    <a href="{{route('social.login', ['provider' => 'facebook'])}}" class="facebook btn-block btn uza-btn btn-2">
        <i class="fa fa-facebook"></i> Entrar com o Facebook
    </a>
    </div>
    <div class="col-12  text-center">
    <br>
    <a href="{{route('social.login', ['provider' => 'github'])}}" class="btn btn-block uza-btn btn-2">
        <i class="fa fa-github"></i> Entrar com o GitHub
    </a>
    <a href="{{route('suap.login')}}" class="btn btn-block uza-btn btn-2">
        <i class="fa fa-github"></i> Entrar com o SUAP
    </a>
    </div>
    <div class="text-center">
        <br>
    <a class="btn" href="{{url('/register')}}">Ainda não tem uma conta? Crie uma!</a>
    </div>

</div> 
</form>
@endsection