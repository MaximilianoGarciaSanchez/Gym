function init(){
	
        $("#alumno_form").on("submit",function(e){
                
                guardaryeditar(e);
                
        });
}

// Suponiendo que tienes una función para manejar el envío del formulario
function enviarFormulario() {
        // Realiza la lógica de envío del formulario aquí
        
        // Limpia los campos del formulario
        document.getElementById("gen_id").value = "";
        document.getElementById("id_carrera").value = "";
        document.getElementById("sem_id").value = "";
        document.getElementById("fecha_inscripcion").value = "";
    }
    
    


$(document).ready(function() {
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
});

function guardaryeditar(e){
        e.preventDefault();
        var formData = new FormData($("#alumno_form")[0])
        $.ajax({

                url: "../../controller/alumno.php?op=insert",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos){
                        $('#no_control').val('');
                        $('#alu_nom').val('');
                        $('#alu_ape').val('');
                        $('#gen_id').val('');
                        $('#id_carrera').val('');
                        $('#sem_id').val('');
                        $('#fecha_inscripcion').val('');
                swal("Correcto!", "Registrado Correctamente", "success");
                }

        });
}

    


init();