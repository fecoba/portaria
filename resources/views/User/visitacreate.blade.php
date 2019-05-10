@extends('adminlte::page')

@section('title', 'Portaria 1.0')

@section('content_header')
    <h1>Nova visita</h1>
	
	<ol class="breadcrumb">
    	<li><a href="{{route('visitante.list')}}">Visitantes</a></li>
    	<li><a href="">Nova visita</a></li>
    	
    </ol>    
@stop

@section('content')
	<div class="box">
		<div class="box-body">

			@include('includes.alerts')

		    <form action="{{route('visita.store')}}" method="POST"> 
		    	{!! csrf_field() !!}


		    	<!-- *** exibir dados do visitante *** -->
				<div class="row">
					<div class="col-lg-2 col-md-3 col-sm-4">
						@if($visitante->foto)
							<img src="{{url('storage/visitantes/'.$visitante->foto)}}" alt="{{$visitante->nome}}" class="img-circle" style="width: 150px; height: 150px; margin-bottom: 10px; " data-toggle="modal" data-target="#modal{{$visitante->id}}">
						
						<!-- Small modal -->
						<div class="modal fade bd-example-modal-sm" id="modal{{$visitante->id}}">
						  	<div class="modal-dialog modal-sm">
					    		<img src="{{url('storage/visitantes/'.$visitante->foto)}}" style="max-width: 400px; max-height: 400px">
						  	</div>
						</div>								

						@else
							<img src="{{url('storage/visitantes/sem_foto.png')}}" class="img-circle" style="width: 150px; height: 150px; margin-bottom: 10px; ">
						@endif
					</div>
					<div class="col-sm-8">
						<h3>{{$visitante->nome}}</h3>
						<h4>{{$visitante->descDoc()}}: {{$visitante->documento}}</h4>
						<!-- <p>Número do documento: <strong>{{$visitante->documento}}</strong></p> -->
					</div>
				</div>
		    	<!-- ********************* -->

		    	<div class="row">
		    		<div class="form-group col-md-2">
			    		<label for="cracha">Crachá</label>
			    		<select name="cracha" class="form-control">
			    			<option value="">Escolha...</option>		    			
			    			@for($i = 1; $i <= 30; $i++ )
			    				@if(old('cracha') == $i)
			    					<option value="{{$i}}" selected="selected">{{$i}}</option>
			    				@endif
			    					<option value="{{$i}}">{{$i}}</option>
			    			@endfor
			    		</select>
			    	</div>
		    		<div class="form-group col-md-10">
			    		<label for="setor_id">Setor</label>
			    		<select name="setor_id" class="form-control">
			    			<option value="">Escolha...</option>		    			
			    			@foreach($setors as $setor)
			    				@if(old('setor_id') == $setor->id)
			    					<option value="{{$setor->id}}" selected="selected">{{$setor->nome}}</option>
			    				@endif
			    					<option value="{{$setor->id}}">{{$setor->nome}}</option>
			    			@endforeach
			    		</select>
			    	</div>
		    	</div>

		    	<div class="row">
			    	<div class="form-group col-md-6">
			    		<label for="pessoa">Pessoa a ser visitada</label>
			    		<input type="text" name="pessoa" value="{{old('pessoa')}}" placeholder="Nome da pessoa que será visitada" class="form-control" maxlength="191">
			    	</div>
			    	<div class="form-group col-md-6">
			    		<label for="pessoa">Assunto</label>
			    		<input type="text" name="assunto" value="{{old('assunto')}}" placeholder="Assunto a tratar" class="form-control" maxlength="191">
			    	</div>
		    	</div>

		    	<input type="hidden" name="visitante_id" value="{{$visitante->id}}">
		    	<button type="submit" class="btn btn-primary">Salvar</button>
		    </form>
		</div>
	</div>
@stop