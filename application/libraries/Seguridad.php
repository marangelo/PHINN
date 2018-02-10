<?php
/**
 *
 * User: Marangelo
 * Date: 04/02/2016
 * Time: 03:46 pm
 */
class Seguridad{	
	public function estactivo($st){
		

		if (!isset($st)) {
			redirect('index.php');
		} 
	}	
}