/*/////////////////////////////////////////////////////////////////////////////////////////
                                    MIS FUNCIONES
//////////////////////////////////////////////////////////////////////////////////////////*/
//Abrir los diferentes modales del sistema
$(document).ready(function() {
/************************************  funciones sobre metas **************************************** */
    
    $("#tblMetas").DataTable();
    $("#tblmetasprod").DataTable({
        "ordering": false,
        "info": false,
        "bPaginate": true,
        "bfilter": false,
        "language": {
            "emptyTable": "No hay datos disponible en la tabla",
            "lengthMenu": "_MENU_",
            "loadingRecords": "",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registro",
            "infoEmpty": "Mostrando 0 a 0 de 0 registro",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "zeroRecords": "No se han encontrado resultados para tu búsqueda",
            "paginate": {
                "first": "Primera",
                "last": "Última ",
                "next": "Anterior",
                "previous": "Siguiente"
            }
        }
    });

    $("#searchMetas").on("keyup", function () {
        var table = $("#tblmetasprod").DataTable();
        table.search(this.value).draw();
    });
/************************************************************************* */


    /***********LISTO LAS FIBRAS EN CARGAS PULPER*********************/
    var pathname = window.location.pathname;
    if (pathname.match(/cargaspulper.*/)) {
        crearTabla();
        listarHorasMolienda();
    };
    if (pathname.match(/reportesDiarios.*/)) {
        crearTabla();
    };
    if (pathname.match(/produccionDiaria.*/)) {        
        var meta = $('#selectMetas').val();
        produccionDiariaTabla(meta);        
    };
    if (pathname.match(/MetasMensual.*/)) {        
        creaTabla();
    }
    if (pathname.match(/dataGraficaRpt.*/)) {
        alert('aca');
        generaGraficaRpt();  
    }

    $("#crearU").click(function() { $("#AUsuario").openModal(); });
    $("#crearT").click(function() { $("#ATrabajador").openModal(); });

    $("#agregaElect").click(function() { $("#agregaElectricidad").openModal(); });
    $("#agregarMP").click(function() { $("#nuevaMatPrim").openModal(); });
    $("#modinsumo").click(function() { $("#modalInsumo").openModal(); });
    $("#AddIns").click(function() { $("#Insumosmodal").openModal() });
    $("#AddMaq").click(function() { $("#Maquinasmodal").openModal(); });
    $("#btnAgregarf").click(function() { $("#modal11").openModal(); });
    $("#btnAgregaHM").click(function() { $("#modal12").openModal(); });
    $("#actualizarM").click(function() { $("#Actualizar").openModal(); });
    $("#AddPlan").click(function() { $("#PlanModal").openModal(); });
    $("#AddTan").click(function() { $("#Tanquesmodal").openModal(); });
    $("#btnAddDetPlan").click(function() { $("#DetPlanModal").openModal(); });
    $("#abrirMdlNOrd").click(function() { $("#ModalNuevaOrdProduccion").openModal(); });
    $("#agregaPasta").click(function() { $("#agregaPastaProc").openModal(); });
    $("#openModalPass").click(function() { $("#personalizarPassword").openModal(); });
    $("#agregaTurno").click(function() { $("#nuevoTurno").openModal(); });

    ///Configurar chosen////
    var config = {
        '.chosen-select': {}
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }

    $('#timepicker , #timepicker1, #timepickerII, #horaInicioTurno, #horaInicioTurno2, #horaFinalTurno2, #horaFinalTurno, #timepickerFF, #horaFinalCons, #horaInicioCons, #timeHM1, #timeHM2, #timeHM12, #timeHM22').pickatime({
        default: '', // default time, 'now' or '13:14' e.g.
        donetext: 'aceptar',
        format: 'HH:i uur',
        formatSubmit: 'HH:i',
        hiddenName: true,
        min: [6, 0],
        max: [17, 00],
        disable: [
            [12, 0],
            [12, 30]
        ], // done button text
        fromnow: 0
    });

    /******************CONFIGURAR DATEPICKER*******************/
    $('.datepicker').pickadate({
        labelMonthNext: 'Mes siguiente',
        labelMonthPrev: 'Mes anterior',
        labelMonthSelect: 'Selecciona un mes',
        labelYearSelect: 'Selecciona un año',
        monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        weekdaysFull: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
        weekdaysLetter: ['D', 'L', 'M', 'X', 'J', 'V', 'S'],
        today: 'Hoy',
        clear: 'Limpiar',
        close: 'Cerrar',
        format: 'yyyy-mm-dd'
            //min: new Date()
    });

    /*************PERMITE SOLO NUMEROS EN LOS INPUTS**********************************/
    $('#numOrden').numeric();
    $('.numeric').numeric();
    $("#Dia").numeric();
    $("#Noche").numeric();
    $("#ptadia").numeric();
    $("#ptanoche").numeric();
    $("#dia").numeric();
    $("#noche").numeric();
    $("#consumo").numeric();
    $("#peso").numeric();
    $("#pesobase").numeric();
    $("#Diametro").numeric();
    $("#Velocidad").numeric();
    $("#merma").numeric();
});

$('#cerrarHM1').click(function() {
    $("#modal13").closeModal();
    location.reload();
});

$('#tlbListaRep2').on('click', 'tbody .detalleNumOrd', function() {
    var table = $('#tlbListaRep2').DataTable();
    var tr = $(this).closest('tr');
    $(this).addClass("detalleNumOrdOrange");
    var row = table.row(tr);
    var data = table.row($(this).parents('tr')).data();

    if (row.child.isShown()) {
        row.child.hide();
        tr.removeClass('shown');
        $('#detail1' + data[1]).hide();
        $('#detail2' + data[1]).show();
        $(this).removeClass("detalleNumOrdOrange");
    } else {
        $('#loader' + data[1]).show();
        $('#detail1' + data[1]).show();
        $('#detail2' + data[1]).hide();

        format(row.child, data[1], data[1]);
        tr.addClass('shown');
    }
});
function format(callback, noOrden, div) {
    var ia = 0;
    $.ajax({
        url: 'detalleOrdenProduccion/' + noOrden,
        async: true,
        success: function(response) {
            var thead = '',
                tbody = '';
            
            var cont = 0;
            if (response != 'false') {
                var obj = $.parseJSON(response);
                var temp = obj.length; var cantRows = 0;
                thead += '<tr class="tblcabecera"><th class="negra center">N° ORDEN</th>';
                thead += '<th class="negra center">TURNO</th>';
                thead += '<th class="negra center">FECHA INICIO</th>';
                thead += '<th class="negra center">FECHA FIN</th>';
                thead += '<th class="negra center">COORDINADOR</th>';
                thead += '<th class="negra center">TIPO PAPEL</th>';
                thead += '<th class="negra center">ESTADO</th>';
                thead += '<th class="negra center">OPCIONES</th>';
                thead += '<th class="negra center">CONTROL</th></tr>';

                $.each(JSON.parse(response), function(i, item) {                                   
                    if (item["Estado"] == 1) {
                        var html = "<a onclick='cambiaEstadoRptD(" + item["IdReporteDiario"] + ", 0)' class='btn-flat tooltipped noHover'><i style='color:#228b22; font-size:30px;' class='material-icons'>lock_open</i></a>";
                    } else if (item["Estado"] == 0) {
                        var html = "<a onclick='cambiaEstadoRptD(" + item["IdReporteDiario"] + ", 1)' class='btn-flat tooltipped noHover'><i style='color:#696969; font-size:30px;' class='material-icons'>lock</i></a>";
                    };
                    var link = "<a onclick='elimarRptDiario(" + item["IdReporteDiario"] + ", "+'"'+ item["Consecutivo"] + '"'+", "+'"'+ item["Turno"] + '"'+")' class='btn-flat tooltipped noHover'><i style='color:#696969; font-size:30px;' class='material-icons'>delete</i></a>";
                    tbody += '<tr >' +

                        '<td><a href="../index.php/reportesDiarios/' + item["IdReporteDiario"] + '" target="_blank" class="noHover"</a>' + item["Consecutivo"] + '</td>' +
                        '<td>' + item["Turno"] + '</td>' +
                        '<td>' + moment(item["FechaInicio"]).format('DD-MM-YYYY') + '</td>' +
                        '<td>' + moment(item["FechaFinal"]).format('DD-MM-YYYY') + '</td>' +
                        '<td>' + item["Nombre"] + '</td>' +
                        '<td>' + item["TipoPapel"] + '</td>' +
                        '<td>' + html + '</td>' +
                        '<td>' + link + '</td>';
                    if (i==cont && item['Cant'] == item['turnos']) {
                        tbody += '<td rowspan="'+item['turnos']+'" style="background-color:#ffe9fe; border: 1px solid #cfd8dc;"><a href="../index.php/controlPiso/' + item["Consecutivo"] + '">CONTROL DE PISO</a></td></tr>';
                        if (obj.length>cont) {
                            cont = parseInt(cont) + (parseInt(item['Cant']));
                        }
                    }else if (i==cont && item['Cant'] != item['turnos']) {
                        tbody += '<td rowspan="'+item['turnos']+'" style="background-color:#ffe9fe; border: 1px solid #cfd8dc;"><a href="../index.php/controlPiso/' + item["Consecutivo"] + '">CONTROL DE PISO</a></td></tr>';
                        if (obj.length>cont) {
                            cont = parseInt(cont) + (parseInt(item['turnos']));
                        }
                    }             
                });            
                callback($('<table id="tlbListaRep3" class="striped">' + thead + tbody + '</table>')).show();
                $('#loader' + div).hide();
                $('#detail1' + div).show();
            } else {
                thead += '<tr class="tblcabecera"><th class="negra center">N° ORDEN</th>';
                thead += '<th class="negra center">TURNO</th>';
                thead += '<th class="negra center">FECHA INICIO</th>';
                thead += '<th class="negra center">FECHA FIN</th>';
                thead += '<th class="negra center">COORDINADOR</th>';
                thead += '<th class="negra center">TIPO PAPEL</th></tr>';
                tbody += '<tr >' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td>No hay datos disponibles</td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '</tr>';
                callback($('<table id="tlbListaRep3" class="striped">' + thead + tbody + '</table>')).show();
                $('#loader' + div).hide();
                $('#detail' + div).show();
            }
        }
    });
}

/******************AGREGAR NUEVAS ROWS DATATABLE INSUMOS******************/
function agregarFilas() {
    var t = $('#tblControlPiso').DataTable();
    var idInsumo = $('#descripcionInsumo').val();
    var consecutivoHTML= $("#consecutivo").text();
    $.ajax({

        url: "../insumoDetalle/"+idInsumo+"/"+consecutivoHTML,
        type: "POST",
        async: true,
        success: function(data) {
            console.log(data);
            if (data!=1) {
                $.each(JSON.parse(data), function(i, item){
                    t.row.add( [
                        item['IdInsumo'],
                        item['Tipo'],
                        '<input class="inputControlPiso numeric" id="codigo' + item['IdInsumo'] + '" value=""/>',
                        item['Descripcion'],
                        item['UnidadMedida'],
                        '<input class="inputControlPiso numeric" id="requisado' + item['IdInsumo'] + '"/>',
                        '<input class="inputControlPiso numeric" id="piso' + item['IdInsumo'] + '" onchange="calcularConsumo(' + item['IdInsumo'] + ')" value=""/>',
                        '<input class="inputControlPiso numeric" id="consumo' + item['IdInsumo'] + '" value=""/>',
                        '<a class="btn-floating red" href="#" onclick=""><i class="tiny material-icons quitar">close</i></a>'
                    ]).draw(false);
                });
            } else {

                mensajeAlerta('Ya existe un registro de este insumo');
            };

        }
    });
}
//***************QUITAR ROW******************************/

