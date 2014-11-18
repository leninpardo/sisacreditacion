<?php  include("../lib/functions.php"); ?>
<script type="text/javascript" src="js/app/evt_form_control_asistencia.js" ></script>
<script type="text/javascript" src="js/validateradiobutton.js"></script>

<div class="div_container">
<h6 class="ui-widget-header">Clase y Asistencia</h6>
<form id="frm" action="index.php" method="POST">
    <input type="hidden" name="controller" value="control_academico_cca" />
    <input type="hidden" name="action" value="save" />
    <div class="contFrm ui-corner-all" style="background: #fff;">
        <div class="contenido" style="margin:0 auto; width: 660px; ">
            <div class="col-md-12">
                Asignatura: 
            <?php
               echo $asignaturas;
            ?>
            </div>
            <br/><br/><br/>
            <div class="col-md-6">
                Clase:
                <input type="text" name="tema" id="tema" class="form-control" style="width: 80%" />
            </div>
            <div class="col-md-6">
                Fecha:
                <input type="text" name="fecha" id="fecha" class="form-control" style="width: 60%" readonly="readonly" value="<?php echo date("Y-m-d") ?>" />
            </div>
                <div  style="clear: both; padding: 10px; width: auto;text-align: center">
                    <a href="#" id="save" class="button">GRABAR</a>
                    <a href="index.php?controller=control_academico_cca" class="button">ATRAS</a>
                </div>
        </div>
    </div>
</form>
</div>


