$(function() {
    
    $("#comision" ).focus();   
    $("#fecha_inicio").datepicker({'dateFormat':'yy-mm-dd'});  
    $("#fecha_termino").datepicker({'dateFormat':'yy-mm-dd'}); 
    $( "#descripcion").focus();
    $( "#save" ).click(function(){
        bval = true;  
//        bval = bval && $( "#comision" ).required();
//        bval = bval && $( "#fecha_inicio" ).required();
//        bval = bval && $( "#fecha_termino" ).required();
//        bval = bval && $( "#descripcion" ).required();
      
        if ( bval ) {
            $("#frm").submit();
        }
        
        return false;
    });
//    
//    $(".asig2").click(function(){
//        var id=$(this).attr("name");
//        document.getElementById("cod").value=id;
////        alert(id);
//        $.get('index.php', 'controller=comision_cca&action=Mostrar_miembros&id=' + id, function(data) { 
////            alert(serialize(data));
//           $("#miembro").empty();
//             $("#miembro").append(data);
//             $("#asignatura").empty();
//        });
//        
//    });
    
    
    $(".vera").click(function(){
//        alert("asdsa");
        var id=$(this).attr("name");
        document.getElementById("cod").value=id;
        $.get('index.php', 'controller=comision_cca&action=Mostrar_asignaturas&id=' + id, function(data) { 
//            alert(serialize(data));
//           $("#asignatura").empty();
//             $("#asignatura").append(data);
//             $("#miembro").empty();
             $("#formumi").empty();
              $("#formu").empty();
            $("#formu").append(data);
        });
        
    });

    $("#nuevo").click(function(){ 
        $(".table").attr({'style':'display:none;'});
        $.post('index.php','controller=comision_cca&action=create&a=b',function(data){
    
            $("#nuevo").attr({'style':'display:none;'});
            $("#formu").empty();
            $("#formu").append(data);
            $("#nuevom").empty();
            $("#miembro").empty();
            $("#nuevaa").empty();
            $("#asignatura").empty();
            $("#scroll").empty();
            $("#paginas").empty();
           
        }); 
    });
    //////
    $("#nuevor").click(function(){
        var comision=$("#cod").val();
        
       $.get('index.php','controller=requisitos_cca&action=create&idcomi='+comision,function(data){
             $("#nuevor").attr({'style':'display:none;'});
            $("#formumi").empty();
            $("#formumi").append(data);
            $("#nuevo").empty();
//            document.getElementById("idcomision").value=document.getElementById("cod").value;
        });
        
    });
    ///////
    
    $("#nuevom").click(function(){
        //var x=$(".codigoc").val();
        //alert (x);
        $.post('index.php','controller=detalle_comision_cca&action=create&a=b',function(data){
            $("#nuevom").attr({'style':'display:none;'});
            $("#formumi").empty();
            $("#formumi").append(data);
            $("#nuevo").empty();
            document.getElementById("idcomision").value=document.getElementById("cod").value;
        });
        
    });
    
    $("#nuevaa").click(function(){
        //var x=$(".codigoc").val();
        //alert (x);
        $.post('index.php','controller=asignatura_cca&action=create&a=b',function(data){
            $("#nuevaa").attr({'style':'display:none;'});
            $("#formumi").empty();
            $("#formumi").append(data);
            $("#nuevo").empty();
            document.getElementById("idcomision").value=document.getElementById("cod").value;
        });
        
        
        
        
        
    });
    
    
    
    $(".asig").click(function(){
        var comision=$(this).val();
        var tamaño=comision.length;
        var id2=comision.split(',');
        var id =id2[0];
        var nombrecomi=id2[1];
//        alert (nombrecomi);
        
        window.location='index.php?controller=comision_cca&action=datos_Comision&id='+id+"&nombrecomi="+nombrecomi;
    });
      $(".asig2").click(function(){
        
      
        var comision=$(this).attr("name");
//        alert(comision);
        
        var tamaño=comision.length;
        var id=parseInt(comision.substring(0,1));
        var nombrecomi=comision.substring(2,tamaño);
//        alert (nombrecomi);
        $.get('index.php','controller=comision_cca&action=Mostrar_miembros&id='+comision,function(data){
             $("#formumi").empty();
            $("#formu").empty();
            $("#formu").append(data);
            
        });
//        window.location='index.php?controller=comision_cca&action=datos_Comision&id='+id+"&nombrecomi="+nombrecomi;
    });
    
    $(".conc").click(function(){
        var id=$(this).attr("name");
       
        document.getElementById("cod").value=id;
//       alert(id);
        $.get('index.php', 'controller=comision_cca&action=Mostrar_concepto&id='+id, function(data) { 
//            alert(serialize(data));
             $("#formumi").empty();
            $("#formu").empty();
            $("#formu").append(data);
        });
//        
    });
    
    
      $("#nuevac").click(function(){
        //var x=$(".codigoc").val();
        //alert (x);
        $.post('index.php','controller=concepto_cca&action=create&a=b',function(data){
            $("#nuevaa").attr({'style':'display:none;'});
            $("#formumi").empty();
            $("#formumi").append(data);
            $("#nuevo").empty();
            document.getElementById("idcomision").value=document.getElementById("cod").value;
        });
   }); 
   
   $(".req").click(function(){
        var id=$(this).attr("name");
       
        document.getElementById("cod").value=id;
//       alert(id);
        $.get('index.php', 'controller=comision_cca&action=Mostrar_requisito&id='+id, function(data) { 
//            alert(serialize(data));
             $("#formumi").empty();
            $("#formu").empty();
            $("#formu").append(data);
        });
//        
    });
    
//        $("#nuevor").click(function(){
//        //var x=$(".codigoc").val();
//        //alert (x);
//        $.post('index.php','controller=requisitos_cca&action=create&a=b',function(data){
//            $("#nuevaa").attr({'style':'display:none;'});
//            $("#formumi").empty();
//            $("#formumi").append(data);
//            $("#nuevo").empty();
//            document.getElementById("idcomision").value=document.getElementById("cod").value;
//        });
//   }); 
});
 
//function ircomision(){
//        var x=document.getElementById("cod").value;
//        window.location.assign("?controller=detalle_comision_cca&action=create&cod="+x);        
//    } 
//function irasignatura(){
//        var x=document.getElementById("cod").value;
//        window.location.assign("?controller=asignatura_cca&action=create&cod="+x);        
//    } 