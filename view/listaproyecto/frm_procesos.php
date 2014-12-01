<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<link type="text/css" href="bootstrap/css/bootstrap.css" rel="stylesheet" />
<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<div class="">
<form id="frm_procesos">
    <div class="span6">
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
                <input readonly="" value="<?php echo date("Y-m-d");?>"class="text-info" type="text" name="fecha_i" id="fecha_i" />
            </div>
            <div>
                <label>Cantidad(Dias):</label>
                <input class="text-info" type="text" name="n_dias" id="n_dias" />
            </div>
            <div>
                <label>Fecha Limite:</label>
                <input class="text-primary" type="text" name="fecha_l" id="fecha_l" />
            </div>
           
        </fieldset>
    </div>
    <div class="span5">
    <div>
        <label>
            Responsable del Proceso:
        </label>
        <span class="h3" id="responsable"></span>
    </div>
  
    <div>
        <label>
            Cantidad(<span id="medicion_fecha"></span>):
        </label>
        <span class="h3" id="numero"></span>
    </div>
    
</div>
    <div class="span8 form-actions">
        <fieldset>

            <legend>Acciones</legend>
            <a class="btn btn-default" id="guardar" >Guardar</a>
            <a class="btn btn-default" id="cancel" value="cerrar">Cerrar</a>
        </fieldset>
    </div>
</form>
</div>

<script>
    $(function()
    {
        $("#n_dias").keyup(function(){
                      bval = true;
        bval = bval && $(this).required();
        str="fecha_inicio="+$("#fecha_i").val()+"&n_dias="+$(this).val();
        if(bval){
            $.post('index.php', 'controller=listaproyecto&action=calcular_fecha&' + str, function(data)
            {
              
        $("#fecha_l").val(data);
            });
        }
        return false;  
        });
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
       /*var file = $("#documento")[0].files[0];
       
        var fileName = file.name;*/
      /*  var fileInput = document.getElementById ("documento");
          var file = fileInput.files[0].mozFullPath;*/
          
            str = $("#frm_procesos").serialize();
         //str=str+"&documento="+file.name;
             //(str);
                   bval = true;
        bval = bval && $("#select_proceso" ).required();
        bval = bval && $("#fecha_i" ).required();
        bval = bval && $("#fecha_l" ).required();
       
        if(bval){
            $.post('index.php', 'controller=listaproyecto&action=save_procesos&' + str, function(data)
            {
                if (data.rep==1) {
                    alert("se guardo correctamente");
                    $.unblockUI({
                        onUnblock: function() {
                            $("#emergente").html("");
                        }
                    });
                    location.reload();
                } else {
                    alert(data.msg);
                }
            },'json');
        }
        return false;
        });
        $("#select_proceso").change(function(){
             $.post('index.php', 'controller=listaproyecto&action=get_procesos_all&id=' +$(this).val(), function(data)
            {
                $("#responsable").append(data.responsable);
                if(data.medicion_fecha==1){x="dias";}else if(data.medicion_fecha==2){x="semanas";}
                else if(data.medicion_fecha==3){x="meses";}
                
                 $("#medicion_fecha").append(x);
                  $("#numero").append(data.numero);
                    if (data.numero != null) {
                        $("#n_dias").val(data.numero);
                        $.post('index.php', 'controller=listaproyecto&action=calcular_fecha&n_dias=' + data.numero + "&fecha_inicio=" + $("#fecha_i").val(), function(data)
                        {
                            $("#fecha_l").val(data);
                        });
                    } else {
                        $("#n_dias").attr("reandonly", false);
                    }
                }, 'json');
            });

        });
</script>