<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    $route['default_controller'] = 'Login_controller';
    $route['login'] = 'Login_controller';
    $route['404_override'] = '';
    $route['translate_uri_dashes'] = FALSE;

    $route['Acreditar'] = 'Login_controller/Acreditar';
    $route['Salir'] = 'Login_controller/Salir';


    $route['dashboard'] = 'Menu_controller';
    

    /*************LINK DE USUARIOS***********/
    $route['Usuarios'] = 'Usuarios';
    $route['GuardarUsuario'] = 'Usuarios/Guardar';
    $route['EditarUsuario/(:any)/(:any)']= "Usuarios/Eliminar/$1/$2";
    $route['ClaveUsuario/(:any)/(:any)']= "Usuarios/Clave/$1/$2";

/********************LINK DE PRODUCCION*************************/
$route['OrdenProduccion'] = 'Ordenproduccion_controller';
$route['GuardaOrden'] = 'Ordenproduccion_controller/GuardarRD';
$route['ValidaFecha/(:any)/(:any)/(:any)'] = 'Ordenproduccion_controller/ValidarFecha/$1/$2/$3';

    /*************LINKS DE REPORTES***********/
    
    $route['reportes'] = "reportes_controller";
    /*************REDIRECT INDEX REPORTE*************/
    $route['ordProduccion'] = "ordenProduccionG_Controller";

    /*************CAMBIAR ESTADO DE REPORTES*********/
    $route['cambiarEstadoRpt/(:any)/(:any)']= "ordenProduccionG_Controller/cambiaStatusRpt/$1/$2";

    /*************PARA VALIDAR SI EL NUMERO DE REPORTE YA EXISTE**********************/
    $route['validarReporte/(:any)']= "ordenProduccionG_Controller/validaNumRpt/$1";

    /*************VALIDA ORDENES DE PRODUCCION***************************************/
    $route['validarNoOrden']= "ordenProduccionG_Controller/validaStatusOrdenP";

    /*************VALIDA FECHA DE ORDEN DE PRODUCCION********************************/
    $route['validaFechaNoOrden']= "ordenProduccionG_Controller/validaFechaOrdenP";

    /******RETORNA LA ULTIMA FECHA DEL ULTIMO REGISTRO DE ORDEN DE PRODUCCION******/
    $route['FechaInicio/(:any)']= "ordenProduccionG_Controller/obtieneUltFec/$1";

    /******GUARDAR CONSECUTIVO DE ORDEN DE PRODUCCION******/
    $route['consecutivo/(:any)/(:any)']= "ordenProduccionG_Controller/guardaConsecutivoOrdP/$1/$2";

    /************/
    $route['buscarOrden/(:any)']= "ordenProduccionG_Controller/buscarOrdenProd/$1";

    /************/
    $route['validaRpt/(:any)']= "ordenProduccionG_Controller/buscarOrdenProdEnOrdTr/$1";

    /******CAMBIAR ORDEN ACTIVA POR UNA NUEVA******/
    $route['cambiarOrdenActiva/(:any)']= "ordenProduccionG_Controller/cambiarOrdenAct/$1";


    /********************LINKS DE TIEMPOS MUERTOS********************************/
    $route['tiemposmuertos'] = "tiemposmuertos_controller";  


    /********************LINKS DE ORDENES DE TRABAJO***********************/
    $route['buscaConsecutivo/(:any)/(:any)'] = "Ordenproduccion_controller/buscarUltConsc/$1/$2";

    /********************ORDENES DE PRODUCCION AGREGAR DETALLES*******************************/
    $route['detalleOrdenT/(:any)/(:any)/(:any)']= "Ordenproduccion_controller/agregaDetalleOrdT/$1/$2/$3";

    /********************DETALLE ORDEN INDEX*******************************/
    $route['tiempoMuerto/(:any)']= "Ordenproduccion_controller/agregaDetalleOrdT1/$1";
    $route['detalleTiempoMuerto/(:any)']= "tiemposMuertos_Controller/buscarDetalleTM/$1";

    /********************MENU REPORTE DE TRABAJO************************/
    $route['reportesDiarios/(:any)']= "exportarPdf_Controller/index/$1";
    $route['menuOrdenTrabajo/(:any)']= "Ordenproduccion_controller/agregaDetalleOrdT/$1";
    /********************GUARDANDO REGISTRO DE TIEMPO MUERTO POR AJAX****************/
    $route['Produccion/(:any)']= "Produccion_Controller/agregaDetalleOrdP1/$1"; 
    $route['GuardaProduccion']= "Produccion_Controller/GuardarProduccion"; 
    $route['EliminarProduccion/(:any)/(:any)']= "Produccion_Controller/Eliminar/$1/$2";
    $route['ActualizarMerma/(:any)/(:any)/(:any)']= "Produccion_Controller/ActualizaMerma/$1/$2/$3";
  /***************************************************************************************************/
    $route['MateriaPrima/(:any)']= "MateriaPrima_controller/agregaDetalleOrdP1/$1"; 
    $route['GuardarMP']= "MateriaPrima_controller/GuardarMatPri"; 
    $route['GuardarMPInsumos']= "MateriaPrima_controller/GuardaMPInsumos"; 
    $route['ValidaPasta/(:any)/(:any)'] = "MateriaPrima_controller/ValidarP/$1/$2";
    $route['ValidaMPInsumo/(:any)/(:any)'] = "MateriaPrima_controller/ValidarIn/$1/$2";
    $route['EliminaPasta/(:any)/(:any)'] = "MateriaPrima_controller/EliminarPasta/$1/$2";
    $route['EliminaMPInsumos/(:any)/(:any)'] = "MateriaPrima_controller/EliminaInsumos/$1/$2";

      
    $route['guardarTM']= "tiemposMuertos_Controller/guardarTiempoM";

    /**************************ELIMINAR TIEMPO MUERTO******************************/
    $route['eliminarTM/(:any)/(:any)']= "tiemposMuertos_Controller/eliminarTiempoM/$1/$2"; 
    
    /***************************ACTUALIZAR TABLA TIEMPOS MUERTOS***********************/
    $route['actualizarTablaTM']= "tiemposMuertos_Controller/actualizarTablaTM";

    /*******************LINKS CARGAS PULPER******************************/
    $route['cargaspulper/(:any)'] = "cargas_pulper_controller/index/$1";    
    $route['listarFibras'] = "cargas_pulper_controller/listarcargaspulper";    
    $route['guardarCP'] = "cargas_pulper_controller/guardarCPulper";
    $route['listandoCargasPulper/(:any)'] = "cargas_pulper_controller/listarCantidadCargas/$1";
    $route['actualizarCargaPulper/(:any)/(:any)/(:any)'] = "cargas_pulper_controller/actualizarCargaP/$1/$2/$3";
    $route['agregarHorasMolienda'] = "cargas_pulper_controller/agregarHorasM";

    /*******************LINKS HORAS MOLIENDA******************************/
    $route['listandoHorasMolienda/(:any)'] = "cargas_pulper_controller/listarHorasM/$1";
    $route['buscarHorasMolienda/(:any)'] = "cargas_pulper_controller/buscarHorasM/$1";
    $route['actualizaHoraMolienda'] = "cargas_pulper_controller/actualizaHMolienda";

    /************RUTAS SUPERVISOR******************************/
    $route['menuSupervisor/(:any)']= "Ordenproduccion_controller/mostrarMenuSupervisor/$1";

    $route['detalleOrdenProduccion/(:any)']="Ordenproduccion_controller/mostrarOrdenesTrabajos/$1";

    $route['cambiarEstadoRptDiario/(:any)/(:any)'] = "reportediario_controller/cambiaEstadoRptD/$1/$2";

    $route['validaRptDiario'] = "reportediario_controller/eliminarRegRptDiario";

    $route['MenuMantenimiento'] = "Mantenimiento_controller";

    /************RUTAS MAQUINAS******************************/
    $route['Maquinas'] = "Maquinas_controller";
    $route['Guardarmaquina'] = "Maquinas_controller/GuardarMaquina";
    $route['Eliminarmaquina/(:any)/(:any)'] = "Maquinas_controller/Eliminarmaquina/$1/$2";
      
        /************RUTAS INSUMOS******************************/
    $route['Insumos'] = "Insumos_controller";   
    $route['GuardaInsumos'] = "Insumos_controller/GuardarInsumos";  
    $route['EliminaInsumo/(:any)'] = "Insumos_controller/Eliminar/$1";

 /************RUTAS TANQUES******************************/
    $route['Tanques'] = "tanques_controller";   
    $route['GuardaTanques'] = "tanques_controller/Guardar"; 
    $route['EliminarTanques/(:any)/(:any)'] = "tanques_controller/EliminarTanque/$1/$2";
    /************RUTAS PLANES******************************/
   $route['Planes'] = "planes_controller";   
   $route['Guardaplan'] = "planes_controller/GuardaPlan"; 
   $route['ActualizaPlan'] = "planes_controller/ActualizarPlan"; 
   $route['AgregaDetalle/(:any)'] = "detalleplanes_controller/AgregaDetallePlanes/$1"; 
   $route['ValidarDetallePlan/(:any)/(:any)/(:any)'] = "detalleplanes_controller/ValidaDetalle/$1/$2/$3"; 

   $route['GuardarDetalles'] = "detalleplanes_controller/GuardaDetalles"; 
   $route['EliminaDetalles'] = "detalleplanes_controller/EliminarDetalle";
   /*****************RUTAS CONTROL PISO***************************************/
   $route['controlPiso/(:any)'] = "controlPiso_Controller/index/$1";
   $route['filtroInsumos/(:any)'] = "controlPiso_Controller/filtroTiposInsumos/$1";
   $route['insumoDetalle/(:any)/(:any)'] = "controlPiso_Controller/detalleInsumo/$1/$2";
   $route['guardarControlPisoDetalle'] = "controlPiso_Controller/guardandoControlPiso";
   $route['guardarConsumoElect'] = "controlPiso_Controller/guardandoConsumoElectrico";

    $route['reporteControlPiso/(:any)'] = "exportarPdf_Controller/reporteControlPiso/$1";

    $route['filtrandoReportesTrabajo/(:any)'] = "reportes_controller/filtrandoOrdTrabajoByIdOrdProd/$1";

    $route['reporteConsolidado/(:any)'] = "exportarPdf_Controller/rptConsolidadoFinal/$1";
    $route['guardandoPastaProc'] = "controlPiso_Controller/guardarPastaProcesada";
    $route['eliminarPastaProces/(:any)'] = "controlPiso_Controller/eliminarPasta/$1";
    /*********ACTULIZANDO CONTRASEÑA*******************************/
    $route['actulizandoPassword'] = "Login_controller/actualizarPassword";

    $route['Acreditar'] = 'Login_controller/Acreditar';
    $route['Salir'] = 'Login_controller/Salir';
    $route['Descargar'] = 'Login_controller/dowload';

    /******************GESTIONAR TURNOS*********************************/
    $route['turnos'] = 'Mantenimiento_controller/turnos';
    $route['actulizarTurnos/(:any)'] = "Mantenimiento_controller/buscarTurno/$1";
    $route['actualizandoTurno/(:any)'] = "Mantenimiento_controller/actualizarTurno/$1";
    $route['guardandoNuevoTurno'] = "Mantenimiento_controller/guardarNuevoTurno";
    $route['elimarTurno/(:any)'] = "Mantenimiento_controller/elimarRegistroTurno/$1";
    $route['restTurno/(:any)'] = "Mantenimiento_controller/restaurarRegistroTurno/$1";


    /*****************PRODUCCION DIARIA********************************/
    $route['produccionDiaria'] = 'produccionDiaria_Controller';
    $route['listandoProduccionDiaria/(:any)'] = 'produccionDiaria_Controller/listarProduccionDiaria/$1';
    $route['guardarPD'] = 'produccionDiaria_Controller/guardarProduccionDiaria';
    $route['gestionarProdDiaria/(:any)/(:any)'] = 'produccionDiaria_Controller/gestionandoProduccionDiaria/$1/$2';
    $route['listarDataRpt'] = 'produccionDiaria_Controller/generandoDataRpt';

    /******************* RUTAS METAS MENSUALES *******************/
    $route["MetasMensual"] = "metasMensual_controller";
    $route["ArticuloAjax"] = "metasMensual_controller/getArticuloAjax";
    $route["GuardarMetas"] = "metasMensual_controller/guardaMetasAjax";
    $route["ActualizarMetas"] = "metasMensual_controller/actualizaMetasAjax";
    $route["EliminaMeta/(:any)"] = "metasMensual_controller/eliminaMeta/$1";
    $route["ModifEstado/(:any)/(:any)"] = "metasMensual_controller/modifEstado/$1/$2";


    $route["reporte-menu"] = "reportes_controller/menuReporte";
    $route["rptProdMensual/(:any)"] = "exportarPdf_Controller/reporteProdMensual/$1";

    /*RUTAS GRAFICA DE PRODUCCION*/    
    $route["diasGraficaProd"] = "produccionDiaria_Controller/diasGrafica";
    $route["dataGraficaProd"] = "produccionDiaria_Controller/dataGraficaProd";