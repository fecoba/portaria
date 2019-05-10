@extends('adminlte::page')

@section('title', 'Portaria 1.0')

@section('content_header')
    <h1>Editando usuário</h1>
	
	<ol class="breadcrumb">
    	<li><a href="{{url('/admin/user-list')}}">Usuários</a></li>
    	<li><a href="">Editar usuário</a></li>
    	
    </ol>    
@stop

@section('content')
	<div class="box">
<!-- 		<div class="box-header">
			<h2>Cadastro de setores</h2>			
		</div> -->
		<div class="box-body">

			@include('includes.alerts')

		    <form action="{{ route('user.update')}}" method="POST"> 
		    	{!! csrf_field() !!}
		    	<div class="form-row">
			    	<div class="form-group col-md-6">
			    		<label for="name">Nome</label>
			    		<input type="text" name="name" class="form-control" placeholder="Insira o nome do usuário" value="{{$user->name}}" maxlength="191">
			    	</div>
			    	<div class="form-group col-md-6">
			    		<label for="email">E-mail</label>
			    		<input type="text" name="email" class="form-control" placeholder="Insira o e-mail no formato: meuemail@meuprovedor.com" value="{{$user->email}}">
			    	</div>
			    </div>

		    	<div class="form-row">
	  		    	<div class="form-grop col-md-2">
	  		    		<label for="tipo_doc">Tipo doc</label>
			    		<select name="tipo_doc" id="tipo_doc" class="form-control">
			    			<option value="">Escolha...</option>
			    			@foreach($tipos as $key => $value)
			    				@if($key == $user->tipo_doc)
			    					<option value="{{$key}}" selected="selected">{{$value}}</option>
			    				@else
			    					<option value="{{$key}}">{{$value}}</option>
			    				@endif
			    			@endforeach
			    		</select>
			    	</div>
			    	<div class="form-group col-md-6">
			    		<label for="documento">Número do documento</label>
			    		<input type="text" name="documento" id="documento" class="form-control" value="{{$user->documento}}">
			    	</div>
	  		    	<div class="form-group col-md-4">
	  		    		<label for="grupo_usuarios_id">Grupo de usuários</label>
			    		<select name="grupo_usuarios_id" class="form-control">
			    			<option value="">Escolha...</option>
			    			@foreach($grupos as $grupo)
			    				@if($user->grupo_usuarios_id == $grupo->id)
			    					<option value="{{$grupo->id}}" selected="selected">{{$grupo->descricao}}</option>
			    				@else
			    					<option value="{{$grupo->id}}">{{$grupo->descricao}}</option>
			    				@endif
			    			@endforeach
			    		</select>
			    	</div>
			    </div>
			    <input type="hidden" name="id" value="{{$user->id}}">
		    	<button type="submit" class="btn btn-primary">Salvar</button>
		    </form>
		</div>
	</div>
@stop

@push('js')
	<script type="text/javascript" src="/js/masks.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.12/jquery.mask.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.12/jquery.mask.min.js"></script>
@endpush