<!doctype html>
<?php $mermaTotalF1=0; ?>
<html lang="en">
<head>
	<title>Reporte Diario-<?php echo $cabeceraRpt[0]['Consecutivo'];?></title>
	<style>
		table {
		    color: black;
		    font-size: 9px;
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
		.image {
			width: 20%;
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
		.totales {
			font-size: 9px;
			text-transform: uppercase!important;
			font-weight: normal;
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
		.titulos {
			width: 98%;			
			text-align: center;
			padding: 1px 1px;
			font-weight: bold;
		}
		.titulos span {
			font-family: arial;
			font-size: 10px;
		}
		.titulos-tablas {
			text-align: center;
		}
		.titulos-tablas-gen {
			background-color: black;
			color: white;
		}
		span {
			text-transform: uppercase!important;
			font-weight: bold;
			font-size: 10px;
		}
	</style>
</head>
<body>
	<div class="contenedor">
		<div class="encabezado">			
			<table id="tablaReporteDiario">
				<?php  
				if ($cabeceraRpt) {
					foreach ($cabeceraRpt as $key) {
					 echo "<tr>
							<td style='text-align: center;'><img class='image' src='".base_url()."assets/img/logo/logoinnova.png'></td>
							<td class='titulos-tablas'><span>PROCESO HUMEDO</span></td>
							<td colspan='2' class='titulos-tablas'><span>ORDEN PRODUCCION N°: </span><span class='totales'>".$key['NoOrder']."</span></td>
						</tr>
						<tr>
							<td><span>REPORTE PRODUCCION: </span><span class='totales'>".$key['Consecutivo']."</span></td>
							<td><span>TIPO PAPEL: </span><span class='totales'>".$key['TipoPapel']."</span></td>
							<td colspan='2' class='titulos-tablas'><span>PRODUCCION TOTAL(kg): </span><span class='totales'>".$key['ProduccionTotal']."</span></td>
						</tr>
						<tr>
							<td><span>Fecha Inicio: </span>".$key['FechaInicio']."</td>
							<td rowspan='1'><span>Hora Inicio:</span></td>
							<td rowspan='3' class='titulos-tablas'><span>TURNO:</span><br /> <span class='totales'>".$key['Turno']."</span></td>								
							<td rowspan='3' class='titulos-tablas'><span>MERMA: </span><br /> <span class='totales'>".$mermaTotal."</span></td>
						</tr>
						<tr>
							<td><span>Fecha Fin: </span><span class='totales'>".$key['FechaFinal']."</span></td>
							<td rowspan='1'><span>Hora Fin: </span></td>																	
						</tr>
						<tr>
							<td><span>Coordinador: </span><span class='totales'>".$key['Nombre']."</span></td>
							<td><span>Grupo:</span><span class='totales'>".$key['Grupo']."</span></td>
						</tr>";
					}
				} ?>
			</table>	
		</div>		
		<div class="titulos">
			<span>PRODUCCIÓN</span>
		</div>
		<div class="contenedor-secundario">
			<table class="table-produccion">
				<thead>
					<tr>
					<?php 
						if ($produccion) {
							foreach ($produccion as $key) { 
								if($key['Maquina']=='Maquina 1') {									
									echo "<th style='text-align:center;' colspan='7'>Operador maq. 1: ".$key['Nombre']."</th>";
								break; 
							}
						}
					} 
					?>
					</tr>
					<tr>
						<th style="text-align:center;">#</th>
						<th style="text-align:center;">HORA INICIO</th>
						<th style="text-align:center;">HORA FINAL</th>
						<th style="text-align:center;">VELOC. MAQUINA</th>
						<th style="text-align:center;">PESO</th>
						<th style="text-align:center;">DIAMETRO</th>
						<th style="text-align:center;">PESO BASE</th>
					</tr>
				</thead>
				<tbody>
					<?php
						if ($produccion) { $cont=0;$prd=0; $merma=0; $prdNeta=0;
							foreach ($produccion as $key) { 
								if ($key['Maquina']=='Maquina 1') {
									$prd=$prd+$key['Peso']; $merma=$key['Merma']; $prdNeta=$prd+$merma; $mermaTotalF1 = $mermaTotalF1 + $merma;
								echo "<tr>
										<td style='text-align:center;'>".($cont=$cont+1)."</td>
										<td style='text-align:center;'>".$key['HoraInicio']."</td>
										<td style='text-align:center;'>".$key['HoraFin']."</td>
										<td style='text-align:center;'>".$key['VelocMaquina']."</td>
										<td style='text-align:center;'>".$key['Peso']."</td>
										<td style='text-align:center;'>".$key['Diametro']."</td>
										<td style='text-align:center;'>".$key['PesoBase']."</td>
									</tr>";
									
								 }
							 } 
					 } ?>
					<?php 
					echo 
					"<tr>
						<td colspan='3' style='text-align:center;'><span>producción(kg)</span></td>
						<td colspan='4' style='text-align:center;'>".$prd."</td>
					</tr>
					<tr>
						<td colspan='3' style='text-align:center;'><span>merma(kg)</span></td>
						<td id='merma1' colspan='4' style='text-align:center;'>".$merma."</td>
					</tr>
					<tr>
						<td colspan='3' style='text-align:center;'><span>producción neta</span></td>
						<td colspan='4' style='text-align:center;'>".$prdNeta."</td>
					</tr>";
					?>
				</tbody>
			</table>
		</div>
		<div class="contenedor-secundario">
			<table class="table-produccion">
				<thead>
					<tr>
					<?php 
						if ($produccion) {
							foreach ($produccion as $key) { 
								if($key['Maquina']=='Maquina 2') {									
									echo "<th style='text-align:center;' colspan='7'>Operador maq. 1: ".$key['Nombre']."</th>";
								break; 
							}
						}
					} 
					?>
					</tr>
					<tr>
						<th style="text-align:center;">#</th>
						<th style="text-align:center;">HORA INICIO</th>
						<th style="text-align:center;">HORA FINAL</th>
						<th style="text-align:center;">VELOC. MAQUINA</th>
						<th style="text-align:center;">PESO</th>
						<th style="text-align:center;">DIAMETRO</th>
						<th style="text-align:center;">PESO BASE</th>
					</tr>
				</thead>
				<tbody>
					<?php
						if ($produccion) { $cont=0;$prd=0; $merma=0; $prdNeta=0;
							foreach ($produccion as $key) { 
								if ($key['Maquina']=='Maquina 2') {
									$prd=$prd+$key['Peso']; $merma=$key['Merma']; $prdNeta=$prd+$merma; $mermaTotalF1 = $mermaTotalF1 + $merma;
								echo "<tr>
										<td style='text-align:center;'>".($cont=$cont+1)."</td>
										<td style='text-align:center;'>".$key['HoraInicio']."</td>
										<td style='text-align:center;'>".$key['HoraFin']."</td>
										<td style='text-align:center;'>".$key['VelocMaquina']."</td>
										<td style='text-align:center;'>".$key['Peso']."</td>
										<td style='text-align:center;'>".$key['Diametro']."</td>
										<td style='text-align:center;'>".$key['PesoBase']."</td>
									</tr>";
									
								 }
							 } 
					 } ?>
					<?php 
					echo 
					"<tr>
						<td colspan='3' style='text-align:center;'><span>producción(kg)</span></td>
						<td colspan='4' style='text-align:center;'>".$prd."</td>
					</tr>
					<tr>
						<td colspan='3' style='text-align:center;'><span>merma(kg)</span></td>
						<td id='merma1' colspan='4' style='text-align:center;'>".$merma."</td>
					</tr>
					<tr>
						<td colspan='3' style='text-align:center;'><span>producción neta</span></td>
						<td colspan='4' style='text-align:center;'>".$prdNeta."</td>
					</tr>";
					?>
				</tbody>
			</table>
		</div>		
		<div class="titulos"> <span>TIEMPOS MUERTOS</span></div>
		<table>
			<thead>
				<tr>
					<th colspan="2" style="text-align:center;">TIEMPO</th>	
					<th rowspan="2" style="text-align:center;">MINUTOS</th>
					<th rowspan="2" style="text-align:center;">TIEMPO MUERTO MQ. 1</th>
				</tr>
				<tr>
					<th style="text-align:center;">DE</th>
					<th style="text-align:center;">A</th>
				</tr>	
			</thead>
			<tbody>
				<?php 
					if ($tiemposM) {
						foreach ($tiemposM as $key) {
							if ($key['Maquina']==1) {
							echo "<tr>
									<td style='text-align:center;'>".$key['HoraInicio']."</td>
									<td style='text-align:center;'>".$key['HoraFin']."</td>
									<td style='text-align:center;'>".$key['Intervalos']."</td>
									<td>".$key['Descripcion']."</td>
								</tr>";
							 }
						 }
				 } ?>
			</tbody>
		</table>
		<table>
			<thead>
				<tr>
					<th colspan="2" style="text-align:center;">TIEMPO</th>	
					<th rowspan="2" style="text-align:center;">MINUTOS</th>
					<th rowspan="2" style="text-align:center;">TIEMPO MUERTO MQ. 1</th>
				</tr>
				<tr>
					<th style="text-align:center;">DE</th>
					<th style="text-align:center;">A</th>
				</tr>	
			</thead>
			<tbody>
				<?php 
					if ($tiemposM) {
						foreach ($tiemposM as $key) {
							if ($key['Maquina']==2) {
							echo "<tr>
									<td style='text-align:center;'>".$key['HoraInicio']."</td>
									<td style='text-align:center;'>".$key['HoraFin']."</td>
									<td style='text-align:center;'>".$key['Intervalos']."</td>
									<td>".$key['Descripcion']."</td>
								</tr>";
							 }
						 }
				 } ?>
			</tbody>
		</table>		
		<div class="titulos"> <span>CARGAS PULPER</span><span class="totales"> (<b>TOTAL:</b><?php echo $cargaTotal;?>)</span></div>
		<table>
			<thead>
				<tr>
					<th style="text-align:center;">TIPO DE FIBRA(kg)</th>
					<?php					
						if($cargasPulper) {
							$cont = 0;
							$cantidad = $cargasPulper['datos'][0]['totalFilas'];
							for ($i=0; $i < $cantidad; $i++) { 
								echo '<th style="text-align:center;">'.($cont=$cont+1).'</th>';
							}
						};
					?>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($cargasPulper) {					
					for ($i=0; $i < count($cargasPulper['datos'][0]['insumos']); $i++) { 
						$nombreTemp= $cargasPulper['datos'][$i]['insumos'][$i]['Descripcion'];
						echo '<tr><td>'.$nombreTemp.'</td>';
						for ($e=0; $e <= count($cargasPulper['datos']); $e++) { 
							if ($nombreTemp == $cargasPulper['datos'][$e]['Descripcion']) {
								echo '<td>'.$cargasPulper['datos'][$e]['Cantidad'].'</td>';
							}
						}
					echo '</tr>';					
					}				
				}
				?>
			</tbody>
		</table>		
		<div class="titulos"> <span>HORAS MOLIENDA</span><span class="totales"> (<b>total:</b><?php echo $totalHrsM?>)</span></div>
		<table>
			<thead>
				<tr>
					<th style="text-align:center;">CARGA</th>
					<th style="text-align:center;">HORAS Y MINUTOS</th>
					<?php $cant=0;
					if ($horasMolienda) {
						for ($i=0; $i<count($horasMolienda);$i++) { 
							echo "<th style='text-align:center;'>".($cant=$cant+1)."</th>";	
						}
					}
					?>
				</tr>
			</thead>
			<tbody>
				<?php 
					if ($horasMolienda) {
						echo "
							<tr>
								<td rowspan='3' style='text-align:center;'>BATIDO</td>
								<td style='text-align:center;'>INICIO</td>";
								for ($i=0; $i<count($horasMolienda);$i++) {
									echo "<td style='text-align:center;'>".$horasMolienda[$i]['horaInicio']."</td></tr>";
								}
						echo "
							<tr>
								<td style='text-align:center;'>FINAL</td>";
								for ($i=0; $i<count($horasMolienda);$i++) {
									echo "<td style='text-align:center;'>".$horasMolienda[$i]['horaFin']."</td></tr>";
								}
						echo "
							<tr>
								<td style='text-align:center;'>TIEMPO</td>";
								for ($i=0; $i<count($horasMolienda);$i++) {
									echo "<td style='text-align:center;'>".$horasMolienda[$i]['tiempo']."</td></tr>";
								}
						} ?>
			</tbody>
		</table>		
		<div class="titulos">
			<span>MATERIA PRIMA</span>
		</div>
		<div class="contenedor-secundario">
			<table class="table-produccion">
				<thead>
					<tr>
						<th style="text-align:center;">TANQUES</th>
						<th style="text-align:center;">DÍA</th>
						<th style="text-align:center;">NOCHE</th>
						<th style="text-align:center;">CONSUMO</th>
					</tr>
				</thead>
				<tbody>						
					<?php 
						if ($pasta) {
							foreach ($pasta as $key) { 
							echo "<tr>
									<td style='text-align:center;'>".$key['Tanque']."</td>
									<td style='text-align:center;'>".$key['Dia']."</td>
									<td style='text-align:center;'>".$key['Noche']."</td>
									<td style='text-align:center;'>".$key['Consumo']."</td>
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
						<th rowspan="2" style="text-align:center;">DESCRIPCION</th>								
						<th colspan="2" style="text-align:center;"></th>							
						<th colspan="2" style="text-align:center;">CANTIDAD</th>
					</tr>
					<tr>
						<th style="text-align:center;">DÍA</th>
						<th style="text-align:center;">NOCHE</th>
						<th style="text-align:center;">PTA AGUA DÍA</th>
						<th style="text-align:center;">PTA AGUA NOCHE</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						if ($insumos) {
							foreach ($insumos as $key) {
								echo "<tr>
									<td style='text-align:center;'>".$key['Descripcion']."</td>
									<td style='text-align:center;'>".$key['Dia']."</td>
									<td style='text-align:center;'>".$key['Noche']."</td>
									<td style='text-align:center;'>".$key['Cantidad_PTA_Agua_Dia']."</td>
									<td style='text-align:center;'>".$key['Cantidad_PTA_Agua_Noche']."</td>
								</tr>";
							 }
						 } ?>											
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>