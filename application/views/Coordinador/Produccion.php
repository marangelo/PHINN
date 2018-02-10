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
                        <h5 class="card-title purple-text accent-4" style="font-family: robotoblack;">PRODUCCION</h5>
                    </center>
                    <div class="row"><br>
                        <div class="col s12 m12" style="text-align:right;">
                            <input type="checkbox" id="maquina1"/>
                            <label id="label-maquina1" for="maquina1">Maquina 1</label>
                            <input type="checkbox" id="maquina2" />
                            <label id="label-maquina2" for="maquina2">Maquina 2</label>
                        </div>
                    </div> 
                    <table id="tablaProd" class="striped">
                        <thead>
                            <tr class="tblcabecera">
                                <th>Operador</th>
                                <th>Maquina</th>
                                <th>Hora Inicio</th>
                                <th>Hora Fin</th>
                                <th>VelocMaquina <br>(m/mit)</th>
                                <th>Peso (KG)</th>
                                <th>Diametro</th>
                                <th>Peso Base</th>
                                <th>Operaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                        $total =0;
                                        $total1 = 0;
                                            if(!($produccion)){									
                                            }else{
                                                foreach ($produccion as $key) {                         

                                                    if($key['Maquina']=='Maquina 1'){
                                                        $total1 +=$key['Peso'];
                                                        $class="mostrarMaquina1";
                                                    }
                                                    else if($key['Maquina']=='Maquina 2')
                                                    {
                                                            $total +=$key['Peso'];
                                                            $class="mostrarMaquina2";
                                                    }else {
                                                        $class="none";
                                                    }
                                                    echo "
                                                        <tr class='".$class."'>
                                                            <td>".$key['Nombre']."</td>
                                                            <td>".$key['Maquina']."</td>
                                                            <td>".$key['HoraInicio']."</td>
                                                            <td>".$key['HoraFin']."</td>
                                                            <td>".$key['VelocMaquina']."</td>
                                                            <td class='sumar'>".$key['Peso']."</td>
                                                            <td>".$key['Diametro']."</td>
                                                            <td>".$key['PesoBase']."</td>
                                                            <td>
                                                            <a id='href' href='#Detalles'
                                                             onclick='EditarProd(".'"'.$key['Nombre'].'","'.$key['Maquina'].'","'.$key['HoraInicio'].'","'.$key['HoraFin'].'","'.$key['VelocMaquina'].'","'.$key['Peso'].'","'.$key['Diametro'].'","'.$key['PesoBase'].'"'.")' 
                                                             class='modal-trigger tooltipped modaldet' data-tooltip='Ver detalles'>
                                                            <i class='material-icons' style='color:#8e24aa ;'>remove_red_eye</i></a>
                                                            <a href='javascript:void(0)' onclick='EliminarProd(this)' id='".$key['IdProduccion']."' class='tooltipped' data-tooltip='Eliminar'><i class='material-icons ' style='color:#8e24aa;'>delete</i></a></td>
                                                        </tr>
                                                    ";
                                                }
                                            }
                                        ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <ul class="collection left-align" style="border:1px solid white;">
                            <li class="collection-item avatar">
                                <div class="row">
                                    <div class="col s4 m4 s4">
                                        <div class="card hoverable">
                                            <h6 class="center-align"><b class="purple-text darken-1 ">Maquina N°1</b></h6>
                                             <h6 class="purple-text darken-1 center-align">Producción (Kg)</h6>
                                             <div class="container">
                                             <h6 class="center-align"><b><?php echo number_format($total1,1)?></b></h6>
                                              <h6 class="center-align purple-text darken-1">MERMA (kg)</h6>
                                             <?php                                             
                                                     $maq1 = 0;
                                                     if(!($produccion2))
                                                     {
                                                          echo '<h6 class="center-align"><b>'.number_format($maq1,1).'</b></h6>';
                                                     }
                                                     else{
                                                foreach($produccion2 as $key)
                                                        {
                                                            if($key['Maquina']=='1')
                                                            {
                                                                $maq1 = $key['Merma'];
                                                                echo '<h6 class="center-align"><b>'.number_format($maq1,1).'</b></h6>';
                                                            }
                                                        }    
                                                   }         
                                             ?>
                                             </div>
                                        </div>
                                    </div>
                                    <div class="col s4 m4 s4">
                                        <div class="card hoverable">
                                            <h6 class="center-align"><b class="purple-text darken-1">Maquina N°2</b></h6>
                                             <h6 class="purple-text darken-1 center-align">Producción (Kg)</h6>
                                             <div class="container">
                                             <h6 class="center-align"><b><?php echo number_format($total,1)?></b></h6>
                                              <h6 class="center-align purple-text darken-1">MERMA (kg)</h6>
                                                <?php  
                                                $maq2 = 0;
                                                if(!($produccion3)){
                                                     echo '<h6 class="center-align"><b>'. number_format($maq2,1).'</b></h6>';
                                                }
                                                else{
                                                foreach($produccion3 as $key)
                                                    {
                                                        if($key['Maquina']=='2')
                                                        {                                         
                                                            $maq2 = $key['Merma'];
                                                            echo '<h6 class="center-align"><b>'. number_format($maq2,1).'</b></h6>';
                                                        }
                                                    }
                                                }
                                             ?>
                                             </div>
                                        </div>
                                    </div>
                                    <div class="col s4 m4 s4">
                                        <div class="card hoverable">
                                            <h6 class="center-align"><b class="purple-text darken-1">Producción Neta</b></h6>
                                                 <h6 class="purple-text darken-1 center-align">Producción Total (Kg)</h6>
                                                  <div class="container">
                                                  <h6 id="Total" class="center-align"><b><?php echo number_format($total1 + $total,1)?></b></h6>
                                                   <h6 class="center-align purple-text darken-1">MERMA TOTAL (kg)</h6>
                                                  <?php 
                                                     $sum = 0;
                                                     $sum = $maq1 += $maq2;
                                                        echo '<h6 class="center-align"><b>'. number_format($sum,1).'</b></h6>';
                                                  ?>
                                                  </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                     <div class="fixed-action-btn ">
                        <a class="btn-floating btn-large amber darken-4">
                        <i class="material-icons">menu</i>
                        </a>
                        <ul>
                        <li><a id="actualizarM" data-tooltip='EDITAR MERMA' data-position="left" href="#Actualizar" class="modal-trigger tooltipped btn-floating waves-effect waves-light purple darken-4"><i class="material-icons">edit</i></a></li>
                         <a  id="agregarP" data-tooltip='AGREGAR PRODUCCION' data-position="left" href="#nuevaProduccion" class="modal-trigger tooltipped btn-floating waves-effect waves-light purple darken-2"><i class="material-icons">add</i></a>
                        </ul>
                    </div>
                    <div  class="fixed-action-btn">
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!--MODALES -->
<div id="nuevaProduccion" class="modal1" style="height:600px;">
    <div class="modal-content">
        <div class="row noMargen center">
            <div class="noMargen col s12 m12 l12">
                <h6 class="center" style="font-family:'robotoblack'; color:#831F82;font-size:30px; margin-bottom:30px;">AGREGAR PRODUCCION</h6>
            </div>
        </div>

        <div class="row">
            <form class="col s12" method="POST" name="formAgregarProd" id="formAgregarProd">
                <?php 
                    if(!($consecutivo)){                                   
                    } else {
                        foreach ($consecutivo as $key) {
                            echo "<input name='idRptD' id='idRptD' type='hidden' value='".$key['IdReporteDiario']."' >";
                             echo "<input name='NoOrden' id='NoOrden' type='hidden' value='".$key['Consecutivo']."' >";
                            }
                        }
                ?>
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
                    <div class="input-field col s6 m6 s6">
                        <select name="operador" id="operador" class="chosen-select browser-default">
                            <option value="" disabled selected>Operador</option>
                            <?PHP
                            if(!$Operador){
                            } else {
                                foreach($Operador as $key){
                                    echo '<option value="'.$key['IdUsuario'].'">'.$key['Nombre'].'</option>';
                                }
                            }
                            ?>
                        </select>
                        <label id="lblmaquina" class="lblValidacion">ELIGE UN OPERADOR</label>
                    </div>
                    <div class="input-field col s6 m6 s6">
                        <select name="maquina" id="maquina" class="chosen-select browser-default">
                            <option value="" disabled selected>MAQUINA</option>
                            <?PHP
                            if(!$listaMaq){
                            } else {
                                foreach($listaMaq as $key){
                                    echo '<option value="'.$key['idMaquina'].'">'.$key['maquina'].'</option>';
                                }
                            }
                            ?>
                        </select>
                        <label id="lblmaquina" class="lblValidacion">ELIGE UNA MAQUINA</label>
                    </div>
                </div><br>
                <div class="row">
                    <div class="input-field col s6 m6 s6">
                        <input type="text" class="center-align" name="Velocidad" id="Velocidad" value="0">
                        <label for="Velocidad">VELOCIDAD MAQUINA</label>
                    </div>
                    <div class="input-field col s6 m6 s6">
                        <input type="text" name="peso" id="peso">
                        <label for="peso">PESO (KG)</label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="input-field col s6 m6 s6">
                        <input type="text" name="Diametro" id="Diametro">
                        <label for="Diametro">DIAMETRO</label>
                    </div>
                    <div class="input-field col s6 m6 s6">
                        <input type="text" name="pesobase" id="pesobase">
                        <label for="peso">PESO BASE</label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="input-field col s6 m6 s6">
                        <input type="text" name="merma" id="merma">
                        <label for="merma">MERMA</label>
                    </div>
                </div>
                <?php foreach ($consecutivo as $key) { $modalHTML="'nuevaProduccion'";
                    if($key['Estado']== 0)
                    {
                        echo '        
                 <div class="row">
                    <div class="center">
                        <a class="Btnadd btn waves-effect waves-light disabled" href="#" style="background-color:#831F82;">GUARDAR
                        </a>
                        <a class="Btnadd btn waves-effect waves-light" onclick="cerrarModales('.$modalHTML.',false)" href="#!" style="background-color:#831F82;">cerrar
                        </a>
                        <span class="badge red-text accent-4"><b>El Consecutivo ya ha sido cerrado</b></span>
                    </div>
                </div>';
                    }
                    else{
                        echo '                
                <div class="row">
                    <div class="center">
                        <a id="Prod" class="Btnadd btn waves-effect waves-light" onclick="Guardar()" href="#" style="background-color:#831F82;">GUARDAR
                        </a>
                        <a class="Btnadd btn waves-effect waves-light" onclick="cerrarModales('.$modalHTML.',true)" href="#!" style="background-color:#831F82;">cerrar
                        </a>
                    </div>
                </div>';
                    }
                 }?>
            </form>
        </div>
    </div>
