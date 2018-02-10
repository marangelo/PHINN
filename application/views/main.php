<div class="">
    <script>
        function change(){
            loc="www.google.com";
            $('#calendar').attr('src', loc);
        }
    </script>
    <div class="row menu">     
        <?php
            if (!isset($_SESSION['Privilegio'])) {
            }else{
                switch ($_SESSION['Privilegio']) {

                case 0: //VISTA SUPERVISOR

                    echo '<br><br><br>
                    <div class="container">
                        <div class="row">
                            <div class="col s3 m3">
                                <center>   
                                   <a data-tooltip="ORDENES DE TRABAJO" href=' . base_url("index.php/OrdenProduccion") . ' class="modal-trigger tooltipped purple-text darken-4">
                                        <i class="material-icons center-align menu-usuarios">content_paste</i>
                                        <center><span class="titulo-secundario">ORDENES DE TRABAJO</span></center>
                                    </a>                                  
                               </center>                                
                           </div>
                            <div class="col s3 m3">
                                <center>                                  
                                    <a data-tooltip="PRODUCCIÓN DIARIA" href='.base_url("index.php/produccionDiaria").' class="modal-trigger tooltipped purple-text darken-4">
                                        <i class="material-icons center-align menu-usuarios">equalizer</i>
                                        <center><span class="titulo-secundario">PRODUCCIÓN DIARIA</span></center>
                                    </a>                                    
                               </center>
                           </div>
                            <div class="col s3 m3">
                                <center>   
                                    <a data-tooltip="REPORTES" href=' . base_url("index.php/reporte-menu") . ' class="modal-trigger tooltipped purple-text darken-4">
                                        <i class="material-icons center-align menu-usuarios">trending_up</i>
                                        <center><span class="titulo-secundario">REPORTES</span></center>
                                    </a>    
                               </center>                                
                           </div>
                            <div class="col s3 m3">
                                <center>            

                                    <a data-tooltip="MANTENIMIENTO" href=' . base_url("index.php/MenuMantenimiento") . ' class="modal-trigger tooltipped purple-text darken-4">
                                        <i class="material-icons center-align menu-usuarios">settings</i>
                                        <center><span class="titulo-secundario">MANTENIMIENTO</span></center>
                                    </a>
                               </center>                                
                           </div>
                        </div>
                    </div>';
                    break;

                    case 1: //VISTA ADMINISTRADOR
                    echo  '<br><br><br>
                    <div class="container">
                        <div class="row">
                            <div class="col s3 m3">
                                <center>                                    
                                    <a data-tooltip="ORDENES DE TRABAJO" href='.base_url("index.php/OrdenProduccion").' class="modal-trigger tooltipped purple-text darken-4">
                                        <i class="material-icons center-align menu-usuarios">content_paste</i>
                                        <center><span class="titulo-secundario">ORDENES DE TRABAJO</span></center>
                                    </a>                                  
                                </center>                                
                            </div>
                            <div class="col s3 m3">
                                <center>                                   
                                    <a data-tooltip="PLAN DE TRABAJO" href='.base_url("index.php/Planes").' class="modal-trigger tooltipped purple-text darken-4">
                                        <i class="material-icons center-align menu-usuarios">assignment_turned_in</i>
                                        <center><span class="titulo-secundario">PLAN DE TRABAJO</span></center>
                                    </a>                                    
                                </center>                                
                            </div>
                            <div class="col s3 m3">
                                <center>                                   
                                    <a data-tooltip="REPORTES" href='.base_url("index.php/reporte-menu").' class="modal-trigger tooltipped purple-text darken-4">
                                        <i class="material-icons center-align menu-usuarios">trending_up</i>
                                        <center><span class="titulo-secundario">REPORTES</span></center>
                                    </a>                                    
                                </center>                                
                            </div> 
                            <div class="col s3 m3">
                                <center>                                   
                                    <a data-tooltip="MANTENIMIENTO" href='.base_url("index.php/MenuMantenimiento").' class="modal-trigger tooltipped purple-text darken-4">
                                        <i class="material-icons center-align menu-usuarios">settings</i>
                                        <center><span class="titulo-secundario">MANTENIMIENTO</span></center>
                                    </a>                                    
                                </center>                                
                            </div>
                        </div><br><br><br>
                        <div class="row">
                            <div class="col s3 m3">
                                <center>                                  
                                    <a data-tooltip="PRODUCCIÓN DIARIA" href='.base_url("index.php/produccionDiaria").' class="modal-trigger tooltipped purple-text darken-4">
                                        <i class="material-icons center-align menu-usuarios">equalizer</i>
                                        <center><span class="titulo-secundario">PRODUCCIÓN DIARIA</span></center>
                                    </a>                                    
                               </center>
                           </div>
                        </div>
                    </div>';
                    break;
                    case 2://VISTA GERENTE
                    echo  '<br><br><br>
                    <div class="container">
                        <div class="row">
                            <div class="col s6 m6">
                                <center>                                    
                                    <a data-tooltip="ORDENES DE TRABAJO" href='.base_url("index.php/OrdenProduccion").' class="modal-trigger tooltipped purple-text darken-4">
                                        <i class="material-icons center-align menu-usuarios">content_paste</i>
                                        <center><span class="titulo-secundario">ORDENES DE TRABAJO</span></center>
                                    </a>                                  
                                </center>                                
                            </div>
                            <div class="col s6 m6">
                                <center>                                   
                                    <a data-tooltip="REPORTES" href='.base_url("index.php/reportes").' class="modal-trigger tooltipped purple-text darken-4">
                                        <i class="material-icons center-align menu-usuarios">trending_up</i>
                                        <center><span class="titulo-secundario">REPORTES</span></center>
                                    </a>                                    
                                </center>                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s3 m3">
                                <center>                                  
                                    <a data-tooltip="PRODUCCIÓN DIARIA" href='.base_url("index.php/produccionDiaria").' class="modal-trigger tooltipped purple-text darken-4">
                                        <i class="material-icons center-align menu-usuarios">equalizer</i>
                                        <center><span class="titulo-secundario">PRODUCCIÓN DIARIA</span></center>
                                    </a>                                    
                               </center>
                           </div>
                        </div>                       
                    </div>';
                    break;
                    case 3: //VISTA SUPERVISOR
                    echo '<br><br><br>
                    <div class="container">
                        <div class="row">
                            <div class="col s3 m3">
                                <center>                                    
                                    <a data-tooltip="ORDENES DE TRABAJO" href='.base_url("index.php/OrdenProduccion").' class="modal-trigger tooltipped purple-text darken-4">
                                        <i class="material-icons center-align menu-usuarios">content_paste</i>
                                        <center><span class="titulo-secundario">ORDENES DE TRABAJO</span></center>
                                    </a>                                  
                                </center>                                
                            </div>
                            <div class="col s3 m3">
                                <center>                                   
                                    <a data-tooltip="PLAN DE TRABAJO" href='.base_url("index.php/Planes").' class="modal-trigger tooltipped purple-text darken-4">
                                        <i class="material-icons center-align menu-usuarios">assignment_turned_in</i>
                                        <center><span class="titulo-secundario">PLAN DE TRABAJO</span></center>
                                    </a>                                    
                                </center>                                
                            </div>
                            <div class="col s3 m3">
                                <center>                                   
                                    <a data-tooltip="REPORTES" href='.base_url("index.php/reportes").' class="modal-trigger tooltipped purple-text darken-4">
                                        <i class="material-icons center-align menu-usuarios">trending_up</i>
                                        <center><span class="titulo-secundario">REPORTES</span></center>
                                    </a>                                    
                                </center>                                
                            </div> 
                            <div class="col s3 m3">
                                <center>                                   
                                    <a data-tooltip="MANTENIMIENTO" href='.base_url("index.php/MenuMantenimiento").' class="modal-trigger tooltipped purple-text darken-4">
                                        <i class="material-icons center-align menu-usuarios">settings</i>
                                        <center><span class="titulo-secundario">MANTENIMIENTO</span></center>
                                    </a>                                    
                                </center>                                
                            </div>
                        </div>
                    </div>';
                    break;  
                    case 4://VISTA COORDINADOR
                    redirect('OrdenProduccion');
                    break;
                    case 7:
                    redirect('reporte-menu');
                    break;
                }
            }
        ?> 
    </div>
</div>
