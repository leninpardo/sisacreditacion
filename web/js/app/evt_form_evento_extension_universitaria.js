//mostar_sub_eventos=function(idevento){
// $.post('index.php','controller=evento_extension_universitaria&action=sub_eventos&idevento='+idevento,function(data){
//            console.log(data);
//            //distrito
//            $("#evento_sub_eventos").empty().append(data);
//        });
//};
$(function() {
    $("#fecha").datepicker({'dateFormat':'yy/mm/dd'}); 
    var codigofacultad = $("#CodigoFacultad");
    var iddepartamento=$("#departamento");
    
    codigofacultad.change(function(){
        var ids = $(this).val();
        
   $.post('index.php','controller=escuelaprofesional&action=getEscuelaProfesional&CodigoFacultad='+ids,function(data){
            $("#CodigoEscuela").empty().append(data);            
        });
    });
    
    iddepartamento.change(function(){ 
        var ids = $(this).val();
        $.post('index.php','controller=alumno&action=getListaProvincias&departamento='+ids,function(data){
            console.log(data);
            //provincia
            $("#provincia").empty().append(data);
        });
    });
    
    
    $("#provincia").change(function(){
        var ids = $(this).val();
        $.post('index.php','controller=alumno&action=getListaDistritos&provincia='+ids,function(data){
            console.log(data);
            //distrito
            $("#distrito").empty().append(data);
        });
    });
    

        
        
    $( "#save" ).click(function(){
        bval = true;        
        bval = bval && $( "#ApellidoPaterno" ).required();
        bval = bval && $( "#ApellidoMaterno" ).required();
        bval = bval && $( "#NombreAlumno" ).required();
        bval = bval && $( "#Direccion" ).required();
        
        
        
      
        
        if ( bval ) {
            $("#frm").submit();
        }
        return false;
    });   
});