</div>


<div id="Actualizar" class="modal1" style="height:350px;">
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
                <h6 class="center" style="font-family:'robotoblack'; color:#831F82;font-size:30px; margin-bottom:30px;">ACTUALIZAR MERMA</h6>
            </div>
        </div>

        <div class="row">
            <form class="col s12" method="POST" name="formAgregarProd" id="formAgregarProd">
                <?php 
                    if(!($consecutivo)){                                   
                    } else {
                        foreach ($consecutivo as $key) {
                            echo "<input name='idRptD' id='idRptD' type='hidden' value='".$key['IdReporteDiario']."' >";
                            }
                        }
                ?>
                <br>
                <div class="row">
                    <div class="input-field col s6 m6 s6">
                        <select name="Maquina" id="Maquina" class="chosen-select browser-default">
                            <option value="" disabled selected>MAQUINA</option>
                            <?PHP
                            if(!$listaMaq){
                            } else {
                                foreach($listaMaq as $key){
                                    echo '<option value="'.$key['idMaquina'].'">'.$key['maquina'].'</option>';
                                }
                            }
                            ?>
                        </select>
                        <label id="lblmaquina" class="lblValidacion">ELIGE UNA MAQUINA</label>
                    </div>
                    <div class="input-field col s6 m6 s6">
                        <input type="text" name="Merma" id="Merma">
                        <label for="Merma">MERMA</label>
                    </div>
                </div>
                <br><br>
                <?php foreach ($consecutivo as $key) {
                    if($key['Estado']== 0)
                    {
                        echo '        
                 <div class="row">
                    <div class="center">
                        <a class="Btnadd btn waves-effect waves-light disabled" href="#" style="background-color:#831F82;">ACTUALIZAR
                        </a>
                        <span class="badge red-text accent-4">El Consecutivo ya ha sido cerrado</span>
                    </div>
                </div>';
                    }
                    else{
                        echo '                
                <div class="row">
                    <div class="center">
                        <a id="ActProd" class="Btnadd btn waves-effect waves-light" href="#" onclick="Actualizamerm(this)" style="background-color:#831F82;">ACTUALIZAR
                        </a>
                    </div>
                </div>';
                    }
                 }?>
            </form>
        </div>
    </div>
