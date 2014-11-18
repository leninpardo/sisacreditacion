<?php  include("../lib/functions.php"); ?>
<script type="text/javascript" src="js/app/evt_form_cronograma_cca.js" ></script>
<script type="text/javascript" src="js/validateradiobutton.js"></script>
<script>
 $(document).ready(function (){
     
    


$("#enviar").click(function(){
        var p1 = document.getElementById("passwd").value;
var p2 = document.getElementById("passwd2").value;
    
var espacios = false;
var cont = 0;
 while (!espacios && (cont < p1.length)) {
  if (p1.charAt(cont) == " ")
    espacios = true;
  cont++;
}
if (espacios) {
  alert ("La contraseña no puede contener espacios en blanco");
  return false;
}

if (p1.length == 0 || p2.length == 0) {
  alert("Los campos de la password no pueden quedar vacios");
  return false;
}

     


if (p1 != p2) {
  alert("Las passwords deben de coincidir");
  return false;
} else {
  alert("Todo esta correcto");
  

     var id=$("#id").val();
var parametro=$("#parametro").val();
var pass=$("#passwd").val();

 window.location="index.php?controller=cambiar_clave&action=actualizar_clave&id="+id+"&parametro="+parametro+"&pass="+pass;
 
}
    
    
    
});








 });







</script>
<div class="div_container">

<form id="frm" action="index.php" method="POST">
    <input type="hidden" name="controller" value="cambiar_clave" />
    <input type="hidden" name="action" value="actualizar_clave" />
    
     <?php if(isset($_SESSION["perfil"]) && ($_SESSION["perfil"] == 'ALUMNO_CCA')){?>
    <input type="hidden" id="parametro" value="alumno" />
    <input type="hidden" id="id" value="<?php echo $_SESSION["idusuario"]?>" />
    <?PHP }?>
   
      <?php if(isset($_SESSION["perfil"]) && ($_SESSION["perfil"] == 'USUARIO_CCA')){?>
    <input type="hidden" id="parametro" value="usuario" />
    <input type="hidden" id="id" value="<?php echo $_SESSION["idusuario"]?>" />

    <?PHP }?>
    
      <?php if(isset($_SESSION["perfil"]) && ($_SESSION["perfil"] == 'DOCENTE_CCA')){?>
    <input type="hidden" id="parametro" value="docente"/>
        <input type="hidden" id="id" value="<?php echo $_SESSION["idusuario"]?>" />

    <?PHP }?>
    
        <div class="contenido" style="margin:0 auto; width: 850px; " align="center">
            
            <h1>CAMBIAR CONTRASEÑA</h1>
            <center>
                Ingrese la nueva contraseña  :<input type="password" name="pass1"  id="passwd"  />
                <br> <br>
             Ingrese de nueva contraseña  :<input type="password" name="pass2" id="passwd2" />

            </center>
          
                </div>
            
<!--             <div class="contenido" style="margin:0 auto; width: 750px; " align="center">
             <fieldset class="ui-corner-all" >
                <legend>Accion</legend> 
                 <div  style="clear: both; padding: 10px; width: auto;text-align: center">
                    <a href="#" id="save" class="button">GRABAR</a>
                    <a href="index.php?controller=alumno_cca&action=create" class="button">ATRAS</a>
                 </div>   
              </fieldset>
              </div>-->
<input type="button" class="button" value="GUARDAR" id="enviar">
</form>
</div>