$(function() {
    $("div#uno .asig").click(function() {
        cadena=$(this).val();
        var pedazo = cadena.split(",");
        idevento=pedazo[0];
        evento=pedazo[1];
        $("#asignacionPS").html('<br><br><br><br><br><strong>Cargando Sub Eventoss....</strong>');
         $.post('index.php', 'controller=asistenciaseventoEU&action=lista_sub_evento&idevento='
                 +idevento+'&evento='+evento, function(data) {
            console.log(data);
            $("#asignacionPS").empty().append(data);
        });
        
        
//        $("#seleccionado").change(function(){
//          seleccionado=$(this).val();    
//        })
       
    });
   
    $("#save").click(function() {
        bval = true;
        
        if (bval) {
            $("#frm").submit();
        }
        return false;
    });
});



