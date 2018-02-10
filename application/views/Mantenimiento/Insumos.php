<main class="mdl-layout__content mdl-color--grey-100">
    <div class="contenedor">
        <div class="container"><br>
            <div class="Buscar row column noMargen">
                <div class="col s1 m1 l1 offset-l3 offset-m2">
                    <i class="material-icons iconSearch">search</i>
                </div>
                <div class="input-field col s12 m6 l4">
                    <input id="BuscarINS" type="text" placeholder="Buscar" class="validate">
                    <label for="search"></label>
                </div>
            </div>
        </div>

        <!--/////////////////////////////////////////////////////////////////////////////////////////
                                       BOTONES
        //////////////////////////////////////////////////////////////////////////////////////////-->
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                    <div class="row">
                        <div class="col s6 m6" style="text-align:left;">
                            <div id="retornarP">
                                <a data-tooltip='REGRESAR' href="<?php echo base_url('index.php/MenuMantenimiento')?>" class="purple-text darken-1 tooltipped">
                                    <i class="waves-effect waves-purple material-icons titulosGen">keyboard_backspace</i>
                                </a>
                            </div>  
                        </div>
                        <div class="col s6 m6" style="text-align:right;">
                            <a data-tooltip='CREAR INSUMO' id="AddIns" href="#" class="purple-text darken-1 modal-trigger tooltipped">
                                <i class="waves-effect waves-purple material-icons titulosGen">queue</i>
                            </a>       
                        </div>       
                    </div><br>
                    <div class="div-cont">
                        <table class="striped" id="tblIns">
                            <thead>
                                <tr class="tblcabecera">
                                    <th>ID INSUMO</th>
                                    <th>DESCRIPCION</th>
                                    <th>CATEGORIAS</th>
                                    <th>UNIDAD MEDIDA</th>
                                    <th>TIPO</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if (!($listainsumos)) {
                                    } else {
                                        foreach ($listainsumos as $key) {
                                            
                                            switch ($key['IdCategoria']) {
                                                case 1:
                                                    $key['IdCategoria'] = "RPTD CARGAS PULPER";
                                                    break;
                                                
                                                case 2:
                                                    $key['IdCategoria'] = "RPTD INSUMOS";
                                                    break;

                                                case 3:
                                                    $key['IdCategoria'] = "LDP MATERIA PRIMA";
                                                    break;
                                            }
                                            echo '
                                                <tr>
                                                <td>'.$key['IdInsumo'].'</td>
                                                <td>'.$key['Descripcion'].'</td>
                                                <td>'.$key['IdCategoria'].'</td>
                                                <td>'.$key['UnidadMedida'].'</td>
                                                <td>'.$key['Tipo'].'</td>
                                                <td>
                                                <a href="javascript:void(0)" onclick="EliminaINS('."'".$key['IdInsumo']."'".')" id="'.$key['IdInsumo'].'" class="tooltipped" data-tooltip="Eliminar" data-position="left">
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
<div id="Insumosmodal" class="modal1" style="height:500px;">
    <div class="modal-content">
        <div class="row noMargen center">
            <div class="noMargen col s12 m12 l12">
                <h6 class="center" style="font-family:'robotoblack'; color:#831F82;font-size:30px; margin-bottom:30px;">AGREGAR INSUMO</h6>
            </div>
        </div>
        <div class="row">
            <form action="" method="post">
                <div class="input-field col s6 m6 s6" style="margin-top:86px;">
                <select class="chosen-select browser-default" name="categoria" id="categoria">
                    <option selected disabled>CATEGORIA</option>
                    <?php
                    foreach ($categoria as $key) {
                           echo '
                         <option value="'.$key['IdCategoria'].'">'.$key['categoria'].'</option>
                        ';
                    }
                    ?>
                </select>
                <label for="lblcategoria">SELECCIONA UNA CATEGORIA</label>
                </div>
                <div class="input-field col s6 m6 s6">
                    <textarea rows="" cols="" name="Descripcion" class="materialize-textarea" id="Descripcion"></textarea>
                    <label for="lbldescripcion">DESCRIPCION</label>
                </div>
                <br>
                <div class="row">
                    <div class="input-field col s6 m6 s6">
                        <input type="text" class="center-align" name="unidadmedida" id="unidadmedida" value="">
                        <label id="lblunidadmedida">UNIDAD MEDIDA</label>
                    </div>
                     <div class="input-field col s6 m6 s6">
                        <input type="text" class="center-align" name="tipo" id="tipo" value="">
                        <label id="lbltipo">TIPO</label>
                    </div>
                </div>
        </div>
        <br><br>
        <div class="row">
            <div class="center">
                <a href="#" onclick="Guardarinsumos()" class="btn waves-effect waves-light" style="background-color:#831F82;">GUARDAR</a>
                <a href="#" onclick="cerrarModales('Insumosmodal', true)" class="btn waves-effect waves-light" style="background-color:#831F82;">CERRAR</a>
            </div>
        </div>
        </form>
    </div>
</div>