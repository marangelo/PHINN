<main class="mdl-layout__content mdl-color--grey-100">
<div class="container">
    <div class="Buscar row column">               
        <div class="col s1 m1 l1 offset-l3 offset-m2">
            <i style='color:#039be5; font-size:40px;' class="material-icons">search</i>
        </div>
        <div class="input-field col s12 m6 l4">
            <input  id="filtrarRep" type="text" placeholder="Buscar" class="validate">
            <label for="search"></label>
        </div>
    </div>       
</div>
<div class="right row">
    <div class="col s1 m1 l1"><p></p></div><div class="col s1 m1 l1"><p></p></div>
    <div id="retornarP" class="col s2 m2 l2">
        <a data-tooltip='REGRESAR' href="<?php echo base_url('index.php/dashboard')?>" class="modal-trigger tooltipped">
            <i style='font-size:40px;' class="waves-effect waves-purple material-icons">keyboard_backspace</i>
        </a>
    </div>         
    <div class="col s1 m1 l1"><p></p></div><div class="col s1 m1 l1"><p></p></div>
</div><br><br>
<div class="row">
	<div class="col s12">
		<ul id="tabs-swipe-demo" class="tabs">
		    <li class="tab col s3"><a class="active" href="#test-swipe-1">TIEMPOS MUERTOS MQ. 1</a></li>
		    <li class="tab col s3"><a href="#test-swipe-2">TIEMPOS MUERTOS MQ. 2</a></li>		    
		</ul>
		<div id="test-swipe-1" class="col s12"><br>
			<table id="tlbTiemposMuertos" class="striped">
				<thead>
					<tr class="tblcabecera">
						<td colspan=2>TIEMPO</td>
						<td colspan=1 rowspan=2>MINUTOS</td>
						<td colspan=1 rowspan=2>DESCRIPCIÓN</td>
					</tr>
					<tr>
						<th>DE</th><th>A</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td> 
					</tr>
				</tbody>
			</table><br>
			<div id="agregarTM" class="right row">
				<a data-tooltip='AGREGAR TIEMPO MUERTO' href="#nuevoTiempoMuerto" class="modal-trigger tooltipped btn-floating btn-large waves-effect waves-light red "><i class="material-icons">add</i></a>		
			</div>
		</div>
		<div id="test-swipe-2" class="col s12"><br>
			<table id="tlbTiemposMuertos2" class="striped">
				<thead>
					<tr class="tblcabecera">
						<td colspan=2>TIEMPO</td>
						<td colspan=1 rowspan=2>MINUTOS</td>
						<td colspan=1 rowspan=2>DESCRIPCIÓN</td>
					</tr>
					<tr>
						<th>DE</th><th>A</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td> 
					</tr>
				</tbody>
			</table><br>
			<div class="right row">
				<a class="btn-floating btn-large waves-effect waves-light red "><i class="material-icons">add</i></a>		
			</div>	
		</div>
		
	</div>
</div>
<!--/////////////////////////////////////////////////////////////////////////////////////////
                                        PANTALLAS MODALES
//////////////////////////////////////////////////////////////////////////////////////////-->
<!-- AGREGAR NUEVO TIEMPO MUERTO -->
<div id="nuevoTiempoMuerto" class="modal1">
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
                <h6 class="center" style="font-family:'robotoblack'; color:#831F82;font-size:30px; margin-bottom:30px;">AGREGAR TIEMPO MUERTO</h6>
                <h2 class="center" style="font-family:'robotoblack'; color:#831F82;font-size:20px; margin-bottom:30px;">Maquina 1</h2>
            </div>
        </div>
        
        <div class="row">
            <form class="col s12" method="POST" name="formAgregarTM" id="formAgregarTM" action="<?php echo base_url()?>index.php/tiemposMuertos_Controller/guardarTiempoM">
                <div class="row">
                    <div class="input-field col s12 m12 s12">
                        <input class="mayuscula" maxlength="4" name="numOrden" id="numOrden" type="text" class="required">
                        <label id="lblNumeroOrden" class="labelValidacion">Nº ORDEN VIGENTE</label>
                    </div>                   
                </div>
                <br>
                <div class="row">
	                <div class="input-field col s12 m6 s6">
						<input id="timepickerI" name="timepickerI" class="timepicker" type="time">
						<label for="timepickerI">HORA INICIO</label>
	                </div>
                    
	                <div class="input-field col s12 m6 s6">
						<input id="timepickerF" name="timepickerF" class="timepicker" type="time">
						<label for="timepickerF">HORA FINAL</label>
	                </div>
                </div>
                <br>
                <div class="row">
                    <div class="input-field col s12 m12 s12">
                      <textarea id="comentario" class="text-area-ord" name="comentario"></textarea>
                      <label for="comentario">DESCRIPCIÓN</label>
                    </div>                  
                </div>
                <br>
                <div class="row">                    
                    <div class="center">
			      	    <a class="Btnadd btn waves-effect waves-light" id="guardarTM" href="#" hre style="background-color:#831F82;">GUARDAR
                            <i class="material-icons right">send</i>
                        </a>
			        </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- VISUALIZAR TIEMPOS MUERTOS -->
<div id="visTiempoM" class="modal1">
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
                <h6 class="center" style="font-family:'robotoblack'; color:#831F82;font-size:30px; margin-bottom:30px;">AGREGAR TIEMPO MUERTO</h6>
                <h2 class="center" style="font-family:'robotoblack'; color:#831F82;font-size:20px; margin-bottom:30px;">Maquina 1</h2>
            </div>
        </div>
        
        <div class="row">
            <form class="col s12" method="POST" name="formAgregarTM" id="formAgregarTM" action="<?php echo base_url()?>index.php/tiemposMuertos_Controller/guardarTiempoM">
                <div class="row">
                    <div class="input-field col s12 m12 s12">
                        <input class="mayuscula" maxlength="4" name="numOrden" id="numOrden" type="text" class="required">
                        <label id="lblNumeroOrden" class="labelValidacion">Nº ORDEN VIGENTE</label>
                    </div>                   
                </div>
                <br>
                <div class="row">
	                <div class="input-field col s12 m6 s6">
						<input id="timepickerI" name="timepickerI" class="timepicker" type="time">
						<label for="timepickerI">HORA INICIO</label>
	                </div>
                    
	                <div class="input-field col s12 m6 s6">
						<input id="timepickerF" name="timepickerF" class="timepicker" type="time">
						<label for="timepickerF">HORA FINAL</label>
	                </div>
                </div>
                <br>
                <div class="row">
                    <div class="input-field col s12 m12 s12">
                      <textarea id="comentario" class="text-area-ord" name="comentario"></textarea>
                      <label for="comentario">DESCRIPCIÓN</label>
                    </div>                  
                </div>
                <br>
                <div class="row">                    
                    <div class="center">
			      	    <a class="Btnadd btn waves-effect waves-light" id="guardarTM" href="#" hre style="background-color:#831F82;">GUARDAR
                            <i class="material-icons right">send</i>
                        </a>
			        </div>
                </div>
            </form>
        </div>
    </div>
</div>
</main>