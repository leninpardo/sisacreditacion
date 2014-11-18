<?php  include("../lib/functions.php"); ?>
<script type="text/javascript" src="js/app/evt_form_pagos_cca.js" ></script>
<script type="text/javascript" src="js/app/evt_form_alumno_cca.js" ></script>
<script type="text/javascript" src="js/validateradiobutton.js"></script>
<script>
    function get2(p1,p2)
    {   
         opener.document.getElementById("idalumno").value=p1;
         opener.document.getElementById("nombres").value=p2;
         window.close();

    }
   
</script>
<div class="div_container">

<!--<form id="frm" action="index.php" method="POST">-->
    <input type="hidden" name="controller" value="alumno_cca" />
    <input type="hidden" name="action" value="save" />
    <div class="contFrm ui-corner-all" style="background: #fff;">
        <div class="contenido" style="margin:0 auto; width: 400px; " align="center">
            <fieldset class="ui-corner-all" >
                <legend><h1><strong>FORMULARIO DE PAGOS</strong></h1></legend>
           
<button  class="button" id="buscaralumno" onclick='window.open("index.php?controller=matricula_cca&action=lista_matriculados&a=b","ventana1" , "width=860,height=400,top=150,left=250");'>ALUMNO MATRICULADOS</button>
<ul class="list-group" style="text-align: left ; border: solid;border-color:background" >
    <li class="list-group-item" style="border-color: background" >    
        <h4>ALUMNO:</h4> <input  type="text" size="2px" name="idalumno" id="idalumno"  value="<?php if(isset($_GET["idalumno"])){ echo $_GET["idalumno"];}?>"readonly /> <input type="text"  id="nombres"name="nombres" value="<?php if(isset($_GET["nombre"])){ echo $_GET["nombre"];}?>" readonly/>    </li>
  <li class="list-group-item" style="border-color: background">
      <h4>USUARIO :</h4> <?PHP echo $_SESSION['name']." - ".$_SESSION['user'];?><input type="hidden" id="idusuario" value="<?php echo $_SESSION['idusuario']?>">
  </li>
   <li class="list-group-item" style="border-color: background" >  
       <h4>N° VOUCHER : </h4><input type="text" name="voucher" size="10px" id="voucher"/>
   </li>
    <li class="list-group-item" style="border-color: background">
        <h4> MONTO : </h4><input type="text" name="monto" size="10px" id="monto"/> 
    </li>
     <li class="list-group-item" style="border-color: background">
         <h4>FECHA DE PAGO : </h4><input type="date" name="fecha_p" size="10px" id="fecha_p"/>
     </li>
      <li class="list-group-item" style="border-color: background">
          <h4>FECHA DE REGISTRO :</h4> <strong> <?php $fechaA= date("Y-m-d");?><?php  echo $fechaA; ?><input type="hidden" id="fecha_r" size="10px" value="<?php  echo $fechaA; ?>"/></strong>
      </li>
</ul>
<input type="button" value="Pagar" class="btn btn-primary" id="gpagos"/>


                </fieldset>
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
        </div>
    
<!--</form>-->
</div>