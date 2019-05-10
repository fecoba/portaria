@extends('adminlte::page')

@section('title', 'Portaria 1.0')

@push('css')
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
@endpush

@section('content_header')
    <h1>Relatório de visitas por setores</h1>
	
	<ol class="breadcrumb">
    	<li><a href="#">Relarorio de visitas por setores</a></li>
    </ol>
@stop

@section('content')
	<div class="box">
 		<div class="box-header">
			@include('includes.alerts')

			<form method="POST" action="{{route('relatorio.visita.setor.search')}}">
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
						<th>Setor</th>
						<th>Visitas</th>
					</tr>					
				</thead>
				<tfoot>
					<tr>
						<th colspan="2" style="text-align: right; ">
							<p>Total de visitas: {{$totalVisitas}}</p>
							<p>Total de visitantes: {{$totalVisitantes}}</p>
							<a href="{{url('user/pdf-visita-setor/'.$attr['inicial'].'/'.$attr['final'])}}" class="btn btn-primary" target="_blank"><i class='fas fa-print'></i> Gerar PDF</a>
						</th>
					</tr>
				</tfoot>
				<tbody>
					@foreach($visitas as $visita)
					<tr>
						<td>{{$visita->setor->nome}}</td>
						<td>{{$visita->total}}</td>
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