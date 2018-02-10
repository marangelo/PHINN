<main class="mdl-layout__content mdl-color--grey-100"><br>
	<div class="container">
        <div class="Buscar row column">               
            <div class="col s1 m1 l1 offset-l3 offset-m2">
                <i class="material-icons iconSearch">search</i>
            </div>
            <div class="input-field col s12 m6 l4">
                <input  id="filtrarRep" type="text" placeholder="Buscar" class="validate">
                <label for="search"></label>
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
                                <a data-tooltip='REGRESAR' href="<?php echo base_url('index.php/dashboard')?>" class="modal-trigger tooltipped">
                                    <i class="waves-effect waves-purple material-icons titulosGen">keyboard_backspace</i>
                                </a>
                            </div>  
                        </div>
                        <div class="col s6 m6" style="text-align:right;">
                            <a data-tooltip='CREAR NUEVA ORDEN' id="crearR" href="#nuevoReporte" class="modal-trigger tooltipped">
                                <i class="waves-effect waves-purple material-icons titulosGen">queue</i>
                            </a>       
                        </div>       
                    </div>
                    <table id="tlbListaRep" class="striped">
                        <thead>
                            <tr class="tblcabecera">
                                <th>Nº orden</th>                                 
                                <th>inicio</th>
                                <th>culminación</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(!($listaReport)){
                                } else {
                                    foreach ($listaReport as $list) {
                                        if($list['Estado'] == 0){
                                            $activo="<td><a data-tooltip='ORDEN ANULADA' class='btn-flat tooltipped noHover'><i style='color:#696969; font-size:30px;' class='material-icons'>delete</i></a></td>";
                                            $status="<li><a href='#!' onclick='buscarOrdProd(".$list['IdOrden'].")'>Ver</a></li>";
                                        }elseif($list['Estado'] == 1){
                                            $activo="<td><a data-tooltip='ORDEN ACTIVA' class='btn-flat tooltipped noHover'><i style='color:green; font-size:30px;' class='material-icons'>done</i></a></td>";
                                            $status="<li><a href='#!' onclick='cambiaStatusRpt(".$list['IdOrden'].",".$list['NoOrden'].", 0)'>Anular</a></li>
                                                     <li><a href='#!' onclick='cambiaStatusRpt(".$list['IdOrden'].",".$list['NoOrden'].", 2)'>Cerrar</a></li>
                                                     <li><a href='#!' onclick='buscarOrdProd(".$list['IdOrden'].")'>Ver</a></li>";
                                        }elseif($list['Estado'] == 2){
                                            $activo="<td><a data-tooltip='ORDEN CERRADA' class='btn-flat tooltipped noHover'><i style='color:#696969; font-size:30px;' class='material-icons'>lock</i></a></td>";
                                            $status="<li><a href='#!' onclick='cambiaStatusRpt(".$list['IdOrden'].",".$list['NoOrden'].", 0)'>Anular</a></li>
                                                        <li><a href='#!' onclick='buscarOrdProd(".$list['IdOrden'].")'>Ver</a></li>";
                                        }elseif($list['Estado'] == 3){
                                            $activo="<td><a data-tooltip='ORDEN INACTIVA' class='btn-flat tooltipped noHover'><i style='color:red; font-size:30px;' class='material-icons'>info_outline</i></a></td>";
                                            $status="<li><a href='#!' onclick='cambiaStatusRpt(".$list['IdOrden'].",".$list['NoOrden'].", 0)'>Anular</a></li>
                                                        <li><a href='#!' onclick='cambiaStatusRpt(".$list['IdOrden'].",".$list['NoOrden'].", 1)'>Activar</a></li>
                                                        <li><a href='#!' onclick='cambiaStatusRpt(".$list['IdOrden'].",".$list['NoOrden'].", 2)'>Cerrar</a></li>
                                                        <li><a href='#!' onclick='buscarOrdProd(".$list['IdOrden'].")'>Ver</a></li>";
                                        }
                                        echo "<tr>                                                                        
                                                <td>".$list['NoOrden']."</td>
                                                <td>".$list['FechaInicio']."</td>
                                                <td>".$list['FechaFin']."</td>
                                                ".$activo."
                                                <td>
                                                    <a class='dropdown-button btn-floating' id='ddlts' data-activates='dropdown".$list['IdOrden']."' href='#!'><i class='material-icons left'>mode_edit</i></a>
                                                    <ul id='dropdown".$list['IdOrden']."' class='dropdown-content'>
                                                ".$status."
                                                    </ul>
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
</main>
<br>
<!--/////////////////////////////////////////////////////////////////////////////////////////
                                        PANTALLAS MODALES
//////////////////////////////////////////////////////////////////////////////////////////-->
<!-- NUEVA ORDEN PRODUCCION -->
<div id="nuevoReporte" class="modal">
    <div class="modal-content">
        <div class="right row">
            <div class="col s1 m1 l1">
                <a href="#!" class="BtnClose modal-action modal-close noHover">
                    <i class="material-icons">highlight_off</i>
                </a>
            </div>
        </div>        
        <div class="row noMargen center">
            <div class="noMargen col s12 m12 l12">
                <h6 class="center titulos">NUEVA ORDEN DE PRODUCCIÓN</h6>
            </div>
        </div>
        
        <div class="row">
            <form class="col s12" method="POST" name="formNuevoReporte" id="formNuevoReporte" action="<?php echo base_url()?>index.php/ordenProduccionG_Controller/guardarReporte">
                <div class="row">
                    <div class="input-field col s12 m12 s12">
                        <input class="mayuscula" maxlength="4" name="numOrden" placeholder="Nº orden" id="numOrden" type="text" class="required">
                        <label id="lblNumeroOrden" class="labelValidacion">DIGITE EL Nº ORDEN</label>
                    </div>                   
                </div>
                <br>
                <div class="row">
	                <div class="input-field col s12 m6 s6">
	                    <input type="text" id="fechaInicio" name="fechaInicio" class="datepicker">
	                    <label for="fechaInicio">Fecha inicio</label>
	                </div>
                    
	                <div class="input-field col s12 m6 s6">
	                    <input type="text" id="fechaFinal" name="fechaFinal" class="datepicker">
	                    <label for="fechaFinal">Fecha final</label>
	                </div>
                </div>
                <br>
                <div class="row">
                    <div class="input-field col s12 m12 s12">
                      <textarea id="comentario" class="text-area-ord" name="comentario"></textarea>
                      <label for="comentario">Comentarios</label>
                    </div>                  
                </div>
                <br>
                <div class="row">                    
                    <div class="center">
			      	    <a class="Btnadd btn waves-effect waves-light" id="guardaRpt" href="#" hre style="background-color:#831F82;">GUARDAR
                        </a>
			        </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ACTUALIZAR ORDEN PRODUCCION -->
<div id="nuevaOrdenP" class="modal">
    <div class="modal-content">
        <div class="right row">
            <div class="col s1 m1 l1">
                <a href="#!" class="BtnClose modal-action modal-close noHover">
                    <i class="material-icons">highlight_off</i>
                </a>
            </div>
        </div>        
        <div class="row noMargen center">
            <div class="noMargen col s12 m12 l12">
                <h6 class="center titulos" id="title1">EDITANDO ORDEN DE PRODUCCIÓN</h6>
                <h6 class="center" id="title2" type="hide">ORDEN DE PRODUCCIÓN ANULADA</h6>
            </div>
        </div>
        
        <div class="row">
            <form class="col s12" method="POST" name="formActualizarOrd" id="formActualizarOrd" action="<?php echo base_url()?>index.php/ordenProduccionG_Controller/editarOrdProd">
                <div class="input-field col s6">
                    <input value="#" id="identificador" name="identificador" type="hidden" class="validate">
                </div>
                <div class="row">
                    <div class="input-field col s12 m12 s12">
                        <input disabled data-tooltip='Nº ORDEN' class="mayuscula" maxlength="4" name="numOrden1" id="numOrden1" placeholder="Nº orden" type="text" class="required">
                        <label id="lblNumeroOrden" class="labelValidacion">Nº ORDEN</label>
                    </div>                   
                </div>
                <br>
                <div class="row">
                    <div class="input-field col s12 m6 s6">
                        <input type="text" id="fechaInicio1" name="fechaInicio1" class="datepicker">
                        <label for="fechaInicio">Fecha inicio</label>
                    </div>
                    
                    <div class="input-field col s12 m6 s6">
                        <input type="text" id="fechaFinal1" name="fechaFinal1" class="datepicker">
                        <label for="fechaFinal">Fecha final</label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="input-field col s12 m12 s12">
                      <textarea id="comentario1" class="text-area-ord" name="comentario1"></textarea>
                      <label for="comentario">Comentarios</label>
                    </div>                  
                </div>
                <br>
                <div class="row">                    
                    <div class="center">
                        <a class="Btnadd btn waves-effect waves-light" id="actualizarRpt" href="#" style="background-color:#831F82;">ACTUALIZAR
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>