$('#tblControlPiso tbody').on( 'click', 'i.quitar', function () {
    var tablaCP = $('#tblControlPiso').DataTable();
    tablaCP
        .row( $(this).parents('tr'))
        .remove()
        .draw();
} );
/****************CALCULANDO CONSUMO CONTROL DE PISO**************************/
function calcularConsumo(item) {
    var cant1 = $("#requisado" + item).val();
    var cant2 = $("#piso" + item).val();
    if (cant2 > cant1) {
        mensajeAlerta('El requisado no puede ser menor a cantidad piso');
    } else {
        var consumo = cant1 - cant2;
        $('#consumo' + item).val(consumo);
    };
}
/**********GUARDA DETALLE CONTROL PISO*****************************/
function guardarControlPiso() {
    var maquinas; var rptPasta;
    var fecha = new Date();
    var encabezadoCPiso = new Array();
    var pos1 = 0;
    if ($('#maquina1').is(':checked') && $('#maquina2').is(':checked')) {
        maquinas = '1-2';
    } else if ($('#maquina1').is(':checked') && (!$('#maquina2').is(':checked'))) {
        maquinas = '1-0';
    } else if ($('#maquina2').is(':checked') && (!$('#maquina1').is(':checked'))) {
        maquinas = '0-2';
    } else if (!$('#maquina2').is(':checked') && (!$('#maquina1').is(':checked'))) {
        maquinas = '0-0';
    };

    if ($('#incluirRptPastaProc').is(':checked')) {
        rptPasta = 1;
    }else if(!$('#incluirRptPastaProc').is(':checked')) {
        rptPasta = 0;
    };
    var fechaCreacion = moment(new Date()).format('YYYY/MM/DD');

    var noOrden= $('#ordTrabajo').text();
    var consecutivoHTML= $("#consecutivo").text();
    var fechaInicio= $('#fechaInicio').val();
    var fechaFin= $('#fechaFin').val();
    var fechaCreacion= fechaCreacion;
    var producto= $('#tipoPapel').text();
    var grupo= $('#grupo').val();
    if (grupo=="") {
        grupo="indefinido,indefinido";
    }
    var grupo2 = grupo.replace(/,/g, "-");
    var maquina= maquinas;
    var horaInicio= $('#horaInicio').text();
    var horaFinal= $('#horaFin').text();
    encabezadoCPiso[pos1] = noOrden+","+consecutivoHTML+","+fechaInicio+","+fechaFin+","+fechaCreacion+","+producto+","+grupo2+","+maquina+","+horaInicio+","+horaFinal+","+rptPasta;


    var table = $('#tblControlPiso').DataTable();
    var array = new Array();
    var pos = 0;
    var detalleCPiso = new Array();
    table.rows().eq(0).each(function(index) {
        var row = table.row(index);
        var data = row.data();

        var idItem=data[0];
        var codigo = $("#codigo"+idItem).val();
        if (codigo=="") {
            codigo="0";
        }
        var requisado = $("#requisado"+idItem).val();
        var piso = $("#piso"+idItem).val();
        var consumo = $("#consumo"+idItem).val();
        detalleCPiso[pos] = data[0] + "," + data[1] + "," + codigo + "," + data[3] + "," + data[4] + "," + requisado + "," + piso + "," + consumo + "," + consecutivoHTML;

        pos++;
    });

    var form_data = {
        consecutivo: consecutivoHTML,
        encabezado: encabezadoCPiso,
        detalle: detalleCPiso
    };

    $.ajax({
        url: "../guardarControlPisoDetalle",
        type: "POST",
        async: true,
        data: form_data,
        success: function(data) {
            if (data == 1) {
                Materialize.toast('SE GUARDO CON ÉXITO', 1000);
            } else {
                Materialize.toast('ERROR AL GUARDAR', 1000);
            };
        }
    });
}
/*********ACTUALIZAR CONTRASEÑA************************/
function actualizarContrasenia() {
    if ($('#oldPassword').val()=="" || $('#newPassword').val()=="") {
        mensajeAlerta('¡Rellene todos los campos!');
    }else {
        var dataPass = new Array();
        dataPass[0] = $('#idUsuarioConectado').val() + "," + $('#oldPassword').val() + "," + $('#newPassword').val();

        var form_data = {
            updatePass : dataPass
        }
        $.ajax({
            url: "actulizandoPassword",
            type: "POST",
            async: true,
            data: form_data,
            success: function(data) {
                if (data == 1) {
                    swal({
                        text: 'Actualizado con éxito',
                        type: 'success',
                        showCloseButton: true,
                        confirmButtonColor: '#831F82',
                        confirmButtonText: 'ACEPTAR',
                    }).then(function() {
                        location.reload();
                    });
                } else {
                    mensajeAlerta('Contraseñas invalidas');
                };
            }
        });
    }
}
/********FUNCIONES SOBRE PASTA FINAL-REPORTE CONTROL PISO******/
$("#incluirRptPastaProc").on('click', function(event) {
    var marcado = $("#incluirRptPastaProc").prop("checked") ? true : false;
    var texto;
    if ($('#incluirRptPastaProc').is(':checked')) {
        texto="¿Esta seguro de querer adjuntar esta información al reporte?";
    } else if(!$('#incluirRptPastaProc').is(':checked')) {
        texto="¿Esta seguro de querer excluir esta información de este reporte?";
    }
    swal({
      text: texto,
      type: 'question',
      showCancelButton: true,
      confirmButtonText: 'ACEPTAR',
      confirmButtonColor: '#831F82',
      cancelButtonText: 'CANCELAR'
    }).then(function() {
        if (marcado==true) {
            $('#incluirRptPastaProc').prop("checked", true);
            $('#label-incluirRptPastaProc').text('EXCLUIR DEL REPORTE');
            guardarControlPiso();
        }else {
            $('#incluirRptPastaProc').prop("checked", false);            
            $('#label-incluirRptPastaProc').text('ADJUNTAR AL REPORTE');
            guardarControlPiso();
        }
    }, function(dismiss) {
      if (dismiss === 'cancel') {
        if (marcado==true) {
            $('#incluirRptPastaProc').prop("checked", false);
        }else {
            $('#incluirRptPastaProc').prop("checked", true);
        }
      }
    })
});
/******************AGREGA Y ACTUALIZA CONSUMO ELECTRICO************************/
function agregaActualizaConsumoElec() {
    var registroElectrico = new Array();    
    var fechaInicioCons = $('#fechaInicCons').val();    
    var fechaFinCons = $('#fechaFinCons').val();
    var consecutivoHTML= $("#consecutivo").text();
    var horaInicioCons = $('#horaInicioCons').val();
    var horaFinalCons = $('#horaFinalCons').val();
    var consumoInicial = $('#consumoInicial').val();
    var consumoFinal = $('#consumoFinal').val();

    registroElectrico[0] = fechaInicioCons + "," + fechaFinCons  + "," + horaInicioCons + "," + horaFinalCons + "," + consumoInicial + "," + consumoFinal + "," + consecutivoHTML;

    var form_data = {
        consumoElectrico: registroElectrico
    };

    $.ajax({
        url: "../guardarConsumoElect",
        type: "POST",
        async: true,
        data: form_data,
        success: function(data) {
            if (data == 1) {
                Materialize.toast('SE GUARDO CON ÉXITO', 1000);
            } else {
                Materialize.toast('ERROR AL GUARDAR', 1000);
            };
        }
    });
}
/****************GUARDANDO PASTA PROCESADA**********************/
function guardarPastaProcesada() {
    var codigo;
    if ($('#codigo').val()=="") {
        codigo = 0;
    }else {
        codigo = $('#codigo').val();
    }
    if ($('#descripcion').val()=="" || $('#tanque').val()==null || $('#undMedidad').val()=="" || $('#cantidad').val()=="") {
        mensajeAlerta("RELLENE LOS CAMPOS REQUERIDOS");
    } else {
        var info = new Array();
        info = {
            descripcion: $('#descripcion').val(),
            codigo: $('#codigo').val(),
            noTanque: $('#tanque').val(),
            undMedida: $('#undMedidad').val(),
            pstTanqueFinal: $('#cantidad').val(),
            consecutivo: $('#consecutivo').text()
        };
        form_data = {
            infoPasta: info
        }
        $.ajax({
            url: "../guardandoPastaProc",
            type: "post",
            async: true,
            data: form_data,
            success: function(data) {
                if (data == 1) {
                    Materialize.toast('SE GUARDO CON ÉXITO', 1000);
                } else {
                    Materialize.toast('ERROR AL GUARDAR', 1000);
                };
            }
        });
    };
}
/****************ELIMINANDO PASTA PROCESADA**********************************/
function eliminarPastaProc(idPastaProc) {
    swal({
        title: 'ELIMINAR',
        text: '¿Desea eliminar permanentemente este registro?',
        type: 'question',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonColor: '#831F82',
        confirmButtonText: 'ACEPTAR',
        cancelButtonText: 'CANCELAR'
    }).then(function() {
        $.ajax({
            url: "../eliminarPastaProces/" + idPastaProc,
            type: "POST",
            async: true,
            success: function(data) {
                if (data == true) {
                    location.reload();
                }
            }
        });
    });
}
/****************FILTRANDO TIPOS DE INSUMOS**********************************/
$("#tipoFibra").on('change', function(event) {
    var tipoInsumo = $('#tipoFibra').val();
    $.ajax({
        url: "../filtroInsumos/" + tipoInsumo,
        type: "POST",
        async: true,
        success: function(data) {
            $('#descripcionInsumo').empty();
            $.each(JSON.parse(data), function(i, item) {
                $("#descripcionInsumo").append('<option value="' + item['IdInsumo'] + '">' + item['Descripcion'] + '</option>');
            });
            $('#descripcionInsumo').trigger("chosen:updated");
        }
    });
});

/****************FILTRANDO ORDENES DE TRABAJO**********************************/
$("#ordProduccion").on('change', function(event) {
    var noOrden = $('#ordProduccion option:selected').text();
    noOrden = noOrden.split(" ");
    $.ajax({
        url: "filtrandoReportesTrabajo/" + noOrden[0],
        type: "POST",
        async: true,
        success: function(data) {
            $('#ordTrabajo').empty();
            $.each(JSON.parse(data), function(i, item) {
                $("#ordTrabajo").append('<option value="' + item['IdReporteDiario'] + '">' + item['consecutivo'] + '</option>');
            });
            $('#ordTrabajo').trigger("chosen:updated");
        }
    });
});
/****************GENERAR REPORTES****************************/
function generarReportes() {
    var ordenProd = $('#ordProduccion').val();
    var IdRptDiario = $("#ordTrabajo").val();
    var html = $("#ordTrabajo option:selected").text();
    var html2 = html.split("/");
    var consecutivo = html2[0];
    if (ordenProd==null) {
        mensajeAlerta('ESCOJA UNA ORDEN DE PRODUCCIÓN');
    }else if (!$('#rptDiario').is(':checked') && (!$('#rptControlPiso').is(':checked')) && (!$('#rptConsolidado').is(':checked'))) {
        mensajeAlerta('DEBE SELECCIONAR EL TIPO DE REPORTE QUE DESEA GENERAR');
    }else {
        if ($('#rptDiario').is(':checked') ) {
            window.open('reportesDiarios/' + IdRptDiario + '', '_blank');
        }
        if ($('#rptControlPiso').is(':checked') ) {
            window.open('reporteControlPiso/' + consecutivo + '', '_blank');
        }
        if ($('#rptConsolidado').is(':checked')) {
            window.open('reporteConsolidado/' + consecutivo + '', '_blank');
        }
    }
}

function generarRpt() {
    var meta = $('#selectMeta1').val();
    window.open('rptProdMensual/' + meta + '', '_blank');
}

$('#openModalPrd').click(function() {
    $('#modalSelectProd').openModal();
})

/****************CAMBIA EL ESTADO DEL REPORTE DIARIO*****************************/
function cambiaEstadoRptD(idRptDiario, estado) {
    var miTexto = "";
    if (estado == 1) {
        miTexto = "¿Desea activar esta orden de trabajo?";
    } else if (estado == 0) {
        miTexto = "¿Desea cerrar esta orden de trabajo?"
    }
    swal({
        title: '',
        text: miTexto,
        type: 'warning',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonColor: '#831F82',
        confirmButtonText: 'ACEPTAR',
        cancelButtonText: 'CANCELAR'
    }).then(function() {
        $.ajax({
            url: "cambiarEstadoRptDiario/" + idRptDiario + '/' + estado,
            type: 'post',
            async: true,
            success: function(data) {
                if (data == 1) {
                    location.reload();
                } else {
                    Materialize.toast('ERROR, NO SE PUDO CAMBIAR EL ESTADO', 7000);
                }
            }
        });
    });
}
/*******************ELIMINA UN REPORTE DIARIO SIN REGISTROS********************/
function elimarRptDiario(idRptDiario, consecutivoH, turnoH) {
    swal({
        title: '',
        text: '¿ELIMINAR ESTE REGISTRO?',
        type: 'warning',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonColor: '#831F82',
        confirmButtonText: 'ACEPTAR',
        cancelButtonText: 'CANCELAR'
    }).then(function() {
        var array = new Array();
        array = {
            idReporteDiario: idRptDiario,
            consecutivo: consecutivoH,
            turno: turnoH
        }
        form_data = {
            deleteInfoRptDiario: array
        }
        $.ajax({
            url: "validaRptDiario",
            type: 'post',
            async: true,
            data: form_data,
            success: function(data) {
                if (data == 'TRUE') {
                    mensajeAlerta('Este registro no se puede eliminar ya que hay uno o mas datos enlazados a el');
                } else if (data == 'FALSE') {
                    location.reload();
                } else if (data == "ERROR") {
                    Materialize.toast("ERROR AL BORRAR", 7000);
                };
            }
        });
    });
}
/******************CREAR Y LLENAR TABLA CARGAS PULPER**************************/
function crearTabla() {
    var cantColumns = 0;
    var cont1 = 0;
    var cont2 = 0;
    var cont3 = 0;
    var IdReporteDiario = $('#idRptD').val();

    $.ajax({
        url: "../listandoCargasPulper/" + IdReporteDiario,
        async: true,
        success: function(json) {
            var cantColumns=0;
            if (json != 'FALSE') { 
                var obj = $.parseJSON(json); var insumos = new Array(); var array = new Array();
                for (var i=0; i< obj.datos.length; i++) {
                    insumos = obj.datos[i]['insumos'];              
                }
                var html = '<table class="striped" id="tblCargasPulper"><thead>';
                html += '<tr class="tblcabecera"><th>TIPO DE FIBRA (KG)</th>';

                var cont = obj.datos[0]['totalFilas'];
                for (var i = 0; i < cont; i++) {
                    html += '<th>' + (cantColumns = cantColumns + 1) + '</th>';
                }
                html += '</tr></thead>';
                html += '<tbody>';
                for (var i = 0; i < insumos.length; i++) {
                    var nombreTemp=insumos[i]['Descripcion'];  
                    html += '<tr><td>' + insumos[i]['Descripcion'] + '</td>';
                    for (var e = 0; e < obj.datos.length; e++) {
                        if (nombreTemp == obj.datos[e]['Descripcion']) {     
                            html += '<td><input class="inputCP numeric" id="cargaN' + obj.datos[e]['IdCargaPulper'] + '" onchange="actualizandoCargasPulper(' + obj.datos[e]['IdCargaPulper'] + ', ' + obj.datos[e]['IdReporteDiario'] + ' ,this.value)" value="' + obj.datos[e]['Cantidad'] + '"/></td>';
                        };
                    }
                };
                html += '</tr>';
                html += '</tbody></table>';
                $("#btnAgregarf").after(html);
                $('#ocultar').hide();
    
            }
        }
    });
}

/******************GUARDAR PRODUCCION AJAX*****************************************/
function guardarProduccionDiaria() {
    if ($('#diaProduccion').val()=="") {
        mensajeAlerta("Tiene que seleccionar una fecha");
    }else {
        if (validandoRangoFechas($('#selectMetas option:selected').html(), $('#diaProduccion').val())==true) {
            var form_data = {
                meta: $('#selectMetas').val(),
                fecha: $('#diaProduccion').val(),
                val1: $('#val1').val(),
                val2: $('#val2').val(),
                val3: $('#val3').val(),
                val4: $('#val4').val(),
                val5: $('#val5').val(),
                val6: $('#val6').val(),
                val7: $('#val7').val(),
                val8: $('#val8').val(),
                val9: $('#val9').val(),
                val10: $('#val10').val(),
                tipo: 'i'
            };
            $.ajax({
                url: "guardarPD",
                type: "post",
                async: true,
                data: form_data,
                success: function(data) {
                    if (data == 1) {
                        swal({
                          title: 'Guardado con éxito!',
                          text: '¿Desea guardar otro registro?',
                          type: 'success',
                          showCancelButton: true,
                          confirmButtonText: 'Sí',
                          confirmButtonColor: '#831F82',
                          cancelButtonText: 'NO',
                        }).then(function() {
                            $('#diaProduccion').val('');
                            $('#val1').val('');
                            $('#val2').val('');
                            $('#val3').val('');
                            $('#val4').val('');
                            $('#val5').val('');
                            $('#val6').val('');
                            $('#val7').val('');
                            $('#val8').val('');
                            $('#val9').val('');
                            $('#val10').val('');
                            $('#diaProduccion').focus();
                        }, function(dismiss) {
                          if (dismiss === 'cancel') {
                            location.reload(true);
                          }
                        })
                    } else if (data==2) {
                        Materialize.toast('¡Ya existe un registro con esta fecha!', 2500, 'red');
                    }else {
                        Materialize.toast('ERROR AL GUARDAR', 1000);
                    };
                }
            });
        }else {
            Materialize.toast('El dia seleccionado no se encuentra en el rango de fechas', 3500, 'red');
        }
    }
}

