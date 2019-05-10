@extends('adminlte::page')

@section('title', 'Portaria 1.0')

@push('css')
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
@endpush

@section('content_header')
    <h1>Informações do visitante</h1>
	
	<ol class="breadcrumb">
    	<li><a href="{{route('visitante.list')}}">Visitantes</a></li>
    	<li><a href="#">Informações do visitante</a></li>    	
    </ol>    
@stop

@section('content')
	<div class="box">
		<div class="box-header">
			@include('includes.alerts')
			
				<h3>Informações sobre o visitante abaixo:</h3>
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
						<h3>{{$visitante->nome}}</h3>
						<p>{{$visitante->descDoc()}}: {{$visitante->documento}}</p>
						<p>Cadastrado em: {{date('d/m/Y', strtotime($visitante->created_at))}}</p>
						<a href="javascript:history.go(-1)" class="btn btn-primary"><span class="glyphicon glyphicon-triangle-left"></span> Voltar</a>
					</div>
				</div>
		</div>
		@if(!$visitante->visitas->isEmpty())
			<hr>
			<h3 align="center">Lista de visitas</h3>
			<hr>
			<div class="box-body">
				<table class="table table-hover table-sm">
					<thead>
						<tr>
							<th></th>
							<th>Crachá</th>
							<th>Entrada</th>
							<th>Saída</th>
							<th>Setor visitado</th>
							<th>Assunto tratado</th>
							<th>Excluir</th>
						</tr>
						
					</thead>
					<tbody>
						@foreach($visitas as $visita)
							<tr>
								<td><a href="{{url('user/visita-info/'.$visita->id)}}" data-toggle="tooltip" data-placement="bottom" title="Informações desta visita"><i class='fas fa-info-circle' style="color: #3F7FBF"></i></a></td>
								<td>{{$visita->cracha}}</td>
								<td>{{date('d/m/Y - H:i', strtotime($visita->entrada))}}</td>
								<td>{{date('d/m/Y - H:i', strtotime($visita->saida))}}</td>
								<td>{{$visita->setor->nome}}</td>
								<td>{{$visita->assunto}}</td>
								@if( ($visita->user_id == auth()->user()->id) || (auth()->user()->grupo->descricao == 'Administrador'))
									<td><a href="{{url('user/visita-confirm/'.$visita->id)}}" data-toggle="tooltip" data-placement="bottom" title="Excluir esta visita"><span class="glyphicon glyphicon-trash"></span></a></td>
								@else
									<td></td>
								@endif
							</tr>
						@endforeach
					</tbody>
				</table>
				{!! $visitas->links() !!}
			</div>
		@endif
	</div>
@stop

@push('js')
	<script type="text/javascript" src="/js/tooltip.js"></script>
@endpush