<?php  include("../lib/functions.php"); ?>
<script type="text/javascript" src="js/app/evt_form_asignatura_cca.js" ></script>
<script type="text/javascript" src="js/validateradiobutton.js"></script>

<div class="div_container">
<h6 class="ui-widget-header">Registro de asignaturas CCA</h6>
<form id="frm" action="index.php" method="POST">
    <input type="hidden" name="controller" value="asignatura_cca" />
    <input type="hidden" name="action" value="save" />
    <div class="contFrm ui-corner-all" style="background: #fff;">
        <div class="contenido" style="margin:0 auto; width: 450px; " align="center">
            <fieldset class="ui-corner-all" >
                <legend>Datos</legend>  
                <table border="0" cellpadding="3" cellspacing="1" style="background-color:#fff;" >
                    <tr class="fil">
                        <td width="20%" align="left">
                            <strong for="idasignatura">ID:</strong>
                        </td>
                        <td width="30%">
                            <input id="idasignatura" name="idasignatura" class="text ui-widget-content ui-corner-all" style=" width: 30px; text-align: left;" value="<?php echo $obj->idasignatura; ?>" readonly />      
                            <input id="idcomision" type="hidden" name="idcomision" value="">
                        </td>
                        <td width="20%" align="left">
                            <strong for="descripcion" >Asignatura:</strong>
                        </td>  
                        <td width="30%" >
                            <input id="descripcion" name="descripcion" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->descripcion; ?>"  />                                            
                            <!--<div id="descripcion_error" class="error" name="descripcion_error" style="color: red">INGRESE DESCRIPCION</div>-->
                        </td>
                    </tr>
                    <tr class="fil">
                        <td align="left">
                           <strong for="iddocente"  >Docente:</strong>
                        </td>
                        <td>
                            <input id="iddocente" type="hidden" name="iddocente" class="text ui-widget-content ui-corner-all" style=" width: 30px; text-align: left;" value="<?php echo $obj->iddocente; ?>"readonly />
                            <input id="nombres" name="nombres" class="text ui-widget-content ui-corner-all" style=" width: 100px; text-align: left;" value="<?php echo $obj->nombres; ?>"readonly />
                            <a  onclick='window.open("index.php?controller=docente_cca&action=buscar2","ventana4", "width=860,height=400,top=150,left=250")'><img alt="" src="images/lupa.gif" /></a>
                            <!--<div id="iddocente_error" class="error" name="iddocente_error" style="color: red">INGRESE DOCENTE</div>-->
                        </td>
                        <td> 
                            <strong for="creditaje" class="labels" style="width: 130px;">Creditaje:</strong>
                        </td>
                        <td>
                            <input id="creditaje" name="creditaje" class="text ui-widget-content ui-corner-all " style=" width: 150px; text-align: left;" value="<?php echo $obj->creditaje; ?>"  />                
<!--                            <div id="creditaje_error" class="error" name="creditaje_error" style="color: red">INGRESE CRETIAJE</div>
                            <div id="creditaje_numero" class="error" name="creditaje_numero" style="color: red">INGRESE SOLO NUMEROS</div>-->
                        </td>
                    </tr>
                </table>
                </fieldset>
            </div>
            
            <div class="contenido" style="margin:0 auto; width: 450px; " align="center">
                <fieldset class="ui-corner-all" >
                    <legend>Accion</legend> 
                    <div  style="clear: both; padding: 10px; width: auto;text-align: center">
                        <a href="#" id="save" class="button">GRABAR</a>
                        <!--<a href="index.php?controller=asignatura_cca" class="button">ATRAS</a>-->
                    </div>   
                </fieldset>
            </div>
        </div>
</form>
</div>

