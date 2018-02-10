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
					<center><h5 class="card-title titulos">PRODUCCIÓN DIARIA</h5></center>
	                <div class="row center">
	                    <div class="col s12 m12">
	                        <div style="width:40%; margin: 0 auto;">
	                            <select name="selectMetas" id="selectMetas" class="chosen-select browser-default">
	                                <?php 
	                                if ($metas) {
	                                    foreach ($metas as $key) {
	                                        echo '<option value="'.$key['value'].'">'.$key['desc'].'</option> ';
	                                    }
	                                }
	                                ?>
	                            </select>
	                        </div>
	                    </div>
	                </div>
					<div class="row">
                        <div class="col s12 m12" style="text-align:right;">
							<?php
								if ($_SESSION['Privilegio']!=1 and $_SESSION['Privilegio']!=7) {
									echo '<a id="nuevaProd" href="#modalNuevaPrd" class="Btnadd btn waves-effect waves-light" style="background-color:#831F82; font-size: 12px;">AGREGAR</a>';
								}
							?>
                            <a id="genGrafica" href="#!" class="Btnadd btn waves-effect waves-light" style="background-color:#831F82; font-size: 12px;"><i class="material-icons">timeline</i>
                            </a>
                        </div>
						<table id="tblPD" class="striped">
							<thead style="font-size: 11px; font-weight: normal;">
		                		<tr class="tblcabecera">
		                            <th width="80px">Fecha</th>
		                            <th>ECO PLUS 24/1 (bols)</th>
		                            <th>ECO PLUS 6/4 (bol)</th>
		                            <th>CHOLIN 1000 8/6(bols)</th>
		                            <th>CHOLIN 900 (bols)</th>
		                            <th>GENERICO ECO 1000 (bol)</th>
		                            <th>GENERICO ECO 900 (bol)</th>
		                            <th>CHOLIN HD 32/1 (bol)</th>
		                            <th>Bolson SERVILLETA</th>
		                            <th>CHOLIN HD Gen32/1 (bol)</th>
		                            <th>PAPIEL FACIAL</th>
		                            <th width="50px">TBS</th>
		                            <th width="50px">TNS</th>
		                            <th width="50px">OPC.</th>
		                        </tr>
                    		</thead>
                    		<tbody></tbody>
                    	</table><br><br>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<!--MODAL: AGREGAR NUEVA PRODUCCION-->
  <div id="modalNuevaPrd" class="modal">
    <div class="modal-content">
	    <div class="row">
	    	<center><h6 class="card-title titulos">AGREGAR PRODUCCIÓN</h6></center><br>
	        <div style="width: 40%; margin: 0 auto; text-align: center; margin-top: 0px;">
	            <input style="text-align: center;" type="text" id="diaProduccion" name="diaProduccion" class="datepicker" placeholder="SELECCIONE EL DÍA">
	        </div><br><br>
	        <div class="col s12 m12">

	        	<table id="tblProduccionDiaria" class="striped">
	        		<thead style="font-size: 12px; font-weight: normal;">
	        			<tr class="tblcabecera">
	        				<th>ECO PLUS 24/1 (bols)</th>
	        				<th>ECO PLUS 6/4 (bol)</th>
	        				<th>CHOLIN 1000 8/6(bols)</th>
	        				<th>CHOLIN 900 (bols)</th>
	        				<th>GENERICO ECO 1000 (bol)</th>
	        				<th>GENERICO ECO 900 (bol)</th>
	        				<th>CHOLIN HD 32/1 (bol)</th>
	        				<th>Bolson  SERVILLETA</th>
	        				<th>CHOLIN HD Gen32/1 (bol)</th>
	        				<th>PAPIEL FACIAL</th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			<tr height="50px">
	        				<td ><input class="inputPD numeric" id="val1"></td>
	        				<td ><input class="inputPD numeric" id="val2"></td>
	        				<td ><input class="inputPD numeric" id="val3"></td>
	        				<td ><input class="inputPD numeric" id="val4"></td>
	        				<td ><input class="inputPD numeric" id="val5"></td>
	        				<td ><input class="inputPD numeric" id="val6"></td>
	        				<td ><input class="inputPD numeric" id="val7"></td>
	        				<td ><input class="inputPD numeric" id="val8"></td>
	        				<td ><input class="inputPD numeric" id="val9"></td>
	        				<td ><input class="inputPD numeric" id="val10"></td>
	        			</tr>
	        		</tbody>
	        	</table>
	        </div>
	    </div><br><br><br><br>
        <div class="row">                    
            <div class="center">
	      	    <a onclick="guardarProduccionDiaria()" id="guardarPD" href="#" class="Btnadd btn waves-effect waves-light" style="background-color:#831F82; font-size: 12px;">GUARDAR
                </a>
	      	    <a href="#" class="modal-action modal-close Btnadd btn waves-effect waves-light" style="background-color:#831F82; font-size: 12px;">CANCELAR
                </a>
	        </div>
        </div>
    </div>
  </div>
  <!--MODAL: EDITAR PRODUCCION-->
  <div id="modalEditarPrd" class="modal">
    <div class="modal-content">
	    <div class="row">
	    	<center><h6 class="card-title titulos">EDITAR PRODUCCIÓN</h6></center><br>
	        <div style="display: none;">
	            <input style="text-align: center;" type="text" id="editarDia" name="editarDia" class="datepicker" placeholder="SELECCIONE EL DÍA">
	        </div>
	        <div class="col s12 m12"><br><br>
	        	<table id="tblEdicioProd" class="striped">
	        		<thead style="font-size: 12px; font-weight: normal;">
	        			<tr class="tblcabecera">
	        				<th>ECO PLUS 24/1 (bols)</th>
	        				<th>ECO PLUS 6/4 (bol)</th>
	        				<th>CHOLIN 1000 8/6(bols)</th>
	        				<th>CHOLIN 900 (bols)</th>
	        				<th>GENERICO ECO 1000 (bol)</th>
	        				<th>GENERICO ECO 900 (bol)</th>
	        				<th>CHOLIN HD 32/1 (bol)</th>
	        				<th>Bolson  SERVILLETA</th>
	        				<th>CHOLIN HD Gen32/1 (bol)</th>
	        				<th>PAPIEL FACIAL</th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			<tr height="50px">
	        				<td ><input class="inputPD numeric" id="val1-1"></td>
	        				<td ><input class="inputPD numeric" id="val2-2"></td>
	        				<td ><input class="inputPD numeric" id="val3-3"></td>
	        				<td ><input class="inputPD numeric" id="val4-4"></td>
	        				<td ><input class="inputPD numeric" id="val5-5"></td>
	        				<td ><input class="inputPD numeric" id="val6-6"></td>
	        				<td ><input class="inputPD numeric" id="val7-7"></td>
	        				<td ><input class="inputPD numeric" id="val8-8"></td>
	        				<td ><input class="inputPD numeric" id="val9-9"></td>
	        				<td ><input class="inputPD numeric" id="val10-10"></td>
	        			</tr>
	        		</tbody>
	        	</table>
	        </div>
	    </div><br><br><br><br>
        <div class="row">                    
            <div class="center">
	      	    <a onclick="guardarEdicion()" id="guardarED" href="#" class="Btnadd btn waves-effect waves-light" style="background-color:#831F82; font-size: 12px;">ACTUALIZAR
                </a>
	      	    <a id="guardarPD" href="#" class="modal-action modal-close Btnadd btn waves-effect waves-light" style="background-color:#831F82; font-size: 12px;">CANCELAR
                </a>
	        </div>
        </div>
    </div>
  </div>
    <!--MODAL: GRAFICA PRODUCCION-->
  <div id="modalGraficaPM" class="modal">
    <div class="modal-content">
        <div class="right row">
            <div class="col s1 m1 l1">
                <a href="#!" class="BtnClose modal-action modal-close noHover">
                    <i class="material-icons">highlight_off</i>
                </a>
            </div>
        </div>
	    <div class="row">
	    	<center><h6 id="titleComp" class="titulo-secundario">Comportamiento de Producción mes de <?php echo $metas[0]['desc'] ?></h6></center>
	    	<div class="col s4">
	    		<div class="card">
	    			<div class="card-content">
	    				<table id="tblPDiariaRpt" class="striped" style="font-size: 12px">
	    					<thead>
		    					<tr>
		    						<th style="background-color: #353536; color: white" width='50'>FECHA</th>
		    						<th style="background-color: #353536; color: white" width='50'>ECO</th>
		    						<th style="background-color: #353536; color: white" width='50'>CHOLIN</th>
		    						<th style="background-color: #353536; color: white" width='50'>GEN</th>
		    					</tr>	    						
	    					</thead>
	    					<tbody>   						
	    					</tbody>
	    				</table>
	    			</div>
	    		</div>	    		
	    	</div>
	    	<div class="col s8">
	    		<div id="container-graf" style="min-width: 310px; height: 400px; margin: 0 auto"></div>		
	    	</div>		
	    </div><br>
    </div>
  </div>