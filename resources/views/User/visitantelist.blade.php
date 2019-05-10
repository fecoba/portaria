@extends('adminlte::page')

@section('title', 'Portaria 1.0')

@push('css')
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
@endpush

@section('content_header')
    <h1>Lista de visitantes</h1>
	
	<ol class="breadcrumb">
    	<li><a href="">Visitantes</a></li>
    </ol>
@stop

@section('content')
	<div class="box">
 		<div class="box-header">
			@include('includes.alerts')
			<form method="POST" action="{{route('visitante.search')}}">
				{!! csrf_field() !!}
				<div class="form-row">
					<div class="form-group col-md-4">
						<input class="form-control" type="text" name="nome" maxlength="191" placeholder="Nome ou parte do nome do visitante">
					</div>
					<div class="form-group col-md-4">
						<input class="form-control" type="text" name="documento" placeholder="Documento ou parte do documento do visitante">
					</div>
					<div class="form-group col-md-4">
						<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-filter"></span>Filtrar</button>
						<a href="{{route('visitante.create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-file"></span>Novo visitante</a>
					</div>
				</div>
			</form>
		</div>
		<div class="box-body">
			<table class="table table-hover table-sm">
				<thead>
					<tr>
						<th></th>
						<th>Nome do visitante</th>
						<th>Tipo doc</th>
						<th>Documento</th>
						<th>Informações</th>
						<th>Visita</th>
						<th>Editar</th>
						<th>Excluir <i class='fas fa-info-circle' style="color: #3F7FBF" data-toggle="tooltip" data-placement="bottom" title="Apenas visitantes sem visita(s) cadastrada(s) podem ser excluídos"></i></th>
					</tr>					
				</thead>
				<tbody>
					@foreach($visitantes as $visitante)
						<tr>
							@if($visitante->foto)
								<td><img src="{{url('storage/visitantes/'.$visitante->foto)}}" alt="{{$visitante->nome}}" class="img-circle" style="width: 50px; height: 50px" data-toggle="modal" data-target="#modal{{$visitante->id}}"></td>

							<!-- Small modal -->							
							<div class="modal fade bd-example-modal-sm" id="modal{{$visitante->id}}">
							  	<div class="modal-dialog modal-sm">
						    		<img src="{{url('storage/visitantes/'.$visitante->foto)}}" style="max-width: 400px; max-height: 400px">
							  	</div>
							</div>								

							@else
								<td><img src="{{url('storage/visitantes/sem_foto.png')}}" class="img-circle" style="width: 50px; height: 50px;"></td>
							@endif


							<td>{{$visitante->nome}}</td>
							<td>{{$visitante->descDoc()}}</td>
							<td>{{$visitante->documento}}</td>
							<td><a href="{{url('user/visitante-info/'.$visitante->id)}}" data-toggle="tooltip" data-placement="bottom" title="Informações deste visitante"><i class='fas fa-info-circle' style="color: #3F7FBF"></i></a></td>
							<td><a href="{{url('user/visita-create/'.$visitante->id)}}" data-toggle="tooltip" data-placement="bottom" title="Registrar uma visita para este visitante"><i class='far fa-address-card' style="color: #3F7FBF"></i></a></td>
							<td><a href="{{url('user/visitante-edit/'.$visitante->id)}}" data-toggle="tooltip" data-placement="bottom" title="Editar este visitante"><span class="glyphicon glyphicon-edit"></span></a></td>
							@if($visitante->visitas->isEmpty())
								<td><a href="{{url('user/visitante-confirm/'.$visitante->id)}}" data-toggle="tooltip" data-placement="bottom" title="Excluir este visitante"><span class="glyphicon glyphicon-trash"></span></a></td>
							@else
								<td></td>		
							@endif
						</tr>
					@endforeach
				</tbody>				
			</table>
			@if(isset($attr))
				{!! $visitantes->appends($attr)->links() !!}
			@else
				{!! $visitantes->links() !!}
			@endif
		</div>
	</div>
@stop

@push('js')
	<script type="text/javascript" src="/js/tooltip.js"></script>
@endpush