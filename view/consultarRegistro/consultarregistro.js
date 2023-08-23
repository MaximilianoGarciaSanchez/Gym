var tabla;
var usu_id = $('#user_idx').val();
var rol_id = $('#rol_idx').val();

function limpiarCampos() {
    $('#no_control').val('');
    $('#alu_nom').val('');
    $('#alu_ape').val('');
    $('#gen_id').val('').trigger('change');
    $('#id_carrera').val('').trigger('change');
    $('#sem_id').val('').trigger('change');
    $('#estado').val('').trigger('change');
    $('#fecha_inscripcion').val('').trigger('change');
    $('#anio').val('').trigger('change');

}

$(document).on("click", "#desactivar", function() {
    desactivarTodos();
});


function init(){
    $("#alumno_form").on("submit",function(e){
        guardaryeditar(e);	
    });    
    
}

function guardaryeditar(e){
    e.preventDefault();
	var formData = new FormData($("#alumno_form")[0]);
    $.ajax({
        url: "../../controller/alumno.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){    
            console.log(datos);
            $('#alumno_form')[0].reset();
            /* Ocultar Modal */
            $("#modalmantenimiento").modal('hide');
            $('#alumno_data').DataTable().ajax.reload();

            /* Mensaje de Confirmacion */
            swal({
                title: "¡Gym Mapaches!",
                text: "Completado.",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    }); 
}

$(document).ready(function(){  
    $.post("../../controller/genero.php?op=combo",function(data, status){    
        $('#gen_id').html(data); 
      });
      $.post("../../controller/carrera.php?op=combo",function(data, status){    
        $('#id_carrera').html(data);       
      });
      $.post("../../controller/semestre.php?op=combo",function(data, status){    
        $('#sem_id').html(data);     
        
      $.post("../../controller/aniosemestre.php?op=combo",function(data, status){    
            $('#fecha_inscripcion').html(data); 
      });
});

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
                    url: '../../controller/alumno.php?op=listar_x_usu',
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
        var no_control = $('#no_control').val();
        var alu_nom = $('#alu_nom').val();
        var alu_ape = $('#alu_ape').val();
        var gen_id = $('#gen_id').val();
        var id_carrera = $('#id_carrera').val();
        // var sem_id = $('#sem_id').val();
        var fecha_inscripcion= $('#fecha_inscripcion').val();
        var anio = $('#anio').val();

        
        listardatatable(no_control,alu_nom,alu_ape,gen_id,id_carrera,fecha_inscripcion,anio);


        
    }
});

function eliminar(alu_id){
    swal({
        title: "¡Gym Mapaches!",
        text: "Esta seguro de eliminar el alumno?",
        type: "error",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    },
    function(isConfirm) {
        if (isConfirm) {
            $.post("../../controller/alumno.php?op=eliminar", {alu_id : alu_id}, function (data) {

            }); 

            $('#alumno_data').DataTable().ajax.reload();	

            swal({
                title: "¡Gym Mapaches!",
                text: "Registro Eliminado.",
                type: "success",
                confirmButtonClass: "btn-success"
            });
            $('#alumno_data').DataTable().ajax.reload();
        }
    });
}

function desactivarTodos() {
    // Mostrar una confirmación al usuario antes de desactivar todos los alumnos
    swal({
      title: "¿Estás seguro?",
      text: "Esto desactivará a todos los alumnos. Esta acción no se puede deshacer.",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Sí, desactivar",
      cancelButtonText: "Cancelar",
      closeOnConfirm: true
    },
    function(isConfirm) {
      if (isConfirm) {
        // Si el usuario confirma, hacer la solicitud AJAX para desactivar todos los alumnos
        $.ajax({
          url: "../../controller/alumno.php?op=desactivar_alumnos", // Asegúrate de usar la ruta correcta a tu controlador
          type: "POST",
          dataType: "json",
          success: function(data) {
            // Aquí puedes mostrar un mensaje de éxito o actualizar la tabla de alumnos si lo deseas
            console.log(data); // En este ejemplo, asumimos que el controlador devolverá una respuesta JSON
            // Si usas DataTables, puedes recargar los datos de la tabla después de desactivar los alumnos
           
          },
          error: function(jqXHR, textStatus, errorThrown) {
            // Aquí puedes manejar errores si ocurren durante la solicitud AJAX
            console.error(errorThrown);
          }
        });
        $('#alumno_data').DataTable().ajax.reload();
      }
    });
}

function ver(alu_id){
    window.open('http://localhost/proyecto_gym/view/DetalleAlumno/?ID='+ alu_id +'');
    console.log(alu_id);
}

function editar(alu_id){
    $.post("../../controller/alumno.php?op=mostrar", {alu_id: alu_id}, function (data) {
        data = JSON.parse(data);
        $('#alu_id').val(data.alu_id);
        $('#no_control1').val(data.no_control);
        $('#alu_nom1').val(data.alu_nom);
        $('#alu_ape1').val(data.alu_ape);
        $('#gen_id1').val(data.gen_id).trigger('change');
        $('#id_carrera1').val(data.id_carrera).trigger('change');
        $('#sem_id1').val(data.sem_id).trigger('change');
        $('#fecha_inscripcion1').val(data.fecha_inscripcion).trigger('change');  // Ajustado el ID del campo
        $('#anio1').val(data.anio);
    }); 

    $('#modalmantenimiento').modal('show');
}


$(document).on("click","#btnfiltrar", function(){
    limpiar();
        var no_control = $('#no_control').val();
        var alu_nom = $('#alu_nom').val();
        var alu_ape = $('#alu_ape').val();
        var gen_id = $('#gen_id').val();
        var id_carrera = $('#id_carrera').val();
        var sem_id = $('#sem_id').val();
        var estado = $('#estado').val();
        var fecha_inscripcion = $('#fecha_inscripcion').val();
        var anio = $('#anio').val();


        

    listardatatable(no_control,alu_nom,alu_ape,gen_id,id_carrera,sem_id,estado,fecha_inscripcion,anio);

    limpiarCampos();

});

function listardatatable(no_control,alu_nom,alu_ape,gen_id,id_carrera,sem_id,estado,fecha_inscripcion,anio){

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
                url: '../../controller/alumno.php?op=listar_filtro',
                type : "post",
                dataType : "json",
                data:{ no_control : no_control, alu_nom, alu_ape, gen_id, id_carrera, sem_id, estado,fecha_inscripcion,anio  },

          
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

function limpiar(){
    $('#table').html(
        "<table id='alumno_data' class='table table-bordered table-striped table-vcenter js-dataTable-full'>"+
						"<thead>"+
							"<tr>"+
                            "<th class='d-none d-sm-table-cell' style='width: 5%;'>Estado</th>"+	
                            "<th class='d-none d-sm-table-cell' style='width: 5%;'>No.Control</th>"+
                            "<th class='d-none d-sm-table-cell' style='width: 15%;'>Nombre</th>"+
							"<th class='d-none d-sm-table-cell' style='width: 20%;'>Apellido</th>"+
							"<th class='d-none d-sm-table-cell' style='width: 10%;'>Genero</th>"+
							"<th class='d-none d-sm-table-cell' style='width: 15%;'>Carrera</th>"+
							"<th class='d-none d-sm-table-cell' style='width: 10%;'>Semestre Escolar</th>"+	
							"<th class='d-none d-sm-table-cell' style='width: 1%;'></th>"+	
							"<th class='d-none d-sm-table-cell' style='width: 1%;'></th>"+
							"<th class='d-none d-sm-table-cell' style='width: 1%;'></th>"+	
							"</tr>"+
                            "</thead>"+
                            "<tbody>"+

                            "</tbody>"+
                            "</table>"
    );
}

init();