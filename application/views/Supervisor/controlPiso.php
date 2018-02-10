<main class="mdl-layout__content mdl-color--grey-100">
	<div class="row">
		<div class="col s12">
			<div class="card">
				<div class="card-content">
					<div class="row">
                        <div class="col s6 m6" style="text-align:left;">
                            <div id="retornarP">
                                <a data-tooltip='REGRESAR' href="<?php echo base_url('index.php/OrdenProduccion')?>" class="modal-trigger tooltipped">
                                    <i class="waves-effect waves-purple material-icons titulosGen">keyboard_backspace</i>
                                </a>
                            </div>  
                        </div>    
                    </div>
					<center><span class="card-title accent-4 titulos">CONTROL PISO INVENTARIO</span></center>
					<?php 
					if ($detalleOrdTrabajo) {
					echo "<center><span id='consecutivo' class='card-title accent-4 titulos'>".$detalleOrdTrabajo['Consecutivo']."</span></center>";						
					}
					?>
					<center><span class="card-title accent-4 titulos"></span></center>
					<div class="row">
						<center>
		                    <?php 
		                    if ($detalleOrdTrabajo) {
		                    	if ($detalleOrdTrabajo['maquina1']==1 && $detalleOrdTrabajo['maquina2']==1) {
		                    		$chkMaq1 = '<input type="checkbox" name="maquina1" id="maquina1" checked />';
		                    		$chkMaq2 = '<input type="checkbox" name="maquina2" id="maquina2" checked />';
		                    	}elseif ($detalleOrdTrabajo['maquina1']==1 && $detalleOrdTrabajo['maquina2']==0) {
		                    		$chkMaq1 = '<input type="checkbox" name="maquina1" id="maquina1" checked />';
		                    		$chkMaq2 = '<input type="checkbox" name="maquina2" id="maquina2" />';
		                    	}elseif ($detalleOrdTrabajo['maquina1']==0 && $detalleOrdTrabajo['maquina2']==1) {
		                    		$chkMaq1 = '<input type="checkbox" name="maquina1" id="maquina1"  />';
		                    		$chkMaq2 = '<input type="checkbox" name="maquina2" id="maquina2" checked/>';
		                    	}elseif ($detalleOrdTrabajo['maquina1']==0 && $detalleOrdTrabajo['maquina2']==0) {
		                    		$chkMaq1 = '<input type="checkbox" name="maquina1" id="maquina1" />';
		                    		$chkMaq2 = '<input type="checkbox" name="maquina2" id="maquina2" />';
		                    	}
		                   		echo "
								<table id='tblDetalleOrdeT'>
									<tr>
										<td class='celda-tr'><b>orden producción no.</b></td>
										<td><span id='ordTrabajo'>".$detalleOrdTrabajo['NoOrder']."</span></td>
										<td class='celda-tr'><b>fecha</b></td>
										<td style='width:100px;'><span>".date('d/m/Y', strtotime($detalleOrdTrabajo['FechaInicio']))."</span> - <span>".date('d/m/Y', strtotime($detalleOrdTrabajo['FechaFinal']))."</span></td>
										<td class='celda-tr'><b>maquina</b></td>
										<td>yankee</td>
									</tr>
									<tr>
										<td class='celda-tr'><b>producto</b></td>
										<td><span id='tipoPapel'>".$detalleOrdTrabajo['TipoPapel']."</span></td>
										<td class='celda-tr'><b>hora inicio</b></td>
										<td><span id='horaInicio'>".$detalleOrdTrabajo['horaInicio']."</span></td>
										<td class='celda-tr'><b>mp. 1</b></td>
										<td>".$chkMaq1."<label for='maquina1' type='hidden'></label></td>
									</tr>
									<tr>
										<td class='celda-tr'><b>grupo</b></td>
										<td><input class='inputControlPiso' id='grupo' value='".$detalleOrdTrabajo['grupo']."'/></td>
										<td class='celda-tr'><b>hora final</b></td>
										<td><span id='horaFin'>".$detalleOrdTrabajo['horaFinal']."</span></td>
										<td class='celda-tr'><b>mp. 2</b></td>
										<td>".$chkMaq2."<label for='maquina2' type='hidden'></label></td>
									</tr>
									<tr style='display:none;'>
										<td><input id='fechaInicio' type='hidden' value='".$detalleOrdTrabajo['FechaInicio']."'></td>
										<td><input id='fechaFin' type='hidden' value='".$detalleOrdTrabajo['FechaFinal']."'></td>
									</tr>
								</table>";
							} 
							?>
						</center>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col s12">
			<div class="card">
				<div class="card-content">
					<div class="row">
						<div class="col s12">
						<a class="Btnadd btn waves-effect waves-light" id="agregaElect" href="#agregaElectricidad" style="background-color:#831F82; float: right;">electricidad                        
						</a>
						</div>
					</div>
					<center><span class="card-title accent-4 titulos">MATERIA PRIMA DIRECTA (MP)</span></center>
						<div id="contenedor-tipo-fibras">
		                    <div class="input-field col s6 m6 s6">                  
			                    <select name="tipoFibra" id="tipoFibra" class="chosen-select browser-default">
			                    	<option value="" disabled selected>TIPO</option>
			                    	<?php 
			                    	if($tiposFibras) {
			                    		foreach ($tiposFibras as $key) {
			                    			echo "<option value='".$key['Tipo']."'>".$key['Tipo']."</option>";
			                    		}
			                    	}?>
			                    </select>
			                    <label id="lblmaquina" class="lblValidacion">SELECCIONE UN TIPO DE FIBRA</label>
		                    </div>
			                <div class="input-field col s6 m6 s6">                  
			                    <select name="" id="descripcionInsumo" class="chosen-select">
			                    	<option disabled selected class="append">DESCRIPCIÓN</option>
			                    </select>
			                    <label id="lblmaquina" class="lblValidacion">SELECCIONE UNA DESCRIPCIÓN</label>
		                    </div>
						</div>
						<div class="row">
							<div class="col s12">
								<center><br>
									<a class="Btnadd btn waves-effect waves-light" id="agregarRows" onclick="agregarFilas()" href="#!" style="background-color:#831F82;">AGREGAR
				                        <i class="material-icons right">add</i>
				                    </a>									
								</center><br>
								<table class="striped" id="tblControlPiso">
									<thead class="tblcabecera">
										<th>Id Insumo</th>
										<th>Tipo</th>
										<th>código</th>
										<th>descripción</th>
										<th style='width:120px;'>ud. de medida</th>
										<th>requisado</th>
										<th>piso</th>
										<th>consumo</th>
										<th>opciones</th>
									</thead>
									<tbody>
										<?php 
											if ($detalle) {
												foreach ($detalle as $key) {
													echo "
													<tr>
														<td style='width:100px;'>".$key['IdInsumo']."</td>
														<td>".$key['tipo']."</td>
														<td><input class='inputControlPiso numeric' id='codigo".$key['IdInsumo']."' value=".$key['codigo']." /></td>
														<td>".$key['descripcion']."</td>
														<td>".$key['unidadMedida']."</td>
														<td><input class='inputControlPiso numeric' id='requisado".$key['IdInsumo']."' onchange='calcularConsumo(".$key['IdInsumo'].")' value=".$key['requisado']." /></td>
														<td><input class='inputControlPiso numeric' id='piso".$key['IdInsumo']."' onchange='calcularConsumo(".$key['IdInsumo'].")' value=".$key['piso']." /></td>
														<td><input class='inputControlPiso numeric' id='consumo".$key['IdInsumo']."' value=".$key['consumo']." /></td>
														<td></td>
													</tr>
													";	
												}
											}
										?>
									</tbody>
								</table><br>								
							</div>
						</div><br><br>
						<div class="right row">							
							<a class="Btnadd btn waves-effect waves-light" id="agregarRows" onclick="guardarControlPiso()" href="#!" style="background-color:#831F82;">guardar			  
		                    </a>	
						</div><br><br>
						<div class="row">
							<div class="col s12">
							<center><span class="card-title accent-4 titulos">PASTA PROCESADA EN TANQUES</span></center><br>
								<div class="row">
									<div class="col s6" align="left">
										<a class="Btnadd btn waves-effect waves-light" id="agregaPasta" href="#agregaPastaProc" style="background-color:#831F82;">AGREGAR
					                        <i class="material-icons right">add</i>
					                    </a>
									</div>
									<div class="col s6" align="right">
									<?php 
										if ($detalleOrdTrabajo) {
											if ($detalleOrdTrabajo['rptPasta']==1) {
												$html = '<input type="checkbox" id="incluirRptPastaProc" checked/>';
												$text = 'EXCLUIR DEL REPORTE';
											}else {
												$html = '<input type="checkbox" id="incluirRptPastaProc"/>';
												$text = 'ADJUNTAR AL REPORTE';
											}
										}
										echo $html;
										echo '<label id="label-incluirRptPastaProc" for="incluirRptPastaProc">'.$text.'</label>';
									?>
									</div>
								</div>
								<table class="striped" id="tblPastaProc">
									<thead class="tblcabecera">
										<th>tipo</th>
										<th>Codigo</th>
										<th>tanque</th>
										<th>ud. de medida</th>
										<th>pasta tanque final</th>
										<th>Opciones</th>
									</thead>
									<tbody>
										<?php 
										if ($pastaDetalle) {
											foreach ($pastaDetalle as $key) {
												echo "
													<tr>
														<td>".$key['descripcion']."</td>
														<td>".$key['codigo']."</td>
														<td>".$key['noTanque']."</td>
														<td>".$key['undMedida']."</td>
														<td>".$key['pstTanqueFinal']."</td>
														<td>
	                                                    <a onclick='eliminarPastaProc(".$key['idPastaProc'].")' href='#' data-tooltip='ELIMINAR' class='modal-trigger tooltipped purple-text darken-4'>
	                                                        <i class='material-icons'>delete</i>
	                                                    </a>
											        	</td> 
													</tr>";
												}
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<!--PANTALLA MODAL: AGREGAR PASTA PROCESADA TANQUE FINAL-->
<div id="agregaPastaProc" class="modal">
	<div class="modal-content">
		<div class="row noMargen center">
            <div class="noMargen col s12 m12 l12">
                <h6 class="center" style="font-family:'robotoblack'; color:#831F82;font-size:30px; margin-bottom:30px;">PASTA PROCESADA EN TANQUES</h6>
			</div>
        </div>
        <div class='row'>
            <div class='input-field col s12 m6 s6'>
                <input type='text' id='descripcion' name='descripcion'>
                <label for='descripcion'>Tipo</label>
            </div>
            
            <div class='input-field col s12 m6 s6'>
                <input type='text' id='codigo' name='codigo'>
                <label for='codigo'>Código</label>
            </div>
        </div><br>
        <div class='row'>
            <div class='input-field col s6 m6 s6'>
                <input id='undMedidad' name='undMedidad' type='text'>
                <label for='horaInicioConsd'>Unidad Medida</label>
            </div>
            <div class='input-field col s6 m6 s6'>
	            <select name="tanque" id="tanque" class="chosen-select browser-default">
	            	<option value="" disabled selected>TANQUES</option>
	            	<?php 
	            	if($tanques) {
	            		foreach ($tanques as $key) {
	            			echo "<option value='".$key['IdInsumo']."'>".$key['Tanque']."</option>";
	            		}
	            	}?>
	            </select>
	            <label id="lblmaquina" class="lblValidacion">SELECCIONE UN TANQUE</label>
            </div>
        </div><br>
        <div class="row">
            <div class="input-field col s7 m7 s7">
                <input id="cantidad" type="text">
                <label for="cantidad">Pasta Tanque Final</label>
            </div>
            <div class="col s5 m5 s5"><br>
            	<span class='purple-text darken-4'>KILOGRAMOS</span>
            </div>
        </div><br><br>
        <div class="row">                    
            <div class="center">
                <a class="Btnadd btn waves-effect waves-light" onclick="guardarPastaProcesada()" id="agregaPasta" href="#!" style="background-color:#831F82;">guardar
                </a>
                <a class="Btnadd btn waves-effect waves-light" onclick="cerrarModales('agregaPastaProc', true)" href="#!" style="background-color:#831F82;">cerrar
                </a>
            </div>
        </div>
	</div>
</div>
<!--PANTALLA MODAL: AGREGAR CONSUMO ELECTRICO-->
<div id="agregaElectricidad" class="modal">
    <div class="modal-content">   
        <div class="row noMargen center">
            <div class="noMargen col s12 m12 l12">
                <h6 class="center" style="font-family:'robotoblack'; color:#831F82;font-size:30px; margin-bottom:30px;">ELECTRICIDAD Kwh</h6>
			</div>
        </div>
        <?php 
        if ($consumoElectrico) {
        	foreach ($consumoElectrico as $key) {
        		$fechaInicio = $key['fechaInicio'];
        		$fechaFin = $key['fechaFin'];
        		$horaInicio = $key['horaInicio'];
        		$horaFinal = $key['horaFinal'];
        		$consumoInicial = $key['consumoInicial'];
        		$consumoFinal = $key['consumoFinal'];
        	}
        }else {
    	    $fechaInicio = "";
    		$fechaFin = "";
    		$horaInicio = date('H:i:s', strtotime('06:00:00'));
    		$horaFinal = date('H:i:s', strtotime('06:00:00'));
    		$consumoInicial = "";
    		$consumoFinal = "";
        }
        
		echo "
        <div class='row'>
            <div class='input-field col s12 m6 s6'>
                <input type='text' id='fechaInicCons' value='".$fechaInicio."' name='fechaInicCons' class='datepicker'>
                <label for='fechaInicCons'>Fecha inicio</label>
            </div>
            
            <div class='input-field col s12 m6 s6'>
                <input type='text' id='fechaFinCons' value='".$fechaFin."' name='fechaFinCons' class='datepicker'>
                <label for='fechaFinCons'>Fecha final</label>
            </div>
        </div><br>
        <div class='row'>
            <div class='input-field col s6 m6 s6'>
                <input id='horaInicioCons' class='timepicker' value='".$horaInicio."' name='horaInicioCons' type='time'>
                <label for='horaInicioCons'>Hora inicio</label>
            </div>
            <div class='input-field col s6 m6 s6'>
                <input id='horaFinalCons' class='timepicker' name='horaFinalCons' value='".$horaFinal."' type='time'>
                <label for='horaFinalCons'>Hora final</label>
            </div>
        </div><br>
		<div class='row'>
            <div class='input-field col s6 m6 s6'>
                <input  id='consumoInicial' type='text' value='".$consumoInicial."' class='validate'>
                <label for='consumoInicial'>Lectura Inicial</label>
            </div>
            <div class='input-field col s6 m6 s6'>
                <input  id='consumoFinal' type='text' value='".$consumoFinal."' class='validate'>
                <label for='consumoFinal'>Lectura Final</label>
            </div>
		</div><br><br>";
        ?>
        <div class="row">                    
            <div class="center">
                <a class="Btnadd btn waves-effect waves-light" onclick="agregaActualizaConsumoElec()" id="agregaConsumo" href="#!" style="background-color:#831F82;">guardar
                </a>
                <a class="Btnadd btn waves-effect waves-light" id="cerrarConsumoElec" onclick="cerrarModales('agregaElectricidad',false)" href="#!" style="background-color:#831F82;">cerrar
                </a>
            </div>
        </div>
    </div>
</div>