/****************VALIDANDO RANGOS DE FECHAS************************/
function validandoRangoFechas(fecha1, fecha2) {
    f1 = fecha1.split("-");    
    var fecha = '';

    switch(f1[0]) {
        case 'enero ':            
            fecha = f1[1]+'-'+'01-01';
            break;
        case 'febrero ':
            fecha = f1[1]+'-'+'02-01';
            break;
        case 'marzo ':
            fecha = f1[1]+'-'+'03-01';
            break;
        case 'abril ':
            fecha = f1[1]+'-'+'04-01';
            break;
        case 'mayo ':
            fecha = f1[1]+'-'+'05-01';
            break;
        case 'junio ':
            fecha = f1[1]+'-'+'06-01';
            break;
        case 'julio ':
            fecha = f1[1]+'-'+'07-01';
            break;
        case 'agosto ':
            fecha = f1[1]+'-'+'08-01';
            break;
        case 'septiembre ':
            fecha = f1[1]+'-'+'09-01';
            break;
        case 'octubre ':
            fecha = f1[1]+'-'+'10-01';
            break;
        case 'noviembre ':
            fecha = f1[1]+'-'+'11-01';
            break;
        case 'diciembre ':
            fecha = f1[1]+'-'+'12-01';
            break;
    }
    fecha = new Date(fecha);
    fecha2 = new Date(fecha2);
    var primerDia = new Date(fecha.getFullYear(), fecha.getMonth(), 1);
    var ultimoDia = new Date(fecha.getFullYear(), fecha.getMonth() + 1, 0);

    if(fecha2.setDate(fecha2.getDate() + 1) >= primerDia && fecha2.setDate(fecha2.getDate() - 1) <= ultimoDia) {
        return true;
    }else {
        return false;
    }
}

/****************FILTRANDO METAS**********************************/
$("#selectMetas").on('change', function(event) {
    var meta = $('#selectMetas').val();
    $('#titleComp').text('Comportamiento de Producción mes de '+ $('#selectMetas option:selected').html());
    produccionDiariaTabla(meta);
});

/*GRAFICA PRODUCCION*/
$('#genGrafica').click( function() {
    var graficaProd = {     
        chart: {
            type: 'line',
            renderTo: 'container-graf'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            title: {
                text: ''
            },
                categories: [],
                type: 'datetime',
                dateTimeLabelFormats: {
                day: '%e of %b'
            }
        },
        yAxis: {
            title: {
                text: ''
            }                
        },
        tooltip: {
            crosshairs: true,
            shared: true
        },
        legend: {
            align: 'center',
            verticalAlign: 'top',
            borderWidth: 0
        },
        plotOptions: {
            spline: {
                marker: {
                    radius: 4,
                    lineColor: '#666666',
                    lineWidth: 1
                }
            }
        },
        series: [],

        responsive: {
            rules: [{
                condition: {
                maxWidth: 500
                },
                chartOptions: {
                    legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                    }
                }
            }]
        }
    };

    $.getJSON("dataGraficaProd", function(json) {
        var newseries;

        $.each(json, function (i, item) {
            newseries = {};
            newseries.showInLegend = true;
            newseries.data = item['Data'];
            newseries.name = item['Tipo'];              
            
            graficaProd.series.push(newseries);
        });
       var chart = new Highcharts.Chart(graficaProd);
    });

    $.getJSON("diasGraficaProd", function(json) {

        graficaProd.xAxis.categories = json.name;
        
        var chart = new Highcharts.Chart(graficaProd);
    });

    $('#tblPDiariaRpt').DataTable({
        ajax: "listarDataRpt",
        "destroy": true,
        "info": false,
        "bPaginate": false,
        "paging": true,
        "ordering": false,
        "pagingType": "full_numbers",
        "emptyTable": "No hay datos disponibles en la tabla",
        "lengthMenu": [[10,20,-1], [10,20,"Todo"]],
        "language": {
            "zeroRecords": "NO HAY RESULTADOS",
            "paginate": {
                "first":      "Primera",
                "last":       "Última ",
                "next":       "Siguiente",
                "previous":   "Anterior"                    
            },
            "lengthMenu": " _MENU_",
            "emptyTable": "NO HAY DATOS DISPONIBLES",
            "search":     "BUSCAR"
        },
        columns: [                     
            { "data": 'fecha', render: function (data) {
                data ='<span style="font-weight:bold">'+ moment(data).format('DD/MM/YYYY')+'</span>';
                return data; } },
            { "data": 'ep' },
            { "data": 'ch' },
            { "data": 'gen' }
        ]
    });
    $('#modalGraficaPM').openModal();
});
/******************CREAR Y LLENAR TABLA PRODUCCION DIARIA**************************/
function produccionDiariaTabla(meta) {
    $('#tblPD').DataTable({
        ajax: "listandoProduccionDiaria/" + meta,
        "destroy": true,
        "info":    false,
        "bPaginate": true,
        "paging": true,
        "ordering": false,
        "pagingType": "full_numbers",
        "emptyTable": "No hay datos disponibles en la tabla",
        "lengthMenu": [[10,20,30,-1], [10,20,30,"Todo"]],
        "language": {
            "zeroRecords": "NO HAY RESULTADOS",
            "paginate": {
                "first":      "Primera",
                "last":       "Última ",
                "next":       "Siguiente",
                "previous":   "Anterior"                    
            },
            "lengthMenu": " _MENU_",
            "emptyTable": "NO HAY DATOS DISPONIBLES",
            "search":     "BUSCAR"
        },
        columns: [                     
            { "data": 'fecha', render: function (data) {
                data ='<span style="font-weight:bold">'+ moment(data).format('DD/MM/YYYY')+'</span>';
                return data; } },
            { "data": '1' },
            { "data": '2' },
            { "data": '3' },
            { "data": '4' },
            { "data": '5' },
            { "data": '6' },
            { "data": '7' },
            { "data": '8' },
            { "data": '9' },
            { "data": '10' },
            { "data": 'TBD' },
            { "data": 'TNS' },
            { "data": 'OPC' }
        ],
        "fnInitComplete": function () {
          $('.dropdown-button').dropdown();
        }
    });
}

//Evento de la paginacion del datatable para los drown
$('#tblPD').on('draw.dt', function () {
      $('.dropdown-button').dropdown();
} );

function deleteProduccion(fechaBorrar, tipo) {
    swal({
        title: '',
        text: '¿Desea eliminar permanentemente este registro?',
        type: 'question',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonColor: '#831F82',
        confirmButtonText: 'ACEPTAR',
        cancelButtonText: 'CANCELAR'
    }).then(function() {
        $.ajax({
            url: "gestionarProdDiaria/" + fechaBorrar + "/" + tipo,
            type: "POST",
            async: true,
            success: function(data) {
                if (data == true) {
                    location.reload();
                }
            }
        });
    });
}

function editandoProduccion(fechaEditar, tipo) {
    $.ajax({
        url: "gestionarProdDiaria/" + fechaEditar + "/" + tipo,
        type: "POST",
        async: true,
        success: function(data) {
            $.each(JSON.parse(data), function(i, item) {
                $('#editarDia').val(item['fecha']),
                $('#val1-1').val(item['1']),
                $('#val2-2').val(item['2']),
                $('#val3-3').val(item['3']),
                $('#val4-4').val(item['4']),
                $('#val5-5').val(item['5']),
                $('#val6-6').val(item['6']),
                $('#val7-7').val(item['7']),
                $('#val8-8').val(item['8']),
                $('#val9-9').val(item['9']),
                $('#val10-10').val(item['10'])          
            });
        }
    });
    $('#modalEditarPrd').openModal();
}

function guardarEdicion() {
    var form_data = {
        meta: $('#selectMetas').val(),
        fecha: $('#editarDia').val(),
        val1: $('#val1-1').val(),
        val2: $('#val2-2').val(),
        val3: $('#val3-3').val(),
        val4: $('#val4-4').val(),
        val5: $('#val5-5').val(),
        val6: $('#val6-6').val(),
        val7: $('#val7-7').val(),
        val8: $('#val8-8').val(),
        val9: $('#val9-9').val(),
        val10: $('#val10-10').val(),
        tipo: 'u'
    };
    $.ajax({
        url: "guardarPD",
        type: "post",
        async: true,
        data: form_data,
        success: function(data) {
            if (data = 1) {
                swal({
                    title: " ",
                    text: 'Guardado con éxito!',
                    type: "success",
                    confirmButtonColor: '#831F82',
                    confirmButtonText: 'ACEPTAR'
                }).then(function() {
                    $("#modalEditarPrd").closeModal();
                    location.reload();
                    }
                );
            } else {
                Materialize.toast('ERROR AL GUARDAR', 1000);
            };
        }
    });
}

/****************ABRE EL MODEL PARA AGREGAR NUEVA PRODUCCION DIARIA*************************/
$("#nuevaProd").click(function() {
    $("#modalNuevaPrd").openModal();
});

