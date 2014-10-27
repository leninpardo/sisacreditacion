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
                <input type="hidden" name="id_proyecto" id="id_proyecto" value="<?php echo $lista_procesos[0][3]; ?>">
                <select name="select_proceso" id="select_proceso">

                    <option value="">::seleccione::</option>
                    <?php
                    foreach ($lista_procesos as $l) {
                        echo "<option value='" . $l[0] . "'>" . $l[1] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div>
                <label>Fecha inicio:</label>
                <input class="text-info" type="text" name="fecha_i" id="fecha_i" />
            </div>
            <div>
                <label>Fecha Limite:</label>
                <input class="text-primary" type="text" name="fecha_l" id="fecha_l" />
            </div>
        </fieldset>
    </div>
    <div class="">
        <fieldset>

            <legend>Acciones</legend>
            <a class="btn btn-default" id="guardar" >Guardar</a>
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
        $("#fecha_i").datepicker({
            dateFormat: 'yy-mm-dd',
        });
        $("#fecha_l").datepicker({
            dateFormat: 'yy-mm-dd',
        });
        $("#guardar").click(function() {
            str = $("#frm_procesos").serialize();
            alert(str);
            $.post('index.php', 'controller=listaproyecto&action=save_procesos&' + str, function(data)
            {
                if (data.rep!=1) {
                    alert("se guardo correctamente");
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
        });

    });
</script>