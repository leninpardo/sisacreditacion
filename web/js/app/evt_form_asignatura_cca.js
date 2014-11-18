$(function() {
//    $( "#descripcion_error" ).fadeOut(); 
//    $( "#idcomision_error" ).fadeOut();
//    $( "#iddocente_error" ).fadeOut(); 
//    $( "#creditaje_error" ).fadeOut();
//    $( "#creditaje_numero" ).fadeOut();
    $( "#save" ).click(function(){
      
        bval = true;  
//        bval = bval && $( "#descripcion" ).required();
//        bval = bval && $( "#creditaje" ).required();
//        bval = bval && $( "#nombres" ).required();
//        var descripcion = $( "#descripcion" ).val();
//        var idcomision= $("#idcomision").val();
//        var iddocente= $("#iddocente").val();
//        var creditaje= $("#creditaje").val();
//        if(descripcion=="")//        {
//          bval = bval && descripcion;
//          $( "#descripcion_error" ).fadeIn();
//        }
//        else
//        {
//          bval = bval && descripcion;
//          $( "#descripcion_error" ).fadeOut();
//        }
//        if(idcomision=="")
//        {
//          bval = bval && descripcion;
//          $( "#idcomision_error" ).fadeIn();
//        }
//        else
//        {
//          bval = bval && descripcion;
//          $( "#idcomision_error" ).fadeOut();
//        }
//        
//        if(iddocente="")
//        {
//            bval = bval && iddocente;
//            $("#iddocente_error").fadeIn();
//        }
//        else
//        {
//           bval = bval && iddocente;
//            $("#iddocente_error").fadeOut(); 
//        }
//        
//        if(creditaje=="")
//        {
//            bval = bval && creditaje;
//            $("#creditaje_error").fadeIn();
//        }
//        else
//        {
//          bval = bval && creditaje;
//          $("#creditaje_error").fadeOut();  
//        }
//        if(isNaN(creditaje))
//        {
//            bval = bval && creditaje;
//            $("#creditaje_numero").fadeIn();
//        }
//        else
//        {
//          bval = bval && creditaje;
//          $("#creditaje_numero").fadeOut();  
//        }   
        if ( bval ) {
            $("#frm").submit();
        }
        return false;
    });   
});