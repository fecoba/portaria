@extends('adminlte::page')

@section('title', 'Portaria 1.0')

@push('css')
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
@endpush

@section('content_header')
    <h1>Relatório de visitas por visitantes</h1>
	
	<ol class="breadcrumb">
    	<li><a href="#">Relarorio de visita por visitantes</a></li>
    </ol>
@stop

@section('content')
	<div class="box">
 		<div class="box-header">
			@include('includes.alerts')

			<form method="POST" action="{{route('relatorio.visita.visitante.search')}}">
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

		@if(isset($visitas) && !$visitas->isEmpty())
		<div class="box-body">
			<table class="table table-hover table-sm">
				<thead>
					<tr>
						<th></th>
						<th>Nome do visitante</th>
						<th>Tipo doc</th>
						<th>Documento</th>
						<th>Entrada</th>
						<th>Saída</th>
						<th>Duração da visita</th>
						<th>Local visitado</th>
						<th>Assunto tratado</th>
					</tr>					
				</thead>
				<tfoot>
					<tr>
						<th colspan="9" style="text-align: right; ">
							<p>Total de visitas: {{$totalVisitas}}</p>
							<p>Total de visitantes: {{$totalVisitantes}}</p>
							<p>Média de duração das visitas: {{$media}}</p>
						</th>
					</tr>
				</tfoot>
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

							<td>{{$visita->visitante->nome}}</td>
							<td>{{$visita->visitante->descDoc()}}</td>
							<td>{{$visita->visitante->documento}}</td>
							<td>{{date('d/m/Y H:i', strtotime($visita->entrada))}}</td>
							<td>{{$visita->saida ? date('d/m/Y H:i', strtotime($visita->saida)) : ''}}</td>
							<td>{{$visita->tempoEmHoras($visita->tempoEmMinutos())}}</td>
							<td>{{$visita->setor->nome}}</td>
							<td>{{$visita->assunto}}</td>
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
		@endif
	</div>
@stop

@push('js')
	<script type="text/javascript" src="/js/tooltip.js"></script>
@endpush