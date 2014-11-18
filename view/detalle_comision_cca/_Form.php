<?php  include("../lib/functions.php"); ?>
<script type="text/javascript" src="js/app/evt_form_detcom_cca.js" ></script>
<script type="text/javascript" src="js/validateradiobutton.js"></script>
<script>
    function get2(p1,p2)
    {   
         opener.document.getElementById("iddocente").value=p1;
         opener.document.getElementById("nombres").value=p2;
         window.close();

    }
   
</script>
<div class="div_container">
<h6 class="ui-widget-header">Nuevo Docente a la Comision</h6>
<form id="frm" action="index.php" method="POST" accept-charset="UTF-8">
    <input type="hidden" name="controller" value="detalle_comision_cca" />
    <input type="hidden" name="action" value="save" />
    <div class="contFrm ui-corner-all" style="background: #fff;" >
        <div class="contenido" style="margin:0 auto; width: 450px; " align="center">
            <fieldset class="ui-corner-all" >
                <legend>Datos</legend> 
                <table>
                    <tr>
                        <td>
                            <label for="iddetalle_comision">Codigo:</label>
                        </td>
                        <td>
                            <input id="iddetalle_comision" name="iddetalle_comision" class="text ui-widget-content ui-corner-all" style=" width: 60px; text-align: left;" value="<?php echo $obj->iddetalle_comision; ?>"readonly />
                        </td>
                        <td>
                            <label for="Docente" >Docente:</label>
                        </td>
                        <td>
                            <input id="idcomision" type="hidden" name="idcomision" value="">
                            <input id="iddocente" type="hidden" name="iddocente" class="text ui-widget-content ui-corner-all" style=" width: 30px; text-align: left;" value="<?php echo $obj->iddocente; ?>"readonly />
                            <input id="nombres" name="nombres" class="text ui-widget-content ui-corner-all" style=" width: 170px; text-align: left;" value="<?php echo $obj->nombres; ?>"readonly />
                            <a  onclick='window.open("index.php?controller=docente_cca&action=buscar2","ventana4", "width=860,height=400,top=150,left=250")'><img alt="" src="images/lupa.gif" /></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="idcargocomision">Cargo:</label>
                        </td>
                        <td>
                            <?php echo $idcargocomision; ?>
                        </td>
                    </tr>
                </table>    
            </fieldset>
        </div>
            <div style="margin:0 auto; width: 450px; height: 100px;">
            <fieldset class="ui-corner-all" >
            <legend>Accion</legend>
                <div  style="clear: both; padding: 10px; width: auto;text-align: center">
                    <a href="#" id="save" class="button">GRABAR</a>
                    <!--<a href="index.php?controller=comision_cca" class="button">ATRAS</a>-->
                </div>
                </fieldset>
            </div>
    </div>
</form>
</div>