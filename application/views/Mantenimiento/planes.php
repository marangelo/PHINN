<main class="mdl-layout__content mdl-color--grey-100">
    <div class="contenedor">
        <div class="container"><br>
            <div class="Buscar row column noMargen">
                <div class="col s1 m1 l1 offset-l3 offset-m2">
                    <i class="material-icons iconSearch">search</i>
                </div>
                <div class="input-field col s12 m6 l4">
                    <input id="BuscarPlan" type="text" placeholder="Buscar" class="validate">
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
                                <a data-tooltip='CREAR PLAN' data-position="left" id="AddPlan" href="#PlanModal" class="purple-text darken-1 modal-trigger tooltipped">
                                    <i class="waves-effect waves-purple material-icons titulosGen">queue</i>
                                </a>       
                            </div>       
                        </div><br>
                        <center>
                            <h5 class="card-title purple-text accent-4" style="font-family: robotoblack;">PLAN</h5>
                        </center>
                        <table id="tblPlan" class="striped">
                            <thead>
                                <tr class="tblcabecera">
                                    <th>PLAN</th>
                                    <th>FECHA</th>
                                    <th>COMENTARIO</th>
                                    <th>ESTADO</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if(!($lista))
                                {}else{
                                    foreach ($lista as $key) {
                                            echo'
                                            <tr>
                                              <td><a href="'.base_url('index.php/AgregaDetalle/'.$key['IdPlan'].'').'">
                                              <i data-tooltip="anexar informacion" class="tooltipped tyni material-icons">add</i></a></td>
                                              <td>'.$key['Fecha'].'</td>
                                              <td>'.$key['Comentario'].'</td>';
                                              if($key['Estado']==1){
                                                 echo '<td>
                                                 <i style="color:#228b22;" data-position="left" data-tooltip="ACTIVO" class="material-icons tooltipped">lock_open</i>
                                                 </td>                                    
                                            ';
                                              }
                                                 else if($key['Estado']==0){
                                                 echo '<td>
                                                 <i style="color:#696969;" data-position="left" data-tooltip="INACTIVO" class="material-icons tooltipped">lock</i>
                                                 </td>                                         
                                            ';
                                              }
                                                  if($key['Estado']==1){
                                                 echo "<td>
                                                <a onclick='EditarPlan(".'"'.$key['IdPlan'].'","'.$key['Fecha'].'","'.$key['Comentario'].'"'.")' class='tooltipped modal-trigger' data-tooltip='EDITAR PLAN' data-position='left' href='javascript:void(0)'><i class='material-icons purple-text darken-4'>edit</i></a>
                                                </td>                             
                                            ";
                                              }
                                                 else if($key['Estado']==0){
                                                 echo '
                                               <td>
                                               <a style="pointer-events: none;" href="#"><i class="material-icons grey-text darken-4">edit</i></a>
                                               </td>  
                                                                                    
                                            ';
                                              }
                                              echo' </tr>';
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
</main>



<div id="PlanModal" class="modal1" style="height:400px;">
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
                <h6 class="center" style="font-family:'robotoblack'; color:#831F82;font-size:30px; margin-bottom:30px;">AGREGAR PLAN</h6>
            </div>
        </div>
        <div class="row">
            <form action="" method="post">
                <div class="row">
                    <div class="input-field col s6 m6 s6" style="margin-top:85px;">
                        <input type="date" name="fecha" class="datepicker" id="fecha" value="">
                        <label id="lblfecha">FECHA</label>
                    </div>
                    <div class="input-field col s6 m6 s6">
                        <textarea rows="" class="materialize-textarea" name="comentario" id="comentario" cols=""></textarea>
                        <label id="lblcomentario">COMENTARIO</label>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="center">
                        <a href="#" id="guardarPL" class="btn waves-effect waves-light" onclick="guardaplan()">GUARDAR</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<div id="ModalPlanEdit" class="modal1" style="height:320px;">
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
                <h6 class="center" style="font-family:'robotoblack'; color:#831F82;font-size:30px; margin-bottom:30px;">EDITAR PLAN</h6>
            </div>
        </div>
        <div class="row">
            <form action="" method="post">
                <div class="row">
                    <div class="input-field col s6 m6 s6">
                        <input type="hidden" name="IdPlan" id="IdPlan" value="">
                        <input type="date" name="Fecha" class="datepicker" id="Fecha" value="">
                        <label id="lblFecha">FECHA</label>
                    </div>
                    <div class="input-field col s6 m6 s6">
                        <input type="text" name="Comentario" id="Comentario" value="">
                        <label id="lblComentario">COMENTARIO</label>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="center">
                        <a href="#" id="actPlanes" onclick="actualizaPlan()" class="btn waves-effect waves-light">ACTUALIZAR</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>