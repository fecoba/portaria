@extends('adminlte::page')

@section('title', 'Portaria 1.0')

@section('content_header')
    <h1>Excluir visitante</h1>
	
	<ol class="breadcrumb">
    	<li><a href="{{route('visitante.list')}}">Visitantes</a></li>
    	<li><a href="">Confirmar exclusão</a></li>    	
    </ol>    
@stop

@section('content')
	<div class="box">
		<div class="box-body">

			@include('includes.alerts')
			
				<h3>Confirme a exclusão do visitante informado abaixo:</h3>
				<div class="row">
					<div class="col-lg-2 col-md-3 col-sm-4">
						@if($visitante->foto)
							<td><img src="{{url('storage/visitantes/'.$visitante->foto)}}" alt="{{$visitante->nome}}" class="img-circle" style="width: 150px; height: 150px;" data-toggle="modal" data-target="#modal{{$visitante->id}}"></td>

						<!-- Small modal -->							
						<div class="modal fade bd-example-modal-sm" id="modal{{$visitante->id}}">
						  	<div class="modal-dialog modal-sm">
					    		<img src="{{url('storage/visitantes/'.$visitante->foto)}}" style="max-width: 400px; max-height: 400px">
						  	</div>
						</div>								

						@else
							<td><img src="{{url('storage/visitantes/sem_foto.png')}}" style="border-radius: 150px; width: 150px; height: 150px; "></td>
						@endif
					</div>
					<div class="col-sm-8">
						<p>Nome: <strong>{{$visitante->nome}}</strong></p>
						<p>Tipo doc: <strong>{{$visitante->descDoc()}}</strong></p>
						<p>Número do documento: <strong>{{$visitante->formatedDoc()}}</strong></p>
						<a href="{{url('user/visitante-delete/'.$visitante->id)}}" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Excluir</a>
						<a href="javascript:history.go(-1)" class="btn btn-primary"><span class="glyphicon glyphicon-triangle-left"></span> Voltar</a>
					</div>

				</div>
		</div>
	</div>
@stop