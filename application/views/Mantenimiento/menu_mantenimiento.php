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
                <?php
                    if ($this->session->userdata("Privilegio") != 0) {

                        echo '<div class="row">
                            <div class="col s3 m3">
                                <center>                                   
                                    <a data-tooltip="USUARIOS" href="Usuarios" class="modal-trigger tooltipped purple-text darken-4">
                                        <i class="material-icons menu-usuarios">supervisor_account</i>
                                        <center><span class="titulo-secundario">USUARIOS</span></center>
                                    </a>                                    
                                </center>                                
                            </div>
                            <div class="col s3 m3">
                                <center>                          
                                    <a data-tooltip="MAQUINAS" href="Maquinas" class="modal-trigger tooltipped purple-text darken-4">
                                        <i class="material-icons menu-usuarios">power</i>
                                        <center><span class="titulo-secundario">MAQUINAS</span></center>
                                    </a>
                                </center>
                            </div>
                            <div class="col s3 m3">
                                <center>                                    
                                    <a data-tooltip="INSUMOS" href="Insumos" class="modal-trigger tooltipped purple-text darken-4">
                                        <i class="material-icons menu-usuarios">settings_input_component</i>
                                        <center><span class="titulo-secundario">INSUMOS</span></center>
                                    </a>                                  
                                </center>                                
                            </div>
                            <div class="col s3 m3">
                                <center>                                   
                                    <a data-tooltip="TANQUES" href="Tanques" class="modal-trigger tooltipped purple-text darken-4">
                                        <i class="material-icons menu-usuarios">ev_station</i>
                                        <center><span class="titulo-secundario">TANQUES</span></center>
                                    </a>                                    
                                </center>                                
                            </div>
                        </div><br><br>
                        <div class="row">
                            <div class="col s3 m3">
                                <center>                                   
                                    <a data-tooltip="TURNOS" href="turnos" class="modal-trigger tooltipped purple-text darken-4">
                                        <i class="material-icons" style="font-size:70px;">alarm</i>
                                        <center><span class="titulo-secundario">TURNOS</span></center>
                                    </a>                                    
                                </center>                                
                            </div>
                        </div>';

                    } else {
                        echo '<div class="row">
                            <div class="col s12 m12 center">
                                <center>                                   
                                    <a data-tooltip="METAS MENSUAL" data-position="right" href="MetasMensual" class="tooltipped purple-text darken-4">
                                        <i class="material-icons" style="font-size:70px;">date_range</i>
                                        <center><span class="titulo-secundario">METAS MENSUAL</span></center>
                                    </a>                                    
                                </center>                                
                            </div>
                        </div>';
                    }
                    
                ?>
            </div><br><br><br>
        </div>
    </div>
</div>