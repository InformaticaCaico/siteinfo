@extends('layouts.dashboard')
@section('aba')
<title>Perfil</title>
@endsection
@section('conteudo')
                    <h1 class="h3 mb-4 text-gray-800"></h1>

                        <div class="card o-hidden border-0 shadow-lg my-5">
                            <div class="card-body p-0">
                                <!-- Nested Row within Card Body -->
                                <div class="row justify-content-center">
                                    <div class="row-4 d-lg-block align-items-center rounded-circle">
                                        <img class="img-responsive img-profile rounded-circle d-sm-flex w-100 h-50 mt-5" src="/img/profiles/{{$user->image}}">
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="p-5">
                                            <div class="text-center">
                                                <h1 class="h3 text-gray-900 mb-4 d-inline-block">{{$user->name}}</h1>
                                            </div>
                                                <div class="form-group row">
                                                    <div class="col-sm mb-3 mb-sm-0">
                                                        <h6 class="control control-user"><strong>E-mail: </strong>{{$user->email}}</h6>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h6 class="control control-user"><strong>Data de Nascimento: </strong>{{$user->nascimento}}</h6>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm mb-3 mb-sm-0">
                                                        <h6 class="control control-user"><strong>Formação: </strong>{{$user->formacao}}</h6>
                                                    </div>
                                                </div>
            
                                                <div class="form-group row">
                                                    <a href="{{route('user.edit', [$user = Auth::user()])}}" class="btn bg-warning text-light btn-user col-sm-5 ml-auto">Editar Perfil</a>
                                                </div>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            @include('flash-message')
                            @yield('content')
                        </div>
                        <div class="card o-hidden border-0 shadow-lg my-5">
                            <div class="card-body p-0">
                                <!-- Nested Row within Card Body -->
                                <div class="row justify-content-center">
                                    <div class="col-lg-9">
                                        <div class="p-5 form-group row">
                                            
                                            <form action="{{ route('solicitacaos.store') }}" method="POST" id="form_soli">
                                                @csrf
                                                <h5>Deseja fazer postagens e contribuir com o conteúdo da página? Torne-se um usuário interno!</h5>
                                                <input class="d-none" type="text" value= "{{$user -> id}}" name='user_id'>
                                                <input class="d-none" type="text" value= "{{$user -> name}}" name='name'>
                                                <input class="d-none" type="text" value= "{{$user -> email}}" name='email'>
                                                
                                            </form>
                                            

                                            <input type="submit" class="btn bg-gradient-primary text-light btn-user col-sm-4 ml-auto" value="Enviar Solicitação" onclick=document.getElementById('form_soli').submit(); return false;>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

@endsection