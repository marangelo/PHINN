<main class="mdl-layout__content mdl-color--grey-100">
    <div class="contenedor"><br>
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
                                <a data-tooltip='CREAR TANQUE' id="AddTan" href="#" class="purple-text darken-1 modal-trigger tooltipped">
                                    <i class="waves-effect waves-purple material-icons titulosGen">queue</i>
                                </a>       
                            </div>       
                        </div><br>
                        <div class="div-cont">
                               <table id="tblTanques" class="striped" id="tblTanq">
                                <thead>
                                    <tr class="tblcabecera">
                                        <th>ID TANQUE</th>
                                        <th>TANQUE</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(!($tanques))
                                    {}else{
                                       foreach ($tanques as $key) {
                                           echo'
                                            <tr>
                                                <td>'.$key['IdTanque'].'</td>
                                                <td>'.$key['Tanque'].'</td>
                                                <td><a class="tooltipped" data-tooltip="Eliminar" data-position="right" href="javascript:void(0)" id="'.$key['IdTanque'].'" onclick="DeleteTanq('.$key['IdTanque'].', '."'".$key['Tanque']."'".')"><i class="material-icons purple-text">delete</i></a></td>
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

<div id="Tanquesmodal" class="modal1" style="height:300px;">
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
                <h6 class="center" style="font-family:'robotoblack'; color:#831F82;font-size:30px; margin-bottom:30px;">AGREGAR TANQUE</h6>
            </div>
        </div>
        <div class="row">
            <form action="" method="post">
            <div class="container">
             <div class="input-field col s12 m12 s12">
            <input type="text" name="tanque" class="center-align" value="" id="tanque">
            </div>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="center">
                <a href="#" onclick="guardatanque()" id="guardarTanq" class="btn waves-effect waves-light">GUARDAR</a>
                <a href="#" id="cerrarMDL" class="modal-action modal-close noHover btn waves-effect waves-light">CERRAR</a>
            </div>
        </div>
        </form>
    </div>
</div>