</div>



<div id="Detalles" class="modal1">
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
                <h6 class="center" style="font-family:'robotoblack'; color:#831F82;font-size:30px; margin-bottom:30px;">DETALLE PRODUCCION</h6>
            </div>
        </div>

        <div class="row">
            <ul class="collection">
                <li class="collection-item avatar">
                    <i class="material-icons circle purple darken-1">touch_app</i>
                    <div class="row">
                        <div class="col s4 m4">
                            <h6 class="purple-text left-align"><b>Operador</b></h6>
                            <p class="purple-text left-align" id="lbloperador"></p>
                        </div>
                        <div class="col s4 m4">
                            <h6 class="purple-text left-align"><b>Maquina</b></h6>
                            <p class="purple-text left-align" id="lblmaq"></p>
                        </div>
                    </div>
                </li>

                <li class="collection-item avatar">
                    <i class="material-icons circle purple darken-1">alarm</i>
                    <div class="row">
                        <div class="col s4 m4">
                            <h6 class="purple-text left-align"><b>Hora Inicio</b></h6>
                            <p class="purple-text left-align" id="lblhorain"></p>
                        </div>
                        <div class="col s4 m4">
                            <h6 class="purple-text left-align"><b>Hora Fin</b></h6>
                            <p class="purple-text left-align" id="lblhorafin"></p>
                        </div>
                    </div>
                </li>

                <li class="collection-item avatar">
                    <i class="material-icons circle purple darken-1">assignment</i>
                    <div class="row">
                        <div class="col s3 m3">
                            <h6 class="purple-text left-align"><b>Velocidad Maquina</b></h6>
                            <p class="purple-text" id="lblvelocidad"></p>
                        </div>
                        <div class="col s3 m3">
                            <h6 class="purple-text"><b>Peso</b></h6>
                            <p class="purple-text" id="lblpeso"></p>
                        </div>
                        <div class="col s3 m3">
                            <h6 class="purple-text"><b>Diametro</b></h6>
                            <p class="purple-text" id="lbldiametro"></p>
                        </div>
                        <div class="col s3 m3">
                            <h6 class="purple-text"><b>Peso Base</b></h6>
                            <p class="purple-text" id="lblpesobase"></p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>