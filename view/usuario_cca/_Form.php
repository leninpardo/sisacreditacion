<?php  include("../lib/functions.php"); ?>
<script type="text/javascript" src="js/app/evt_form_usuario_cca.js" ></script>
<script type="text/javascript" src="js/validateradiobutton.js"></script>
<script>
    /*function buscar() {
        var x=document.getElementById("buscar").value;
        window.open("index.php?controller=matricula_cca&par="+x,"", "width=550, height=300");
    
    }*/
</script>
<div class="div_container">
<!--<h6 class="ui-widget-header">Registro de alumnos CCA</h6>-->
<input id="parametro" type="hidden" name="parametro" class="text ui-widget-content ui-corner-all" style=" width: 250px; text-align: left;" value="" readonly>


<!--<button onclick='window.open("index.php?controller=alumno_cca&action=buscar","ventana2" , "width=860,height=400,top=150,left=250");'>BUSCAR</button>-->


<!--<button onclick='window.open("index.php?controller=alumno_cca&action=buscar","ventana2" , "width=860,height=400,top=150,left=250");'>BUSCAR</button>-->

<form id="frm" action="index.php" method="POST">
    <input type="hidden" name="controller" value="usuario_cca" />
    <input type="hidden" name="action" value="save" />
    <div class="contFrm ui-corner-all" style="background: #fff;">
        <div class="contenido" style="margin:0 auto; width: 750px; " align="center">
            <fieldset class="ui-corner-all" >
                <legend>Datos</legend>  
               <table border="0" cellpadding="3" cellspacing="1" style="background-color:#fff;" >
                   <tr class="fil">
                      <td width="20%" align="left">
                        <span for="idalumno" ><strong>ID:</strong></label>
                      </td>
                      <td width="30%">
                        <input id="idusuario" name="idusuario" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->idusuario; ?>" readonly />                
                      </td>
                      <td width="20%" align="left">
                         <strong for="nombres" >Nombres:</strong>
                      </td>  
                      <td width="30%" >

                          <input id="nombres" name="nombres" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->nombres;  if (isset($_GET['nombre'])){echo $_GET['nombre'];}?>"  />                
                       </td>

                    </tr>
                    <tr class="fil">
                       <td> 
                         <strong for="apellidos" align="right" >Apellidos:</strong>
                       </td> 
                       <td>
                         <input id="apellidos" name="apellidos" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->apellidos; if (isset($_GET['apellidos'])){echo $_GET['apellidos'];}?>"  />           
                       </td>
                       
                        <td align="rigth">
                            <strong for="dni"  >DNI:</strong>
                        </td> 
                        <td>
                            <input id="dni" name="dni" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->dni; if (isset($_GET['dni'])){echo $_GET['dni'];}?>"  />                
                        </td>   
                       
                       
                     </tr>
                     <tr class="fil">
                       
                          <td> 
                               <strong for="telefono" class="labels" style="width: 130px;">Telefono:</strong>
                            </td>
                            <td>
                                <input id="telefono" name="telefono" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->telefono; ?>"  />                
                            </td>
                            <td align="left">
                                 <strong for="direccion" class="labels" >Direccion:</strong>
                           </td>
                           <td>
                                 <input id="direccion" name="direccion" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->direccion; ?>"  />                
                           </td>
                         
                      </tr>  
               </table>
                </fieldset>
                </div>
            
             <div class="contenido" style="margin:0 auto; width: 750px; " align="center">
             <fieldset class="ui-corner-all" >
                <legend>Accion</legend> 
                 <div  style="clear: both; padding: 10px; width: auto;text-align: center">
                    <a href="#" id="save" class="button">GRABAR</a>
                    <a href="index.php?controller=usuario_cca" class="button">ATRAS</a>
                 </div>   
              </fieldset>
              </div>
        </div>
    </div>
</form>