/**************AGREGAR HORAS MOLIENDAS******************************/
function listarHorasMolienda() {
    var cantColumns = 0;
    var IdReporteDiario = $('#idRptD').val();
    $.ajax({
        url: "../listandoHorasMolienda/" + IdReporteDiario,
        type: "POST",
        async: true,
        success: function(json) {
            if (json != 'FALSE') {
                var obj = $.parseJSON(json);
                var html = '<table class="striped"><thead>';
                html += '<tr class="tblcabecera"><th>CARGA</th>'
                html += '<th>HORAS Y MINUTOS</th>';
                for (var i = 0; i < obj.length; i++) {
                    html += '<th>' + (cantColumns = cantColumns + 1);
                    html += '<a onclick="buscarHorasMolienda(' + obj[i]['IdHora'] + ')" href="#!" class="purple-text darken-4">';
                    html += '<i class="material-icons right">create</i></a>';
                    html += '</th>';
                };
                html += '</tr></thead>';
                html += '<tbody>';
                html += '<tr><td rowspan="3">BATIDO</td>'
                html += '<td>HORA INICIO</td>';
                for (var i = 0; i < obj.length; i++) {
                    html += '<td><span>' + obj[i]['horaInicio'] + '</span></td>';
                };
                html += '</tr>';
                html += '<tr><td>HORA FINAL</td>';
                for (var i = 0; i < obj.length; i++) {
                    html += '<td><span>' + obj[i]['horaFin'] + '</span></td>';
                };
                html += '</tr>';
                html += '<tr><td>TIEMPO</td>';
                for (var i = 0; i < obj.length; i++) {
                    html += '<td><span class="editar1">' + obj[i]['tiempo'] + '</span></td>';
                };
                html += '</tr>';
                html += '</tbody></table>';
                $("#btnAgregaHM").after(html);
                $('#ocultar2').hide();
            };
        }
    });
}
/****************BUSQUEDA POR ID HORAS MOLIENDA*********************/
function buscarHorasMolienda(idHoraMolienda) {
    $.ajax({
        url: "../buscarHorasMolienda/" + idHoraMolienda,
        type: 'POST',
        async: true,
        success: function(data) {
            if (data != 'FALSE') {
                $.each(JSON.parse(data), function(i, item) {
                    $('#timeHM12').val(item['horaInicio']),
                        $('#timeHM22').val(item['horaFin']),
                        $('#idHora').val(item['IdHora'])
                });
                $("#modal13").openModal();
            }
        }
    });
}
/*************ACTUALIZANDO HORA MOLIENDA***************************/
function actualizarHorasMolienda() {

    var form_data = {
        idHora: $('#idHora').val(),
        idRptD: $("#idRptD").val(),
        timepickerII: $('#timeHM12').val(),
        timepickerFF: $('#timeHM22').val()
    };
    $.ajax({
        url: "../actualizaHoraMolienda",
        type: "post",
        async: true,
        data: form_data,
        success: function(data) {

            console.log(data);
            if (data = 1) {
                Materialize.toast('SE ACTUALIZO CON ÉXITO', 1000);
                $('#descipcion').val('');
            } else {
                Materialize.toast('ERROR AL GUARDAR', 1000);
            };
        }
    });
}
/****************GUARDANDO HORAS MOLIENDA**********************/
function guardarHorasMolienda() {
    var result = validarControlesTM();
    if (result != false) {
        var form_data = {
            idRptD: $('#idRptD').val(),
            timepickerII: $('#timeHM1').val(),
            timepickerFF: $('#timeHM2').val()
        };
        $.ajax({
            url: "../agregarHorasMolienda",
            type: "post",
            async: true,
            data: form_data,
            success: function(data) {
                if (data == 1) {
                    Materialize.toast('SE GUARDO CON ÉXITO', 1000);
                    $('#descipcion').val('');
                } else {
                    Materialize.toast('ERROR AL GUARDAR', 1000);
                };
            }
        });
    };
}
/****************VALIDAR TIMEPICKER HORAS MOLIENDA****************************************/
function validarControlesTM() {
    var horaInicio = $('#timeHM1').val();
    var horaFinal = $('#timeHM2').val();
    var turno = $('#ordT').text();
    if (turno == "6:00am-6:00pm") {
        var h1F = moment(horaInicio, ["h:mm A"]).format("HH:mm");
        var h2F = moment(horaFinal, ["h:mm A"]).format("HH:mm");

        var h1C = moment('06:00AM', ["h:mm A"]).format("HH:mm");
        var h2C = moment('06:00PM', ["h:mm A"]).format("HH:mm");
        if (h1F < h1C || h2F > h2C) {
            mensajeAlerta('ESCOJA UNA HORA DE INICIO Y UNA FINAL ACORDE AL TURNO ACTUAL');
            return false
        } else {
            return true;
        }
    } else if (turno == "6:00pm-6:00am") {
        var h1F = moment(horaInicio, ["h:mm A"]).format("HH:mm");
        var h2F = moment(horaFinal, ["h:mm A"]).format("HH:mm");
        var AM = horaInicio.indexOf("AM");
        var PM = horaFinal.indexOf("PM");

        var h1C = moment('06:00PM', ["h:mm A"]).format("HH:mm");
        var h2C = moment('06:00AM', ["h:mm A"]).format("HH:mm");
        if (h1F < h1C && PM > 1) {
            mensajeAlerta('ESCOJA UNA HORA DE INICIO Y UNA FINAL ACORDE AL TURNO ACTUAL');
            return false;
        } else if (h1F < h1C && AM < 1) {
            mensajeAlerta('ESCOJA UNA HORA DE INICIO Y UNA FINAL ACORDE AL TURNO ACTUAL');
        } else if (h2F > h2C && AM > 1) {
            mensajeAlerta('ESCOJA UNA HORA DE INICIO Y UNA FINAL ACORDE AL TURNO ACTUAL');
            return false;
        } else if (h2F > h2C && PM < 1) {
            mensajeAlerta('ESCOJA UNA HORA DE INICIO Y UNA FINAL ACORDE AL TURNO ACTUAL');
            return false;
        } else { return true; }
    };
}
/************ACTUALIZANDO CARGAS PULPER****************************/
function actualizandoCargasPulper(idInsumo, IdReporteDiario, cantidad) {

    $.ajax({
        url: "../actualizarCargaPulper/" + idInsumo + '/' + IdReporteDiario + "/" + cantidad,
        type: "POST",
        async: true,
        success: function(data) {
            if (data=="del") {
                Materialize.toast('SE ELIMINO UN REGISTRO', 1000);
            }else if (data = true) {
                Materialize.toast('SE ACTUALIZO UN REGISTRO', 1000);
            } else {
                Materialize.toast('ERROR AL MOMENTO DE ACTUALIZAR', 1000);
            };
        }
    });
}
/*******************BUSCA CONSECUTIVO Y AÑADE EL SIGUIENTE**************/
$("#OrdeProd").click(function() {
    var numOrden = $('#lblnoOrden').text();

    var fechaInicio = new Date($('#txtFechaInicio').val());
    var fechaFinal = new Date($('#txtFechaFinal').val());

    var fechaFormat1 = moment(fechaInicio, 'MM/DD/YYYY');
    var fechaFormat2 = moment(fechaFinal, 'MM/DD/YYYY');
    var dias = fechaFormat2.diff(fechaFormat1, 'days');
    $.ajax({
        url: "buscaConsecutivo/" + dias + "/" + numOrden,
        type: "POST",
        async: true,
        success: function(data) {
            if (data == "") {
                mensajeAlerta('Esta orden no puede aceptar mas ordenes de trabajo');
            } else {
                $('#cons').val(data);
                $('#spanNoOrdenT').text(data);
                $("#ordenprod").openModal();
            };
        }
    });
});
/*******NUEVA ORDEN DE PRODUCCION GERENTE************************/
$('#guardaRpt').click(function() {
    var numOrden = $('#numOrden').val();
    var fechaInicio = $('#fechaInicio').val();
    var fechaFinal = $('#fechaFinal').val();

    if (numOrden == '' || fechaInicio == '' || fechaFinal == '') {
        mensajeAlerta('Todavia no ha rellenado los campos necesarios');
    } else {
        var f1 = new Date(fechaInicio);
        var f2 = new Date(fechaFinal);
        if (f1 > f2) {
            mensajeAlerta('La fecha inicial no puede ser mayor a la final');
        } else {
            if (numOrden.length > 4 || numOrden.length < 4) {
                mensajeAlerta('El número de reporte no tiene el formato correcto');
            } else {
                $('#formNuevoReporte').submit();
            };
        }
    };

});
/*******NUEVA ORDEN DE PRODUCCION SUPERVISOR************************/
$('#nuevaOrdProduccion').click(function() {
    var numOrden = $('#numOrden').val();
    if (numOrden == '' || fechaInicio == '' || fechaFinal == '') {
        mensajeAlerta('Todavia no ha rellenado los campos necesarios');
    } else {
        if (numOrden.length > 4 || numOrden.length < 4) {
            mensajeAlerta('El número de reporte no tiene el formato correcto');
        } else {
            $('#formNuevaOrden').submit();
        };        
    };
});
/****************GUARDA CONSECUTIVOS ORDEN DE PRODUCCION*******************************/
function guardarConsecutivo(noOrden) {
    var noOrden1 = noOrden;
    var fechaInicio = new Date($('#fechaInicio').val());
    var fechaFinal = new Date($('#fechaFinal').val());

    var fechaFormat1 = moment(fechaInicio, 'MM/DD/YYYY');
    var fechaFormat2 = moment(fechaFinal, 'MM/DD/YYYY');
    var dias = fechaFormat2.diff(fechaFormat1, 'days');
    $.ajax({
        url: "consecutivo/" + dias + "/" + noOrden1,
        type: "POST",
        async: true,
        success: function(data) {}
    });
}
/****************GUARDAR TIEMPO MUERTO***************************/
function validarControlesTiempoMuertos() {
    var result = false;
    var horaInicio = $('#timepickerII').val();
    var horaFinal = $('#timepickerFF').val();
    var maquina = $('#maquina').val();
    var descipcion = $('#descipcion').val();
    var turno = $('#ordT').text();
    if (horaInicio == "" || horaFinal == "") {
        mensajeAlerta('ESCOJA UNA HORA DE INICIO Y UNA FINAL');
        return false;
    } else {
        if (turno == "6:00pm-6:00am") {
            var h1F = moment(horaInicio, ["h:mm A"]).format("HH:mm");
            var h2F = moment(horaFinal, ["h:mm A"]).format("HH:mm");
            var AM = horaInicio.indexOf("AM");
            var PM = horaFinal.indexOf("PM");

            var h1C = moment('06:00PM', ["h:mm A"]).format("HH:mm");
            var h2C = moment('06:00AM', ["h:mm A"]).format("HH:mm");
            if (h1F < h1C && PM > 1) {
                mensajeAlerta('ESCOJA UNA HORA DE INICIO Y UNA FINAL ACORDE AL TURNO ACTUAL');
                return false;
            } else {
                if (h1F < h1C && AM < 1) {
                    mensajeAlerta('ESCOJA UNA HORA DE INICIO Y UNA FINAL ACORDE AL TURNO ACTUAL');
                } else {
                    if (h2F > h2C && AM > 1) {
                        mensajeAlerta('ESCOJA UNA HORA DE INICIO Y UNA FINAL ACORDE AL TURNO ACTUAL');
                        return false;
                    } else {
                        if (h2F > h2C && PM < 1) {
                            mensajeAlerta('ESCOJA UNA HORA DE INICIO Y UNA FINAL ACORDE AL TURNO ACTUAL');
                            return false;
                        } else {
                            if (maquina == "") {
                                mensajeAlerta('SELECCIONE UNA MAQUINA');
                                return false;
                            } else {
                                if (descipcion == "") {
                                    mensajeAlerta('ESCRIBA UNA DESCRIPCIÓN');
                                    return false;
                                } else {};
                            };
                        };
                    }

                };

            }
        } else {
            if (turno == "6:00am-6:00pm") {
                var h1F = moment(horaInicio, ["h:mm A"]).format("HH:mm");
                var h2F = moment(horaFinal, ["h:mm A"]).format("HH:mm");

                var h1C = moment('06:00AM', ["h:mm A"]).format("HH:mm");
                var h2C = moment('06:00PM', ["h:mm A"]).format("HH:mm");
                if (h1F < h1C || h2F > h2C) {
                    mensajeAlerta('ESCOJA UNA HORA DE INICIO Y UNA FINAL ACORDE AL TURNO ACTUAL');
                    return false;
                } else {
                    if (maquina == "") {
                        mensajeAlerta('SELECCIONE UNA MAQUINA');
                        //return false;
                    } else {
                        if (descipcion == "") {
                            mensajeAlerta('ESCRIBA UNA DESCRIPCIÓN');
                            //return false;
                        } else {};
                    };
                };
            };
        }
    }
}

/****************ABRE EL MODEL PARA CREAR NUEVA ORDEN DE PRODUCCION*************************/
$("#crearR").click(function() {
    $.ajax({
        url: "validarNoOrden",
        type: "POST",
        async: true,
        success: function(data) {
            if (data == true) {
                mensajeAlerta('Ya existe una orden activa, cierre la anterior y agrege una nueva');
            } else {
                $("#nuevoReporte").openModal();
            }
        }
    });
});

/****************ABRE EL MODEL PARA AGREGAR NUEVO TIEMPO MUERTO*************************/
$("#agregarTM").click(function() {
    var val1 = $('#ordC').text();
    var val2 = $('#ordP').text();
    var val3 = $('#ordT').text();
    $('#consecutivo').val(val1);
    $('#ordP1').val(val2);
    $('#turno1').val(val3);
    $("#nuevoTiempoMuerto").openModal();
});

/****************VALIDAR FECHA DE ORDEN DE PRODUCCION***************************************/
$("#valOrdP7").on('click', function() {
    $.ajax({
        url: "validaFechaNoOrden",
        type: "POST",
        async: true,
        success: function(data) {
            var fechaOrdF = moment(data, 'YYYY-MM-DD');
            var hoy = moment(new Date(), 'YYYY-MM-DD');
            if (fechaOrdF < hoy) {
                $.ajax({
                    url: "cambiarEstadoRpt",
                    type: "POST",
                    async: true,
                    success: function() {
                        gotopage("ordProduccion");
                    }
                })
            } else {
                gotopage("ordProduccion");
            };
        }
    });
});
/****************GUARDANDO TIEMPOS MUERTOS**********************/
function guardarTM1() {

    var result = validarControlesTiempoMuertos();
    if (result == false) {} else {
        var form_data = {
            idRptD: $('#idRptD').val(),
            ordP1: $('#ordP1').val(),
            consecutivo: $('#consecutivo').val(),
            turno1: $('#turno1').val(),
            timepickerII: $('#timepickerII').val(),
            timepickerFF: $('#timepickerFF').val(),
            maquina: $('#maquina').val(),
            descipcion11: $('#descipcion').val()
        };
        $.ajax({
            url: "../guardarTM",
            type: "post",
            async: true,
            data: form_data,
            success: function(data) {
                if (data = 1) {
                    Materialize.toast('SE GUARDO CON ÉXITO', 1000);
                    $('#descipcion').val('');
                } else {
                    Materialize.toast('ERROR AL GUARDAR', 1000);
                };
            }

        });
    }
}

/****************GUARDAR TIEMPO MUERTO***************************/
function validarControlesTiempoMuertos() {
    var result = false;
    var horaInicio = $('#timepickerII').val();
    var horaFinal = $('#timepickerFF').val();
    var maquina = $('#maquina').val();
    var descipcion = $('#descipcion').val();
    var turno = $('#ordT').text();
    if (horaInicio == "" || horaFinal == "") {
        mensajeAlerta('ESCOJA UNA HORA DE INICIO Y UNA FINAL');
        return false;
    } else {
        if (turno == "6:00pm-6:00am") {
            var h1F = moment(horaInicio, ["h:mm A"]).format("HH:mm");
            var h2F = moment(horaFinal, ["h:mm A"]).format("HH:mm");
            var AM = horaInicio.indexOf("AM");
            var PM = horaFinal.indexOf("PM");

            var h1C = moment('06:00PM', ["h:mm A"]).format("HH:mm");
            var h2C = moment('06:00AM', ["h:mm A"]).format("HH:mm");
            if (h1F < h1C && PM > 1) {
                mensajeAlerta('ESCOJA UNA HORA DE INICIO Y UNA FINAL ACORDE AL TURNO ACTUAL');
                return false;
            } else {
                if (h1F < h1C && AM < 1) {
                    mensajeAlerta('ESCOJA UNA HORA DE INICIO Y UNA FINAL ACORDE AL TURNO ACTUAL');
                } else {
                    if (h2F > h2C && AM > 1) {
                        mensajeAlerta('ESCOJA UNA HORA DE INICIO Y UNA FINAL ACORDE AL TURNO ACTUAL');
                        return false;
                    } else {
                        if (h2F > h2C && PM < 1) {
                            mensajeAlerta('ESCOJA UNA HORA DE INICIO Y UNA FINAL ACORDE AL TURNO ACTUAL');
                            return false;
                        } else {
                            if (maquina == "") {
                                mensajeAlerta('SELECCIONE UNA MAQUINA');
                                return false;
                            } else {
                                if (descipcion == "") {
                                    mensajeAlerta('ESCRIBA UNA DESCRIPCIÓN');
                                    return false;
                                } else {};
                            };
                        };
                    }

                };

            }
        } else {
            if (turno == "6:00am-6:00pm") {
                var h1F = moment(horaInicio, ["h:mm A"]).format("HH:mm");
                var h2F = moment(horaFinal, ["h:mm A"]).format("HH:mm");

                var h1C = moment('06:00AM', ["h:mm A"]).format("HH:mm");
                var h2C = moment('06:00PM', ["h:mm A"]).format("HH:mm");
                if (h1F < h1C || h2F > h2C) {
                    mensajeAlerta('ESCOJA UNA HORA DE INICIO Y UNA FINAL ACORDE AL TURNO ACTUAL');
                    return false;
                } else {
                    if (maquina == "") {
                        mensajeAlerta('SELECCIONE UNA MAQUINA');
                        //return false;
                    } else {
                        if (descipcion == "") {
                            mensajeAlerta('ESCRIBA UNA DESCRIPCIÓN');
                            //return false;
                        } else {};
                    };
                };
            };
        }
    }
}
/****************GUARDANDO CARGAS PULPER**********************/
function guardarCargaPulper() {
    if ($('#idRptD').val() == "" || $('#tipoFibra').val() == null || $('#cantidad').val() == "") {
        mensajeAlerta('AUN NO HA RELLENADO TODOS LOS CAMPOS');
    } else {
        var form_data = {
            idReporteDiario: $('#idRptD').val(),
            tipoFibra: $('#tipoFibra').val(),
            cantidad: $('#cantidad').val()
        };
        $.ajax({
            url: "../guardarCP",
            type: "post",
            async: true,
            data: form_data,
            success: function(data) {
                if (data == 1) {
                    Materialize.toast('SE GUARDO CON ÉXITO', 1000);
                    $('#cantidad').val('');
                    $('#cantidad').focus();
                } else {
                    Materialize.toast('ERROR AL GUARDAR', 1000);
                };
            }

        });
    };
}
/****************ELIMAR TIEMPO MUERTO*********************************************************/
function eliminarTM(idTiempoMuerto, IdReporteDiario) {

    swal({
        title: 'ELIMINAR',
        text: '¿Desea eliminar permanentemente este registro?',
        type: 'question',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonColor: '#831F82',
        confirmButtonText: 'ACEPTAR',
        cancelButtonText: 'CANCELAR'
    }).then(function() {
        $.ajax({
            url: "../eliminarTM/" + idTiempoMuerto + "/" + IdReporteDiario,
            type: "POST",
            async: true,
            success: function(data) {
                if (data == true) {
                    location.reload();
                }
            }
        });
    });
}
/****************VALIDA SI EL NUMERO DE ORDEN YA EXISTE***************************************/
$("#numOrden").on('change', function(event) {
    var numOrden = $('#numOrden').val();
    $.ajax({
        url: "validarReporte/" + numOrden,
        type: "POST",
        async: true,
        success: function(data) {
            if (data == true) {
                mensajeAlerta('El número de orden ya existe');
                $('#numOrden').val("");
            }
        }
    });
    $("#numOrden").focus();
});
/*********CAMBIAR ESTADO A REPORTE**************************/
function cambiaStatusRpt(idOrden, numOrden, estado) {
    var idOrd = idOrden;
    var numOrd = numOrden;
    var status = estado;
    var miMSS = "";

    switch (estado) {
        case 0:
            $.ajax({
                url: "validaRpt/" + numOrd,
                async: true,
                success: function(data) {
                    if (data == true) {
                        swal({
                            title: '',
                            text: 'Esta orden tiene registros, ¿desea anularla de todos modos?',
                            type: 'warning',
                            showCloseButton: true,
                            showCancelButton: true,
                            confirmButtonColor: '#831F82',
                            confirmButtonText: 'ACEPTAR',
                            cancelButtonText: 'CANCELAR'
                        }).then(function() {
                            confirmacionCambioStatus('¿Desea anular esta orden de producción?', 'ANULAR', idOrd, status);
                        });
                    } else {
                        confirmacionCambioStatus('¿Desea anular esta orden de producción?', 'ANULAR', idOrd, status);
                    }
                }
            });
            break;
        case 1:
            $.ajax({
                url: "validarNoOrden",
                type: "POST",
                async: true,
                success: function(data) {
                    if (data == true) {
                        swal({
                            title: 'Ya existe una orden activa',
                            text: '¿Desea dar de baja a la anterior y agregar esta como orden activa?',
                            type: 'warning',
                            showCloseButton: true,
                            showCancelButton: true,
                            confirmButtonColor: '#831F82',
                            confirmButtonText: 'ACEPTAR',
                            cancelButtonText: 'CANCELAR'
                        }).then(function() {
                            cambiaOrdenActiva(idOrd, 3);
                            /*$.ajax({
                                url: "FechaInicio/" + numOrd,
                                type: "post",
                                async: true,
                                success: function(data) {
                                    var fecha3 = moment(data).format('DD/MM/YYYY');
                                    var fec2 = new Date();
                                    var fecha4 = moment(fec2).format('DD/MM/YYYY');
                                    if (fecha3 >= fecha4) {
                                        cambiaOrdenActiva(idOrd, 3);
                                    } else {
                                        swal({
                                            title: "",
                                            text: 'Esta orden no puede ser seleccionada como activa porque su fecha de inicio ya caduco',
                                            type: 'warning',
                                            confirmButtonColor: '#831F82',
                                            confirmButtonText: 'CERRAR'
                                        }).then()
                                    };
                                }
                            });*/

                        });
                    } else { cambiaOrdenActiva(idOrd, 3); }
                }
            });
            break;
        case 2:
            swal({
                title: "CAMBIAR ESTADO",
                text: '¿Desea cerrar esta orden?',
                type: 'warning',
                showCloseButton: true,
                confirmButtonColor: '#831F82',
                confirmButtonText: 'CERRAR',
                showCancelButton: true,

                cancelButtonText: 'Cancelar',
            }).then(function() {
                $.ajax({
                    url: "cambiarEstadoRpt/" + idOrd + "/" + status,
                    type: "post",
                    async: true,
                    success: function() {
                        swal({
                            title: "EL ESTADO DE LA ORDEN SE CAMBIO CORECTAMENTE!",
                            type: "success",
                            confirmButtonText: "CERRAR",
                        }).then(
                            function() { location.reload(); }
                        )
                    }
                })
            });
            break;

    }
}
/****************FUNCION PARA CAMBIAR STATUS DE LA ORDEN DE PRODUCCION********************/
function confirmacionCambioStatus(mensaje, textbutton, idOrden, status) {
    swal({
        title: "CAMBIAR ESTADO",
        text: mensaje,
        type: 'warning',
        showCloseButton: true,
        confirmButtonColor: '#831F82',
        confirmButtonText: textbutton,
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
    }).then(function() {
        $.ajax({
            url: "cambiarEstadoRpt/" + idOrden + "/" + status,
            type: "post",
            async: true,
            success: function() {
                swal({
                    title: "EL ESTADO DE LA ORDEN SE CAMBIO CORECTAMENTE!",
                    type: "success",
                    confirmButtonText: "CERRAR",
                }).then(
                    function() { location.reload(); }
                )
            }
        });
    })
}

