<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Relatório de visitas por setor</title>
	<meta charset="utf-8">
	<style type="text/css">
		.sistem{
			background-color: #d8d8d8;			
			border: 1px;
			margin: 0;
		}
		.cabec{
			background-color: #d8d8d8;
			width: 100%;
			text-align: center;
			border: 1px;
			margin: 0;
		}
		.total{
			text-align: right;			
		}
		table{
			width: 100%;
			border-collapse: collapse;
		}
		table th{
			background-color: #d8d8d8;			
		}
		table td{
			border-top: 1px solid black;
		}

		tr:nth-child(even) {
			background: #f2f2f2;
		}
		.quant{
			text-align: center;
		}
	</style>
</head>
<body>

	<div class="header">
		<h6 class="sistem">Sistema Portaria 1.0 - Relatório gerado em: {{date('d/m/Y')}}</h6>
		<div class="cabec">
			<h1>Relatório de visitas por setor</h1>
			<h4>Período: {{date('d/m/Y', strtotime($inicial))}} - {{date('d/m/Y', strtotime($final))}}</h4>
		</div>
	</div>

	<div class="content">

		<table>

			<thead>
				<tr>
					<th>Setor</th>
					<th class="quant">Quantidade de visitas</th>
				</tr>
			</thead>

			<tbody>
				@foreach($visitas as $visita)
				<tr>
					<td>{{$visita->nome}}</td>
					<td class="quant">{{$visita->total}}</td>
				</tr>
				@endforeach
			</tbody>

			<tfoot>
				<tr>
					<th class="total" colspan="2">
						<p>Total de visitas: {{$totalVisitas}}</p>
						<p>Total de visitantes: {{$totalVisitantes}}</p>
					</th>
				</tr>
			</tfoot>

		</table>
	</div>

</body>
</html>