@extends('adminlte::page')

@section('title', 'Portaria 1.0')

@section('content_header')
    <h1>Novo usuário</h1>
	
	<ol class="breadcrumb">
    	<li><a href="{{url('/admin/user-list')}}">Usuários</a></li>
    	<li><a href="">Novo usuário</a></li>
    	
    </ol>    
@stop

@section('content')
	<div class="box">
<!-- 		<div class="box-header">
			<h2>Cadastro de setores</h2>			
		</div> -->
		<div class="box-body">

			@include('includes.alerts')

		    <form action="{{ route('user.store')}}" method="POST"> 
		    	{!! csrf_field() !!}
		    	<div class="form-row">
			    	<div class="form-group col-md-6">
			    		<label for="name">Nome</label>
			    		<input type="text" name="name" class="form-control" maxlength="191" placeholder="Insira o nome do usuário" value="{{old('name')}}">
			    	</div>
			    	<div class="form-group col-md-6">
			    		<label for="email">E-mail</label>
			    		<input type="text" name="email" class="form-control" placeholder="Insira o e-mail no formato: meuemail@meuprovedor.com" value="{{old('email')}}">
			    	</div>
			    </div>

			    <div class="form-row">
			    	<div class="form-group col-md-6">
			    		<label for="password">Senha</label>
			    		<input type="password" name="password" minlength="6" maxlength="8" class="form-control">
			    	</div>
	  		    	<div class="form-group col-md-6">
			    		<label for="confirma">Confirme sua senha</label>
			    		<input type="password" name="confirma" class="form-control" minlength="6" maxlength="8">
			    	</div>
		    	</div>

		    	<div class="form-row">
	  		    	<div class="form-grop col-md-2">
	  		    		<label for="tipo_doc">Tipo doc</label>
			    		<select name="tipo_doc" class="form-control" id="tipo_doc">
			    			<option value="">Escolha...</option>
			    			@foreach($tipos as $key => $value)
			    				@if(old('tipo_doc') == $key)
			    					<option value="{{$key}}" selected="selected">{{$value}}</option>
			    				@else
			    					<option value="{{$key}}">{{$value}}</option>
			    				@endif
			    			@endforeach
			    		</select>
			    	</div>
			    	<div class="form-group col-md-6">
			    		<label for="documento">Número do documento</label>
			    		<input type="text" id="documento" name="documento" class="form-control" value="{{old('documento')}}" maxlength="20">
			    	</div>
	  		    	<div class="form-group col-md-4">
	  		    		<label for="grupo_usuarios_id">Grupo de usuários</label>
			    		<select name="grupo_usuarios_id" class="form-control">
			    			<option value="">Escolha...</option>
			    			@foreach($grupos as $grupo)
			    				@if(old('grupo_usuarios_id') == $grupo->id)
			    					<option value="{{$grupo->id}}" selected="selected">{{$grupo->descricao}}</option>
			    				@else
			    					<option value="{{$grupo->id}}">{{$grupo->descricao}}</option>
			    				@endif
			    			@endforeach
			    		</select>
			    	</div>
			    </div>
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