<!doctype html>
<?php $mermaTotalF1=0; ?>
<html lang="en">
<head>
	<title>Reporte Control de piso-<?php echo $controPisoDetalle[0]['noOrden'];?> </title>
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
		.image {
			width: 20%;
			height: auto;
			padding: 5px 5px;
		}
		.image2 {
			width: 14px;
			height: auto;
			padding: 2px 2px;
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
		.table-control {			
			text-align: center;
			width: 98%;
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
			<?php  
				if ($controPisoDetalle) {
					list($maquina1, $maquina2) = explode('-', $controPisoDetalle[0]['maquina']);
					if ($maquina1==1 && $maquina2==2) {
						$chkMaq1 = "<center><img class='image2' src='".base_url()."assets/img/logo/done.png'></center>";
						$chkMaq2 = "<center><img class='image2' src='".base_url()."assets/img/logo/done.png'></center>";
					}
					elseif ($maquina1==1 && $maquina2==0) {
						$chkMaq1 = "<center><img class='image2' src='".base_url()."assets/img/logo/done.png'></center>";
					}elseif ($maquina1==0 && $maquina2==2) {
						$chkMaq2 = "<center><img class='image2' src='".base_url()."assets/img/logo/done.png'></center>";
					}
					$horaInicio = date('g:i A', strtotime($controPisoDetalle[0]['horaInicio']));
					$horaFinal = date('g:i A', strtotime($controPisoDetalle[0]['horaFinal']));
					 echo "
					<table id='tablaReporteDiario'>
						<tr>
							<td style='text-align: center;'><img class='image' src='".base_url()."assets/img/logo/logoinnova.png'></td>
							<td class='titulos-tablas'><span>PROCESO HUMEDO</span></td>
						</tr>
						<tr>
							<td class='titulos-tablas'><span>control piso inventario</span></td>
							<td class='titulos-tablas'><span>producción no. ".$controPisoDetalle[0]['consecutivo']."</span></td>
						</tr>
					</table>
					<table id='tablaReporteDiario'>
						<tr>
							<td class='titulos-tablas'><span>orden producción</span></td>
							<td class='titulos-tablas'><span class='span'>".$controPisoDetalle[0]['noOrden']."</span></td>
							<td class='titulos-tablas'><span>fecha</span></td>
							<td class='titulos-tablas'><span class='span'>".$controPisoDetalle[0]['fechaInicio']." / ".$controPisoDetalle[0]['fechaFinalizacion']."</span></td>
							<td class='titulos-tablas'><span>maquina</span></td>
							<td class='titulos-tablas'><span>yankee</span></td>
						</tr>
						<tr>
							<td class='titulos-tablas'><span>producto</span></td>
							<td class='titulos-tablas'><span class='span'>".$controPisoDetalle[0]['producto']."</span></td>
							<td class='titulos-tablas'><span>hora inicio</span></td>
							<td class='titulos-tablas'><span class='span'>".$horaInicio."</span></td>
							<td class='titulos-tablas'><span>mp 1</span></td>
							<td class='span'>".$chkMaq1."</td>
						</tr>
						<tr>
							<td class='titulos-tablas'><span>grupo</span></td>
							<td class='titulos-tablas'><span class='span'>".$controPisoDetalle[0]['grupo']."</span></td>
							<td class='titulos-tablas'><span>hora final</span></td>
							<td class='titulos-tablas'><span class='span'>".$horaFinal."</span></td>
							<td class='titulos-tablas'><span>mp 2</span></td>
							<td class='span'>".$chkMaq2."</td>
						</tr>
					</table>";
					} ?>
		</div>		
		<div class="titulos">
			<span>materia prima directa (m.p)</span>
		</div>
		<table class="table-control">
			<thead>
				<tr>
					<th style="text-align:center;">TIPO</th>
					<th style="text-align:center;">CÓDIGO</th>
					<th style="text-align:center;">DESCRIPCIÓN</th>
					<th style="text-align:center;">UD. DE MEDIDA</th>
					<th style="text-align:center;">REQUISADO</th>
					<th style="text-align:center;">PISO</th>
					<th style="text-align:center;">CONSUMO</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($controPisoDetalle) {
					foreach ($controPisoDetalle as $key) {
					echo 
						"<tr>
							<td style='text-align:center;'>".$key['tipo']."</td>
							<td style='text-align:center;'>".$key['codigo']."</td>
							<td style='text-align:center;'>".$key['descripcion']."</td>
							<td style='text-align:center; width:20px;'>".$key['unidadMedida']."</td>
							<td style='text-align:center;'>".$key['requisado']."</td>
							<td style='text-align:center;'>".$key['piso']."</td>
							<td style='text-align:center;'>".$key['consumo']."</td>
						</tr>
						<tr>";
						}
					}
				?>
			</tbody>
		</table>
		<?php
		if ($pastaDetalle!=false) {
		echo "<div class='titulos'>
				<span>pasta procesada en tanques</span>
			</div>
				<table class='table-control'>
					<thead>
						<tr>
							<th style='text-align:center;'>TIPO</th>
							<th style='text-align:center;'>CÓDIGO</th>
							<th style='text-align:center;'>TANQUE</th>
							<th style='text-align:center;'>UD. MEDIDA</th>
							<th style='text-align:center;'>PASTA TANQUE FINAL</th>
						</tr>
					</thead>
					<tbody>";
				foreach ($pastaDetalle as $key) {
				echo "<tr>
					<td style='text-align:center;'>".$key['descripcion']."</td>
					<td style='text-align:center;'>".$key['codigo']."</td>
					<td style='text-align:center;'>".$key['noTanque']."</td>
					<td style='text-align:center; width:20px;'>".$key['undMedida']."</td>
					<td style='text-align:center;'>".$key['pstTanqueFinal']."</td>
				</tr>";	
				}					
				echo "</tbody>
				</table>";				
			}
		?>
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