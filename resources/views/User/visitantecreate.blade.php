@extends('adminlte::page')

@section('title', 'Portaria 1.0')

@section('content_header')
    <h1>Novo visitante</h1>
	
	<ol class="breadcrumb">
    	<li><a href="{{route('visitante.list')}}">Visitantes</a></li>
    	<li><a href="#">Novo visitante</a></li>
    	
    </ol>    
@stop

@section('content')
	<div class="box">
		<div class="box-body">

			@include('includes.alerts')

		    <form action="{{ route('visitante.store')}}" method="POST" enctype="multipart/form-data"> 
		    	{!! csrf_field() !!}
		    	<div class="form-group col-md-12">
		    		<label for="nome">Nome</label>
		    		<input type="text" name="nome" class="form-control" placeholder="Insira o nome do visitante" value="{{old('nome')}}" maxlength="191">
		    	</div>
		    	<div class="form-row">
	  		    	<div class="form-group col-md-6">
	  		    		<label for="tipo_doc">Tipo doc</label>
			    		<select name="tipo_doc" id="tipo_doc" class="form-control">
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
			    		<input type="text" name="documento" id="documento" class="form-control" value="{{old('documento')}}" placeholder="Insira o número do documento">
			    	</div>
			    </div>
				<div class="form-group col-md-12">
					<label for="image">Imagem</label>
					<input class="form-control" type="file" name="imagem" value="{{old('imagem')}}">
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