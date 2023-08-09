function init(){
	
        $("#alumno_form").on("submit",function(e){
                
                guardaryeditar(e);
                
        });
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
        //      console.log(data);   
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
                swal("Correcto!", "Registrado Correctamente", "success");
                }

        });
}




init();