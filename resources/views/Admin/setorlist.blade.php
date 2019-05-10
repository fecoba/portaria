@extends('adminlte::page')

@section('title', 'Portaria 1.0')

@push('css')
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
@endpush

@section('content_header')
    <h1>Lista de setores</h1>
	
	<ol class="breadcrumb">
    	<li><a href="">Setores</a></li>
    </ol>
@stop

@section('content')
	<div class="box">
 		<div class="box-header">
			@include('includes.alerts')
			<form method="POST" action="{{route('setor.search')}}">
				{!! csrf_field() !!}
				<div class="form-row">
					<div class="form-group col-md-4">
						<input class="form-control" type="text" name="nome" maxlength="150" placeholder="Nome ou parte do nome do setor">
					</div>
					<div class="form-group col-md-4">
						<input class="form-control" type="text" name="telefone" maxlength="9" placeholder="Telefone ou parte do telefone do setor" pattern="[0-9]{4}\-[0-9]{4}">
					</div>
					<div class="form-group col-md-4">
						<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-filter"></span>Filtrar</button>
						<a href="{{url('admin/setor-create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-file"></span>Novo setor</a>
					</div>
				</div>
			</form>
		</div>
		<div class="box-body">
			<table class="table table-hover table-sm">
				<thead>
					<tr>
						<th>Nome do Setor</th>
						<th>Telefone</th>
						<th>Editar</th>
						<th>Excluir <i class='fas fa-info-circle' style="color: #3F7FBF" data-toggle="tooltip" data-placement="bottom" title="Apenas setores ainda não visitados podem ser excluídos"></i> </th>
					</tr>					
				</thead>
				
				<tbody>
					@foreach($setors as $setor)
						<tr>
							<td>{{$setor->nome}}</td>
							<td>{{$setor->telefone}}</td>
							<td><a href="{{url('admin/setor-edit/'.$setor->id)}}" data-toggle="tooltip" data-placement="bottom" title="Editar este setor"><span class="glyphicon glyphicon-edit"></span></a></td>
							<td>
								@if($setor->visitas->isEmpty())
									<a href="{{url('admin/setor-confirm/'.$setor->id)}}" data-toggle="tooltip" data-placement="bottom" title="Excluir este setor"><span class="glyphicon glyphicon-trash"></span></a>
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>				
			</table>
			@if(isset($attr))
				{!! $setors->appends($attr)->links() !!}
			@else
				{!! $setors->links() !!}
			@endif
		</div>
	</div>
@stop

@push('js')
	<script type="text/javascript" src="/js/tooltip.js"></script>
@endpush