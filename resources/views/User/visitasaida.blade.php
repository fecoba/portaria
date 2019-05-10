@extends('adminlte::page')

@section('title', 'Portaria 1.0')

@push('css')
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
@endpush

@section('content_header')
    <h1>Saída de visitante</h1>
	
	<ol class="breadcrumb">
    	<li><a href="{{route('visita.list')}}">Visitas</a></li>
    	<li><a href="">Confirmar saída</a></li>    	
    </ol>    
@stop

@section('content')
	<div class="box">
		<div class="box-body">

			@include('includes.alerts')
			
				<h3>Confirme a saída do visitante informado abaixo:</h3>
				<div class="row">
					<div class="col-lg-2 col-md-3 col-sm-4">
						@if($visita->visitante->foto)
							<td><img src="{{url('storage/visitantes/'.$visita->visitante->foto)}}" alt="{{$visita->visitante->nome}}" class="img-circle" style="width: 150px; height: 150px;" data-toggle="modal" data-target="#modal{{$visita->visitante->id}}"></td>

						<!-- Small modal -->							
						<div class="modal fade bd-example-modal-sm" id="modal{{$visita->visitante->id}}">
						  	<div class="modal-dialog modal-sm">
					    		<img src="{{url('storage/visitantes/'.$visita->visitante->foto)}}" style="max-width: 400px; max-height: 400px">
						  	</div>
						</div>								

						@else
							<td><img src="{{url('storage/visitantes/sem_foto.png')}}" style="border-radius: 150px; width: 150px; height: 150px; "></td>
						@endif
					</div>
					<div class="col-sm-8">
						<h3>{{$visita->visitante->nome}}</h3>
						<p>{{$visita->visitante->descDoc()}}: {{$visita->visitante->formatedDoc()}}</p>
						<p>No dia {{date('d/m/Y - H:i', strtotime($visita->entrada))}}, visitou {{$visita->pessoa}} no(a) {{$visita->setor->nome}}, para falar sobre assunto {{$visita->assunto}}</p>
						<a href="{{url('user/visita-update/'.$visita->id)}}" class="btn btn-primary"><i class='fas fa-sign-out-alt'></i> Registrar saída agora</a>
						<a href="javascript:history.go(-1)" class="btn btn-primary"><span class="glyphicon glyphicon-triangle-left"></span> Voltar</a>
					</div>

				</div>
		</div>
	</div>
@stop