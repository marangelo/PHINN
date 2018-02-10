<main class="mdl-layout__content mdl-color--grey-100">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <center><span class="card-title purple-text accent-4" style="font-family: robotoblack;">ORDEN DE PRODUCCIÓN</span></center>
                    <?php 
                    if ($listaReport) {
                        foreach($listaReport as $key) {
                            echo "
                            <div class='row'>
                                <center>
                                    <div class='col s4'>
                                        <span class='card-title purple-text accent-4' id='lblnoOrden'>".$key["NoOrden"]."</span><br/>
                                        <label class='labelValidacion'>N° ORDEN ACTIVA</label>
                                    </div>
                                    <div class='col s4'>
                                        <span id='lblFechaInicio' class='card-title purple-text accent-4'>".date('d-m-Y', strtotime($key["FechaInicio"]))."</span><br/>
                                        <label  class='labelValidacion'>FECHA DE INICIO</label>
                                        <input type='hidden' id='txtFechaInicio' value='".$key["FechaInicio"]."'>
                                    </div>
                                    <div class='col s4'>
                                        <span id='lblFechaFin' class='card-title purple-text accent-4' id='lblnoOrden'>".date('d-m-Y', strtotime($key["FechaFin"]))."</span><br/>
                                        <label class='labelValidacion'>FECHA FINAL</label>
                                        <input type='hidden' id='txtFechaFinal' value='".$key["FechaFin"]."'>
                                    </div>
                                </center>
                            </div> ";
                        }
                    } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="Buscar row column">               
            <div class="col s1 m1 l1 offset-l3 offset-m2">
                <i style='color:#039be5; font-size:40px;' class="material-icons purple-text accent-4">search</i>
            </div>
            <div class="input-field col s12 m6 l4">
                <input  id="filtrarRpt" type="text" placeholder="Buscar" class="validate">
                <label for="filtrarRpt"></label>
            </div>
        </div>        
    </div>
