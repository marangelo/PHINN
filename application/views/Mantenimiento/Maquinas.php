<main class="mdl-layout__content mdl-color--grey-100">
    <div class="contenedor">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                    <div class="row">
                        <div class="col s6 m6" style="text-align:left;">
                            <div id="retornarP">
                                <a data-tooltip='REGRESAR' href="<?php echo base_url('index.php/MenuMantenimiento')?>" class="modal-trigger tooltipped">
                                    <i class="waves-effect waves-purple material-icons titulosGen">keyboard_backspace</i>
                                </a>
                            </div>  
                        </div>
                        <div class="col s6 m6" style="text-align:right;">
                            <a data-tooltip='CREAR MAQUINA' id="AddMaq" href="#" class="purple-text darken-1 modal-trigger tooltipped">
                                <i class="waves-effect waves-purple material-icons titulosGen">queue</i>
                            </a>       
                        </div>       
                    </div><br>
                    <div class="div-cont">
                        <table class="striped" id="tblMaquinas">
                            <thead>
                                <tr class="tblcabecera">
                                    <th>ID MAQUINA</th>
                                    <th>MAQUINA</th>
                                    <th>COMENTARIOS</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if (!($maquinas)) {
                                    } else {
                                        foreach ($maquinas as $key) {
                                            echo '
                                                <tr>
                                                <td>'.$key['idMaquina'].'</td>
                                                <td>'.$key['maquina'].'</td>
                                                <td>'.$key['comentario'].'</td>
                                                <td>
                                                <a href="javascript:void(0)" onclick="EliminaMaquina('.$key['idMaquina'].','."'".$key['maquina']."'".')" id="'.$key['idMaquina'].'" class="tooltipped" data-tooltip="Eliminar" data-position="left">
                                                <i class="purple-text darken-1 material-icons">delete</i></a>
                                                </td>
                                                </tr>
                                            ';
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
    </div>
</main>

<!--MODALES-->

<div id="Maquinasmodal" class="modal1" style="height:400px;">
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
                <h6 class="center" style="font-family:'robotoblack'; color:#831F82;font-size:30px; margin-bottom:30px;">AGREGAR MAQUINA</h6>
            </div>
        </div>
        <div class="row">
            <form action="" method="post">
                <div class="input-field col s6 m6 s6" style="margin-top:86px;">
                    <input type="text" name="maquina" value="" id="maquina">
                    <label for="lblmaquina">MAQUINA</label>
                </div>
                <div class="input-field col s6 m6 s6">
                    <textarea rows="" cols="" name="comentario" class="materialize-textarea" id="comentario"></textarea>
                    <label for="lblcomentario">COMENTARIO</label>
                </div>
        </div>
        <br><br>
        <div class="row">
            <div class="center">
                <a href="#" onclick="GuardarMaquina()" class="btn waves-effect waves-light" id="grdMaquina">GUARDAR</a>
                <a href="#" onclick="cerrarModalMaq()" class="btn waves-effect waves-light" id="cerrarMDL">CERRAR</a>
            </div>
        </div>
        </form>
    </div>
</div>