@extends('adminlte::page')

@section('title', 'Portaria 1.0')

@section('content_header')
    <h1>Editar setor</h1>
	
	<ol class="breadcrumb">
    	<li><a href="{{route('setor.list')}}">Setores</a></li>
    	<li><a href="">Editar setor</a></li>
    	
    </ol>    
@stop

@section('content')
	<div class="box">
<!-- 		<div class="box-header">
			<h2>Cadastro de setores</h2>			
		</div> -->
		<div class="box-body">

			@include('includes.alerts')

		    <form action="{{ route('setor.update')}}" method="POST"> 
		    	{!! csrf_field() !!}

		    	<div class="form-group">
		    		<label for="nome">Nome</label>
		    		<input type="text" name="nome" class="form-control" maxlength="191" placeholder="Insira o nome do setor" value="{{$setor->nome}}">
		    	</div>
		    	<div class="form-group">
		    		<label for="telefone">Telefone</label>
		    		<input type="text" name="telefone" class="form-control" maxlength="9" data-mask="0000-0000" placeholder="Insira telefone no formato: 9999-9999" value="{{$setor->telefone}}">
		    	</div>
		    	<input type="hidden" name="id" value="{{$setor->id}}">
		    	<button type="submit" class="btn btn-primary">Salvar</button>
		    </form>
		</div>
	</div>
@stop

@push('js')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.12/jquery.mask.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.12/jquery.mask.min.js"></script>
@endpush