<?php
//ABRIENDO FUNCIONES PARA SUPERVISOR
if ($this->session->userdata("Privilegio") == 3) {?>
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
                            <a id="OrdeProd" href="#ordenprod" class="Btnadd btn waves-effect waves-light" style="background-color:#831F82; font-size: 12px;">ORDEN TRABAJO
                            </a>
                            <a id="abrirMdlNOrd" href="#ModalNuevaOrdProduccion" class="Btnadd btn waves-effect waves-light" style="background-color:#831F82; font-size: 12px;">ORDEN PROD.
                            </a>  
                        </div>
                    </div>
                    <div class="row"><br>
                        <div class="col s12 m12" style="text-align:right;">
                            <input type="checkbox" id="ordActiva" checked/>
                            <label id="label-ordActiva" for="ordActiva">Activa</label>
                            <input type="checkbox" id="ordInactiva" />
                            <label id="label-ordInactiva" for="ordInactiva">Inactiva</label>
                            <input type="checkbox" id="ordCerrada" />
                            <label id="label-ordCerrada" for="ordCerrada">Cerrada</label>
                            <input type="checkbox" id="ordAnulada" />
                            <label id="label-ordAnulada" for="ordAnulada">Anulada</label>
                        </div>
                    </div><br>
                    <table id="tlbListaRep2" class="striped">
                        <thead>
                            <tr class="tblcabecera">
                                <th>Ordenes</th>
                                <th>Nº orden</th>                                 
                                <th>Inicio</th>
                                <th>culminación</th>
                                <th>Estado</th>
                                <th>OPCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($ordenesTrabajosCom) {
                                    $clase="mostrar";
                                    foreach ($ordenesTrabajosCom as $list) {
                                        if($list['Estado'] == 0){
                                            $activo="<td><a data-tooltip='ORDEN ANULADA' class='btn-flat tooltipped noHover'><i style='color:red; font-size:30px;' class='material-icons'>close</i></a></td>";
                                            $status="<li><a href='#!' onclick='buscarOrdProd(".$list['IdOrden'].")'>Ver</a></li>";
                                            $ocultarOrden="nomostrarOrdenAnul";
                                        }elseif($list['Estado'] == 1){
                                            $activo="<td><a data-tooltip='ORDEN ACTIVA' class='btn-flat tooltipped noHover'><i style='color:green; font-size:30px;' class='material-icons'>done</i></a></td>";
                                            $status="<li><a href='#!' onclick='cambiaStatusRpt(".$list['IdOrden'].",".$list['NoOrden'].", 0)'>Anular</a></li>
                                                     <li><a href='#!' onclick='cambiaStatusRpt(".$list['IdOrden'].",".$list['NoOrden'].", 2)'>Cerrar</a></li>
                                                     <li><a href='#!' onclick='buscarOrdProd(".$list['IdOrden'].")'>Ver</a></li>";
                                            $ocultarOrden="OrdenActiva";
                                        }elseif($list['Estado'] == 2){
                                            $activo="<td><a data-tooltip='ORDEN CERRADA' class='btn-flat tooltipped noHover'><i style='color:#696969; font-size:30px;' class='material-icons'>lock</i></a></td>";
                                            $status="<li><a href='#!' onclick='cambiaStatusRpt(".$list['IdOrden'].",".$list['NoOrden'].", 0)'>Anular</a></li>
                                                        <li><a href='#!' onclick='buscarOrdProd(".$list['IdOrden'].")'>Ver</a></li>";
                                            $ocultarOrden="nomostrarOrdenCerr";
                                        }elseif($list['Estado'] == 3){
                                            $activo="<td><a data-tooltip='ORDEN INACTIVA' class='btn-flat tooltipped noHover'><i style='color:red; font-size:30px;' class='material-icons'>info_outline</i></a></td>";
                                            $status="<li><a href='#!' onclick='cambiaStatusRpt(".$list['IdOrden'].",".$list['NoOrden'].", 0)'>Anular</a></li>
                                                    <li><a href='#!' onclick='cambiaStatusRpt(".$list['IdOrden'].",".$list['NoOrden'].", 1)'>Activar</a></li>
                                                    <li><a href='#!' onclick='cambiaStatusRpt(".$list['IdOrden'].",".$list['NoOrden'].", 2)'>Cerrar</a></li>
                                                    <li><a href='#!' onclick='buscarOrdProd(".$list['IdOrden'].")'>Ver</a></li>";
                                            $ocultarOrden="nomostrarOrdenInac";
                                        }
                                        echo "<tr class='".$ocultarOrden."'>
                                                <td class='center green-text detalleNumOrd'><i id='detail2".$list['NoOrden']."' class='material-icons expand-more'>expand_more</i><i id='detail1".$list['NoOrden']."' style='display:none;' class='material-icons expand-more'>expand_less</i>
                                                    <div id='loader".$list['NoOrden']."' style='display:none;' class='preloader-wrapper small active' >
                                                        <div class='spinner-layer spinner-yellow-only'>
                                                        <div style='overflow: visible!important;' class='circle-clipper left'>
                                                            <div class='circle'></div>
                                                        </div><div class='gap-patch'>
                                                            <div class='circle'></div>
                                                        </div><div style='overflow: visible!important;' class='circle-clipper right'>
                                                            <div class='circle'></div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </td>                                                                        
                                                <td>".$list['NoOrden']."</td>
                                                <td>".date('d-m-Y', strtotime($list['FechaInicio']))."</td>
                                                <td>".date('d-m-Y', strtotime($list['FechaFin']))."</td>
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
                    </table><br><br>
                </div>
            </div>
        </div>
    </div>
</main>
<?php }
//ABRIENDO FUNCION PARA COORDINADORES
else if ($this->session->userdata("Privilegio") == 4) {?>
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <center><h4 class="card-title purple-text accent-4" style="font-family: robotoblack;">ORDENES DE TRABAJOS</h4></center>
                    <table id="TblMaster" class="striped">
                        <thead>
                            <tr class="tblcabecera">
                                <th>N° ORDEN</th>
                                <th>TURNO</th>
                                <th>FECHA INICIO</th>
                                <th>FECHA FIN</th>
                                <th>COORDINADOR</th>
                                <!--<th>GRUPO</th>-->
                                <th>TIPO PAPEL</th>
                            </tr>   
                        </thead>
                        <tbody>
                            <?php
                            if (($lista)) {
                            foreach ($lista as $key) {?>
                            <?php if ($this->session->userdata("IdUser") == $key["Coordinador"]) {?>
                            <tr>
                                <td>
                                    <a href="../index.php/menuOrdenTrabajo/<?php echo $key["IdReporteDiario"]?>"><?php echo $key["Consecutivo"]?></a>
                                </td>
                                <td><?php echo $key["Comentario"]?></td>
                                <td><?php echo date('d-m-Y', strtotime($key["FechaInicio"]))?></td>
                                <td><?php echo date('d-m-Y', strtotime($key["FechaFinal"]))?></td>
                                <td><?php echo $key["Nombre"]?></td>
                                <!--<td><?php //echo $key["Grupo"]?></td>-->
                                <td><?php echo $key["TipoPapel"]?></td>
                            </tr> 
                            <?php }?>
                            <?php } ?>   
                            <?php } ?>              
                        </tbody>
                    </table>  
                </div>
            </div>
        </div>
    </div>
</main>
<?php }else if ($this->session->userdata("Privilegio") == 1) {?>
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="" style="text-align:left;">
                        <div id="retornarP">
                            <a data-tooltip='REGRESAR' href="<?php echo base_url('index.php/dashboard')?>" class="modal-trigger tooltipped">
                                <i class="waves-effect waves-purple material-icons titulosGen">keyboard_backspace</i>
                            </a>
                        </div>  
                    </div>
                    <center><h4 class="card-title purple-text accent-4" style="font-family: robotoblack;">ORDENES DE PRODUCCIÓN</h4><span>Lista de ordenes de produccion y ordenes de trabajo</span>
                    </center>
                    <div class="row"><br>
                        <div class="col s12 m12" style="text-align:right;">
                            <input type="checkbox" id="ordActiva" checked/>
                            <label id="label-ordActiva" for="ordActiva">Activa</label>
                            <input type="checkbox" id="ordInactiva" />
                            <label id="label-ordInactiva" for="ordInactiva">Inactiva</label>
                            <input type="checkbox" id="ordCerrada" />
                            <label id="label-ordCerrada" for="ordCerrada">Cerrada</label>
                            <input type="checkbox" id="ordAnulada" />
                            <label id="label-ordAnulada" for="ordAnulada">Anulada</label>
                        </div>
                    </div><br>
                    <table id="tlbListaRep2" class="striped">
                        <thead>
                            <tr class="tblcabecera">
                                <th>Ordenes</th>
                                <th>Nº orden</th>                                 
                                <th>Inicio</th>
                                <th>culminación</th>
                                <th>Estado</th>
                                <th>OPCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($ordenesTrabajosCom) {
                                    $clase="mostrar";
                                    foreach ($ordenesTrabajosCom as $list) {
                                        if($list['Estado'] == 0){
                                            $activo="<td><a data-tooltip='ORDEN ANULADA' class='btn-flat tooltipped noHover'><i style='color:red; font-size:30px;' class='material-icons'>close</i></a></td>";
                                            $status="<li><a href='#!' onclick='buscarOrdProd(".$list['IdOrden'].")'>Ver</a></li>";
                                            $ocultarOrden="nomostrarOrdenAnul";
                                        }elseif($list['Estado'] == 1){
                                            $activo="<td><a data-tooltip='ORDEN ACTIVA' class='btn-flat tooltipped noHover'><i style='color:green; font-size:30px;' class='material-icons'>done</i></a></td>";
                                            $status="<li><a href='#!' onclick='cambiaStatusRpt(".$list['IdOrden'].",".$list['NoOrden'].", 0)'>Anular</a></li>
                                                     <li><a href='#!' onclick='cambiaStatusRpt(".$list['IdOrden'].",".$list['NoOrden'].", 2)'>Cerrar</a></li>
                                                     <li><a href='#!' onclick='buscarOrdProd(".$list['IdOrden'].")'>Ver</a></li>";
                                            $ocultarOrden="OrdenActiva";
                                        }elseif($list['Estado'] == 2){
                                            $activo="<td><a data-tooltip='ORDEN CERRADA' class='btn-flat tooltipped noHover'><i style='color:#696969; font-size:30px;' class='material-icons'>lock</i></a></td>";
                                            $status="<li><a href='#!' onclick='cambiaStatusRpt(".$list['IdOrden'].",".$list['NoOrden'].", 0)'>Anular</a></li>
                                                        <li><a href='#!' onclick='buscarOrdProd(".$list['IdOrden'].")'>Ver</a></li>";
                                            $ocultarOrden="nomostrarOrdenCerr";
                                        }elseif($list['Estado'] == 3){
                                            $activo="<td><a data-tooltip='ORDEN INACTIVA' class='btn-flat tooltipped noHover'><i style='color:red; font-size:30px;' class='material-icons'>info_outline</i></a></td>";
                                            $status="<li><a href='#!' onclick='cambiaStatusRpt(".$list['IdOrden'].",".$list['NoOrden'].", 0)'>Anular</a></li>
                                                    <li><a href='#!' onclick='cambiaStatusRpt(".$list['IdOrden'].",".$list['NoOrden'].", 1)'>Activar</a></li>
                                                    <li><a href='#!' onclick='cambiaStatusRpt(".$list['IdOrden'].",".$list['NoOrden'].", 2)'>Cerrar</a></li>
                                                    <li><a href='#!' onclick='buscarOrdProd(".$list['IdOrden'].")'>Ver</a></li>";
                                            $ocultarOrden="nomostrarOrdenInac";
                                        }
                                        echo "<tr class='".$ocultarOrden."'>
                                                <td class='center green-text detalleNumOrd'><i id='detail2".$list['NoOrden']."' class='material-icons expand-more'>expand_more</i><i id='detail1".$list['NoOrden']."' style='display:none;' class='material-icons expand-more'>expand_less</i>
                                                    <div id='loader".$list['NoOrden']."' style='display:none;' class='preloader-wrapper small active' >
                                                        <div class='spinner-layer spinner-yellow-only'>
                                                        <div style='overflow: visible!important;' class='circle-clipper left'>
                                                            <div class='circle'></div>
                                                        </div><div class='gap-patch'>
                                                            <div class='circle'></div>
                                                        </div><div style='overflow: visible!important;' class='circle-clipper right'>
                                                            <div class='circle'></div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </td>                                                                        
                                                <td>".$list['NoOrden']."</td>
                                                <td>".date('d-m-Y', strtotime($list['FechaInicio']))."</td>
                                                <td>".date('d-m-Y', strtotime($list['FechaFin']))."</td>
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
                    </table><br><br>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <center><h4 class="card-title purple-text accent-4" style="font-family: robotoblack;">ORDENES DE TRABAJOS</h4><span>Ordenes asignadas a los coordinadores</span>
                    </center>
                    <table id="TblMaster" class="striped">
                        <thead>
                            <tr class="tblcabecera">
                                <th>N° ORDEN</th>
                                <th>TURNO</th>
                                <th>FECHA INICIO</th>
                                <th>FECHA FIN</th>
                                <th>COORDINADOR</th>
                                <th>GRUPO</th>
                                <th>TIPO PAPEL</th>
                            </tr>   
                        </thead>
                        <tbody>
                            <?php
                            if (($lista)) {
                            foreach ($lista as $key) {
                            switch($key["Turno"])
                                {
                                    case 1:
                                    $key["Turno"] = "MATUTINO";
                                    break;
                                    case 2:
                                    $key["Turno"] = "VESPERTINO";
                                    break;
                                }?>
                            <tr>
                                <td>
                                    <a href="../index.php/menuOrdenTrabajo/<?php echo $key["IdReporteDiario"]?>"><?php echo $key["Consecutivo"]?></a>
                                </td>
                                <td><?php echo $key["Turno"]?></td>
                                <td><?php echo date('d-m-Y', strtotime($key["FechaInicio"]))?></td>
                                <td><?php echo date('d-m-Y', strtotime($key["FechaFinal"]))?></td>
                                <td><?php echo $key["Nombre"]?></td>
                                <td><?php echo $key["Grupo"]?></td>
                                <td><?php echo $key["TipoPapel"]?></td>
                            </tr>
                            <?php } ?>   
                            <?php } ?>              
                        </tbody>
                    </table>  
                </div>
            </div>
        </div>
    </div>
</main>
<?php }else if ($this->session->userdata("Privilegio") == 0) {?>
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
                        <div class="row"><br>
                            <div class="col s12 m12" style="text-align:right;">
                                <input type="checkbox" id="ordActiva" checked/>
                                <label id="label-ordActiva" for="ordActiva">Activa</label>
                                <input type="checkbox" id="ordInactiva" />
                                <label id="label-ordInactiva" for="ordInactiva">Inactiva</label>
                                <input type="checkbox" id="ordCerrada" />
                                <label id="label-ordCerrada" for="ordCerrada">Cerrada</label>
                                <input type="checkbox" id="ordAnulada" />
                                <label id="label-ordAnulada" for="ordAnulada">Anulada</label>
                            </div>
                        </div><br>
                        <table id="tlbListaRep2" class="striped">
                            <thead>
                                <tr class="tblcabecera">
                                    <th>Ordenes</th>
                                    <th>Nº orden</th>                                 
                                    <th>Inicio</th>
                                    <th>culminación</th>
                                    <th>Estado</th>
                                    <th>OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if ($ordenesTrabajosCom) {
                                        $clase="mostrar";
                                        foreach ($ordenesTrabajosCom as $list) {
                                            if($list['Estado'] == 0){
                                                $activo="<td><a data-tooltip='ORDEN ANULADA' class='btn-flat tooltipped noHover'><i style='color:red; font-size:30px;' class='material-icons'>close</i></a></td>";
                                                $status="<li><a href='#!' onclick='buscarOrdProd(".$list['IdOrden'].")'>Ver</a></li>";
                                                $ocultarOrden="nomostrarOrdenAnul";
                                            }elseif($list['Estado'] == 1){
                                                $activo="<td><a data-tooltip='ORDEN ACTIVA' class='btn-flat tooltipped noHover'><i style='color:green; font-size:30px;' class='material-icons'>done</i></a></td>";
                                                $status="<li><a href='#!' onclick='cambiaStatusRpt(".$list['IdOrden'].",".$list['NoOrden'].", 0)'>Anular</a></li>
                                                         <li><a href='#!' onclick='cambiaStatusRpt(".$list['IdOrden'].",".$list['NoOrden'].", 2)'>Cerrar</a></li>
                                                         <li><a href='#!' onclick='buscarOrdProd(".$list['IdOrden'].")'>Ver</a></li>";
                                                $ocultarOrden="OrdenActiva";
                                            }elseif($list['Estado'] == 2){
                                                $activo="<td><a data-tooltip='ORDEN CERRADA' class='btn-flat tooltipped noHover'><i style='color:#696969; font-size:30px;' class='material-icons'>lock</i></a></td>";
                                                $status="<li><a href='#!' onclick='cambiaStatusRpt(".$list['IdOrden'].",".$list['NoOrden'].", 0)'>Anular</a></li>
                                                            <li><a href='#!' onclick='buscarOrdProd(".$list['IdOrden'].")'>Ver</a></li>";
                                                $ocultarOrden="nomostrarOrdenCerr";
                                            }elseif($list['Estado'] == 3){
                                                $activo="<td><a data-tooltip='ORDEN INACTIVA' class='btn-flat tooltipped noHover'><i style='color:red; font-size:30px;' class='material-icons'>info_outline</i></a></td>";
                                                $status="<li><a href='#!' onclick='cambiaStatusRpt(".$list['IdOrden'].",".$list['NoOrden'].", 0)'>Anular</a></li>
                                                        <li><a href='#!' onclick='cambiaStatusRpt(".$list['IdOrden'].",".$list['NoOrden'].", 1)'>Activar</a></li>
                                                        <li><a href='#!' onclick='cambiaStatusRpt(".$list['IdOrden'].",".$list['NoOrden'].", 2)'>Cerrar</a></li>
                                                        <li><a href='#!' onclick='buscarOrdProd(".$list['IdOrden'].")'>Ver</a></li>";
                                                $ocultarOrden="nomostrarOrdenInac";
                                            }
                                            echo "<tr class='".$ocultarOrden."'>
                                                    <td class='center green-text detalleNumOrd'><i id='detail2".$list['NoOrden']."' class='material-icons expand-more'>expand_more</i><i id='detail1".$list['NoOrden']."' style='display:none;' class='material-icons expand-more'>expand_less</i>
                                                        <div id='loader".$list['NoOrden']."' style='display:none;' class='preloader-wrapper small active' >
                                                            <div class='spinner-layer spinner-yellow-only'>
                                                            <div style='overflow: visible!important;' class='circle-clipper left'>
                                                                <div class='circle'></div>
                                                            </div><div class='gap-patch'>
                                                                <div class='circle'></div>
                                                            </div><div style='overflow: visible!important;' class='circle-clipper right'>
                                                                <div class='circle'></div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </td>                                                                        
                                                    <td>".$list['NoOrden']."</td>
                                                    <td>".date('d-m-Y', strtotime($list['FechaInicio']))."</td>
                                                    <td>".date('d-m-Y', strtotime($list['FechaFin']))."</td>
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
<?php } ?>
<!--/////////////////////////////////////////////////////////////////////////////////////////
                                        MODALES
//////////////////////////////////////////////////////////////////////////////////////////-->
<!--  -->
<div id="ordenprod" class="modal">
    <div class="modal-content">
        <div class="right row">
            <div class="col s1 m1 l1">
                <a href="#!" class="BtnClose modal-action modal-close noHover">
                    <i class="small mdi-navigation-cancel"></i>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="row noMargen center">
                <div class="noMargen col s12 m12 l12">
                    <h6 class="center titulos">ORDEN DE TRABAJO N°: <span id="spanNoOrdenT"></span></h6>
                    <label>( PROCESO HUMEDO )</label> 
                </div>
            </div>
        </div>
        <div class="row">
            <form action="<?php echo base_url("index.php/GuardaOrden")?>"  method="post" name="formAddUser">
                <div class="row">
                    <?php foreach($listaReport as $key) {?>
                        <input type="hidden" name="noOrden1" value="<?php echo $key["NoOrden"]?>" id="noOrden1">
                    <?php } ?>                   
                    <input type="hidden" name="cons" id="cons">   
                    
                    <div class="input-field col s6 m6 s6">
                        <input type="date" name="Fechainicio" id="Fechainicio" class="datepicker">
                        <label id="lblFechainicio" class="labelValidacion">Fecha de inicio</label>
                    </div>
             
                    <div class="input-field col s6 m6 s6">
                        <input type="date" name="Fechafin" id="Fechafin" class="datepicker">
                        <label id="lblFechafin" class="labelValidacion">Fecha fin</label>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="input-field col s6 m6 s6">
                        <input type="text" name="papel" id="papel">
                        <label id="lblpapel" class="labelValidacion">TIPO PAPEL</label>
                    </div>
                 <?php if ($coordinadores) {?>
                    <div class="input-field col s6 m6 s6">
<!--                    <input type="hidden" name="coordinador" value="<?php echo $this->session->userdata("IdUser")?>">
                        <input type="text" readonly name="" id="coordinador" value="<?php echo $this->session->userdata("Nombre")?>">
                     <label id="lblcoordinador" class="lblValidacion">COORDINADOR</label>  -->                   
                    <select name="coordinador" id="coordinador" class="chosen-select browser-default">
                        <option value="" disabled selected>COORDINADOR</option>
                        <?php
                        if($coordinadores) {
                            foreach($coordinadores as $key){
                                echo '<option value="'.$key['IdUsuario'].'">'.$key['Nombre'].'</option>';
                            }
                        }
                        ?>
                    </select>
                    <label id="lblmaquina" class="lblValidacion">ESCOJA UN COORDINADOR</label>
                    </div>
                    <?php }?>
                </div>
                <br>
                <div class="row">
                    <div class="col s6 m6 s6">
                        <select name="turno" id="turno" class="chosen-select browser-default">
                            <option value="" disabled selected>TURNO</option>
                            <?PHP
                            if(!$turnos){
                            } else {
                                foreach($turnos as $key){
                                    echo '<option value="'.$key['IdTurno'].'">'.$key['Turno'].'';
                                    echo' <span class="badge">('.$key['Comentario'].')</span>';
                                    echo'</option>';
                                }
                            }
                            ?>
                        </select>
                        <label id="lblturno" class="lblValidacion">ELIGE UN TURNO</label>
                    </div>
                </div><br><br>
                <div class="center">
                    <button name="usersubmit" type="submit" class="Btnadd btn waves-effect waves-light" id="AddOrden" style="background-color:#831F82;">GUARDAR
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- NUEVA ORDEN PRODUCCION -->
<div id="ModalNuevaOrdProduccion" class="modal">
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
            <form class="col s12" method="post" name="formNuevaOrden" id="formNuevaOrden" action="<?php echo base_url()?>index.php/ordenProduccionG_Controller/guardarOrdenSupervisor">
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
                        <a class="Btnadd btn waves-effect waves-light" id="nuevaOrdProduccion" href="#!" style="background-color:#831F82;">GUARDAR
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
            <form class="col s12" method="POST" name="formActualizarOrd" id="formActualizarOrd" action="<?php echo base_url()?>index.php/ordenProduccionG_Controller/editarOrdProdSupervisor">
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