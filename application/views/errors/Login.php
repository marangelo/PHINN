<nav>
		<div class="nav-wrapper orange accent-4">
				<a href="<?php echo base_url('index.php/Menu')?>" class="brand-logo left">
					<img src="<?php echo base_url('assets/img/logo/innova-blanco.png')?>" width="200px">
				</a>
		</div>
</nav>
<br>
<div class="container "> 	
	<div class="col s3 ">
		    <div class="card-panel grey lighten-5 z-depth-1 center" >
			    <div class="col s6" >
			        <h5>Plataforma SISCOV, Bienvenido.</h5>
		    	    <p>Sistema de Incentivos Proceso Conversion</p>			  
        		
        		    <div class="col s3">
                        <img src="<?php echo base_url();?>/assets/img/LG.png" alt="" class="circle responsive-img valign" style="width:100px;">
		   		    </div>
        	    </div>
		        
                <div class="col s12" >
			        <form class="col s12" method="post" action="<?php echo base_url('index.php/Acreditar')?>" >		      
		                <div class="row">
		                    <div class="input-field col s12">
		                        <p>Usuario</p>
		                        <input name="txtUsuario" id="Usuario" type="text" class="validate" value="<?php echo set_value('Usuario'); ?>">
		          
		                        <?php echo form_error('txtUsuario'); ?>
		                    </div>
		                </div>
		      
                        <div class="row">
                            <div class="input-field col s12">
		                    <p>Contraseña</p>
		                    <input name="txtpassword" type="password" class="validate">		          
		                    <?php echo form_error('txtpassword'); ?>
		                </div>
		                
		      	        <div class="card-action">
             		        <button class="btn waves-effect waves-light" type="submit" name="action">Acceder
			    		        <i class="material-icons right">send</i>
			  		        </button>
            	        </div>
		            </form>
		        </div>
            </div>
    </div>
 </div>
    
            
