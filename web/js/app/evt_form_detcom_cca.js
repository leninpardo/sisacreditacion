$(function() {
    
    $( "#save" ).click(function(){
        bval = true;  
//        bval = bval && $( "#idcomision" ).required();
//        bval = bval && $( "#nombres" ).required();
      
        if ( bval ) {
            $("#frm").submit();
        }
        return false;
    });   
});