
$(document).ready(function() {
//    $("#idalumno_error").fadeOut();
//    $("#idcomision_error").fadeOut();
//    $("#nombre_proyecto_error").fadeOut();
//    $("#fecha_error").fadeOut();
    
    $("#fecha").datepicker({'dateFormat':'yy-mm-dd'});
    $( "#save" ).click(function(){
        bval = true;
//        var idalumno = $("#idalumno").val();
//        //var idcomision = $("#comision").val();
//        var nombre_proyecto = $("#nombre_proyecto").val();
//        var fecha = $("#fecha").val();
//        if(idalumno =="")
//        {
//            bval = bval && idalumno;
//            $("#idalumno_error").fadeIn();
//        }
//        else
//        {
//            bval = bval && idalumno;
//            $("#idalumno_error").fadeOut();
//        }
//       
//        if(nombre_proyecto=="")
//        {
//            bval = bval && nombre_proyecto;
//            $("#nombre_proyecto_error").fadeIn();
//        }
//        else
//        {
//            bval = bval && nombre_proyecto;
//            $("#nombre_proyecto_error").fadeOut(); 
//        }
//        if(fecha=="")
//        {
//            bval = bval && fecha;
//            $("#fecha_error").fadeIn();
//        }
//        else
//        { 
//             bval = bval && fecha;
//              $("#fecha_error").fadeOut();  
//        }
        if ( bval ) {
            $("#frm").submit();
        }
        return false;
    });   
    $("#agregarmi").click(function(){
        
      

        $("#tabmatriula").append(html);
    });
    
    $("#vermatriculados").click(function(){
            $.GET('index.php','controller=matricula_cca&action=lista_matriculados',function(data){
            
            });

    });
    
    
    $("#veralumnos_cca").click(function(){
        
       
        $.get('index.php','controller=alumno_cca&a=b',function(data){
            $("#contenedor").empty();
            $("#contenedor").append(data);
        });
        
    });
      $("#buscaralumno").click(function(){
        
      window.location='index.php?controller=matricula_cca';
        
    });
    
  
    
    
});

