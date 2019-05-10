@extends('adminlte::page')

@section('title', 'Portaria 1.0')

@section('content_header')
    <h1>Excluir setor</h1>
	
	<ol class="breadcrumb">
    	<li><a href="{{route('setor.list')}}">Setores</a></li>
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
			
			<h3>Confirme a exclusão do setor informado abaixo:</h3>
			<p>Nome: <strong>{{$setor->nome}}</strong></p>
			<p>Telefone: <strong>{{$setor->telefone}}</strong></p>
			<a href="{{url('admin/setor-delete/'.$setor->id)}}" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Excluir</a>
			<a href="javascript:history.go(-1)" class="btn btn-primary"><span class="glyphicon glyphicon-triangle-left"></span> Voltar</a>
		</div>
	</div>
@stop