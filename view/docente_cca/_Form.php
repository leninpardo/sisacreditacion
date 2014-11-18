<?php  include("../lib/functions.php"); ?>
<script type="text/javascript" src="js/app/evt_form_docente_cca.js" ></script>
<script type="text/javascript" src="js/validateradiobutton.js"></script>
<script type="text/javascript">
 
      function get2(p1,p2)
    {   
         opener.document.getElementById("iddocente").value=p1;
         opener.document.getElementById("nombres").value=p2;
         window.close();

    }
</script>
    
<div class="div_container">
<h6 class="ui-widget-header">Registro de Docentes CCA</h6>
<input id="parametro" type="hidden" name="parametro" class="text ui-widget-content ui-corner-all" style=" width: 250px; text-align: left;" value="" readonly>
<!--<button onclick="javascript:popup('index.php?controller=docente_cca&action=buscar',860,400);">BUSCAR</button>-->

<form id="frm" action="index.php" method="POST">
    <input type="hidden" name="controller" value="docente_cca" />
    <input type="hidden" name="action" value="save" />
    <div class="contFrm ui-corner-all" style="background: #fff;">
        <div class="contenido" style="margin:0 auto; width: 750px; " align="center">
            <fieldset class="ui-corner-all" >
                <legend>Datos</legend>  
               <table border="0" cellpadding="3" cellspacing="1" style="background-color:#fff;" >
                   <tr class="fil">
                      <td width="20%" align="left">
                        <span for="iddocente" ><strong>ID:</strong></label>
                      </td>
                      <td width="30%">
                        <input id="iddocente" name="iddocente" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->iddocente; ?>" readonly />                
                      </td>
                      <td width="20%" align="left">
                         <strong for="nombres" >Nombres:</strong>
                      </td>  
                      <td width="30%" >
                         <input id="nombres" name="nombres" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->nombres; ?>"  />                
                         <a onclick='window.open("index.php?controller=docente_cca&action=buscar","ventana8" , "width=860,height=400,top=150,left=250");' /><img alt="" src="images/lupa.gif" /></a>
                         
                      </td>
                    </tr>
                    <tr class="fil">
                       <td> 
                         <strong for="apellidop" align="right" >Apellido Paterno:</strong>
                       </td> 
                       <td>
                         <input id="apellidop" name="apellidop" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->apellidop; ?>"  />           
                       
                       </td>
                       <td align="left">
                           <strong for="apellidom"  >Apellido Materno:</strong>
                       </td>
                       <td>
                           <input id="apellidom" name="apellidom" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->apellidom; ?>"  />                
                           
                      
                       </td>
                     </tr>
                     <tr class="fil">
                        <td align="rigth">
                            <strong for="dni"  >DNI:</strong>
                        </td> 
                        <td>
                            <input id="dni" name="dni" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->dni; ?>"  />                
                            
                        </td>   
                        <td align="left">
                            <strong for="sexo"  style="width: 80px">Sexo:</strong>
                        </td>
                        <td>        
                            <select name="sexo" id="sexo">
                                <option value="">...</option>
                                <option value="M" <?php if($obj->sexo=="M"){echo "selected";} ?> >MASCULINO</option>
                                <option value="F" <?php if($obj->sexo=="F"){echo "selected";} ?> >FEMENINO</option>
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
                               <strong for="telefono" class="labels" style="width: 130px;">Telefono:</strong>
                            </td>
                            <td>
                                <input id="telefono" name="telefono" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->telefono; ?>"  />                
                                
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
                    <a href="index.php?controller=docente_cca" class="button">ATRAS</a>
                 </div>   
              </fieldset>
              </div>
        </div>
    </div>
</form>
