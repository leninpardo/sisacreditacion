<?php  include("../lib/functions.php"); ?>
<script type="text/javascript" src="js/app/evt_form_alumno_cca.js" ></script>
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
    <input type="hidden" name="controller" value="alumno_cca" />
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
                        <input id="idalumno" name="idalumno" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->idalumno; ?>" readonly />                
                      </td>
                      <td width="20%" align="left">
                         <strong for="nombres" >Nombres:</strong>
                      </td>  
                      <td width="30%" >

                          <input id="nombres" name="nombres" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->nombres;  if (isset($_GET['nombre'])){echo $_GET['nombre'];}?>"  required>                  
                          
                      </td>

                    </tr>
                    <tr class="fil">
                       <td> 
                         <strong for="apellidop" align="right" >Apellido Paterno:</strong>
                       </td> 
                       <td>
                           <input id="apellidop" name="apellidop" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->apellidop; if (isset($_GET['apellidop'])){echo $_GET['apellidop'];}?>"  required>           
                         
                       </td>
                       <td align="left">
                           <strong for="apellidom"  >Apellido Materno:</strong>
                       </td>
                       <td>
                           <input id="apellidom" name="apellidom" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->apellidom; if (isset($_GET['apellidom'])){echo $_GET['apellidom'];}?>"  required>                  
                           
                       </td>
                     </tr>
                     <tr class="fil">
                        <td align="rigth">
                            <strong for="dni"  >DNI:</strong>
                        </td> 
                        <td>
                            <input id="dni" name="dni" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->dni; if (isset($_GET['dni'])){echo $_GET['dni'];}?>" required>                  

                        </td>   
                        <td align="left">
                            <strong for="sexo"  style="width: 80px">Sexo:</strong>
                        </td>
                        <td>        
                            <select name="sexo" id="sexo">
                                <option value="">...</option>
                                <option value="M" <?php if($obj->sexo=="M"){echo "selected";} if($_GET['sexo']=="M"){echo "selected";} ?> >MASCULINO</option>
                                <option value="F" <?php if($obj->sexo=="F"){echo "selected";} if($_GET['sexo']=="F"){echo "selected";}?> >FEMENINO</option>
                            </select>   
                            
                       </td>
                      </tr>
                      <tr class="fil">
                          <td align="left">
                                 <strong for="direccion" class="labels" >Direccion:</strong>
                           </td>
                           <td>
                                 <input id="direccion" name="direccion" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->direccion; ?>"  />                
                                 
                           </td>
                           <td>
                                <strong for="procedencia" class="labels" >Procedencia:</strong>
                            </td> 
                            <td>
                                <input id="procedencia" name="procedencia" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->procedencia; ?>"  />                
                                
                            </td>        
                      </tr>
                      <tr class="fil">
                            <td> 
                               <strong for="telefono" class="labels" style="width: 130px;">Telefono:</strong>
                            </td>
                            <td>
                                <input id="telefono" name="telefono" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->telefono; ?>"  />                
                                
                            </td>
                            <td>
                                 <strong for="idtipo_alumno" class="labels" >Tipo Alumno:</strong>
                            </td>
                            <td>        
                                <?php echo $descripcion; ?>
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
                    <!--<a href="index.php?controller=alumno_cca&action=create" class="button">ATRAS</a>-->
                 </div>   
              </fieldset>
              </div>
        </div>
    </div>
</form>
