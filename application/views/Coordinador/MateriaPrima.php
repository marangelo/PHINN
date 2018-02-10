<!-- modify date 2017-08-31 10:26:26-->
<main class="mdl-layout__content mdl-color--grey-100">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <center><span class="card-title purple-text accent-4" style="font-family: robotoblack;">DETALLE DE ORDEN DE TRABAJO</span></center>
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
                    </div>
                    <center>
                        <h5 class="card-title purple-text accent-4" style="font-family: robotoblack;">MATERIA PRIMA</h5>
                         <h6 class="card-title purple-text accent-4" style="font-family: robotoblack;">Pasta</h6>
                    </center>
                    <div class="row">
                        <div class="col s12 m12">
                            <a class="Btnadd btn waves-effect waves-light" id="agregarMP" href="#nuevaMatPrim" style="background-color:#831F82;">AGREGAR
                                <i class="material-icons right">add</i>
                            </a>
                        </div>
                    </div>
                    <table id="tblpasta" class="striped">
                        <thead>
                            <tr class="tblcabecera">
                                <th>TANQUES</th>
                                <th>DIA</th>
                                <th>NOCHE</th>
                                <th>CONSUMO</th>
                                <th>acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if (!($listamp)) {
                                } else {
                                    foreach ($listamp as $key) {
                                       echo '
                                       <tr>                                  
                                            <td>'.$key['Tanque'].'</td>
                                            <td>'.$key['Dia'].'</td>
                                            <td>'.$key['Noche'].'</td>
                                            <td>'.$key['Consumo'].'</td>
                                            <td>
                                             <a href="javascript:void(0)" onclick="DetallePasta('."'".$key["Tanque"]."','".$key["Dia"]."','".$key["Noche"]."','".$key['Consumo']."'".')" class="modal-trigger"><i class="purple-text darken-1 material-icons">visibility</i></a>
                                            <a href="javascript:void(0)" onclick="Eliminarpasta(this)" id="'.$key['IdPasta'].'">
                                            <i class="purple-text darken-1 material-icons">delete</i></a>
                                            </td>
                                       </tr>';
                                    }
                                }
                                
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <center>
                         <h6 class="card-title purple-text accent-4" style="font-family: robotoblack;">Insumos</h6>
                    </center>
                    <div class="row">
                        <div class="col s12 m12">
                            <a class="Btnadd btn waves-effect waves-light" id="modinsumo" href="#modalInsumo" style="background-color:#831F82;">AGREGAR
                                <i class="material-icons right">add</i>
                            </a>
                        </div>
                    </div>
                    <table id="" class="striped">
                        <thead>
                          <tr class="tblcabecera">
                            <th>Descripcion</th>
                            <th>Dia</th>
                            <th>Noche</th>
                            <th>PTA agua dia</th>
                            <th>pta agua noche</th>
                            <th>ACCIONES</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(!($listaMPInsumos))
                            {}
                            else{
                                foreach ($listaMPInsumos as $key) {
                              echo '
                              <tr>
                                <td>'.$key['Descripcion'].'</td>
                                <td>'.$key['Dia'].'</td>
                                <td>'.$key['Noche'].'</td>
                                <td>'.$key['Cantidad_PTA_Agua_Dia'].'</td>
                                <td>'.$key['Cantidad_PTA_Agua_Noche'].'</td>
                                <td>
                                <a href="javascript:void(0)" onclick="DetalleInsumo('."'".$key["Descripcion"]."','".$key["Dia"]."','".$key["Noche"]."','".$key['Cantidad_PTA_Agua_Dia']."','".$key['Cantidad_PTA_Agua_Noche']."'".')" class="modal-trigger verdet"><i class="purple-text darken-1 material-icons">visibility</i></a>
                                <a href="javascript:void(0)" class="tooltipped" data-tooltip="Eliminar insumo" data-position="left" onclick="EliminarInsumo(this)" id="'.$key['IdMpInsumos'].'"><i class="purple-text darken-1 material-icons">delete</i></a>
                                </td>
                              </tr>';
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

    <!-- MODALES -->

<div id="DetallesPasta" class="modal1">
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
                <h6 class="center" style="font-family:'robotoblack'; color:#831F82;font-size:30px; margin-bottom:30px;">DETALLE PASTA</h6>
            </div>
        </div>

        <div class="row">
            <ul class="collection">
                <li class="collection-item avatar">
                    <i class="material-icons circle purple darken-1">assignment</i>
                    <div class="row">
                        <div class="col s3 m3">
                            <h6 class="purple-text left-align"><b>TANQUES</b></h6>
                            <p class="purple-text" id="lblTanque"></p>
                        </div>
                        <div class="col s3 m3">
                            <h6 class="purple-text"><b>Dia</b></h6>
                            <p class="purple-text" id="lbldia"></p>
                        </div>
                        <div class="col s3 m3">
                            <h6 class="purple-text"><b>Noche</b></h6>
                            <p class="purple-text" id="lblnoche"></p>
                        </div>
                         <div class="col s3 m3">
                            <h6 class="purple-text"><b>Consumo</b></h6>
                            <p class="purple-text" id="lblconsumo"></p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<div id="DetallesIns" class="modal1">
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
                <h6 class="center" style="font-family:'robotoblack'; color:#831F82;font-size:30px; margin-bottom:30px;">DETALLE INSUMO</h6>
            </div>
        </div>

        <div class="row">
            <ul class="collection">
                <li class="collection-item avatar">
                    <i class="material-icons circle purple darken-1">assignment</i>
                    <div class="row">
                        <div class="col s4 m4">
                            <h6 class="purple-text left-align"><b>Descripcion</b></h6>
                            <p class="purple-text" id="lblDescripcion"></p>
                        </div>
                        <div class="col s4 m4">
                            <h6 class="purple-text"><b>Dia</b></h6>
                            <p class="purple-text" id="lblDia"></p>
                        </div>
                        <div class="col s4 m4">
                            <h6 class="purple-text"><b>Noche</b></h6>
                            <p class="purple-text" id="lblNoche"></p>
                        </div>
                    </div>
                </li>
                   <li class="collection-item avatar">
                    <i class="material-icons circle purple darken-1">opacity</i>
                    <div class="row">
                        <div class="col s6 m6">
                            <h6 class="purple-text"><b>PTA Agua Dia</b></h6>
                            <p class="purple-text" id="lblptadia"></p>
                        </div>
                        <div class="col s6 m6">
                            <h6 class="purple-text"><b>PTA Agua Noche</b></h6>
                            <p class="purple-text" id="lblptanoche"></p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<div id="modalInsumo" class="modal1">
      <div class="modal-content">
        <div class="row noMargen center">
            <div class="noMargen col s12 m12 l12">
                <h6 class="center" style="font-family:'robotoblack'; color:#831F82;font-size:30px; margin-bottom:30px;">AGREGAR INSUMO</h6>
            </div>
        </div>

        <div class="row">
            <form class="col s12" method="POST" name="" id="">
                <div class="row">
                                     <?php 
                    if(!($consecutivo)){

                     }
                     else {
                        foreach ($consecutivo as $key) {
                           echo "<input name='idRptd' id='idRptd' type='hidden' value='". $key['IdReporteDiario']."'> ";                         
                           }
                         }
                         ?>
                         <?php foreach ($consecutivo as $key) { ?>
                         <div class="row">
                         <?php if ($key['tipo'] == "M") {?>
                             <div class="input-field col s6 m6 s6">
                                <input id="Dia" class="" name="Dia" type="text">
                                <label for="Dia">DIA</label>
                            </div>
                         <?php } elseif ($key['tipo'] == "N") {?>
                            <div class="input-field col s6 m6 s6">
                                <input id="Noche" class="" name="Noche" type="text">
                                <label for="Noche">NOCHE</label>
                            </div>
                         <?php } elseif($key["tipo"] == "MX") {?>
                            <div class="input-field col s6 m6 s6">
                                <input id="Dia1" class="" name="Dia1" type="text">
                                <label for="Dia1">DIA</label>
                            </div>
                            <div class="input-field col s6 m6 s6">
                                <input id="Noche1" class="" name="Noche1" type="text">
                                <label for="Noche1">NOCHE</label>
                            </div>
                         <?php }?>
                         <?php } ?>
                         <?php foreach ($consecutivo as $key) { ?>
                         <?php if ($key['tipo'] == "M") {?>
                             <div class="input-field col s6 m6 s6">
                                <input id="ptadia" class="" name="ptadia" type="text">
                                <label for="ptadia">PTA AGUA DIA</label>
                            </div>
                         <?php } elseif ($key['tipo'] == "N") {?>
                            <div class="input-field col s6 m6 s6">
                                <input id="ptanoche" class="" name="ptanoche" type="text">
                                <label for="ptanoche">PTA AGUA NOCHE</label>
                            </div>
                         <?php } elseif ($key["tipo"] == "MX") {?>
                            <div class="input-field col s6 m6 s6">
                                <input type="text" id="ptadia1" name="ptadia1">
                                <label for="ptadia1">PTA AGUA DIA</label>
                            </div>
                            <div class="input-field col s6 m6 s6">
                                <input id="ptanoche1" class="" name="ptanoche1" type="text">
                                <label for="ptanoche1">PTA AGUA NOCHE</label>
                            </div>
                         <?php }?>
                        </div>
                         <?php } ?>
                </div>
                <br>
                <div class="row">
                    <div class="input-field col s12 m12 s12">
                        <select class="chosen-select browser-default" name="descripcion" id="descripcion">
                          <option selected disabled>Descripcion</option>                        
                            <?php
                            if (!($listaInsumos)) {
                            } else {
                                foreach ($listaInsumos as $key) {                                                 
                                echo'
                                 <option value="'.$key['IdInsumo'].'">'.$key['Descripcion'].'</option>
                                ';
                                }
                            }
                            ?>
                        </select>
                        <label id="lbldescripcion" class="lblValidacion">ELIGE UNA DESCRIPCION</label>
                    </div>
                </div>
                <br>
                <?php
                    foreach ($consecutivo as $key) {$modalHTML="'modalInsumo'";
                       if ($key['Estado'] == 0) {
                           echo '               
                 <div class="row">
                    <div class="center">
                        <a class="Btnadd btn waves-effect waves-light disabled" href="#" style="background-color:#831F82;">GUARDAR
                        </a>
                        <a class="Btnadd btn waves-effect waves-light" onclick="cerrarModales('.$modalHTML.',false)" href="#!" style="background-color:#831F82;">cerrar
                        </a> 
                        <span class="badge red-text darken-4"><b>El Consecutivo ya ha sido cerrado</b></span>
                    </div>
                </div>';
                       } else {
                           echo '
                <div class="row">
                    <div class="center">
                        <a id="btninsumo" class="Btnadd btn waves-effect waves-light" onclick="guardaInsumos()" href="#" style="background-color:#831F82;">GUARDAR
                        </a>
                        <a class="Btnadd btn waves-effect waves-light" onclick="cerrarModales('.$modalHTML.',true)" href="#!" style="background-color:#831F82;">cerrar
                        </a>
                    </div>
                </div>
                           ';
                       }
                       
                    }
                ?>
            </form>
        </div>
    </div>
</div>

    <div id="nuevaMatPrim" class="modal1">
    <div class="modal-content">
        <div class="row noMargen center">
            <div class="noMargen col s12 m12 l12">
                <h6 class="center" style="font-family:'robotoblack'; color:#831F82;font-size:30px; margin-bottom:30px;">AGREGAR PASTA</h6>
            </div>
        </div>

        <div class="row">
            <form class="col s12" method="POST" name="formAgregarMatPrim" id="formAgregarMatPrim">
                    <?php 
                    if(!($consecutivo)){

                     }
                     else {
                        foreach ($consecutivo as $key) {
                           echo "<input name='idRptD' id='idRptD' type='hidden' value='". $key['IdReporteDiario']."'> ";                         
                           }
                         }
                         ?>
                         <?php foreach ($consecutivo as $key) { ?>
                         <div class="row">
                         <?php if ($key['tipo'] == "M") {?>  <!-- fragmento para el turno matutino -->
                             <div class="input-field col s6 m6 s6">
                                <input id="dia" class="" name="dia" type="text">
                                <label for="dia">DIA</label>
                            </div>
                         <?php } elseif ($key['tipo'] == "N") {?>  <!-- fragmento para el turno nocturno -->
                            <div class="input-field col s6 m6 s6">
                                <input id="noche" class="" name="noche" type="text">
                                <label for="noche">NOCHE</label>
                            </div>
                         <?php } elseif($key["tipo"] == "MX"){ ?>  <!-- fragmento para el turno mixto -->
                            <div class="input-field col s6 m6 s6">
                                <input type="text" id="dia1" class="" name="dia1">
                                <label for="dia1">DIA</label>
                            </div>
                            <div class="input-field col s6 m6 s6">
                                <input id="noche1" class="" name="noche1" type="text">
                                <label for="noche1">NOCHE</label>
                            </div>
                         <?php }?>
                         <?php } ?>
                    <div class="input-field col s6 m6 s6">
                        <select name="Tanque" id="Tanque" class="chosen-select browser-default">
                            <option disabled selected>TANQUES</option>
                            <?php
                            if(!($listaTanques))
                            {}else{
                                foreach ($listaTanques as $key) {
                                    echo'
                                    <option value="'.$key['IdInsumo'].'">'.$key['Tanque'].'</option>
                                    ';
                                  }
                                }                            
                            ?>
                        </select>
                         <label id="lbltanque" class="lblValidacion">ELIGE UN TANQUE</label>
                    </div>
                    <div class="input-field col s6 m6 s6">
                        <input type="hidden" value="0" name="consumo" id="consumo">
                    </div>
                </div>
               <br>
               <?php
                foreach ($consecutivo as $key) { $modalHTML="'nuevaMatPrim'";
                    if($key['Estado'] == 0)
                    {
                        echo'               
                <div class="row">
                    <div class="center">
                        <a class="Btnadd btn waves-effect waves-light disabled" href="#" style="background-color:#831F82;">GUARDAR
                        </a>
                        <a class="Btnadd btn waves-effect waves-light" onclick="cerrarModales('.$modalHTML.',false)" href="#!" style="background-color:#831F82;">cerrar
                        </a>
                         <span class="badge red-text darken-4"><b>El Consecutivo ya ha sido cerrado</b></span>
                    </div>
                </div>';
                    }
                    else{
                        echo '
                 <div class="row">
                    <div class="center">
                        <a id="matprim" class="Btnadd btn waves-effect waves-light" onclick="Guardarmp()" href="#" style="background-color:#831F82;">GUARDAR
                        </a>
                        <a class="Btnadd btn waves-effect waves-light" onclick="cerrarModales('.$modalHTML.',true)" href="#!" style="background-color:#831F82;">cerrar
                        </a>
                    </div>
                </div>
                        ';
                    }
                }
               ?>
            </form>
        </div>
    </div>
</div>
