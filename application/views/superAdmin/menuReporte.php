<main class="mdl-layout__content mdl-color--grey-100">
	<div class="row"><br>
		<div class="col s12">
            <?php
                if ($_SESSION['Privilegio']==7) {
                    $regresar='<br>';
                    $title='SELECCIONAR TIPO DE REPORTE';                    
                    $pDiaria='
                    <center>                                  
                        <a data-tooltip="PRODUCCIÓN DIARIA" href='.base_url("index.php/produccionDiaria").' class="modal-trigger tooltipped purple-text darken-4">
                            <i class="material-icons center-align menu-usuarios">equalizer</i>
                            <center><span class="titulo-secundario">PRODUCCIÓN DIARIA</span></center>
                        </a>                                    
                   </center>';
                }else {
                    $regresar='
                    <div id="retornarP">
                        <a data-tooltip="REGRESAR" href="dashboard" class="modal-trigger tooltipped">
                            <i class="waves-effect waves-purple material-icons titulosGen">keyboard_backspace</i>
                        </a>
                    </div>';
                    $title='TIPO DE REPORTE';
                    $pDiaria='&nbsp';
                }

            echo'
            <div class="row">
                <div class="col s6 m6" style="text-align:left;">
                    '.$regresar.'
                </div>      
            </div>
            <center><span class="card-title accent-4 titulos" style="font-size: 24px;">'.$title.'</span></center>
            <br><br><br>
            <div class="container">
                <div class="row">
                    <div class="col s4 m4">
                        <center>                                   
                            <a href="reportes" class="modal-trigger purple-text darken-4">
                                <i class="material-icons center-align menu-usuarios">content_paste</i>
                                <center><span class="titulo-secundario">PROCESO HUMEDO</span></center>
                            </a>                                    
                        </center> 
                    </div>
                    <div class="col s4 m4">
                        '.$pDiaria.'                        
                    </div>
                    <div class="col s4 m4">
                        <center>                                   
                            <a href="#modalSelectProd" class="modal-trigger purple-text darken-4" id="openModalPrd">
                                <i class="material-icons center-align menu-usuarios">date_range</i>
                                <center><span class="titulo-secundario">PROD. MENSUAL</span></center>
                            </a>                                 
                        </center> 
                    </div>
                </div><br><br>
            </div>';
            ?>

		</div>
	</div>
</main>
<!--MODAL: EDITAR PRODUCCION-->
<div id="modalSelectProd" class="modal">
    <div class="modal-content">
        <div class="row">
            <center><span class="card-title accent-4 titulos" style="font-size: 24px;">SELECCIONAR REPORTE</span></center>
            <br><br>
            <div class="col s12 m12">
                <div class="row center">
                    <div class="col s12 m12">
                        <div style="width:75%; margin: 0 auto;">
                            <select name="selectMeta1" id="selectMeta1" class="chosen-select browser-default">
                                <?php 
                                if ($metas) {
                                    foreach ($metas as $key) {
                                        echo '<option value="'.$key['value'].'">'.$key['desc'].'</option> ';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div><br><br><br>
        <div class="row">                    
            <div class="center">
                <a onclick="generarRpt()" id="generarRptProd" href="#" class="Btnadd btn waves-effect waves-light" style="background-color:#831F82; font-size: 12px;">GENERAR
                </a>
                <a id="guardarPD" href="#" class="modal-action modal-close Btnadd btn waves-effect waves-light" style="background-color:#831F82; font-size: 12px;">CANCELAR
                </a>
            </div>
        </div>
    </div>
</div>