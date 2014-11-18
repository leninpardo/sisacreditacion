-$(function() {    
//    $("#descripcion_error").fadeOut();
    $( "#save" ).click(function(){
        bval = true; 
//        bval = bval && $( "#descripcion" ).required();
//        var descripcion = $( "#descripcion" ).val();
//        if(descripcion=="")
//        {
//          bval = bval && descripcion;
//          $("#descripcion").fadeIn();
//        }
//        else
//        {
//          bval = bval && descripcion;
//          $("#descripcion").fadeIn();  
//        }
//             
        if ( bval ) {
            $("#frm").submit();
        }
        return false;
    });   
});