/***************MENSAJE NOTIFICACION*****************************************/
function mensajeAlerta(mensaje) {
    swal({
        title: '',
        text: mensaje,
        type: 'warning',
        showCloseButton: true,
        confirmButtonColor: '#831F82',
        confirmButtonText: 'ACEPTAR',
    }).then();
}

/****************DANDO DE BAJA A ORDENES DE PRODUCCION******************************/
function cambiaOrdenActiva(idOrden, status) {
    var codigoUnico = idOrden;
    $.ajax({
        url: "cambiarOrdenActiva/" + codigoUnico,
        async: true,
        success: function(data) {
            if (data == true) {
                swal({
                    text: "SE CAMBIO A ACTIVA LA ORDEN SELECCIONADA",
                    type: "success",
                    confirmButtonText: "CERRAR",
                }).then(
                    function() { location.reload(); }
                )
            } else {
                swal({
                    text: "LA ORDEN SELECCIONADA NO PUEDE SER MARCADA COMO ACTIVA",
                    type: "warning",
                    confirmButtonText: "CERRAR",
                }).then()
            };
        }
    });
}
/****************ACTUALIZAR ORDEN DE PRODUCCION***************************/
$('#actualizarRpt').click(function() {
    var codUnico = $('#numOrden1').val();
    $.ajax({
        url: "validaRpt/" + codUnico,
        async: true,
        success: function(data) {
            if (data == true) {
                mensajeAlerta('No se puede editar esta orden ya que existen uno o más registros enlazados a ella');
            } else {
                swal({
                    title: " ",
                    text: 'Actualizado con éxito!',
                    type: "success",
                    confirmButtonColor: '#831F82',
                    confirmButtonText: 'ACEPTAR'
                }).then(
                    function() {
                        $('#formActualizarOrd').submit();
                    }
                )
            };
        }
    });
});

function buscarOrdProd(identificador) {
    var codigoUnico = identificador;
    $("#actualizarRpt").show();
    $("#title1").show();
    $("#title2").hide();
    $.ajax({
        url: "buscarOrden/" + codigoUnico,
        async: true,
        success: function(json) {
            var estadoA = "";
            $.each(JSON.parse(json), function(i, item) {
                estadoA = item['Estado'],
                    $('#identificador').val(item['IdOrden'])
                $('#numOrden1').val(item['NoOrden']),
                    $('#fechaInicio1').val(item['FechaInicio']),
                    $('#fechaFinal1').val(item['FechaFin']),
                    $('#comentario1').val(item['comentarios'])
            })
            if (estadoA == 0) {
                $("#actualizarRpt").hide();
                $("#title2").show();
                $("#title1").hide();
            };
            $("#nuevaOrdenP").openModal();
        }
    });
}
$('.dropdown-button').click(function() {
    $(this).dropdown();
});

/*****************BUSCAR TIEMPO MUERTO POR ID****************************/
function buscarTiempoM(identificador) {
    $.ajax({
        url: "../detalleTiempoMuerto/" + identificador,
        async: true,
        success: function(json) {
            $.each(JSON.parse(json), function(i, item) {
                //$('#IdReporteDiario').text(item['IdReporteDiario']),
                $('#HoraInicio').text(item['HoraInicio']),
                    $('#HoraFin').text(item['HoraFin']),
                    $('#Maquina').text(item['Maquina']),
                    $('#Descrip').val(item['Descripcion']),
                    $('#interval').text(item['Intervalos']),
                    $('#turno').text(item['Turno']);
            })
            $("#visTiempoM").openModal();
        }
    });
}

/*****************BUSCAR TURNO POR ID****************************/
function buscandoTurnoById(idTurno) {
    var tipo="";
    $.ajax({
        url: "actulizarTurnos/" + idTurno,
        async: true,
        success: function(json) {
            $.each(JSON.parse(json), function(i, item) {
                $('#idTurno').val(item['IdTurno']),
                $('#horaInicioTurno2').val(moment(item['horaInicio'], ["HH:mm"]).format("h:mm A")),
                $('#horaFinalTurno2').val(moment(item['horaFinal'], ["HH:mm"]).format("h:mm A")),
                $('#comentario2').val(item['Comentario']),
                tipo = item['tipo']
            })
            if (tipo == 'M') {                
                $("#tMatutinoA").prop('checked', true);
            }else if (tipo == "MX") {
                $("#tMixtoA").prop('checked', true);
            }else if (tipo == "N") {
                $("#tNocturnoA").prop('checked', true);
            }
            $("#actualizarRegistro").openModal();
        }
    });
}
/*******************ACTUALIZANDO REGISTRO TURNO***********************************/
function actualizandoTurno() {
    var array = new Array();
    var tipoC = "";
    if ($('#tMatutinoA').prop('checked')) {
        tipoC = $('#tMatutinoA').val();
    }else if ($('#tMixtoA').prop('checked')) {
        tipoC = $('#tMixtoA').val();
    }else if ($('#tNocturnoA').prop('checked')) {
        tipoC = $('#tNocturnoA').val();
    }
    var concat = String($('#horaInicioTurno2').val()) + '-' + String($('#horaFinalTurno2').val());
    array = {
        Turno: concat,
        horaInicio: $('#horaInicioTurno2').val(),
        horaFinal: $('#horaFinalTurno2').val(),
        Comentario: $('#comentario2').val(),
        tipo: tipoC
    }
    form_data = {
        dataTurno: array
    }
    $.ajax({
        url: "actualizandoTurno/" + $('#idTurno').val(),
        type: 'post',
        async: true,
        data: form_data,
        success: function(data) {
            if (data == '1') {
                mensajeAlerta('Se actualizo con éxito');
            } else {
                Materialize.toast("ERROR AL ACTUALIZAR", 7000);
            };
        }
    });
    location.reload();
}

/***************GUARDAR TURNO******************************************/
function agregandoNuevoTurno() {
    var array = new Array();
    var tipoC = "";
    if ($('#tMatutino').prop('checked')) {
        tipoC = $('#tMatutino').val();
    }else if ($('#tMixto').prop('checked')) {
        tipoC = $('#tMixto').val();
    }else if ($('#tNocturno').prop('checked')) {
        tipoC = $('#tNocturno').val();
    }

    if ($('#horaInicioTurno').val()=="" || $('#horaFinalTurno').val()=="" || $('#comentario').val()=="") {
        mensajeAlerta('¡TIENE QUE RELLENAR TODOS LOS CAMPOS!');
    } else {
        var concat = String($('#horaInicioTurno').val()) + '-' + String($('#horaFinalTurno').val());
        array = {
            Turno: concat,
            horaInicio: moment($('#horaInicioTurno').val(), ["h:mm A"]).format("HH:mm"),
            horaFinal: moment($('#horaFinalTurno').val(), ["h:mm A"]).format("HH:mm"),
            Comentario: $('#comentario').val(),
            tipo: tipoC,
            estado: 1
        }
        form_data = {
            data_turno: array
        }
        $.ajax({
            url: "guardandoNuevoTurno",
            type: 'post',
            async: true,
            data: form_data,
            success: function(data) {
                if (data == 'true') {
                    mensajeAlerta('Se guardo con éxito');
                } else {
                    Materialize.toast("ERROR AL GUARDAR", 7000);
                };
            }
        });
        location.reload();
        };
}

/************************ELIMINADO TURNO***********************************/
function eliminarTurnoById(idTurno) {
    swal({
        text: "¿Esta seguro de eliminar al usuario?",
        type: 'warning',
        showCloseButton: true,
        confirmButtonColor: '#831F82',
        confirmButtonText: 'ACEPTAR',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
    }).then(function() {
        $.ajax({
            url: "elimarTurno/" + idTurno,
            type: "post",
            async: true,
            success: function(data) {
                if(data=="true") {
                    swal({
                        title: "SE ELIMINO CON ÉXITO EL REGISTRO!",
                        type: "success",
                        confirmButtonText: "CERRAR",
                    }).then(
                        function() { location.reload(); }
                    )
                }                
            }
        });
    })
}
/*************************************RESTAURAR TURNO********************************************/
function restaurarTurnoById(idTurno) {
    swal({
        text: "¿Esta seguro de querer restaurar el registro?",
        type: 'warning',
        showCloseButton: true,
        confirmButtonColor: '#831F82',
        confirmButtonText: 'ACEPTAR',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
    }).then(function() {
        $.ajax({
            url: "restTurno/" + idTurno,
            type: "post",
            async: true,
            success: function(data) {
                if(data=="true") {
                    swal({
                        title: "SE RESTAURO CON ÉXITO EL REGISTRO!",
                        type: "success",
                        confirmButtonText: "CERRAR",
                    }).then(
                        function() { location.reload(); }
                    )
                }                
            }
        });
    })
}

/********************************************************************************************** */
$('#cerrarMdl').click(function() {
    $("#visTiempoM").closeModal();
});
function gotopage(mypage) {
    $(location).attr('href', mypage);
}
function cerrarModales(modal, recargar) {
    if (recargar==true) {
        $("#"+modal).closeModal();
        location.reload();
    }else {
        $("#"+modal).closeModal();
    }
}
/*/////////////////////////////////////////////////////////////////////////////////////////
                                    FIN MIS FUNCIONES
//////////////////////////////////////////////////////////////////////////////////////////*/



/*/////////////////////////////////////////////////////////////////////////////////////////
                                FUNCIONES SOBRE Id's Tablas
//////////////////////////////////////////////////////////////////////////////////////////*/
$('#BuscarUsuarios').on('keyup', function() {
    var table = $('#TblMaster').DataTable();
    table.search(this.value).draw();
});

$('#filtrarRpt').on('keyup', function() {
    var table = $('#tlbListaRep2').DataTable();
    table.search(this.value).draw();
});

$('#filTablePlanDetalle').on('keyup', function() {
    var table = $('#tblDetPlan').DataTable();
    table.search(this.value).draw();
});

$('#BuscarINS').on('keyup', function() {
    var table = $('#tblIns').DataTable();
    table.search(this.value).draw();

    //$("#TblMaster_filter").hide();filtrarTM
});

$('#Buscar').on('keyup', function() {
    var table = $('#tblMaquinas').DataTable();
    table.search(this.value).draw();

});

$('#BuscarUsuarios').on('keyup', function() {
    var table = $('#TblMaster').DataTable();
    table.search(this.value).draw();

    //$("#TblMaster_filter").hide();
});

