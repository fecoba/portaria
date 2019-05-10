@extends('adminlte::page')

@section('title', 'Portaria 1.0')

@section('content_header')
    <h1>Excluir usuário</h1>
	
	<ol class="breadcrumb">
    	<li><a href="{{route('user.list')}}">Usuários</a></li>
    	<li><a href="">Confirmar exclusão</a></li>    	
    </ol>    
@stop

@section('content')
	<div class="box">
<!-- 		<div class="box-header">
			<h2>Cadastro de setores</h2>			
		</div> -->
		<div class="box-body">

			@include('includes.alerts')
			
			<h3>Confirme a exclusão do usuário informado abaixo:</h3>
			<p>Nome: <strong>{{$user->name}}</strong></p>
			<p>Email: <strong>{{$user->email}}</strong></p>
			<p>Tipo doc: <strong>{{$user->descDoc()}}</strong></p>
			<p>Número do documento: <strong>{{$user->formatedDoc()}}</strong></p>
			<p>Grupo de usuários: <strong>{{$user->grupo->descricao}}</strong></p>
			<a href="{{url('admin/user-delete/'.$user->id)}}" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>Excluir</a>
		</div>
	</div>
@stop