<?php  include("../lib/functions.php"); ?>
<script type="text/javascript" src="js/app/evt_form_clase_cca.js" ></script>
<script type="text/javascript" src="js/validateradiobutton.js"></script>
<div class="div_container">
<h6 class="ui-widget-header">Registro de Clases</h6>

<form id="frm" action="index.php" method="POST" accept-charset="UTF-8">
    <input type="hidden" name="controller" value="clase_cca" />
    <input type="hidden" name="action" value="save" />
    <div class="contFrm ui-corner-all" style="background: #fff;" >
        <div class="contenido" style="margin:0 auto; width: 750px; " align="center">
           
            <fieldset class="ui-corner-all" >
                <legend>Datos</legend>
                 <table border="0" cellpadding="3" cellspacing="1" style="background-color:#fff;margin-left:8%" >
                 <tr class="fil">
                     <td>
                     <label for="idclase">Codigo:</label>
                     </td>
                     <td>
                     <input id="idclase" name="idclase" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->idclase; ?>"readonly />
                     </td>
                     <td>
                        <strong for="idasignatura" class="labels" >Asignatura:</strong>
                     </td>
                     <td>        
                        <?php echo $asignatura; ?>
                     </td> 
                 </tr>
                 <tr class="fil">
                     <td width="20%" align="left">
                     <label for="tema" >Tema:</label>
                     </td>
                     <td>
                     <input id="tema" name="tema" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->tema; ?>" />
                     </td>
                    <td width="20%" align="left">
                    <label for="fecha">Fecha:</label>
                    </td>
                    <td width="30%">
                    <input id="fecha" name="fecha" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->fecha; ?>" />                  
                    </td>
                    </tr>      
                 </table>
       </fieldset>
      </div>

            <div style="margin:0 auto; width: 660px; height: 70px;">
            <fieldset class="ui-corner-all" >
            <legend>Accion</legend>
                <div  style="clear: both; padding: 10px; width: auto;text-align: center">
                    <a href="#" id="save" class="button">GRABAR</a>
                    <a href="index.php?controller=clase_cca" class="button">ATRAS</a>
                </div>
                </fieldset>
                </div>
        </div>
    </form>
</div>