
$(document).ready(function() {
         $(".fechacrono").datepicker({'dateFormat':'yy-mm-dd'});
    $( "#save" ).click(function(){
        bval = true;        
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
      
        
        if ( bval ) {
            $("#frm").submit();
        }
        return false;
    }); 
//    $("#partes").change(function(){
//        $("#partes").required();
//       var numcroonograma=$("#partes").val();
//       var url="index.php?controller=cronograma_cca&action=insertar_cronograma";
//       var costo=parseInt($("#montocomi").val());
//       if (numcroonograma==1){
//           var pre=costo/1;
//           var monto="S/."+pre;
//           var html="<input type='date' name='fechacrono[]' class='fechacrono' required/> "+monto+"<br><input type='hidden' name='montoc' id='montoc'  value='"+pre+"'/>";
//           $("#cronograma").empty();
//            $("#cronograma").append(html);
//       }
//        if (numcroonograma==2){
//            var pre=(costo/2).toFixed(2);
//           var monto="S/."+pre;
//            var html="<input type='date'name='fechacrono[]' class='fechacrono'required/> "+monto+" <br><br> <input type='date'name='fechacrono[]' class='fechacrono'required/>"+monto+"<br><br><input type='hidden' name='montoc' id='montoc'  value='"+pre+"'/>";
//           $("#cronograma").empty();
//            $("#cronograma").append(html);
//       }
//        if (numcroonograma==3){
//             var pre=(costo/3).toFixed(2);
//            var monto="S/."+pre;
//           var html="<input type='date'name='fechacrono[]'required/> "+monto+" <br><br><input type='date'name='fechacrono[]'required/>"+monto+" <br><br><input type='date'name='fechacrono[]'required/>"+monto+"<br><input type='hidden' id='montoc' name='montoc' value='"+pre+"'/>";
//           $("#cronograma").empty();
//            $("#cronograma").append(html);
//       }
       
    $("#gpagos").click(function(){
        
        var alumno=$("#idalumno").val();
        var idusuario=$("#idusuario").val();
        var voucher =$("#voucher").val();
        var  monto=$("#monto").val();
        var fecha_p=$("#fecha_p").val();
        var fecha_r=$("#fecha_r").val();
           
        
        alert(alumno+"-"+idusuario+"-"+voucher+"-"+monto+"-"+fecha_p+"-"+fecha_r);
            
     
       window.location='index.php?controller=pagos_cca&action=insertar_pagos&monto='+monto+'&alumno='+alumno+'&fecha_p='+fecha_p+'&fecha_r='+fecha_r+'&voucher='+voucher+'&idusuario='+idusuario;
    
    });
       
    });
    
  
  
    
   
//});

 function nuevoalumno_cca(a,b,c,d,e,f){
        alert (a+'-'+b+'-'+c+'-'+d+'-'+e+'-'+f);
        
            
            window.location='index.php?controller=alumno_cca&action=create&nombre='+a+'&apellidop='+b+'&apellidom='+c+'&dni='+d+'&sexo='+e+'&parametro='+f;
       
        
        
    }