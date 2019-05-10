@extends('adminlte::page')

@section('title', 'Portaria 1.0')

@push('css')
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
@endpush

@section('content_header')
    <h1 align="center">Sistema Portaria 1.0</h1>
@stop

@section('content')
		<hr>
	    <h4 align="center">Visitas em aberto</h4>
	    <div class="box">
	    	<div class="box-body">
	    		<div class="row">
	    			@foreach($visitas as $visita)
		    			<div class="col-lg-3 col-md-4 col-sm-6">
							<div class="card" style="width: 18rem; margin-bottom: 20px;">

								@if($visita->visitante->foto)
									<td><img src="{{url('storage/visitantes/'.$visita->visitante->foto)}}" alt="{{$visita->visitante->nome}}" class="img-circle card-img-top" style="width: 150px; height: 150px;" data-toggle="modal" data-target="#modal{{$visita->visitante->id}}"></td>

								<!-- Small modal -->							
								<div class="modal fade bd-example-modal-sm" id="modal{{$visita->visitante->id}}">
								  	<div class="modal-dialog modal-sm">
							    		<img src="{{url('storage/visitantes/'.$visita->visitante->foto)}}" style="max-width: 400px; max-height: 400px">
								  	</div>
								</div>								

								@else
									<td><img src="{{url('storage/visitantes/sem_foto.png')}}" style="width: 150px; height: 150px; " class="card-img-top img-circle"></td>
								@endif


								<!-- <img class="card-img-top" src=".../100px180/" alt="Imagem de capa do card"> -->
							  	<div class="card-body">
							    	<h4 class="card-title">{{$visita->visitante->nome}}</h4>						    	
							    	<p class="card-text">Entrou {{ date('d/m/Y - H:i', strtotime($visita->entrada)) }}, com crachá {{$visita->cracha}}, para ir no(a) {{$visita->setor->nome}}</p>
							    	<a href="{{url('user/visita-saida/'.$visita->id)}}"><i class='fas fa-sign-out-alt'></i> Registrar saída</a>
							  	</div>
							</div>
		    			</div>
	    			@endforeach
	    		</div>
	    		{!! $visitas->links() !!}
	    	</div>
	    	
	    </div>

@stop