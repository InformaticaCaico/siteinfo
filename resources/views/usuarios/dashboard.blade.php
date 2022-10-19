@extends('layouts.dashboard')

@section('aba')
    <title>Painel de Controle</title>
@endsection

@section('conteudo')

    @can('view admin page')

        @include('partials.dashboard.admin')

    @else
    
        @include('partials.dashboard.common')

    @endcan

@endsection