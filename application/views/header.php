<!DOCTYPE html>
<html lang="en">
    <head>
        <!--Import Google Icon Font localmente by Alder-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/fuente.css" >

        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/iweb.png" />
        <link rel="icon" type="image/png" href="<?php echo base_url(); ?>/img/iweb.png" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>INNOVA - PHINN</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->        
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.min.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/index.css" media="screen,projection"/> 

        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/sweetalert2.min.css"/>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/chosen.css"/>

        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fullcalendar.min.css"/>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fullcalendar.print.min.css" media="print"/>

        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/materialize.clockpicker.css" media="screen,projection" />

        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/materialize.css" media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/materialize.clockpicker.css"/>

        <style type="text/css" media="screen">
            select{
                display: block;
                height: auto;
                width: 90px;
                margin-bottom: 10px;
                color: black;
                font-size: 15px;
                border: none;
            }
            
            .dataTables_wrapper .dataTables_filter{ text-align: left; }
            .dataTables_wrapper .dataTables_filter input{ width: auto;}
            .Ancho { width: 5%;}
        </style>
    </head>
<body>
<div id="personalizarPassword" class="modal">
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
                <h6 class="center titulos">PERSONALIZAR CONTRASEÑA</h6>
            </div>
        </div>
            <div class="row">
                <?php
                   if ($this->session->userdata['IdUser']) {
                        $usuario = $this->session->userdata['IdUser'];
                   };
                   echo "
                <div class='input-field col s12 m6 s6'>
                    <input type='hidden' id='idUsuarioConectado' value='".$usuario."' name='idUserConectado'>
                </div> ";
                ?>
            </div>    
            <div class="row">
                <div class="input-field col s12 m6 s6">
                    <input type="text" id="oldPassword" name="oldPassword">
                    <label for="oldPassword">CONTRASEÑA ACTUAL</label>
                </div>                
                <div class="input-field col s12 m6 s6">
                    <input type="text" id="newPassword" name="newPassword">
                    <label for="newPassword">NUEVA CONTRASEÑA</label>
                </div>
            </div><br><br>
            <div class="row">                    
                <div class="center">
                    <a class="Btnadd btn waves-effect waves-light" onclick="actualizarContrasenia()" id="updatePass" href="#!" style="background-color:#831F82;">ACTUALIZAR
                    </a>
                </div>
            </div>    
    </div>
</div>