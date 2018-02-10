<main class="mdl-layout__content mdl-color--grey-100">
	<div class="row">
		<div class="col s12">
			<div class="card">
				<div class="card-content">
					<center><span class="card-title purple-text accent-4" style="font-family: robotoblack;">DETALLE DE ORDEN DE TRABAJO</span></center>
						<div class="row">
							<center>
								<?php 
								if ($consecutivo) {								
								foreach ($consecutivo as $key) {
										echo "
								<div class='col s4'>
									<span class='card-title purple-text darken-4' id='ordP'>".$key['NoOrder']."</span><br/>
									<label class='labelValidacion'>N° ORDEN DE PRODUCCIÓN</label>
								</div>
								<div class='col s4'>
									<span class='card-title purple-text darken-4' id='ordC'>".$key['Consecutivo']."</span><br/>
									<label class='labelValidacion'>N° CONSECUTIVO DE TRABAJO</label>
								</div>
								<div class='col s4'>
									<span class='card-title purple-text darken-4' id='ordT'>".$key['Turno']."</span><br/>
									<label class='labelValidacion'>TURNO</label>
								</div>";
									}
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
                        <div class="col s6 m6" style="text-align:left;">
                            <div id="retornarP">
                                <a data-tooltip='REGRESAR' href="<?php echo base_url('index.php/OrdenProduccion')?>" class="modal-trigger tooltipped">
                                    <i class="waves-effect waves-purple material-icons titulosGen">keyboard_backspace</i>
                                </a>
                            </div>  
                        </div>
                    </div><br><br>
                    <div class="row oculto" style="text-align: center;">
						<div class="collection1">
							<div class="col s12 m12">  
								<?php
								/*echo '<div class="col s3 m3"><a href="<?php echo base_url()."index.php/Produccion/"'.$key['IdReporteDiario'].'" class="collection-item activo">PRODUCCIÓN</a></div>
											 <div class="col s3 m3"><a href="<?php echo base_url()."index.php/tiempoMuerto/"'.$key['IdReporteDiario'].'" class="collection-item1">TIEMPOS MUERTOS</a></div>
											 <div class="col s3 m3"><a href="<?php echo base_url()."index.php/cargaspulper/"'.$key['IdReporteDiario'].'" class="collection-item1">CARGAS PULPER</a></div>
											 <div class="col s3 m3"><a href="<?php echo base_url()."index.php/MateriaPrima/"'.$key['IdReporteDiario'].'" class="collection-item activo">MATERIA PRIMA</a></div>';*/
								if ($consecutivo) {								
									foreach ($consecutivo as $key) {
										echo "<div class='col s3 m3'><a href='".base_url()."index.php/Produccion/".$key['IdReporteDiario']."' class='collection-item1'>PRODUCCIÓN</a></div>
											 <div class='col s3 m3 mostrar'><a href='".base_url()."index.php/tiempoMuerto/".$key['IdReporteDiario']."' class='collection-item1'>TIEMPOS MUERTOS</a></div>
											 <div class='col s3 m3 ocultar'><a href='".base_url()."index.php/tiempoMuerto/".$key['IdReporteDiario']."' class='collection-item1'>T. MUERTOS</a></div>
											 <div class='col s3 m3'><a href='".base_url()."index.php/cargaspulper/".$key['IdReporteDiario']."' class='collection-item1'>CARGAS PULPER</a></div>
											 <div class='col s3 m3'><a href='".base_url()."index.php/MateriaPrima/".$key['IdReporteDiario']."' class='collection-item1'>MATERIA PRIMA</a></div>";
								}	
							}?>
							</div>
						</div>
					</div><br><br>
				</div>
			</div>
		</div>
	</div>
</main>