$('#filtrarRep').on('keyup', function() {
    var table = $('#tlbListaRep').DataTable();
    table.search(this.value).draw();
});

$('#BuscarTanq').on('keyup', function() {
    var table = $('#tblTanques').DataTable();
    table.search(this.value).draw();
});

$('#BuscarPlan').on('keyup', function() {
    var table = $('#tblPlan').DataTable();
    table.search(this.value).draw();
});

$("#tlbListaRep2").DataTable({
    "ordering": false,
    "info": false,
    "bPaginate": false,
    "bfilter": true,
    "pagingType": "full_numbers",
    "aaSorting": [
        [0, "asc"]
    ],
    "language": {
        "emptyTable": "No hay datos disponible en la tabla",
        "lengthMenu": "_MENU_",
        "loadingRecords": "",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ registro",
        "infoEmpty": "Mostrando 0 a 0 de 0 registro",
        "infoFiltered": "(filtrado de _MAX_ registros totales)",
        "zeroRecords": "No se han encontrado resultados para tu búsqueda",
        "paginate": {
            "first": "Primera",
            "last": "Última ",
            "next": "Anterior",
            "previous": "Siguiente"
        }
    }
});


$("#tablaProd, #tlbListaRep3, #tlbTiemposMuertos, #tlbListaRep, #tlbTiemposMuertos2, #TblMaster, #tblMaquinas, #tblIns, #tblTanques, #chkTanques, #tblDetPlan,#tblPlan").DataTable({
    "ordering": false,
    "info": false,
    "bPaginate": true,
    "bfilter": true,
    "pagingType": "full_numbers",
    "aaSorting": [
        [0, "asc"]
    ],
    "lengthMenu": [
        [20, 10, -1],
        [20, 30, "Todo"]
    ],
    "language": {
        "emptyTable": "No hay datos disponible en la tabla",
        "lengthMenu": "_MENU_",
        "loadingRecords": "",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ registro",
        "infoEmpty": "Mostrando 0 a 0 de 0 registro",
        "infoFiltered": "(filtrado de _MAX_ registros totales)",
        "zeroRecords": "No se han encontrado resultados para tu búsqueda",
        "paginate": {
            "first": "Primera",
            "last": "Última ",
            "next": "Anterior",
            "previous": "Siguiente"
        }
    }
});

$("#tblControlPiso, #tblPastaProc, #chkInsumo, #chkInsumo3, #chktanques, #chkInsumo2").DataTable({
    "ordering": false,
    "info": false,
    "bPaginate": false,
    "bfilter": false,
    "language": {
        "emptyTable": "No hay datos disponible en la tabla",
        "lengthMenu": "_MENU_",
        "loadingRecords": "",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ registro",
        "infoEmpty": "Mostrando 0 a 0 de 0 registro",
        "infoFiltered": "(filtrado de _MAX_ registros totales)",
        "zeroRecords": "No se han encontrado resultados para tu búsqueda",
        "paginate": {
            "first": "Primera",
            "last": "Última ",
            "next": "Anterior",
            "previous": "Siguiente"
        }
    }
});

/*/////////////////////////////////////////////////////////////////////////////////////////
                                FIN FUNCIONES SOBRE USUARIO
//////////////////////////////////////////////////////////////////////////////////////////*/

$("#rol").change(function() {
    if ($(this).val() == "5") {
        $("#Pass").hide();
        $("#lblPass").hide();
        $("#PassC").hide();
        $("#lblPassC").hide();
    } else {
        $("#Pass").show();
        $("#lblPass").show();
        $("#PassC").show();
        $("#lblPassC").show();
    }
});
// VALIDACION DE PASSWORD //
$("#Adduser").click(function() {
    var pass = $("#Pass").val();
    var passc = $("#PassC").val();
    var priv = $("#rol").val().trim();
    if (pass != passc) {
        swal({
            text: "Las contraseñas no coinciden, " +
                " inténtelo nuevamente",
            type: 'warning',
            confirmButtonText: 'cerrar'
        });
        event.preventDefault();
    } else if (pass.length < 6 && priv != "5") {
        swal({
            text: "La contraseña debe tener como mínimo 6 dígitos, " +
                " inténtelo nuevamente",
            type: 'info',
            confirmButtonText: 'cerrar'
        });
        event.preventDefault();
    }
});


// VALIDACION DE CAMPOS VACIOS //
$("#Adduser").click(function() {
    var user = $("#Usuario").val();
    var nomc = $("#NombreC").val();
    var priv = $("#rol").val().trim();
    var pasw = $("#Pass").val();
    if (pasw == "" && priv == "5") {
        pasw = null;
    }
    if (user == "" | nomc == "" | priv == "" | pasw == "") {
        swal({
            text: "TODOS LOS CAMPOS SON REQUERIDOS, " +
                " DEBE COMPLETAR EL CAMPO FALTANTE",
            confirmButtonText: "cerrar",
            type: "info"
        }).then(function() {
            if (user == "") {
                $("#Usuario").focus();
            }
            if (nomc == "") {
                $("#NombreC").focus();
            }
            if (pasw == "") {
                $("#Pass").focus();
            }
            if (priv == "") {
                swal({
                    text: "Debe seleccionar un Rol para el usuario",
                    type: "info",
                    confirmButtonText: "cerrar"
                });
            }
        });
        event.preventDefault();
    }
});
////// EVITAR EL DOBLE ENVIO DE FORMULARIO//////
function checksubmit(form) {
    $("#Adduser").hide();
    $("#load").show();
    return true;
}

function BorrarUsuario(IdUsuario, Estado) {

    if (Estado == 1) {
        var miMSS = "¿DESEA CAMBIAR EL ESTADO ACTIVO AL USUARIO?";
    } else { var miMSS = "¿DESEA CAMBIAR EL ESTADO INACTIVO AL USUARIO?"; }

    swal({
        title: '',
        text: miMSS,
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#831F82',
        confirmButtonText: 'Cambiar',
        cancelButtonText: 'Cancelar'
    }).then(function() {

        $.ajax({
            url: "EditarUsuario/" + IdUsuario + "/" + Estado,
            type: "post",
            async: true,
            success: function(json) {
                swal({
                    title: "EL USUARIO SE CAMBIO CORRECTAMENTE!",
                    type: "success",
                    confirmButtonText: "CERRAR"
                }).then(
                    function() { gotopage("Usuarios"); }
                )
            }
        });
    })
}


/*/////////////////////////////////////////////////////////////////////////////////////////
                                 FUNCIONES SOBRE ORDENES
//////////////////////////////////////////////////////////////////////////////////////////*/

$("#AddOrden").click(function() {

    var Fechainicio = $("#Fechainicio").val();
    var Fechafin = $("#Fechafin").val();
    var papel = $("#papel").val();
    var coordinador = $("#coordinador").val();
    var Turno = $('#turno option:selected').val();
    if (Fechainicio == "" | Fechafin == "" | papel == "" | coordinador == "" | Turno == "") {
        swal({
            text: "Todos los campos son requeridos",
            type: "info",
            confirmButtonText: "CERRAR"
        });
        event.preventDefault();
    }

    var fec = Fechainicio.substring(8);
    var fec1 = Fechafin.substring(8);
    if (fec > fec1) {
        swal({
            text: "La fecha de inicio no puede ser mayor a la fecha final",
            type: "info",
            confirmButtonText: "CERRAR"
        });
        event.preventDefault();
    }
});

$('#turno').change(function() {
        var Fecha = $("#Fechainicio").val();
        var turno = $('#turno option:selected').val();
        var consecutivo = $("#cons").val();
        var ajax = $.ajax({
            url: "ValidaFecha/" + Fecha + "/" + turno + "/" + consecutivo,
            type: "POST",
            async: true,
            success: function(data) {

                if (data == true) {
                    swal({
                        title: " ",
                        text: 'ya existe una registro de produccion con la misma fecha de inicio y turno ' + " para la orden " + consecutivo,
                        type: 'warning',
                        showCloseButton: true,
                        confirmButtonColor: '#831F82',
                        confirmButtonText: 'ACEPTAR'
                    });
                }
            }
        });
    })
    /*/////////////////////////////////////////////////////////////////////////////////////////
                                    FIN FUNCIONES SOBRE ORDENES
    //////////////////////////////////////////////////////////////////////////////////////////*/



/*/////////////////////////////////////////////////////////////////////////////////////////
                                 FUNCIONES SOBRE PRODUCCION
//////////////////////////////////////////////////////////////////////////////////////////*/
$("#agregarP").click(function() {
    $('#nuevaProduccion').openModal();
});


function Guardar() {

    var form_data = {
        idRptD: $("#idRptD").val(),
        NoOrden: $("#NoOrden").val(),
        timepickerII: $("#timepickerII").val(),
        timepickerFF: $("#timepickerFF").val(),
        operador: $("#operador option:selected").val(),
        maquina: $("#maquina option:selected").val(),
        Velocidad: $("#Velocidad").val(),
        peso: $("#peso").val(),
        Diametro: $("#Diametro").val(),
        pesobase: $("#pesobase").val(),
        merma: $("#merma").val()
    };
    var envio = $.ajax({
        url: "../GuardaProduccion",
        type: "post",
        async: true,
        data: form_data,
        beforeSend: function() {
            var horain = $("#timepickerII").val(),
                horafin = $("#timepickerFF").val(),
                oper = $("#operador option:selected").val(),
                maq = $("#maquina option:selected").val(),
                vel = $("#Velocidad").val(),
                peso = $("#peso").val(),
                diam = $("#Diametro").val(),
                pesobase = $("#pesobase").val(),
                merma = $("#merma").val();
            if (horain == "" | horafin == "" | oper == "" | maq == "" | peso == "" | pesobase == "" | diam == "" | merma == "") {
                swal({
                    type: "info",
                    text: "TODOS LOS CAMPOS SON REQUERIDOS" + ", " + "DEBE COMPLETAR EL CAMPO FALTANTE",
                    confirmButtonText: "CERRAR"
                });
                envio.abort();
                envio = null;
            }
        },
        success: function(data) {
            if (data = 1) {

                swal({
                    type: "success",
                    text: "SE GUARDO CORRECTAMENTE",
                    confirmButtonText: "CERRAR"
                }).then(function() {
                    $("#timepickerII").val("")
                    $("#timepickerFF").val("")
                    $("#operador option:selected").val()
                    $("#maquina option:selected").val()
                    $("#peso").val("")
                    $("#Diametro").val("")
                    $("#pesobase").val("")
                });
            } else {
                Materialize.toast('ERROR AL GUARDAR', 1000);
            }
        }
    });
}

function EliminarProd(elem, IDretp) {
    var id = $(elem).attr("id");
    var IDretp = $("#idRptD").val();
    swal({
        title: '¿Estas seguro que deseas eliminar este registro?',
        text: 'esta operacion no podra revertirse',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#831F82',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
    }).then(function() {
        $.ajax({
            url: "../EliminarProduccion/" + id + "/" + IDretp,
            async: true,
            success: function() {
                swal({
                    text: "El registro se ha elimando correctamente",
                    type: "success",
                    confirmButtonText: "CERRAR"
                }).then(
                    function() {
                        location.reload();
                    }
                )
            }
        });
    })
}

function EditarProd(Operador, Maquina, HoraInicio, HoraFin, Velocidad, Peso, Diametro, PesoBase) {
    $("#lbloperador").text(Operador);
    $("#lblmaq").text(Maquina);
    $("#lblhorain").text(HoraInicio)
    $("#lblhorafin").text(HoraFin)
    $("#lblvelocidad").text(Velocidad)
    $("#lblpeso").text(Peso)
    $("#lbldiametro").text(Diametro)
    $("#lblpesobase").text(PesoBase)
    $("#Detalles").openModal();
}

function Actualizamerm() {
    var IdReporteDiario = $("#idRptD").val(),
        Merma = $("#Merma").val(),
        Maquina = $("#Maquina option:selected").val();
    swal({
        text: '¿Estas seguro que deseas modificar la cantidad de merma para esta maquina?',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#831F82',
        confirmButtonText: 'Actualizar',
        cancelButtonText: 'Cancelar'
    }).then(function() {
        var AJAX = $.ajax({
            url: "../ActualizarMerma/" + IdReporteDiario + '/' + Merma + "/" + Maquina,
            type: "POST",
            async: true,
            beforeSend: function(data) {
                if (Merma == "" | Maquina == "") {
                    swal({
                        text: "Debe seleccionar una maquina e ingresar la cantidad de merma," +
                            " verifica  los datos e inténtalo nuevamente",
                        type: "warning",
                        confirmButtonText: "CERRAR"
                    });
                    AJAX.abort();
                }
            },
            success: function(data) {
                if (data = true) {
                    swal({
                        text: "CANTIDAD MERMA ACTUALIZADA",
                        type: "success",
                        confirmButtonText: "CERRAR"
                    }).then(
                        function() {
                            location.reload();
                        }
                    )
                } else {
                    swal({
                        text: "ERROR AL ACTUALIZAR CANTIDAD MERMA",
                        type: "error",
                        confirmButtonText: "CERRAR"
                    }).then(
                        function() {
                            location.reload();
                        }
                    )
                };
            }
        });
    })

}

/*/////////////////////////////////////////////////////////////////////////////////////////
                               FIN  FUNCIONES SOBRE PRODUCCION
//////////////////////////////////////////////////////////////////////////////////////////*/

/*/////////////////////////////////////////////////////////////////////////////////////////
                                FUNCIONES SOBRE MATERIA PRIMA
//////////////////////////////////////////////////////////////////////////////////////////*/
function Guardarmp() {

    var form_data1 = {
        idRptD: $("#idRptD").val(),
        Tanque: $("#Tanque").val(),
        dia: $("#dia").val(),
        noche: $("#noche").val(),
        dia1: $("#dia1").val(),
        noche1: $("#noche1").val(),
        consumo: $("#consumo").val()
    };
    var AJAX = $.ajax({
        url: "../GuardarMP",
        type: "POST",
        async: true,
        data: form_data1,
        beforeSend: function(data) {

            var tanq = $("#Tanque").val(),
                day = $("#dia").val(),
                night = $("#noche").val(),
                consu = $("#consumo").val();
            if (tanq == "TANQUES" | day == "" | night == "" | consu == "") {
                swal({
                    text: "Todos los campos son requeridos",
                    type: "info",
                    confirmButtonText: "CERRAR"
                });
                AJAX.abort();
            }
        },
        success: function(data) {
            if (data = 1) {
                Materialize.toast('SE GUARDO CON ÉXITO', 1000);
            } else {
                Materialize.toast('ERROR AL GUARDAR', 1000);
            }
        }
    });
}

