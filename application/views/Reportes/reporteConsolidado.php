<!doctype html>
<?php $mermaTotalF1=0; ?>
<html lang="en">
<head>
	<title>Consolidado final-<?php echo $consolidadoFinal[0]['Consecutivo']; ?></title>
	<style>
		#footer {			
			padding: 30px 30px;
			width: 90%;
			height: auto;
			margin: 0 auto;
			font-family: 'arial'!important;
		    text-transform: uppercase!important;
        }
        .footer {
        	margin-top: 50px;
        }
		.footer tr td {
			width: 50%;
			text-align: center;
			padding: 5px 5px;
			border: none;
		}
		table {
		    color: black;
		    font-size: 11px;
		    font-family: 'arial'!important;
		    text-transform: uppercase!important;
		    border-collapse: collapse;
		    width: 98%;
		    margin: 0 auto;
		    margin-bottom: 5px;
		}
		table th,td{
		    text-align: left;
		    padding: 2px 2px;
		    border: 1px solid black;
		}
		.tabla-titulo tr td {
			width: 33%;
			text-align: center;
			padding: 5px 5px;
			border: none;
		}
		.image {
			width: 15%;
			height: auto;
			padding: 5px 5px;
		}
		.contenedor {
			width: 100%;
			height: 100%;
			margin: 0 auto;
			border: 1px solid black;
			border-radius: 2px;
			padding: 2px 2px;
		}
		.encabezado {
			width:100%;
			margin: 0 auto;
			margin-bottom:2px;
			margin-top: 5px;
		}
		.titulos {
			width: 100%;			
			text-align: center;
			padding: 1px 1px;
			font-weight: bold;
			margin: 0 auto;
			margin-top: 10px;
		}
		.titulos span {
			font-family: arial;
			font-size: 12px;
		}
		.titulos-tablas {
			text-align: center;
		}
		span {
			text-transform: uppercase!important;
			font-weight: bold;
			font-size: 10px;
		}
		.span-1 {
			text-transform: uppercase!important;
			font-weight: bold;
			font-size: 16px;
		}
		.contenedor-secundario {				
			display: block;			
			padding:5px 5px;
			width: 48%;			
			float: left;
			margin-left: 2px;
		}
		.table-produccion {			
			text-align: center;
			width: 100%;
			margin-top: 1px;
		}
		.table-produccion tr td {
			padding: 5px 5px;
		}
		.table-produccion th{
			padding: 5px 5px;
		}
		.contenedor-uno {
			display: block;			
			padding:5px 5px;
			width: 30%;			
			float: left;
			margin: 0 auto;
			margin-left: 2px;			
			height: auto;

		}
		.contenedor-dos {				
			padding:5px 5px;	
			width: 66%;
			height: auto;			
			text-align: center;
			float: right;
		}
		.content-medium {			
			width: 98%;
			margin: 0 auto;
			overflow:hidden;
			padding: 5px 5px;
		}
		.table-1 {
			width: 100%;			
		}
		.span {
			text-transform: uppercase!important;
			font-family: 'arial'!important;
			font-size: 10px;
			font-weight: normal;
		}

	</style>
