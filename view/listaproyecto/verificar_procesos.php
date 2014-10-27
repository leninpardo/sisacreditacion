<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<link type="text/css" href="bootstrap/css/bootstrap.css" rel="stylesheet" />
<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<form id="frm_procesos">
    <div class="form">
        <fieldset>
            <legend>Datos de registro de procesos</legend>
            <div>
                <label>lista de Procesos</label>
                <input type="hidden" name="id_proyecto" id="id_proyecto" value="<?php echo $datos[0][3]; ?>">
                <input type="hidden" name="idproceso" id="id_proyecto" value="<?php echo $datos[0][0]; ?>">
               <input type="text" readonly name="nombre_proceso" id="nombre_proceso" value="<?php echo $datos[0][1];?>"/>
            </div>
            <div>
                <label>Fecha inicio:</label>
                <input  readonly="" class="text-info" type="text" name="fecha_i" id="fecha_i" value="<?php echo $datos[0][5]; ?>" />
            </div>
            <div>
                <label>Fecha Limite/plazo:</label>
                <input readonly class="text-primary" type="text" name="fecha_l" id="fecha_l" value="<?php echo $datos[0][6]; ?>"/>
            </div>
            <div>
                <label>Fecha Entrega:</label>
                <input  class="text-primary" type="text" name="fecha_e" id="fecha_e" value="<?php echo $datos[0][7]; ?>"/>
            </div>
            <div>
                <label>Fecha observaciones:</label>
                <textarea id="obs" name="obs">
                <?php echo $datos[0][8]; ?>
                </textarea>
            </div>
        </fieldset>
        
    </div>
    <div class="">
        <fieldset>

            <legend>Acciones</legend>
            <?php if($datos[0][9]==1){ ?>
            <a class="btn btn-default" id="guardar" >Dar por culminacion el proceso</a>
            <?php }else{?>
            <div class="message">El proceso se concluyo</div>
            <?php }?>
            <a class="btn btn-default" id="cancel" value="cerrar">Cerrar</a>
        </fieldset>
    </div>
</form>
<script>
    $(function()
    {
        
        $("#cancel").click(function() {
            $.unblockUI({
                onUnblock: function() {
                    $("#emergente").html("");
                }
            });
        });
        $("#fecha_e").datepicker({
            dateFormat: 'yy-mm-dd',
        });
     
        $("#guardar").click(function() {
            str = $("#frm_procesos").serialize();
                bval = true;
        
        bval = bval && $("#fecha_e").required();
        bval = bval && $("#obs").required();
        if(bval){
            $.post('index.php', 'controller=listaproyecto&action=update_procesos&' + str, function(data)
            {
                if (data.rep!=1) {
                    alert("se Finalizo correctamente");
                    $.unblockUI({
                        onUnblock: function() {
                            $("#emergente").html("");
                        }
                    });
                    location.reload();
                } else {
                    alert(data.rep);
                }
            });
            }
            return false;
        });

    });
</script>