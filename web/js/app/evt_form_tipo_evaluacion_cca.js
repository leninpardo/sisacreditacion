-$(function() {    
    $( "#save" ).click(function(){
        bval = true;        
        bval = bval && $( "#descripcion" ).required(); 
        bval = bval && $( "#ponderado" ).required();        
        if ( bval ) {
            $("#frm").submit();
        }
        return false;
    });   
});