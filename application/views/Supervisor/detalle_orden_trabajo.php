<main class="mdl-layout__content mdl-color--grey-100">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <center><span class="card-title titulos">DETALLE DE ORDEN DE TRABAJO</span></center>
	                    <div class="row">
	                        <center>
                                <?php 
                                    if(!($consecutivo)){                                   
                                        } else {
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
                                <a data-tooltip='REGRESAR' href="../menuOrdenTrabajo/<?php echo $key["IdReporteDiario"]?>" class="modal-trigger tooltipped">
                                    <i class="waves-effect waves-purple material-icons titulosGen">keyboard_backspace</i>
                                </a>
                            </div>  
                        </div>
                    <div class="row">
                        <div class="col s12 m12">
                            <center><h5 class="card-title titulos" >TIEMPOS MUERTOS</h5></center>
                        </div>
                    </div>
                    <div class="row"><br>
                        <div class="col s12 m12" style="text-align:right;">
                            <input type="checkbox" id="maquina1"/>
                            <label id="label-maquina1" for="maquina1">Maquina 1</label>
                            <input type="checkbox" id="maquina2" />
                            <label id="label-maquina2" for="maquina2">Maquina 2</label>
                            <input type="checkbox" id="maquina3" />
                            <label id="label-maquina3" for="maquina3">Maquina 3</label>
                        </div>
                    </div>   
					<table id="tlbTiemposMuertos" class="striped">
						<thead>
		                    <tr class="tblcabecera">
		                        <th>HORA INICIO</th>
		                        <th>HORA FINAL</th>
		                        <th>TIEMPO TRANSCURRIDO</th>
		                        <th>MAQUINA</th>
		                        <th>OPCIONES</th>
		                    </tr>
						</thead>
						<tbody>
							<?php 
								if(!($tiemposM)){									
								} else {
									foreach ($tiemposM as $key) {
                                        if ($key['Maquina'] == 'Maquina 1') {
                                            $class="mostrarMaquina1";
                                        }elseif ($key['Maquina'] == 'Maquina 2') {
                                            $class="mostrarMaquina2";
                                        }elseif ($key['Maquina'] == 'Maquina 3') {
                                            $class="mostrarMaquina3";
                                        }else {
                                            $class="none";
                                        }
										echo "
											<tr class='".$class."'>
												<td>".$key['HoraInicio']."</td>
												<td>".$key['HoraFin']."</td>
												<td>".$key['Intervalos']."</td>
												<td>".$key['Maquina']."</td>
												<td>
                                                    <a onclick='buscarTiempoM(".$key['IdTiempoMuerto'].")' href='#!' data-tooltip='VER' class='modal-trigger tooltipped purple-text darken-4'>
                                                        <i class='material-icons'>visibility</i>
                                                    </a>&nbsp;&nbsp;&nbsp;
                                                    <a onclick='eliminarTM(".$key['IdTiempoMuerto'].",".$key['IdReporteDiario'].")' href='#!' data-tooltip='ELIMINAR' class='modal-trigger tooltipped purple-text darken-4'>
                                                        <i class='material-icons'>delete</i>
                                                    </a>
										        </td> 
											</tr>";
										}
								}
							?>							
						</tbody>
					</table><br>
					<div id="agregarTM" class="fixed-action-btn">
						<a data-tooltip='AGREGAR TIEMPO MUERTO' data-position="top" href="#nuevoTiempoMuerto" class="modal-trigger tooltipped btn-floating btn-large waves-effect waves-light amber darken-4"><i class="material-icons">add</i></a>		
					</div><br> 				
    			</div><br><br>
    		</div>
    	</div>
    </div>
</main>
<!--/////////////////////////////////////////////////////////////////////////////////////////
                                        PANTALLAS MODALES
//////////////////////////////////////////////////////////////////////////////////////////-->
<!-- AGREGAR NUEVO TIEMPO MUERTO -->
<div id="nuevoTiempoMuerto" class="modal">
    <div class="modal-content">     
        <div class="row noMargen center">
            <div class="noMargen col s12 m12 l12">
                <h6 class="center titulos">AGREGAR TIEMPO MUERTO</h6>
            </div>
        </div>        
        <div class="row">
            <?php 
                if(!($consecutivo)){                                   
                } else {
                    foreach ($consecutivo as $key) {
                        echo "<input name='idRptD' id='idRptD' type='hidden' value='".$key['IdReporteDiario']."' >";
                        }
                    }
            ?>
            <input name="ordP1" id="ordP1" type="hidden" >                
            <input name="consecutivo" id="consecutivo" type="hidden" >
            <input name="turno1" id="turno1" type="hidden" >
            <div class="row">
                <div class="input-field col s6 m6 s6">
                    <input id="timepickerII" class="timepicker" name="timepickerII" type="time">
                    <label for="timepickerII">Hora inicio</label>
                </div>
                <div class="input-field col s6 m6 s6">
                    <input id="timepickerFF" class="timepicker" name="timepickerFF" type="time">
                    <label for="timepickerFF">Hora final</label>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="input-field col s12 m12 s12">
                    <select name="maquina" id="maquina" class="chosen-select browser-default">
                        <option value="" disabled selected>MAQUINA</option>
                        <?PHP
                        if(!$listaMaq){
                        } else {
                            foreach($listaMaq as $key){
                                   $maq="";
                                 switch ($key['idMaquina']) {
                                            case '1':
                                                $maq = " <span>(Yankee 1 - Jumbo Roll)</span>";
                                                break;
                                            case '2':
                                                $maq = "<span>(Yankee 2 - Jumbo Roll)</span>";
                                                break;
                                            case '3':
                                                $maq = "<span>(Caldera y Plan tratamiento)</span>";
                                                break;
                                        }
                                echo '<option value="'.$key['idMaquina'].'">'.$key['maquina'].' '.$maq.'</option>';
                            }
                        }
                        ?>
                    </select>
                    <label id="lblmaquina" class="lblValidacion">ELIGE UNA MAQUINA</label>
                </div>
            </div><br>
            <div class="row">
                <div class="input-field col s12 m12 s12">
                  <textarea id="descipcion" class="text-area-ord" name="descipcion"></textarea>
                  <label for="descipcion">DESCRIPCIÓN</label>
                </div>                  
            </div>
            <br>
            <div class="row">                    
                <div class="center">
                    <?php
                        foreach ($consecutivo as $key) {
                            if ($key['Estado'] == 0) {
                                echo ' 
                                <span class="badge red-text darken-4"><b>El Consecutivo ya ha sido cerrado</b></span><br>   
                                <a class="Btnadd btn waves-effect waves-light disabled" href="#" style="background-color:#831F82;">Guardar
                                </a>';
                            } else {
                                echo '
                                <a class="Btnadd btn waves-effect waves-light" onclick="guardarTM1()" id="guardarTM1" href="#" style="background-color:#831F82;">GUARDAR
                                </a>
                                ';
                            }
                            
                        }
                    ?>
                <a class="Btnadd btn waves-effect waves-light" onclick="cerrarModales('nuevoTiempoMuerto',true)" href="#!" style="background-color:#831F82;">cerrar
                </a>
		        </div>
            </div>
        </div>
    </div>
</div>
<!-- VISUALIZAR TIEMPOS MUERTOS -->
<div id="visTiempoM" class="modal">
    <div class="modal-content">    
        <div class="row noMargen center">
            <div class="noMargen col s12 m12 l12">
                <h6 class="center" style="font-family:'robotoblack'; color:#831F82;font-size:30px; margin-bottom:30px;">DETALLE TIEMPO MUERTO</h6>
                <h5 class="card-title" id="Maquina" style="font-family:'robotoblack'; color:#831F82;"></h5>
            </div>
        </div>   
            <ul class="collection">
                <li class="collection-item avatar">
                    <i class="material-icons circle purple darken-1">alarm</i>
                    <span class="title">TIEMPO</span>
                    <div class="row">
                        <div class="col s4 m4">
                            <h5 class="card-title titleh5" id="HoraInicio"></h5>
                            <label class="labelValidacion">HORA INICIO</label>
                        </div>
                        <div class="col s4 m4">
                            <h5 class="card-title titleh5" id="HoraFin"></h5>
                            <label class="labelValidacion">HORA FINALIZACIÓN</label>
                        </div>
                        <div class="col s4 m4">
                            <h5 class="card-title titleh5" style="font-family:'roboto'; color:#831F82;" id="interval"></h5>
                            <label class="labelValidacion">TIEMPO TRANSCURRIDO</label>
                        </div>
                    </div>
                </li>
                <li class="collection-item avatar">
                <i class="material-icons circle purple darken-1">content_paste</i>
                <span class="title">DESCRIPCIÓN</span>
                <div class="row">
                    <div class="input-field col s12 m12 s12">
                      <textarea disabled id="Descrip" class="text-area-ord"></textarea>
                    </div>                  
                </div>
                </li>
            </ul>
            <div class="row">                    
                <div class="center">
                    <a class="Btnadd btn waves-effect waves-light" onclick="cerrarModales('visTiempoM',false)" href="#!" style="background-color:#831F82;">cerrar
                    </a>
                </div>
            </div>
    </div>
</div>