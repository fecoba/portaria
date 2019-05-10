@extends('adminlte::page')

@section('title', 'Portaria 1.0')

@section('content_header')
    <h1>Alterar senha</h1>
	
	<ol class="breadcrumb">
    	<li><a href="">Alterar senha</a></li>
    	
    </ol>    
@stop

@section('content')
	<div class="box">
		<div class="box-body">

			@include('includes.alerts')

		    <form action="{{route('password.update')}}" method="POST"> 
		    	{!! csrf_field() !!}

		    	<div class="form-group">
		    		<label for="passwordatual">Senha atual</label>
		    		<input type="password" name="passwordatual" class="form-control" maxlength="8" minlength="6">
		    	</div>
		    	<div class="form-group">
		    		<label for="password">Nova senha</label>
		    		<input type="password" name="password" class="form-control" maxlength="8" minlength="6">
		    	</div>
  		    	<div class="form-group">
		    		<label for="confirma">Confirme nova senha</label>
		    		<input type="password" name="confirma" class="form-control" maxlength="8" minlength="6">
		    	</div>
		    	<button type="submit" class="btn btn-primary">Salvar</button>
		    </form>
		</div>
	</div>
@stop