</head>
<body>
	<div class="contenedor">
		<div class="encabezado">
			<div>
				<table class="tabla-titulo">
					<tr>
						<?php
							if ($consolidadoFinal) {
							echo "
								<td><img class='image' src='".base_url()."assets/img/logo/logoinnova.png'></td>
								<td><center><span class='span-1'>INNOVA INDUSTRIAS, S.A.</span></center></td>
								<td><span class='span-1'>".$consolidadoFinal[0]['Consecutivo']."</span></td>";
							}
						?>
					</tr>
				</table>
			</div>
			<?php  
				if ($consolidadoFinal) {
					$horaInicio = date('g:i A', strtotime($consolidadoFinal[0]['horaInicio']));
					$horaFinal = date('g:i A', strtotime($consolidadoFinal[0]['horaFin']));
					$fechaInicio = date('d-m-Y', strtotime($consolidadoFinal[0]['FechaInicio']));
					$fechaFinal = date('d-m-Y', strtotime($consolidadoFinal[0]['FechaFinal']));
					if ($horaInicio==$horaFinal) {
						$horasProd = "24";
					}else {
						$horasProd = "12";
					}
					 echo "
					<table id='tablaReporteDiario'>
						<tr>
							<td colspan='3' class='titulos-tablas'><span>orden de producción no.</span></td>
							<td class='titulos-tablas'><span class='span'>".$consolidadoFinal[0]['NoOrder']."</span></td>
							<td class='titulos-tablas'><span>fecha inicio</span></td>
							<td class='titulos-tablas'><span class='span'>".$fechaInicio."</span></td>
						</tr>
						<tr>
							<td colspan='3' class='titulos-tablas'><span>producto</span></td>
							<td class='titulos-tablas'><span class='span'>".$consolidadoFinal[0]['Producto']."</span></td>
							<td class='titulos-tablas'><span>fecha final</span></td>
							<td class='titulos-tablas'><span class='span'>".$fechaFinal."</span></td>
						</tr>
						<tr>
							<td class='titulos-tablas'><span>lote</span></td>
							<td class='titulos-tablas' colspan='5'><span></span></td>
						</tr>
						<tr>
							<td class='titulos-tablas'><span>hora inicio</span></td>
							<td class='titulos-tablas'><span class='span'>".$horaInicio."</span></td>
							<td class='titulos-tablas'><span>hora final</span></td>
							<td class='titulos-tablas'><span class='span'>".$horaFinal."</span></td>
							<td class='titulos-tablas'><span>horas a producir</span></td>
							<td class='titulos-tablas'><span class='span'>".$horasProd."</span></td>
						</tr>
					</table>
					<table id='tablaReporteDiario'>
						<tr>
							<td colspan='3' class='titulos-tablas'><span>producto</span></td>
							<td class='titulos-tablas'><span class='span'>".$consolidadoFinal[0]['Producto']."</span></td>
							<td class='titulos-tablas'><span>código</span></td>
							<td colspan='3' class='titulos-tablas'><span></span></td>
						</tr>
						<tr>
							<td colspan='3' class='titulos-tablas'><span>prod. total(unds y kls)</span></td>
							<td class='titulos-tablas'><span class='span'>".$consolidadoFinal[0]['produccionTotal']."</span></td>
							<td class='titulos-tablas'><span>prod. real(unds y kls)</span></td>
							<td class='titulos-tablas'><span class='span'>".$consolidadoFinal[0]['produccionReal']."</span></td>
							<td class='titulos-tablas'><span>merma producción</span></td>
							<td class='titulos-tablas'><span class='span'>".$consolidadoFinal[0]['mermaTotal']."</span></td>
						</tr>
					</table>";
				} ?>
		</div>
		<div class="contenedor-secundario">
			<table class="table-produccion">
				<thead>
					<tr>
						<th style='text-align:center;' colspan='3'>MATERIA PRIMA DIRECTA (M.P)</th>
					</tr>
					<tr>
						<th style="text-align:center;">MAQUINA</th>
						<th style="text-align:center;">DESCRIPCIÓN</th>
						<th style="text-align:center;">CANTIDAD (KG)</th>
					</tr>
				</thead>
				<tbody>					
					<?php
						if ($materiaPrima) {
							foreach ($materiaPrima as $key) {
						echo "
						<tr>
							<td style='text-align:center;'><span>-</span></td>
							<td style='text-align:center;'>".$key['descripcion']."</td>
							<td style='text-align:center;'>".$key['consumo']."</td>
						</tr>";
							}
						} 
					?>
				</tbody>
			</table>
		</div>
		<div class="contenedor-secundario">
			<table class="table-produccion">
				<thead>
					<tr>
						<th style='text-align:center;' colspan='8'><span>mano de obra directa</span></th>
					</tr>
					<tr>
						<th style="text-align:center;"><span>descripción de la act.</span></th>
						<th style="text-align:center;"><span>día</span></th>
						<th style="text-align:center;"><span>Mixto</span></th>
						<th style="text-align:center;"><span>noche</span></th>
						<th style="text-align:center;"><span>total</span></th>
						<th colspan="3" style="text-align:center;"><span>no. personas</span></th>
					</tr>
				</thead>
				<tbody>
				<?php
				if ($consolidadoFinal) {
					$totalCarga = abs($consolidadoFinal[0]['cargaDia']) + abs($consolidadoFinal[0]['cargaNoche']) + abs($consolidadoFinal[0]['cargaMixta']);
					$totalYankee1 = abs($consolidadoFinal[0]['MMaquina1']) + abs($consolidadoFinal[0]['MMXMaquina1']) + abs($consolidadoFinal[0]['MNMaquina1']);
					$totalYankee2 = abs($consolidadoFinal[0]['MMaquina2']) + abs($consolidadoFinal[0]['MMXMaquina2']) + abs($consolidadoFinal[0]['MNMaquina2']);
					$totalCaldera = abs($consolidadoFinal[0]['MMaquina3']) + abs($consolidadoFinal[0]['MMXVMaquina3']) + abs($consolidadoFinal[0]['MNMaquina3']);
					$totalMerma = abs($consolidadoFinal[0]['mermaMQ1']) + abs($consolidadoFinal[0]['mermaMQ2']);
					/*<tr>
						<td style='text-align:center;'>PULPER 3-PASTA DE MERMA</td>
						<td style='text-align:center;'>".abs(number_format($consolidadoFinal[0]['MermaMX1'], 2))."</td>
						<td style='text-align:center;'>".abs(number_format($consolidadoFinal[0]['MermaMX2'], 2))."</td>
						<td style='text-align:center;'>".abs(number_format($consolidadoFinal[0]['MNMaquina1'], 2))."</td>
						<td style='text-align:center;'>".abs(number_format($totalYankee1, 2))."</td>						
						<td style='text-align:center;'>2</td>
						<td style='text-align:center;'>2</td>
						<td style='text-align:center;'>4</td>
					</tr>*/

				 	echo "
					<tr>
						<td style='text-align:center;'>PULPER 1-PASTA RECICLADA</td>
						<td style='text-align:center;'>".abs(number_format($consolidadoFinal[0]['cargaDia'], 2))."</td>
						<td style='text-align:center;'>".abs(number_format($consolidadoFinal[0]['cargaMixta'], 2))."</td>
						<td style='text-align:center;'>".abs(number_format($consolidadoFinal[0]['cargaNoche'], 2))."</td>
						<td style='text-align:center;'>".abs(number_format($totalCarga, 2))."</td>						
						<td style='text-align:center;'>2</td>
						<td style='text-align:center;'>2</td>
						<td style='text-align:center;'>4</td>
					</tr>
					<tr>
						<td style='text-align:center;'>YANKEE 1 - JUMBO ROLL</td>
						<td style='text-align:center;'>".abs(number_format($consolidadoFinal[0]['MMaquina1'], 2))."</td>
						<td style='text-align:center;'>".abs(number_format($consolidadoFinal[0]['MMXMaquina1'], 2))."</td>
						<td style='text-align:center;'>".abs(number_format($consolidadoFinal[0]['MNMaquina1'], 2))."</td>
						<td style='text-align:center;'>".abs(number_format($totalYankee1, 2))."</td>						
						<td style='text-align:center;'>2</td>
						<td style='text-align:center;'>2</td>
						<td style='text-align:center;'>4</td>
					</tr>
					<tr>
						<td style='text-align:center;'>YANKEE 2 - JUMBO ROLL</td>
						<td style='text-align:center;'>".abs(number_format($consolidadoFinal[0]['MMaquina2'], 2))."</td>
						<td style='text-align:center;'>".abs(number_format($consolidadoFinal[0]['MMXMaquina2'], 2))."</td>
						<td style='text-align:center;'>".abs(number_format($consolidadoFinal[0]['MNMaquina2'], 2))."</td>
						<td style='text-align:center;'>".abs(number_format($totalYankee2, 2))."</td>						
						<td style='text-align:center;'>2</td>
						<td style='text-align:center;'>2</td>
						<td style='text-align:center;'>4</td>
					</tr>
					<tr>
						<td style='text-align:center;'>CALDERA</td>
						<td style='text-align:center;'>".abs(number_format($consolidadoFinal[0]['MMaquina3'], 2))."</td>
						<td style='text-align:center;'>".abs(number_format($consolidadoFinal[0]['MMXVMaquina3'], 2))."</td>
						<td style='text-align:center;'>".abs(number_format($consolidadoFinal[0]['MNMaquina3'], 2))."</td>
						<td style='text-align:center;'>".abs(number_format($totalCaldera, 2))."</td>						
						<td style='text-align:center;'>2</td>
						<td style='text-align:center;'>2</td>
						<td style='text-align:center;'>4</td>
					</tr>
					<tr>
					<td style='text-align:center;'>PLANTA TRATAMIENTO</td>
						<td style='text-align:center;'>".abs(number_format($consolidadoFinal[0]['MMaquina3'], 2))."</td>
						<td style='text-align:center;'>".abs(number_format($consolidadoFinal[0]['MMXVMaquina3'], 2))."</td>
						<td style='text-align:center;'>".abs(number_format($consolidadoFinal[0]['MNMaquina3'], 2))."</td>
						<td style='text-align:center;'>".abs(number_format($totalCaldera, 2))."</td>						
						<td style='text-align:center;'>2</td>
						<td style='text-align:center;'>2</td>
						<td style='text-align:center;'>4</td>
					</tr>";
				 } 
				?>				
				</tbody>
			</table>
		</div>
		<div class="titulos">
			<span>costos indirectos de fabricación</span>
		</div>
		<div class="content-medium">
			<div class="contenedor-uno">
				<table class="table-1">
					<thead>
						<tr>
							<th style='text-align:center;'>DESCRIPCIÓN DE LA ACTIVIDAD</th>
							<th style='text-align:center;'>HORAS</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							if($consolidadoFinal) {
								$totalCarga = abs($consolidadoFinal[0]['cargaDia']) + abs($consolidadoFinal[0]['cargaNoche']) + abs($consolidadoFinal[0]['cargaMixta']);
								$totalYankee1 = abs($consolidadoFinal[0]['MMaquina1']) + abs($consolidadoFinal[0]['MMXMaquina1']) + abs($consolidadoFinal[0]['MNMaquina1']);
								$totalYankee2 = abs($consolidadoFinal[0]['MMaquina2']) + abs($consolidadoFinal[0]['MMXMaquina2']) + abs($consolidadoFinal[0]['MNMaquina2']);
								$totalCaldera = abs($consolidadoFinal[0]['MMaquina3']) + abs($consolidadoFinal[0]['MMXVMaquina3']) + abs($consolidadoFinal[0]['MNMaquina3']);
								$totalMerma = abs($consolidadoFinal[0]['mermaMQ1']) + abs($consolidadoFinal[0]['mermaMQ2']);
						 	echo "
							<tr>
								<td style='text-align:center;'>Pulper 1-PASTA TRATADA</td>
								<td style='text-align:center;'>".abs(number_format($totalCarga, 2))."</td>
							</tr>
							<tr>
								<td style='text-align:center;'>YANKEE 1 - JUMBO ROLL</td>
								<td style='text-align:center;'>".abs(number_format($totalYankee1, 2))."</td>						
							</tr>
							<tr>
								<td style='text-align:center;'>YANKEE 2 - JUMBO ROLL</td>
								<td style='text-align:center;'>".abs(number_format($totalYankee2, 2))."</td>
							</tr>
							<tr>
								<td style='text-align:center;'>CALDERA</td>
								<td style='text-align:center;'>".abs(number_format($totalCaldera, 2))."</td>
							</tr>
							<tr>
								<td style='text-align:center;'>PLANTA TRATAMIENTO</td>
								<td style='text-align:center;'>".abs(number_format($totalCaldera, 2))."</td>
							</tr>";	
							}
						?>
							<!--<tr>
								<td style='text-align:center;'>Pulper 3-Pasta de mermas</td>
								<td style='text-align:center;'>".abs(number_format($totalMerma, 2))."</td>
							</tr> -->
					</tbody>
				</table>			
			</div>
			<div class="contenedor-dos">
				<table class="table-1">
					<thead>
						<tr>
							<td style="text-align:center;" colspan="7"><b>ELECTRICIDAD Kwh</b></td>
						</tr>
						<tr>
							<td style="text-align:center;"><span>FECHA INICIO</span></td>
							<td style="text-align:center;"><span>FECHA FINALIZACIÓN</span></td>
							<td style="text-align:center;"><span>HORA INICIO</span></td>
							<td style="text-align:center;"><span>HORA FINALIZACIÓN</span></td>
							<td style="text-align:center;"><span>CONSUMO INICIAL</span></td>
							<td style="text-align:center;"><span>CONSUMO FINAL</span></td>
							<td style="text-align:center;"><span>TOTAL</span></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<?php 
								if ($consumoElectrico) {
									$horaInicio = date('g:i A', strtotime($consumoElectrico[0]['horaInicio']));
									$horaFinal = date('g:i A', strtotime($consumoElectrico[0]['horaFinal']));
									$total = ($consumoElectrico[0]['consumoFinal'] - $consumoElectrico[0]['consumoInicial']) * 560;					
							echo "
									<td style='text-align:center;'>".$consumoElectrico[0]['fechaInicio']."</td>
									<td style='text-align:center;'>".$consumoElectrico[0]['fechaFin']."</td>
									<td style='text-align:center;'>".$horaInicio."</td>
									<td style='text-align:center;'>".$horaFinal."</td>
									<td style='text-align:center;'>".number_format($consumoElectrico[0]['consumoInicial'],2)."</td>
									<td style='text-align:center;'>".number_format($consumoElectrico[0]['consumoFinal'],2)."</td>
									<td style='text-align:center;'>".number_format($total,2)."</td>";
								}
							?>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div id="footer">
			<table class="footer">
				<tr>
					<td><span>preparado y revisado por</span></td>
					<td><span>autorizado por</span></td>
				</tr>
				<tr>
				<?php 
					if ($this->session->userdata['IdUser']) {
						$usuario = $this->session->userdata['Nombre'];
						echo "<td><span>".$usuario."</span></td>";
					};
				?>
				<td></td>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>