<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<link type="text/css" href="bootstrap/css/bootstrap.css" rel="stylesheet" />
<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<h4 class="ui-widget-header"><center>Datos de Registro de Procesos</center></h4>
<form id="frm_procesos">
    <div class="span5">
        <fieldset>

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
    </div>
    <div class="span5">
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
             <div>
                <label>Documento</label>
                <input type="file" name="documento" id="documento" value=""/>
            </div>
         <div>
                <label>Docente</label>
                 <?php echo $select_docente;?>
            </div>
        </fieldset>
        
    </div>
 
    <div class="span7 form-actions">
        <fieldset>

            <legend>Acciones</legend>
            <?php if($datos[0][9]==1){ ?>
            <a class="btn btn-info" id="guardar" >Dar por culminacion el proceso</a>
            <?php }else{?>
            <div class="message">El proceso se concluyo</div>
            <?php }?>
            <a class="btn btn-info" id="cancel" value="cerrar">Cerrar</a>
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
        
      $("#docentes").change(function() {
        
            str = $("#frm_procesos").serialize();
                bval = true;
        
       // bval = bval && $("#fecha_e").required();
        //bval = bval && $("#obs").required();
        //alert(str);
        if(bval){
            $.post('index.php', 'controller=listaproyecto&action=update_docente&' + str, function(data)
            {
                if (data.rep==1) {
                    alert("se Finalizo correctamente");
                    $.unblockUI({
                        onUnblock: function() {
                            $("#emergente").html("");
                        }
                    });
                    location.reload();
                } else {
                    alert(data.rep.message);
                }
            },'json');
            }
            return false;
        });
     
        $("#guardar").click(function() {
        
            str = $("#frm_procesos").serialize();
                bval = true;
        
       // bval = bval && $("#fecha_e").required();
        //bval = bval && $("#obs").required();
        //alert(str);
        if(bval){
            $.post('index.php', 'controller=listaproyecto&action=update_subprocesos&' + str, function(data)
            {
                if (data.rep==1) {
                    alert("se Finalizo correctamente");
                    $.unblockUI({
                        onUnblock: function() {
                            $("#emergente").html("");
                        }
                    });
                    location.reload();
                } else {
                    alert(data.rep.message);
                }
            },'json');
            }
            return false;
        });

    });
</script>