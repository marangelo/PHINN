<main class="mdl-layout__content mdl-color--grey-100">
	<div class="row">
		<div class="col s12">
			<div class="card">
				<div class="card-content">
					<div class="row">
                        <div class="col s6 m6" style="text-align:left;">
                            <div id="retornarP">
                                <a data-tooltip='REGRESAR' href="<?php echo base_url('index.php/dashboard')?>" class="modal-trigger tooltipped">
                                    <i class="waves-effect waves-purple material-icons titulosGen">keyboard_backspace</i>
                                </a>
                            </div>  
                        </div>      
                    </div>
					<center><span class="card-title accent-4 titulos">REPORTES</span></center>
					<div id="contenedor-tipo-fibras">
						<div class="row">
							<div class="col s6 m6">                  
			                    <select name="ordProduccion" id="ordProduccion" class="chosen-select browser-default">
			                    	<option value="" disabled selected>ORDEN DE PRODUCCION</option>
			                    	<?php
			                    	setlocale(LC_TIME, 'spanish');
			                    	$activa='';
			                    	if($ordProduccion) {
			                    		foreach ($ordProduccion as $key) {
			                    			if ($key['Estado']==1) {
			                    				$activa='(Activa)';
			                    			}else {
			                    				$activa='';
			                    			}
			                    			echo "<option value='".$key['IdOrden']."'>".$key['NoOrden']." - ".strftime("%d %b %Y", strtotime($key['FechaInicio']))." ".$activa."</option>";
			                    		}
			                    	}?>
			                    </select>
			                    <label id="ordProduccion" class="lblValidacion">SELECCIONE UNA ORDEN DE PRODUCCION</label>
		                    </div>
			                <div class="col s6 m6">                  
			                    <select name="ordTrabajo" id="ordTrabajo" class="chosen-select">
			                    	<option disabled selected class="append">ORDEN DE TRABAJO</option>
			                    </select>
			                    <label id="ordTrabajo" class="lblValidacion">SELECCIONE UNA ORDEN DE TRABAJO</label>
		                    </div>
						</div>
					</div>
					<div class="content-select">
						<div class="row">
							<center><span class="titulo-secundario">TIPO DE REPORTE</span></center>
							<br>
							<div class="col s4">
								<center>
									<input type="checkbox" id="rptConsolidado" />
									<label for="rptConsolidado">Reporte Consolidado</label>
								</center>							
							</div>
							<div class="col s4">
								<center>
									<input type="checkbox" id="rptControlPiso" />
									<label for="rptControlPiso">Reporte Control Piso</label>	
								</center>							
							</div>
							<div class="col s4">
								<center>
									<input type="checkbox" id="rptDiario" />
									<label for="rptDiario">Reporte Diario</label>	
								</center>							
							</div>
						</div>
					</div>
					<center><br><br>
						<a class="Btnadd btn waves-effect waves-light" id="generarRpts" onclick="generarReportes()" href="#!" style="background-color:#831F82;">GENERAR
						</a>									
					</center><br>
				</div>
			</div>
		</div>
	</div>
</main>