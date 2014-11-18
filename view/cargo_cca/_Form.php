<?php  include("../lib/functions.php"); ?>
<script type="text/javascript" src="js/app/evt_form_cargo_cca.js" ></script>
<script type="text/javascript" src="js/validateradiobutton.js"></script>
<div class="div_container">
<h6 class="ui-widget-header">Registro de Cargo</h6>
<form id="frm" action="index.php" method="POST">
    <input type="hidden" name="controller" value="cargo_cca" />
    <input type="hidden" name="action" value="save" />
    <div class="contFrm ui-corner-all" style="background: #fff;">
        <div class="contenido" style="margin:0 auto; width: 750px; " align="center">
            
            <fieldset class="ui-corner-all" >
                <legend>Datos</legend>            
                <table border="0" cellpadding="3" cellspacing="1" style="background-color:#fff;margin-left:8%" >
                    <tr class="fil">
                      <td width="20%">
                        <label for="idcargo">Codigo:</label>
                       </td>
                       <td>
                           <input id="idcargo" maxlength="100" name="idcargo" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->idcargo; ?>" readonly>
                       </td>
                       <td>
                        <label for="descripcion" class="labels" style="width: 110px" >Nombre Cargo:</label>
                       </td>
                       <td>
                       <input id="descripcion" maxlength="100" name="descripcion" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->descripcion; ?>" >
                       <div id="descripcion_numero" class="error" name="descripcion_numero" style="color: red">INGRESE DESCRIPCION</div>
                       </td>
                      </tr>                
                        </table>
             </fieldset> 
                 <div class="contenido" style="margin:0 auto; width: 350px; ">
                    <fieldset class="ui-corner-all" >
                    <legend>Accion</legend>
                    <div  style="clear: both; padding: 10px; width: auto;text-align: center">
                    <a href="#" id="save" class="button">GRABAR</a>
                    <a href="index.php?controller=cargo_cca" class="button">ATRAS</a>
                    </div>
                    </fieldset>
                 </div>
        </div>
    </div>
</form>
</div>