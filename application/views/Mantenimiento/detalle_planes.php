<main class="mdl-layout__content mdl-color--grey-100">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <center><span class="card-title purple-text accent-4" style="font-family: robotoblack;">DETALLE DE PLAN DE TRABAJO</span></center>
                    <div class="row">
                        <center>
                            <?php 
                                    if(!($planes)){                                   
                                        } else {
                                            foreach ($planes as $key) {
                                                switch ($key['Estado']) {
                                                    case 1:
                                                        $key['Estado'] = "ACTIVO";
                                                        break;
                                                        case 0:
                                                            $key['Estado'] = "INACTIVO";
                                                        break;
                                                }
                                                echo "
                                            <div class='col s4'>
                                                <span class='card-title purple-text darken-4' id='ordP'>".$key['IdPlan']."</span><br/>
                                                <label class='labelValidacion'>ID PLAN</label>
                                            </div>
                                            <div class='col s4'>
                                                <span class='card-title purple-text darken-4' id='ordC'>".$key['Fecha']."</span><br/>
                                                <label class='labelValidacion'>FECHA</label>
                                            </div>";
                                            if($key['Estado']== "ACTIVO")
                                            {
                                                echo "
                                            <div class='col s4'>
                                                <span class='card-title purple-text darken-4' id='ordT'>".$key['Estado']."</span> <i class='material-icons green-text'>lock_open</i><br/>
                                                <label class='labelValidacion'>ESTADO</label>
                                            </div>";
                                            }
                                            else{
                                                echo"
                                            <div class='col s4'>
                                                <span class='card-title purple-text darken-4' id='ordT'>".$key['Estado']."</span> <i class='material-icons'>lock</i><br/>
                                                <label class='labelValidacion'>ESTADO</label>
                                            </div>";
                                            }
                                          }
                                        }
                                ?>
                        </center>
                    </div>
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
                <input  id="filTablePlanDetalle" type="text" placeholder="Buscar" class="validate">
                <label for="filTablePlanDetalle"></label>
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
                                <a data-tooltip='REGRESAR' href="<?php echo base_url('index.php/Planes')?>" data-position="right" class="modal-trigger tooltipped">
                                    <i class="waves-effect waves-purple material-icons titulosGen">keyboard_backspace</i>
                                </a>
                            </div>  
                        </div>    
                    </div>
                    <center><span class="card-title purple-text accent-4" style="font-family: robotoblack;">LISTA PLAN DE TRABAJO</span></center>
                    <table id="tblDetPlan" class="striped">
                        <thead>
                            <tr class="tblcabecera">
                                <th>IDPlan</th>
                                <th>COMENTARIO</th>
                                <th>CATEGORIA</th>
                                <th>DESCRIPCION</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                  if(!($cat1)){}
                                  else{
                                       foreach($cat1 as $key)
                                       {
                                            echo'
                                                <tr>
                                                    <td>'.$key['IdPlan'].'</td>
                                                    <td>'.$key['Comentario'].'</td>
                                                    <td>'.$key['categoria'].'</td>
                                                    <td>'.$key['Descripcion'].'</td>
                                                    <td><a onclick="EliminaDetPlan(this, '."'".$key['Descripcion']."'".', '.$key['IdPlan'].')" href="javascript:void(0)" id="'.$key['IdDetallePlan'].'"><i class="material-icons purple-text">delete</i></a></td>
                                                    </tr>
                                            ';
                                       } 
                                  }
                                     if(!($cat2))
                                  {}
                                  else{
                                      foreach($cat2 as $key)
                                       {
                                            echo'<tr>
                                                    <td>'.$key['IdPlan'].'</td>
                                                    <td>'.$key['Comentario'].'</td>
                                                    <td>'.$key['categoria'].'</td>
                                                    <td>'.$key['Descripcion'].'</td>
                                                    <td><a onclick="EliminaDetPlan(this, '."'".$key['Descripcion']."'".', '.$key['IdPlan'].')" href="javascript:void(0)" id="'.$key['IdDetallePlan'].'"><i class="material-icons purple-text">delete</i></a></td>
                                            </tr>
                                            ';
                                       } 
                                  }
                                      if(!($cat3))
                                  {}
                                  else{
                                      foreach($cat3 as $key)
                                       {
                                            echo'<tr>
                                                    <td>'.$key['IdPlan'].'</td>
                                                    <td>'.$key['Comentario'].'</td>
                                                    <td>'.$key['categoria'].'</td>
                                                    <td>'.$key['Descripcion'].'</td>
                                                    <td><a onclick="EliminaDetPlan(this, '."'".$key['Descripcion']."'".', '.$key['IdPlan'].')" href="javascript:void(0)" id="'.$key['IdDetallePlan'].'"><i class="material-icons purple-text">delete</i></a></td>
                                            </tr>
                                            ';
                                       } 
                                  }
                                  if(!($cat4))
                                  {}
                                  else{
                                      foreach($cat4 as $key)
                                       {
                                            echo'<tr>
                                                    <td>'.$key['IdPlan'].'</td>
                                                    <td>'.$key['Comentario'].'</td>
                                                    <td>'.$key['categoria'].'</td>
                                                    <td>'.$key['Tanque'].'</td>
                                                    <td><a onclick="EliminaDetPlan(this, '."'".$key['Tanque']."'".', '.$key['IdPlan'].')" href="javascript:void(0)" id="'.$key['IdDetallePlan'].'"><i class="material-icons purple-text">delete</i></a></td>
                                            </tr>
                                            ';
                                       } 
                                  }
                               ?>
                        </tbody>
                    </table>

                    <div class="fixed-action-btn">
                        <a id="btnAddDetPlan" class="tooltipped btn-floating btn-large amber darken-4" data-position="left" data-tooltip="AGREGAR DETALLE">
                        <i class="large material-icons">add</i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<div id="DetPlanModal" class="modal1" style="height:90%; width:90%;">
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
                <h6 class="center" style="font-family:'robotoblack'; color:#831F82;font-size:30px; margin-bottom:30px;">AGREGAR DETALLE PLAN</h6>
            </div>
        </div>
        <div class="row">
            <form action="" method="post">
                <?php
                 if(!($planes)){                                   
                 } else {
                     foreach ($planes as $key) {
                         echo '<input type="hidden" id="idplan" value="'.$key['IdPlan'].'">';
                     }
                 }
            ?>
                    <div class="row">
                        <div class="input-field col s6 m6 s6">
                            <select name="categorias" id="categorias" class="chosen-select browser-default">
                        <option disabled selected>CATEGORIA</option>
                        <?php
                            if(!($categorias)){}
                            else{
                                foreach ($categorias as $key) {
                                    echo '<option value="'.$key['IdCategoria'].'">'.$key['categoria'].'</option>';
                                }
                            }
                        ?>
                    </select>
                        </div>
                    </div><br><br>
                    <div class="row">
                        <div class="col s12 m12 s12">
                            <table id="chkInsumo" class="striped compact">
                                <thead>
                                    <tr class="tblcabecera">
                                        <th style="display:none;"></th>
                                        <th>RPTD INSUMOS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(!($insumos))
                                    {}else{
                                            foreach($insumos as $key)
                                            {
                                            echo'<tr>
                                            <td style="display:none;">'.$key['IdInsumo'].'</td>
                                                <td>
                                                <p>
                                                    <input type="checkbox" class="val" name="chkinsumo'.$key['IdInsumo'].'" id="chkinsumo'.$key['IdInsumo'].'" value="'.$key['IdInsumo'].'"/>
                                                    <label class="purple-text" for="chkinsumo'.$key['IdInsumo'].'">'.$key['Descripcion'].'</label>
                                                </p>
                                                </td>
                                            </tr>'
                                            ;
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col s12 m12 s12">
                            <table id="chkInsumo2" class="striped compact">
                                <thead>
                                    <tr class="tblcabecera">
                                        <th style="display:none;"></th>
                                        <th>RPTD CARGAS PULPER</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(!($insumos2))
                                    {}else{
                                            foreach($insumos2 as $key)
                                            {
                                                echo'<tr>
                                                <td style="display:none;" >'.$key['IdInsumo'].'</td>
                                            <td> <p>
                                                <input type="checkbox" name="chkinsumo'.$key['IdInsumo'].'" id="chkinsumo'.$key['IdInsumo'].'" value="'.$key['IdInsumo'].'"/>
                                                <label class="purple-text" for="chkinsumo'.$key['IdInsumo'].'">'.$key['Descripcion'].'</label>
                                                </p></td>
                                            </tr>';
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col s12 m12 s12">
                            <table id="chkInsumo3" class="striped compact">
                                <thead>
                                    <tr class="tblcabecera">
                                        <th style="display:none;"></th>
                                        <th>LDP MATERIA PRIMA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(!($insumos3)){}
                                    else{
                                        foreach($insumos3 as $key)
                                        {
                                            echo'<tr>
                                            <td style="display:none;">'.$key['IdInsumo'].'</td>
                                        <td> <p>
                                            <input type="checkbox" name="chkinsumo'.$key['IdInsumo'].'" id="chkinsumo'.$key['IdInsumo'].'" value="'.$key['IdInsumo'].'"/>
                                            <label class="purple-text" for="chkinsumo'.$key['IdInsumo'].'">'.$key['Descripcion'].'</label>
                                            </p></td>
                                        </tr>';
                                        }
                                      }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col s12 m12 s12">
                            <table id="chktanques" class="striped compact">
                                <thead>
                                    <tr class="tblcabecera">
                                        <th style="display:none;"></th>
                                        <th>RPTD PASTA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(!($tanques))
                                    {}
                                    else{
                                        foreach($tanques as $key)
                                        {
                                            echo'<tr>
                                            <td style="display:none;">'.$key['IdTanque'].'</td>
                                        <td> <p>
                                            <input type="checkbox" name="chk'.$key['IdTanque'].'" id="chk'.$key['IdTanque'].'" value="'.$key['IdTanque'].'"/>
                                            <label class="purple-text" for="chk'.$key['IdTanque'].'">'.$key['Tanque'].'</label>
                                            </p></td>
                                        </tr>';
                                        }
                                     }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    <?php
                        foreach ($planes as $key) { $modalHTML="'DetPlanModal'";
                            if ($key["Estado"]==1) { 
                                echo '
                                    <div class="row-fluid">
                                        <div class="center col s12 m12 s12">
                                            <a href="#" id="btnSave" onclick="GuardaDetPlan()" class="btn waves-effect waves-light" style="background-color:#831F82;">GUARDAR</a>
                                            <a href="#" class="btn waves-effect waves-light modal-action modal-close noHover" style="background-color:#831F82;" onclick="cerrarModales('.$modalHTML.', true)">CERRAR</a>
                                        </div>
                                    </div>
                                    ';
                            } else if($key["Estado"]==0){
                                echo '
                                    <div class="row-fluid">
                                        <div class="center col s12 m12 s12">
                                            <a href="#" class="btn waves-effect disabled waves-light">GUARDAR</a>
                                            <span class="red-text right"><b>Plan de trabajo cerrado</b></span>
                                            <a href="#" class="btn waves-effect waves-light modal-action modal-close noHover" style="background-color:#831F82;" onclick="cerrarModales('.$modalHTML.', false)">CERRAR</a>
                                        </div>
                                    </div>';
                                }
                            }
                        ?>
            </form>
        </div>
    </div>
</div>