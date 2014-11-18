$(function() {
    $( "#nombres" ).focus();    
    $( "#save" ).click(function(){
        bval = true;        
        bval = bval && $( "#nombres" ).required();
        bval = bval && $( "#apellidos" ).required();
        bval = bval && $( "#dni" ).required();
        bval = bval && $( "#telefono" ).required();
        bval = bval && $( "#direccion" ).required();
        if ( bval ) {
            $("#frm").submit();
        }
        return false;
    });   
});