<nav>
	<div style="background-color:#831F82!important;" class="nav-wrapper orange accent-4">
		<a style="margin-top:10px;margin-left:10px;" href="<?php echo base_url('index.php/dashboard')?>" class="brand-logo left"><img src="<?php echo base_url('assets/img/logo/innova-blanco.png')?>" width="120px"></a>
		<?php
			/*if($this->uri->segment(1)=='dashboard' or $this->uri->segment(1)=='Menu'){
				echo '<center><a href="#" class="titulos-menu-superior"></a></center>';
			}elseif($this->uri->segment(1)=='Usuarios'){
				echo '<a href="#" class="brand-logo center">LISTA DE USUARIOS</a>';
			}elseif($this->uri->segment(1)=='Empleados'){
				echo '<a href="#" class="brand-logo center">LISTA DE TRABAJADORES</a>';
			}elseif($this->uri->segment(1)=='Reportes'){
				echo '<a href="#" class="brand-logo center">REPORTES</a>';
			}elseif($this->uri->segment(1)=='ordProduccion'){
				echo '<a href="#" class="brand-logo center">ORDEN DE PRODUCCIÓN</a>';
			}elseif($this->uri->segment(1)=='menuOrdenTrabajo'){
				echo '<a href="#" class="brand-logo center">ORDEN DE TRABAJO</a>';
			}elseif($this->uri->segment(1)=='OrdenProduccion'){
				echo '<a href="#" class="brand-logo center"></a>';
			}
			elseif($this->uri->segment(1)=='Produccion'){
				echo '<a href="#" class="brand-logo center">PRODUCCION</a>';
			}
			elseif($this->uri->segment(1)=='tiempoMuerto'){
				echo '<a href="#" class="brand-logo center">TIEMPOS MUERTOS</a>';
			}
			elseif($this->uri->segment(1)=='cargaspulper'){
				echo '<a href="#" class="brand-logo center titulos-menu-superior">CARGAS PULPER Y HORAS MOLIENDA</a>';
			}
			elseif($this->uri->segment(1)=='MateriaPrima'){
				echo '<a href="#" class="brand-logo center">MATERIA PRIMA</a>';
			}
			elseif($this->uri->segment(1)=='MenuMantenimiento'){
				echo '<a href="#" class="brand-logo center">MANTENIMIENTO</a>';
			}*/
		   if ($this->session->userdata['IdUser']) {
		   		$usuario = $this->session->userdata['Nombre'];
		   };
			echo '<ul class="right hide-on-med-and-down">
					<li>'.$usuario.'</li>
					<li><a href="'.base_url("index.php/dashboard").'"><i style="font-size:32px;" class="mdi-action-home tooltipped" data-tooltip="INICIO"></i></a></li>
					<li ><a href="'.base_url("index.php/Salir").'"><i style="font-size:32px;" class="material-icons">power_settings_new</i></a></li>
					<li>
						<ul id="dropdown1" class="dropdown-content">
						  <li><a href="'.base_url("index.php/Descargar").'">Ayuda</a></li>
						  <li><a id="openModalPass" class="modal-trigger" href="#personalizarPassword">Contraseña</a></li>
						</ul>
						<nav>
						  <div class="nav-wrapper">
						    <ul class="right hide-on-med-and-down">
						      <li><a class="dropdown-button" href="#!" style="background-color:#831f82;" data-activates="dropdown1"><i class="material-icons">apps</i></a></li>
						    </ul>
						  </div>
						</nav>
					</li>					
				</ul>'; 
			?>
	</div>
</nav>