$('#Tanque').on("change", function() {
    var tanque = $('#Tanque option:selected').val(),
        ID = $("#idRptD").val();
    var ajax = $.ajax({
        url: "../ValidaPasta/" + tanque + "/" + ID,
        type: "POST",
        async: true,
        success: function(data) {
            if (data == true) {
                swal({
                    title: " ",
                    text: 'ya existe una registro con el tanque #' + tanque,
                    type: 'warning',
                    showCloseButton: true,
                    confirmButtonColor: '#831F82',
                    confirmButtonText: 'ACEPTAR'
                });
                $("#matprim").hide();
            } else {
                $("#matprim").show();
            }
        }
    });
})

function guardaInsumos() {
    var form_data = {
        idRptd: $("#idRptd").val(),
        Dia: $("#Dia").val(),
        Noche: $("#Noche").val(),
        ptadia: $("#ptadia").val(),
        ptanoche: $("#ptanoche").val(),
        Dia1: $("#Dia1").val(),
        Noche1: $("#Noche1").val(),
        ptadia1: $("#ptadia1").val(),
        ptanoche1: $("#ptanoche1").val(),
        descripcion: $("#descripcion option:selected").val()
    };
    var AJAX = $.ajax({
        url: "../GuardarMPInsumos",
        type: "POST",
        async: true,
        data: form_data,
        beforeSend: function(data) {
            var Dia = $("#Dia").val(),
                Noche = $("#Noche").val(),
                ptadia = $("#ptadia").val(),
                ptanoche = $("#ptanoche").val(),
                descripcion = $("#descripcion").val();
            if (Dia == "" | Noche == "" | ptadia == "" | ptanoche == "" | descripcion == null) {
                swal({
                    text: "Todos los campos son requeridos",
                    type: "info",
                    confirmButtonText: "CERRAR"
                });
                AJAX.abort();
            }
        },
        success: function(data) {
            if (data = 1) {
                Materialize.toast('SE GUARDO CON ÉXITO', 1000);
            } else {
                Materialize.toast('ERROR AL GUARDAR', 1000);
            }
        }
    });
}

$('#descripcion').on("change", function() {
    var descrip = $('#descripcion option:selected').val(),
        id = $("#idRptd").val();
    var ajax = $.ajax({
        url: "../ValidaMPInsumo/" + id + "/" + descrip,
        type: "POST",
        async: true,
        success: function(data) {
            if (data == true) {
                swal({
                    title: " ",
                    text: 'ya existe una registro con la misma desripcion para este insumo',
                    type: 'warning',
                    showCloseButton: true,
                    confirmButtonColor: '#831F82',
                    confirmButtonText: 'ACEPTAR'
                });
                $("#btninsumo").hide();
            } else {
                $("#btninsumo").show();
            }
        }
    })
});

function DetalleInsumo(Descripcion, Dia, Noche, Cantidad_PTA_Agua_Dia, Cantidad_PTA_Agua_Noche) {
    $("#lblDescripcion").text(Descripcion);
    $("#lblDia").text(Dia);
    $("#lblNoche").text(Noche);
    $("#lblptadia").text(Cantidad_PTA_Agua_Dia);
    $("#lblptanoche").text(Cantidad_PTA_Agua_Noche);
    $("#DetallesIns").openModal();

}

function DetallePasta(Tanque, Dia, Noche, Consumo) {
    $("#lblTanque").text(Tanque);
    $("#lbldia").text(Dia);
    $("#lblnoche").text(Noche);
    $("#lblconsumo").text(Consumo);
    $("#DetallesPasta").openModal();

}

function EliminarInsumo(elem, idrpt) {

    var id = $(elem).attr("id");
    var idrpt = $("#idRptD").val();
    swal({
        title: '¿Estas seguro que deseas eliminar este registro?',
        text: 'esta operacion no podra revertirse',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#831F82',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
    }).then(function() {
        $.ajax({
            url: "../EliminaMPInsumos/" + id + "/" + idrpt,
            async: true,
            success: function() {
                swal({
                    text: "El registro se ha elimando correctamente",
                    type: "success",
                    confirmButtonText: "CERRAR"
                }).then(
                    function() {
                        location.reload();
                    }
                )
            }
        });
    })
}

function Eliminarpasta(elem, idrpt) {

    var id = $(elem).attr("id");
    var idrpt = $("#idRptD").val();
    swal({
        title: '¿Estas seguro que deseas eliminar este registro?',
        text: 'esta operacion no podra revertirse',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#831F82',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
    }).then(function() {
        $.ajax({
            url: "../EliminaPasta/" + id + "/" + idrpt,
            async: true,
            success: function() {
                swal({
                    text: "El registro se ha elimando correctamente",
                    type: "success",
                    confirmButtonText: "CERRAR"
                }).then(
                    function() {
                        location.reload();
                    }
                )
            }
        });
    })
}
/////////////////FUNCIONES SOBRE MAQUINAS////////////////////////////
function GuardarMaquina() {

    var form_data = {
        maquina: $("#maquina").val(),
        comentario: $("#comentario").val()
    };

    var AJAX = $.ajax({
        url: "Guardarmaquina",
        type: "POST",
        async: true,
        data: form_data,
        beforeSend: function(data) {
            var maq = $("#maquina").val();
            var com = $("#comentario").val();
            if (maq == "" | com == "") {
                swal({
                    text: "Todos los campos son requeridos",
                    type: "info",
                    confirmButtonText: "CERRAR",
                });
                AJAX.abort();
            }
        },
        success: function(data) {

            if (data = 1) {
                Materialize.toast('SE GUARDO CON ÉXITO', 1000);
            } else {
                Materialize.toast('ERROR AL GUARDAR', 1000);
            }
        }
    });
}

function EliminaMaquina(elem, descripcion) {
    swal({
        title: '¿Estas seguro que deseas eliminar este registro?',
        text: 'esta operacion no podra revertirse',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#831F82',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
    }).then(function() {

        $.ajax({
            url: "Eliminarmaquina/" + elem + "/" + descripcion,
            async: true,
            success: (function() {
                swal({
                    text: "El registro se ha elimando correctamente",
                    type: "success",
                    confirmButtonText: "CERRAR"
                }).then(
                    function() {
                        location.reload();
                    }
                )
            })
        });
    })

}

function cerrarModalMaq() {
    $("#Maquinasmodal").closeModal();
    location.reload();
}

/////////////////FUNCIONES SOBRE INSUMOS////////////////////////////

function Guardarinsumos() {

    var form_data = {
        Descripcion: $("#Descripcion").val(),
        categoria: $("#categoria").val(),
        unidadmedida: $("#unidadmedida").val(),
        tipo: $("#tipo").val()
    };

    var AJAX = $.ajax({
        url: "GuardaInsumos",
        type: "POST",
        async: true,
        data: form_data,
        beforeSend: function(data) {
            var desc = $("#Descripcion").val();
            var cat = $("#categoria").val();
            var unidad = $("#unidadmedida").val();
            var tipo = $("#tipo").val();
            if (desc == "" | cat == "") {
                swal({
                    text: "Todos los campos son requeridos",
                    type: "info",
                    confirmButtonText: "CERRAR",
                });
                AJAX.abort();
            }
        },
        success: function(data) {

            if (data = 1) {
                Materialize.toast('SE GUARDO CON ÉXITO', 1000);
                $("#Descripcion").val("");
                $("#categoria option:selected").val();
            } else {
                Materialize.toast('ERROR AL GUARDAR', 1000);
            }
        }
    });
}
function EliminaINS(elem) {
    swal({
        title: '¿Estas seguro que deseas eliminar este registro?',
        text: 'esta operacion no podra revertirse',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#831F82',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
    }).then(function() {

        $.ajax({
            url: "EliminaInsumo/" + elem,
            async: true,
            success: (function() {
                swal({
                    text: "El registro se ha elimando correctamente",
                    type: "success",
                    confirmButtonText: "CERRAR"
                }).then(
                    function() {
                        location.reload();
                    }
                )
            })
        });
    })

}
/*******************FILTRA POR ESTADOS DE TURNOS*******************************/
$("#turnActivo").on("change",function(){
    if($("#turnActivo").is(":checked")){
        $(".1").show();
    }
    else{
        $(".1").css("display","none");
    }
});
$("#turnInactivo").on("change",function(){
    if($("#turnInactivo").is(":checked")){
        $(".2").show();
    }
    else{
        $(".2").css("display","none");
    }
});
/******************************************************************************/


/*******************FILTRA POR ESTADOS DE ORDENES DE PRODUCCION*******************************/
    $("#ordActiva").on( 'change', function() {
        if(!$(this).is(':checked') ) {
            $( ".OrdenActiva" ).removeClass( "OrdenActiva" ).addClass( "nomostrarOrdenAct" );
        }else {
            $( ".nomostrarOrdenAct" ).removeClass( "nomostrarOrdenAct" ).addClass( "OrdenActiva" );
        }
    });
    $("#ordCerrada").on( 'change', function() {
        if($(this).is(':checked') ) {
            $( ".nomostrarOrdenCerr" ).removeClass( "nomostrarOrdenCerr" ).addClass( "OrdenCerrada" );
        }else {
            $( ".OrdenCerrada" ).removeClass( "OrdenCerrada" ).addClass( "nomostrarOrdenCerr" );
        }
    });
    $("#ordAnulada").on( 'change', function() {
        if($(this).is(':checked') ) {
            $( ".nomostrarOrdenAnul" ).removeClass( "nomostrarOrdenAnul" ).addClass( "OrdenAnulada" );
        }else {
            $( ".OrdenAnulada" ).removeClass( "OrdenAnulada" ).addClass( "nomostrarOrdenAnul" );
        }
    });
    $("#ordInactiva").on( 'change', function() {
        if($(this).is(':checked') ) {            
            $( ".nomostrarOrdenInac" ).removeClass("nomostrarOrdenInac").addClass( "OrdenInactiva" );
        }else {
            $( ".OrdenInactiva" ).removeClass( "OrdenInactiva" ).addClass( "nomostrarOrdenInac" );
        }
    });

    /*******************FILTRA POR MAQUINAS/TIEMPOS MUERTOS*******************************/
    $("#maquina1").on( 'change', function() {
        if($(this).is(':checked') ) {
            $( ".mostrarMaquina2" ).removeClass( "mostrarMaquina2" ).addClass( "noMostrarMaquina2" );
            $( ".mostrarMaquina3" ).removeClass( "mostrarMaquina3" ).addClass( "noMostrarMaquina3" );
        }else {
            $( ".noMostrarMaquina2" ).removeClass( "noMostrarMaquina2" ).addClass( "mostrarMaquina2" );
            $( ".noMostrarMaquina3" ).removeClass( "noMostrarMaquina3" ).addClass( "mostrarMaquina3" );
        }
    });
    $("#maquina2").on( 'change', function() {
        if($(this).is(':checked') ) {
            $( ".mostrarMaquina1" ).removeClass( "mostrarMaquina1" ).addClass( "noMostrarMaquina1" );
            $( ".mostrarMaquina3" ).removeClass( "mostrarMaquina3" ).addClass( "noMostrarMaquina3" );
        }else {
            $( ".noMostrarMaquina1" ).removeClass( "noMostrarMaquina1" ).addClass( "mostrarMaquina1" );
            $( ".noMostrarMaquina3" ).removeClass( "noMostrarMaquina3" ).addClass( "mostrarMaquina3" );
        }
    });
    $("#maquina3").on( 'change', function() {
        if($(this).is(':checked') ) {
            $( ".mostrarMaquina1" ).removeClass( "mostrarMaquina1" ).addClass( "noMostrarMaquina1" );
            $( ".mostrarMaquina2" ).removeClass( "mostrarMaquina2" ).addClass( "noMostrarMaquina2" );
        }else {
            $( ".noMostrarMaquina1" ).removeClass( "noMostrarMaquina1" ).addClass( "mostrarMaquina1" );
            $( ".noMostrarMaquina2" ).removeClass( "noMostrarMaquina2" ).addClass( "mostrarMaquina2" );
        }
    });

/****************************************FUNCIONES SOIBRE PLANES********************************************************/
function guardaplan() {
    var form_data = {
        fecha: $("#fecha").val(),
        comentario: $("#comentario").val()
    };
    $.ajax({
        url: "Guardaplan",
        type: "POST",
        async: true,
        data: form_data,
        beforeSend: function(data) {
            var fecha = $("#fecha").val();
            var comentario = $("#comentario").val();
            if (fecha == "" || comentario == "") {
                swal({
                    text: "Todos los campos son requeridos",
                    type: "warning",
                    confirmButtonText: "CERRAR"
                });
                $.ajax.abort();
            }
        },
        success: function(data) {
            swal({
                text: "Guardado con exito",
                type: "success",
                confirmButtonText: "CERRAR"
            }).then(
                function() {
                    location.reload();
                }
            );
        }
    });
}

function EditarPlan(IdPlan, Fecha, Comentario) {
    $("#IdPlan").val(IdPlan);
    $("#Fecha").val(Fecha);
    $("#Comentario").val(Comentario);
    $("#ModalPlanEdit").openModal();

}

function actualizaPlan() {

    var form_data = {
        IdPlan: $("#IdPlan").val(),
        Fecha: $("#Fecha").val(),
        Comentario: $("#Comentario").val()
    };
    $.ajax({
        url: "ActualizaPlan",
        type: "POST",
        data: form_data,
        async: true,
        success: function(data) {

            if (data == "FALSE") {
                swal({
                    text: "Este plan no se puede modificar ya que hay uno o mas datos enlazados a el",
                    type: "error",
                    confirmButtonText: "CERRAR"
                });
            } else if (data == "TRUE") {
                swal({
                    text: "Se actualizo correctamente",
                    type: "success",
                    confirmButtonText: "CERRAR"
                }).then(function() {
                    location.reload();
                });
            } else if (data = "ERROR") {
                swal({
                    text: "No se pudo actualizar el plan",
                    type: "error",
                    confirmButtonText: "CERRAR"
                });
            }
        }
    });
}

/***************FUNCIONES SOBRE TANQUES****************** */
function guardatanque() {
    var form_data = {
        tanque: $("#tanque").val()
    };
    $.ajax({
        url: "GuardaTanques",
        type: "POST",
        data: form_data,
        async: true,
        beforeSend: function(data) {
            var tanque = $("#tanque").val();
            if (tanque == "") {
                swal({
                    text: "No puede dejar vacio este campo",
                    type: "warning",
                    confirmButtonText: "CERRAR"
                });
                $.ajax.abort();
            }

        },
        success: function(data) {
            swal({
                text: "Guardado con exito",
                type: "success",
                confirmButtonText: "CERRAR"
            }).then(
                function() {
                    location.reload();
                }
            );
        }
    });
}

