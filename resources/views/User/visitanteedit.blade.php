@extends('adminlte::page')

@section('title', 'Portaria 1.0')

@section('content_header')
    <h1>Editar visitante</h1>
	
	<ol class="breadcrumb">
    	<li><a href="{{route('visitante.list')}}">Visitantes</a></li>
    	<li><a href="">Editar visitante</a></li>
    	
    </ol>    
@stop

@section('content')
	<div class="box">
		<div class="box-body">

			@include('includes.alerts')

		    <form action="{{ route('visitante.update')}}" method="POST" enctype="multipart/form-data"> 
		    	{!! csrf_field() !!}
		    	<div class="form-group col-md-12">
		    		<label for="nome">Nome</label>
		    		<input type="text" name="nome" class="form-control" placeholder="Insira o nome do visitante" value="{{$visitante->nome}}" maxlength="191">
		    	</div>
		    	<div class="form-row">
	  		    	<div class="form-group col-md-6">
	  		    		<label for="tipo_doc">Tipo doc</label>
			    		<select name="tipo_doc" id="tipo_doc" class="form-control">
			    			<option value="">Escolha...</option>
			    			@foreach($tipos as $key => $value)
			    				@if($visitante->tipo_doc == $key)
			    					<option value="{{$key}}" selected="selected">{{$value}}</option>
			    				@else
			    					<option value="{{$key}}">{{$value}}</option>
			    				@endif
			    			@endforeach
			    		</select>
			    	</div>
			    	<div class="form-group col-md-6">
			    		<label for="documento">Número do documento</label>
			    		<input type="text" name="documento" id="documento" class="form-control" value="{{$visitante->documento}}" placeholder="Insira o número do documento">
			    	</div>
			    </div>
				<div class="form-group col-md-12">
					<label for="image">Imagem</label>

							@if($visitante->foto)
								<td><img src="{{url('storage/visitantes/'.$visitante->foto)}}" alt="{{$visitante->nome}}" class="img-circle" style="width: 50px; height: 50px" data-toggle="modal" data-target="#modal{{$visitante->id}}"></td>

							<!-- Small modal -->							
							<div class="modal fade bd-example-modal-sm" id="modal{{$visitante->id}}">
							  	<div class="modal-dialog modal-sm">
						    		<img src="{{url('storage/visitantes/'.$visitante->foto)}}" style="max-width: 400px; max-height: 400px">
							  	</div>
							</div>								

							@else
								<td><img src="{{url('storage/visitantes/sem_foto.png')}}" style="border-radius: 50px; width: 50px; height: 50px;"></td>
							@endif

					<input class="form-control" type="file" name="imagem" value="{{old('imagem')}}">
				</div>
				<input type="hidden" name="id" value="{{$visitante->id}}">
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