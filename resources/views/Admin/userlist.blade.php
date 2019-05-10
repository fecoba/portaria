@extends('adminlte::page')

@section('title', 'Portaria 1.0')

@section('content_header')
    <h1>Lista de usuários</h1>
	
	<ol class="breadcrumb">
    	<li><a href="">Usuários</a></li>
    </ol>
@stop

@section('content')
	<div class="box">
 		<div class="box-header">
			@include('includes.alerts')
			<form method="POST" action="{{route('user.search')}}">
				{!! csrf_field() !!}
				<div class="form-row">
					<div class="form-group col-md-3">
						<input class="form-control" type="text" name="name" placeholder="Nome ou parte do nome do usuário">
					</div>
					<div class="form-group col-md-3">
						<input class="form-control" type="text" name="email" placeholder="E-mail ou parte do e-mail do usuário">
					</div>
					<div class="form-group col-md-3">
						<input class="form-control" type="text" name="documento" placeholder="Número do documento ou parte do número">
					</div>
					<div class="form-group col-md-3">
						<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-filter"></span>Filtrar</button>
						<a href="{{url('admin/user-create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-file"></span>Novo usuário</a>
					</div>
				</div>
			</form>
		</div>
		<div class="box-body">
			<table class="table table-hover table-sm">
				<thead>
					<tr>
						<th>Nome do usuário</th>
						<th>E-mail</th>
						<th>Tipo de doc.</th>
						<th>Número Documento</th>
						<th>Tipo de usuário</th>
						<th>Editar</th>
						<th>Status</th>
						<th>Resetar senha</th>
					</tr>					
				</thead>
				<tbody>
					@foreach($users as $user)
						<tr>
							<td>{{$user->name}}</td>
							<td>{{$user->email}}</td>
							<td>{{$user->descDoc()}}</td>
							<td>{{$user->documento}}</td>
							<td>{{$user->grupo->descricao}}</td>
							<td><a href="{{url('admin/user-edit/'.$user->id)}}" data-toggle="tooltip" data-placement="bottom" title="Editar este usuário"><span class="glyphicon glyphicon-edit"></span></a></td>
							
							@if(($user->id) != (auth()->user()->id))
								@if($user->status == '1')
									<td><a href="{{url('admin/user-status/'.$user->id)}}"><span class="glyphicon glyphicon-ok" style="color: green;" data-toggle="tooltip" data-placement="bottom" title="Usuário ativo, clique para inativá-lo"></span></a></td>
								@else
									<td><a href="{{url('admin/user-status/'.$user->id)}}"><span class="glyphicon glyphicon-remove" style="color: red; " data-toggle="tooltip" data-placement="bottom" title="Usuário inativo, clique para ativá-lo"></span></a></td>
								@endif
							@else
								<td><span class="glyphicon glyphicon-ok" style="color: green;"></span></td>
							@endif

							<td><a href="{{url('admin/password-reset/'.$user->id)}}" data-toggle="tooltip" data-placement="bottom" title="Definir a senha de acesso deste usuário como 123456"><span class="glyphicon glyphicon-repeat"></span></a></td>
						</tr>
					@endforeach
				</tbody>				
			</table>
			@if(isset($attr))
				{!! $users->appends($attr)->links() !!}
			@else
				{!! $users->links() !!}
			@endif
		</div>
	</div>
@stop

@push('js')
	<script type="text/javascript" src="/js/tooltip.js"></script>
@endpush