function DeleteTanq(elem, descripcion) {
    swal({
        title: '¿Estas seguro que deseas eliminar este registro?',
        text: 'esta operacion no podra revertirse',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#831F82',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
    }).then(function() {
        $.ajax({
            url: "EliminarTanques/" + elem + "/" + descripcion,
            type: "POST",
            async: true,
            success: function() {
                swal({
                    text: "El tanque se elimino correctamente",
                    type: "success",
                    confirmButtonText: "CERRAR"
                }).then(function() {
                    location.reload();
                });
            }
        });
    })
}

/***************FIN FUNCIONES SOBRE TANQUES*******************/
function GuardaDetPlan() {
    var table = $('#chkInsumo').DataTable();
    var insumos1 = new Array();
    var insumos2 = new Array();
    var insumos3 = new Array();
    var tanques = new Array();
    var Posi = 0;
    table.rows().eq(0).each(function(index) {
        var id = $("#idplan").val();
        var cat = $("#categorias").val();
        var row = table.row(index);
        var data = row.data();
        var idInsumo = data[0];
        if ($('#chkinsumo' + data[0]).is(':checked')) {
            insumos1[Posi] = id + "," + cat + "," + data[0];
            Posi++;
        }
    });

    var table = $('#chkInsumo2').DataTable();
    var Posi = 0;
    table.rows().eq(0).each(function(index) {
        var id = $("#idplan").val();
        var cat = $("#categorias").val();
        var row = table.row(index);
        var data = row.data();
        var idInsumo = data[0];
        if ($('#chkinsumo' + data[0]).is(':checked')) {
            insumos2[Posi] = id + "," + cat + "," + data[0];
            Posi++;
        }
    });

    var table = $('#chkInsumo3').DataTable();
    var Posi = 0;
    table.rows().eq(0).each(function(index) {
        var id = $("#idplan").val();
        var cat = $("#categorias").val();
        var row = table.row(index);
        var data = row.data();
        var idInsumo = data[0];
        if ($('#chkinsumo' + data[0]).is(':checked')) {
            insumos3[Posi] = id + "," + cat + "," + data[0];
            Posi++;
        }
    });

    var table = $('#chktanques').DataTable();
    var Posi = 0;
    table.rows().eq(0).each(function(index) {
        var id = $("#idplan").val();
        var cat = $("#categorias").val();
        var row = table.row(index);
        var data = row.data();
        var idTanque = data[0];
        if ($('#chk' + data[0]).is(':checked')) {
            tanques[Posi] = id + "," + cat + "," + data[0];
            Posi++;
        }
    });

    var form_data = {
        insumos1: insumos1,
        insumos2: insumos2,
        insumos3: insumos3,
        tanques: tanques
    };
    $.ajax({
        url: "../GuardarDetalles",
        type: "POST",
        async: true,
        data: form_data,
        beforeSend: function(data) {

            var cat = $("#categorias").val();
            if (cat == null) {
                swal({
                    text: "Debe seleccionar una categoria",
                    type: "warning",
                    confirmButtonText: "CERRAR"
                });
                $.ajax.abort();
            }
        },
        success: function(data) {
            if (data = 1) {
                swal({
                    text: "Guardado con exito",
                    type: "success",
                    confirmButtonText: "CERRAR"
                }).then(
                    function() {
                        location.reload();
                    }
                );
                console.log(form_data);
            }
        }
    });
}

function EliminaDetPlan(elem, descripcion, idPlanHTML) {
    var id = $(elem).attr('id');
    var array = new Array();
    array = {
        idDetalle: id,
        descripcion: descripcion,
        idPlan: idPlanHTML
    };
    form_data = {
        deleteDetalle: array
    }
    swal({
        text: '¿ELIMINAR ESTE REGISTRO?',
        type: 'warning',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'ELIMINAR',
        confirmButtonColor: '#831F82',
        cancelButtonText: 'CANCELAR'
    }).then(function() {
        $.ajax({
            url: "../EliminaDetalles",
            type: "POST",
            async: true,
            data: form_data,
            success: function() {
                swal({
                    text: "El registro se ha eliminado",
                    type: "success",
                    confirmButtonText: "cerrar"
                }).then(function() {
                    location.reload();
                });
            }
        });
    })
}

/******************************FUNCIONES PARA METAS PRODUCCION***************************************/
$("#btnnuevameta").on("click", function () {
    $("#nuevaMeta").openModal();
});

function editar(id, consecutivo, fecha, dias, eco1, eco2, cholin1, cholin2, generico1, generico2, cholinhd1, bolson, cholinhd2, papFacial,estmeta) {
    $("#idMeta").val(id);
    $("#consecutivometaedit").val(consecutivo);
    $("#selected").val(fecha);
    $("#selected").text(fecha);
    $("#eco1edit").val(eco1);
    $("#eco2edit").val(eco2);
    $("#cholin1edit").val(cholin1);
    $("#cholin2edit").val(cholin2);
    $("#generico1edit").val(generico1);
    $("#generico2edit").val(generico2);
    $("#cholinhd1edit").val(cholinhd1);
    $("#bolsonedit").val(bolson);
    $("#cholinhd2edit").val(cholinhd2);
    $("#papielFacedit").val(papFacial);
    $("#estadoMeta").val(estmeta);
    $("#cantDiasedit").val(dias);

    $("#FechaMetaedit").trigger("chosen:updated");
    $("#actualizaMeta").openModal();

}

function creaTabla() {
    $.ajax({
        url: "ArticuloAjax",
        async: true,
        success: function (json) {
            var obj = $.parseJSON(json);
            var html = '<table class="stripped" id="tblMetas"><thead style="font-size:12px;"><tr>';
            html += '<th class=""></th>';
            var array = new Array();
            for (var i = 0; i < obj.data.length; i++) {
                array = obj.data[i]["Descripcion"]
                html += '<th class="tblcabecera">' + obj.data[i]["Descripcion"] + '</th>';
            }
            html += "</tr>";
            html += "</thead>";
            html += '<tbody><tr>';
            html += '<td style="background:#dabce2;">Pesos</td>';
            for (var i = 0; i < obj.data.length; i++) {
                array = obj.data[i]["Peso"]
                html += '<td style="background:#dabce2;">' + obj.data[i]['Peso'] + '</td>';
            }

            html += "</tr>";
            html += "</tbody></table>";
            $("#contenedor").html(html);
        }
    });
}

$("#BtnGuardarMeta").on("click", function () {
    var form_data = {
        consecutivometa: $("#consecutivometa").val(),
        FechaMeta: $("#FechaMeta option:selected").val(),
        cantDias: $("#cantDias").val(),
        eco1: $("#eco1").val(),
        eco2: $("#eco2").val(),
        cholin1: $("#cholin1").val(),
        cholin2: $("#cholin2").val(),
        generico1: $("#generico1").val(),
        generico2: $("#generico2").val(),
        cholinhd1: $("#cholinhd1").val(),
        bolson: $("#bolson").val(),
        cholinhd2: $("#cholinhd2").val(),
        papielFac: $("#papielFac").val()
    };
    $.ajax({
        url: "GuardarMetas",
        async: true,
        data: form_data,
        success: function (data) {
            if (true) {
                swal({
                    text: "Meta producción guardada con éxito!",
                    type: "success",
                    confirmButtonText: "ACEPTAR"
                }).then(function () {
                    location.reload();
                });
            }else {
                swal({
                    text: "Algo salió mal, contáctese con el administrador!",
                    type: "error",
                    confirmButtonText: "CERRAR"
                });
            }
        }
    });
});


$("#BtnActualizarMeta").on("click", function () {
    var form_data = {
        idMeta: $("#idMeta").val(),
        FechaMetaedit: $("#FechaMetaedit option:selected").val(),
        cantDiasedit: $("#cantDiasedit").val(),
        eco1edit: $("#eco1edit").val(),
        eco2edit: $("#eco2edit").val(),
        cholin1edit: $("#cholin1edit").val(),
        cholin2edit: $("#cholin2edit").val(),
        generico1edit: $("#generico1edit").val(),
        generico2edit: $("#generico2edit").val(),
        cholinhd1edit: $("#cholinhd1edit").val(),
        bolsonedit: $("#bolsonedit").val(),
        cholinhd2edit: $("#cholinhd2edit").val(),
        papielFacedit: $("#papielFacedit").val()
    };

    $.ajax({
        url: "ActualizarMetas",
        async: true,
        data: form_data,
        success: function (data) {
            if (true) {
                swal({
                    text: "Meta producción actualizada con éxito!",
                    type: "success",
                    confirmButtonText: "ACEPTAR"
                }).then(function () {
                    location.reload();
                });
            } else {
                swal({
                    text: "Algo salió mal, contáctese con el administrador!",
                    type: "error",
                    confirmButtonText: "CERRAR"
                });
            }
        }
    });
});


function EliminarMeta(elem) {
    var id = $(elem).attr("id");
    swal({
        text: '¿ELIMINAR ESTE REGISTRO?',
        type: 'warning',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'ELIMINAR',
        confirmButtonColor: '#831F82',
        cancelButtonText: 'CANCELAR'
    }).then(function () {
        $.ajax({
            url: "EliminaMeta/" + elem,
            type: "POST",
            async: true,
            success: function () {
                swal({
                    text: "El registro se ha eliminado",
                    type: "success",
                    confirmButtonText: "cerrar"
                }).then(function () {
                    location.reload();
                });
            }
        });
    })
}


function cambiarState(id, estado)
{
    if (estado == 1) {
        var miMSS = "¿DESEA CAMBIAR EL ESTADO 'ACTIVO' A ESTA META?";
    } else {
        var miMSS = "¿DESEA CAMBIAR EL ESTADO 'INACTIVO' A ESTA META?";
    }
    swal({
        text: miMSS,
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#1e75bc',
        confirmButtonText: 'Cambiar',
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#c63939'
    }).then(function () {
        $.ajax({
            url: "ModifEstado/" + id + "/" + estado,
            type: "POST",
            success: function () {
                swal({
                    title: "EL estado se cambió correctamente!",
                    type: "success",
                    confirmButtonText: "ACEPTAR"
                }).then(function () {
                    location.reload();
                });
            }
        });
    });
}
/******************************FIN FUNCIONES PARA METAS PRODUCCION***************************************/

/******************************FIN FUNCIONES PARA METAS PRODUCCION***************************************/
/*TEMA DARK PARA GRAFICA DE PRODUCCION DIARIA*/
Highcharts.theme = {
   colors: ['#04B45F', '#FE642E', '#F3F781', '#7798BF', '#aaeeee', '#ff0066',
      '#eeaaee', '#55BF3B', '#DF5353', '#7798BF', '#aaeeee'],
   chart: {
      backgroundColor: {
         linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
         stops: [
            [0, '#2a2a2b'],
            [1, '#3e3e40']
         ]
      },
      style: {
         fontFamily: '\'roboto\', sans-serif'
      },
      plotBorderColor: '#606063'
   },
   title: {
      style: {
         color: '#E0E0E3',
         textTransform: 'uppercase',
         fontSize: '20px'
      }
   },
   subtitle: {
      style: {
         color: '#E0E0E3',
         textTransform: 'uppercase'
      }
   },
   xAxis: {
      gridLineColor: '#707073',
      labels: {
         style: {
            color: '#E0E0E3'
         }
      },
      lineColor: '#707073',
      minorGridLineColor: '#505053',
      tickColor: '#707073',
      title: {
         style: {
            color: '#A0A0A3'

         }
      }
   },
   yAxis: {
      gridLineColor: '#707073',
      labels: {
         style: {
            color: '#E0E0E3'
         }
      },
      lineColor: '#707073',
      minorGridLineColor: '#505053',
      tickColor: '#707073',
      tickWidth: 1,
      title: {
         style: {
            color: '#A0A0A3'
         }
      }
   },
   tooltip: {
      backgroundColor: 'rgba(0, 0, 0, 0.85)',
      style: {
         color: '#F0F0F0'
      }
   },
   plotOptions: {
      series: {
         dataLabels: {
            color: '#B0B0B3'
         },
         marker: {
            lineColor: '#333'
         }
      },
      boxplot: {
         fillColor: '#505053'
      },
      candlestick: {
         lineColor: 'white'
      },
      errorbar: {
         color: 'white'
      }
   },
   legend: {
      itemStyle: {
         color: '#E0E0E3'
      },
      itemHoverStyle: {
         color: '#FFF'
      },
      itemHiddenStyle: {
         color: '#606063'
      }
   },
   credits: {
      style: {
         color: '#666'
      }
   },
   labels: {
      style: {
         color: '#707073'
      }
   },

   drilldown: {
      activeAxisLabelStyle: {
         color: '#F0F0F3'
      },
      activeDataLabelStyle: {
         color: '#F0F0F3'
      }
   },

   navigation: {
      buttonOptions: {
         symbolStroke: '#DDDDDD',
         theme: {
            fill: '#505053'
         }
      }
   },

   // scroll charts
   rangeSelector: {
      buttonTheme: {
         fill: '#505053',
         stroke: '#000000',
         style: {
            color: '#CCC'
         },
         states: {
            hover: {
               fill: '#707073',
               stroke: '#000000',
               style: {
                  color: 'white'
               }
            },
            select: {
               fill: '#000003',
               stroke: '#000000',
               style: {
                  color: 'white'
               }
            }
         }
      },
      inputBoxBorderColor: '#505053',
      inputStyle: {
         backgroundColor: '#333',
         color: 'silver'
      },
      labelStyle: {
         color: 'silver'
      }
   },

   navigator: {
      handles: {
         backgroundColor: '#666',
         borderColor: '#AAA'
      },
      outlineColor: '#CCC',
      maskFill: 'rgba(255,255,255,0.1)',
      series: {
         color: '#7798BF',
         lineColor: '#A6C7ED'
      },
      xAxis: {
         gridLineColor: '#505053'
      }
   },

   scrollbar: {
      barBackgroundColor: '#808083',
      barBorderColor: '#808083',
      buttonArrowColor: '#CCC',
      buttonBackgroundColor: '#606063',
      buttonBorderColor: '#606063',
      rifleColor: '#FFF',
      trackBackgroundColor: '#404043',
      trackBorderColor: '#404043'
   },

   // special colors for some of the
   legendBackgroundColor: 'rgba(0, 0, 0, 0.5)',
   background2: '#505053',
   dataLabelsColor: '#B0B0B3',
   textColor: '#C0C0C0',
   contrastTextColor: '#F0F0F3',
   maskColor: 'rgba(255,255,255,0.3)'
};

// Apply the theme
Highcharts.setOptions(Highcharts.theme);