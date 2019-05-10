@extends('adminlte::page')

@section('title', 'Portaria 1.0')

@push('css')
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
@endpush

@section('content_header')
    <h1>Lista de visitas</h1>
	
	<ol class="breadcrumb">
    	<li><a href="#">Visitas</a></li>
    </ol>
@stop

@section('content')
	<div class="box">
 		<div class="box-header">
			@include('includes.alerts')

			<form method="POST" action="{{route('visita.search')}}">
				{!! csrf_field() !!}
				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="inicial">Data</label>
						<input class="form-control" type="date" name="inicial" placeholder="Data inicial">
					</div>
					<div class="form-group col-md-4">
						<label for="final">Até data</label>
						<input class="form-control" type="date" name="final" placeholder="Data final">
					</div>
					<div class="form-group col-md-4">
						<br />
						<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-filter"></span>Filtrar</button>
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
						<th>Crachá</th>
						<th>Entrada</th>
						<th>Saída</th>
						<th>Informações</th>
						<th>Excluir</th>
					</tr>					
				</thead>
				<tbody>
					@foreach($visitas as $visita)
						<tr>
							@if($visita->visitante->foto)
								<td><img src="{{url('storage/visitantes/'.$visita->visitante->foto)}}" alt="{{$visita->visitante->nome}}" class="img-circle" style="width: 50px; height: 50px" data-toggle="modal" data-target="#modal{{$visita->visitante->id}}"></td>

							<!-- Small modal -->							
							<div class="modal fade bd-example-modal-sm" id="modal{{$visita->visitante->id}}">
							  	<div class="modal-dialog modal-sm">
						    		<img src="{{url('storage/visitantes/'.$visita->visitante->foto)}}" style="max-width: 400px; max-height: 400px">
							  	</div>
							</div>								

							@else
								<td><img src="{{url('storage/visitantes/sem_foto.png')}}" class="img-circle" style=" width: 50px; height: 50px;"></td>
							@endif

							<td>{{$visita->visitante->nome}} <a href="{{url('user/visitante-info/'.$visita->visitante->id)}}" data-toggle="tooltip" data-placement="bottom" title="Informações sobre o visitante"><i class='fas fa-info-circle' style="color: #3F7FBF"></i></a></td>
							<td>{{$visita->cracha}}</td>
							<td>{{date('d/m/Y - H:i', strtotime($visita->entrada))}}</td>
							@if($visita->saida)
								<td>{{date('d/m/Y - H:i', strtotime($visita->saida))}}</td>
							@else
								<td><a href="{{url('user/visita-saida/'.$visita->id)}}" data-toggle="tooltip" data-placement="bottom" title="Registrar a saída do visitante"><i class='fas fa-sign-out-alt'></i></a></td>
							@endif
							<td><a href="{{url('user/visita-info/'.$visita->id)}}" data-toggle="tooltip" data-placement="bottom" title="Informações sobre a visita"><i class='fas fa-info-circle' style="color: #3F7FBF"></i></a></td>

							@if( ($visita->user_id == auth()->user()->id) || (auth()->user()->grupo->descricao == 'Administrador'))
								<td><a href="{{url('user/visita-confirm/'.$visita->id)}}" data-toggle="tooltip" data-placement="bottom" title="Excluir esta visita"><span class="glyphicon glyphicon-trash"></span></a></td>
							@else
								<td></td>
							@endif

						</tr>
					@endforeach
				</tbody>				
			</table>
			@if(isset($attr))
				{!! $visitas->appends($attr)->links() !!}
			@else
				{!! $visitas->links() !!}
			@endif
		</div>
	</div>
@stop

@push('js')
	<script type="text/javascript" src="/js/tooltip.js"></script>
@endpush