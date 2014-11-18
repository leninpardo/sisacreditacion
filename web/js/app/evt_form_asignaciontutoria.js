     
$(function() {
   
   
    
    $("#CodigoSemestre").change(function() {
         var idsemestre = $(this).val();
      $.post('index.php', 'controller=asignaciontutoria&action=Parametros_facultad&sem='+idsemestre, function(data) {
            console.log(data);
            $("#tabla").empty().append(data);
        });  
        
    });
    $("#alumnos").css("display","none");
    
    $("#lupa").click(function() {
       $("#alumnos").css("display","");
        $("#iframe_buscar_alumno").css("display","");
    });
  
    //pagina a cargar  // datos a enviar/funciones a hacer 
    $.post('index.php', 'controller=asignaciontutoria&action=Parametros_facultad', function(data) {
            console.log(data);
            $("#tabla").empty().append(data);
            
        });
    $.post('index.php', 'controller=asignaciontutoria&action=mostrarLupa', function(data) {
            console.log(data);
            $("#lupa").empty().append(data);
        });
        

 

    /////////grillla abajo
    $("#btnadd").click(function() {
        bval = true;
        bval = bval && $("#NombreAlumno").required();
        if (bval)
        {
            ida = $("#CodigoAlumno").val();
            dc = $("#NombreAlumno").val();
            band = true;
            msg = "";
            $("tbody tr").each(function(i, j) {
                id_a = $("tbody tr td:eq(0) :input").val();
                if (id_a == ida) {
                    band = false;
                    msg = "Este Alumno ya fue agregado";
                }
            });
            if (!band) {
                alert(msg);
            }
            else
            {
                html = '<tr>';
                html += '<td><input type="hidden" name="id_idalumno[]" value="' + ida + '" />' + ida + '</td>';
                html += '<td><input type="hidden" name="id_nombrealumno[]" value="' + ida + '" />' + dc + '</td>';
                html += '<td width="20px"><a class="delete" title="Eliminar item" href="javascript:"><img src="images/delete.png"/></a></td>';
                html += '</tr>';
                $("#detalle tbody").append(html);
                $("#CodigoAlumno").val("");
                $("#NombreAlumno").val("");
            }
        }
    });
$('#agregar_lista').click(function () {
        array_click2 = $("#array_click2").val(); 
        var array_click2 = array_click2.split(",");
        filas = array_click2.length - 1;
        for (i = 1; i <= filas; i++) {
            contenido_temp=array_click2[i];
            var contenido_temp=contenido_temp.split("-");
            html = '<tr>';
            html += '<td><input type="hidden" name="id_idalumno[]" value="' + contenido_temp[0] + '" />' + contenido_temp[0] + '</td>';
            html += '<td><input type="hidden" name="id_nombrealumno[]" value="' + contenido_temp[0] + '" />' + contenido_temp[1] + '</td>';
            html += '<td width="20px"><a class="delete glyphicon glyphicon-trash" title="Eliminar item" href="javascript:"></a></td>';
            html += '</tr>';
            $("#detalle tbody").append(html);
        }
        $('#array_click').val('');
        $('#array_click2').val('');

    });


    //////////cierra grilla abajo



    $("#save").click(function() {

            $("#frm").submit();
        
    });
});

