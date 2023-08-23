
var tabla;
var usu_id = $('#user_idx').val();
var rol_id = $('#rol_idx').val();

function init(){
        
}

$(document).ready(function(){  
    if(rol_id==1){
        tabla=$('#alumno_data').dataTable({
            "aProcessing": true,
                "aServerSide": true,
                dom: 'Bfrtip',
                "searching": false,
                lengthChange: false,
                colReorder: true,
                buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                        ],
                "ajax":{
                    url: '../../controller/alumno.php?op=listar_entrada',
                    type : "post",
                    dataType : "json",
                    data:{ usu_id : usu_id },
                    error: function(e){
                        console.log(e.responseText);
                    }
                },
                "ordering": false,
                "bDestroy": true,
                "responsive": true,
                "bInfo":true,
                "iDisplayLength": 10,
                "autoWidth": false,
                "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }     
    
    
        }).DataTable();

    }else{
        tabla=$('#alumno_data').dataTable({
            "aProcessing": true,
                "aServerSide": true,
                dom: 'Bfrtip',
                "searching": false,
                lengthChange: false,
                colReorder: true,
                buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                        ],
                "ajax":{
                    url: '../../controller/alumno.php?op=listar_entrada',
                    type : "post",
                    dataType : "json",
                    error: function(e){
                        console.log(e.responseText);
                    }
                },
                "ordering": false,
                "bDestroy": true,
                "responsive": true,
                "bInfo":true,
                "iDisplayLength": 10,
                "autoWidth": false,
                "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }     
    
    
        }).DataTable();

    }
      
    });

    // function ver(alu_id){
    //     console.log(alu_id);
    // }
    
    $(document).ready(function() {
        // Capturar evento de clic en el botón de entrada
        $("#btn_entrada").click(function() {
            // Obtener número de control y fecha y hora actual
            var noControl = $("#no_control").val(); // Obtener el valor del campo de entrada
            var fechaHora = obtenerFechaHoraActual();
    
            // Verificar si se ha proporcionado el número de control
            if (noControl === "") {
                // Mostrar alerta indicando que se debe escribir el número de control
                swal({
                    title: "¡Error!",
                    text: "Por favor, escriba el número de control.",
                    type: "error",
                    showConfirmButton: true
                });
            } else {
                // Realizar acciones con los valores obtenidos
                // Aquí puedes realizar la acción deseada con los datos obtenidos, como enviarlos al servidor
                enviarDatos(noControl, fechaHora, "entrada");
            }
        });
    
        // Capturar evento de clic en el botón de salida
        $("#btn_salida").click(function() {
            // Obtener número de control y fecha y hora actual
            var noControl = $("#no_control").val(); // Obtener el valor del campo de entrada
            var fechaHora = obtenerFechaHoraActual();
    
            // Verificar si se ha proporcionado el número de control
            if (noControl === "") {
                // Mostrar alerta indicando que se debe escribir el número de control
                swal({
                    title: "¡Error!",
                    text: "Por favor, escriba el número de control.",
                    type: "error",
                    showConfirmButton: true
                });
            } else {
                // Realizar acciones con los valores obtenidos
                // Aquí puedes realizar la acción deseada con los datos obtenidos, como enviarlos al servidor
                enviarDatos(noControl, fechaHora, "salida");
            }
        });
    
        // Función para obtener la fecha y hora local actual
        function obtenerFechaHoraActual() {
            var fechaHora = new Date();
            var year = fechaHora.getFullYear();
            var mes = fechaHora.getMonth() + 1;
            var dia = fechaHora.getDate();
            var hora = fechaHora.getHours();
            var minutos = fechaHora.getMinutes();
            var segundos = fechaHora.getSeconds();
    
            // Formatear el mes, día, hora, minutos y segundos con ceros a la izquierda si es necesario
            mes = mes < 10 ? "0" + mes : mes;
            dia = dia < 10 ? "0" + dia : dia;
            hora = hora < 10 ? "0" + hora : hora;
            minutos = minutos < 10 ? "0" + minutos : minutos;
            segundos = segundos < 10 ? "0" + segundos : segundos;
    
            // Retornar la fecha y hora formateadas
            return year + "-" + mes + "-" + dia + " " + hora + ":" + minutos + ":" + segundos;
        }
    
        // Función para enviar los datos al servidor
        function enviarDatos(noControl, fechaHora, tipo) {
            // Enviar los datos por AJAX al controlador PHP
            $.ajax({
                type: "POST",
                url: "../../controller/entradas.php",
                data: {
                    no_control: noControl,
                    fecha_hora: fechaHora,
                    tipo: tipo
                },
                success: function(response) {
                    // Mostrar la respuesta del servidor
                    console.log("Respuesta del servidor:", response);
    
                    // Mostrar alerta según la respuesta del servidor
                    if (response === "registro_exitoso") {
                        swal({
                            title: "¡Éxito!",
                            text: "La asistencia se ha registrado correctamente.",
                            type: "success",
                            showConfirmButton: true
                        });
                    } else if (response === "error_registro") {
                        swal({
                            title: "¡Error!",
                            text: "Error al registrar la asistencia.",
                            type: "error",
                            showConfirmButton: true
                        });
                    } else if (response === "no_control_inexistente") {
                        swal({
                            title: "¡Error!",
                            text: "El número de control no existe en la tabla de asistencia.",
                            type: "error",
                            showConfirmButton: true
                        });
                    } else if (response === "alumno_desactivado") {
                        swal({
                            title: "¡Error!",
                            text: "Ya se ha registrado la asistencia hoy, o no esta inscrito.",
                            type: "error",
                            showConfirmButton: true
                        });
                    } else if (response === "sin_entrada_registrada") {
                        swal({
                            title: "¡Error!",
                            text: "No se ha registrado la entrada correspondiente para este número de control y fecha.",
                            type: "error",
                            showConfirmButton: true
                        });
                    }
    
                    // Limpiar el campo de número de control
                    $("#no_control").val("");
                },
                error: function(xhr, textStatus, errorThrown) {
                    // Mostrar alerta de error en caso de que falle la petición AJAX
                    swal({
                        title: "¡Error!",
                        text: "Ocurrió un error al enviar los datos al servidor.",
                        type: "error",
                        showConfirmButton: true
                        
                    });
                }
                
            });
            tabla.ajax.reload();

        }
    });

    
    
    
init();