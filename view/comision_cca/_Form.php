<?php  include("../lib/functions.php"); ?>
<script type="text/javascript" src="js/app/evt_form_comision_cca.js" ></script>
<script type="text/javascript" src="js/validateradiobutton.js"></script>
<div id="mayor" style="margin-top: 0px; margin-left: 80px; width: 600px; height: 350px;" >
<!--<div class="div_container"  style="background-color: red">-->
    <form id="frm" action="index.php" method="POST" accept-charset="UTF-8">
    <input type="hidden" name="controller" value="comision_cca" />
    <input type="hidden" name="action" value="save" />
    <!--<div class="contFrm ui-corner-all" style="background: #fff;" >-->
        <?php if(isset($_POST['b'])){?>
        <div class="contenido" style="margin:0 auto; width: 550px; " align="center">
        <?php }else{?>
            <div class="contenido" style="margin-left:10%; width: 550px; " align="center">
             <?php }?>
                <fieldset class="ui-corner-all" >
                <legend>Datos</legend>
                <table border="0" cellpadding="3" cellspacing="1" style="background-color:#fff;margin-left:0%" >
                    <tr class="fil">
                        <td>
                            <label for="idcomision">Codigo:</label>
                        </td>
                        <td>
                            <input id="idcomision" name="idcomision" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->idcomision; ?>"readonly />
                        </td>
                        <td width="20%" align="left">
                            <label for="comision" >Nombre Comision:</label>
                        </td>
                        <td>
                            <input id="comision" name="comision" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->comision; ?>" required="date" />
                        </td>
                    </tr>
                    <tr class="fil">
                        <td width="20%" align="left">
                            <label for="fecha_inicio">Fecha de inicio:</label>
                        </td>
                        <td width="30%">
                            <input id="fecha_inicio" name="fecha_inicio" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->fecha_inicio; ?>" />                  
                        </td>
                        <td width="20%" align="left">
                            <label for="fecha_termino">Fecha de fin:</label>
                        </td>  
                        <td width="30%" >
                            <input id="fecha_termino" name="fecha_termino" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->fecha_termino; ?>" />   
                        </td>
                    </tr> 
                    <tr>
                        <td>
                            <label for="descripcion">Descripcion:</label>
                        </td>
                        <td>
                            <input id="descripcion" name="descripcion" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->descripcion; ?>" />
                        </td>
                    </tr>
                </table>
                </fieldset>
            </div>
            <div style="margin-left:10%; width: 550px; height: 70px;">
            <fieldset class="ui-corner-all" >
            <legend>Accion</legend>
                <div  style="clear: both; padding: 10px; width: auto;text-align: center">
                    <a href="#" id="save" class="button">GRABAR</a>
                </div>
                </fieldset>
            </div>
       </div>
    
    <!--</div>-->
</form>
<!--</div>-->
</div>