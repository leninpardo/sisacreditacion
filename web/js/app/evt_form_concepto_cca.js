
$(document).ready(function() {
//    $("#descripcion_error").fadeOut();
//    $("#monto_error").fadeOut();
//    $("#monto_numero").fadeOut();
    $("#save").click(function(){
        
//        alert("asd");
        bval = true;      
//        bval = bval && $( "#descripcion" ).required();
//        bval = bval && $( "#monto" ).required();
//        bval = bval && $( "#idtipo_alumno" ).required();
//        bval = bval && $( "#nombres" ).required();
//        bval = bval && $( "#apellidop" ).required();
//        bval = bval && $( "#apellidom" ).required();
//        
//        bval = bval && $( "#dni" ).required();
//        bval = bval && $( "#sexo" ).required();
//        bval = bval && $( "#direccion" ).required();
//        bval = bval && $( "#procedencia" ).required();
//        bval = bval && $( "#telefono" ).required();
//        var descripcion = $("#descripcion").val();
//        var monto = $("#monto").val();
//      if(descripcion=="")
//      {
//          bval = bval && descripcion;
//          $("#descripcion_error").fadeIn();
//      }
//      else
//      {
//          bval = bval && descripcion;
//          $("#descripcion_error").fadeOut();
//      }
//      
//      if(monto=="")
//      {
//          bval = bval && monto;
//          $("#monto_error").fadeIn();
//      }
//      else
//      {
//          bval = bval && monto;
//          $("#monto_error").fadeOut();
//      }
//      if(isNan(monto))
//      {
//          bval = bval && monto;
//          $("#monto_numero").fadeIn();
//      } 
//      else
//      {
//          bval = bval && monto;
//          $("#monto_numero").fadeOut();
//      } 
      
        if ( bval ) {
            $("#frm").submit();
        }
        return false;
    }); 
    
   
});

// function nuevoalumno_cca(a,b,c,d,e,f){
//        alert (a+'-'+b+'-'+c+'-'+d+'-'+e+'-'+f);
//        
//            
//            window.location='index.php?controller=alumno_cca&action=create&nombre='+a+'&apellidop='+b+'&apellidom='+c+'&dni='+d+'&sexo='+e+'&parametro='+f;
//       
//        
//        
//    }