<?php  include("../lib/functions.php"); ?>
<script type="text/javascript" src="js/app/evt_form_control_asistencia.js" ></script>
<script type="text/javascript" src="js/validateradiobutton.js"></script>

<form id="frm" action="index.php" method="POST">
    <input type="hidden" name="controller" value="control_academico_cca" />
    <input type="hidden" name="action" value="save_asistencia" />
<div class="div_container">
<h6 class="ui-widget-header">Clase y Asistencia</h6>
<input type="hidden" name="idclase" value="<?php echo $clase[0]['idclase'] ?>" />
<div class="col-md-8"><b>Asignatura:</b> <?php echo $clase[0]['asignatura']; ?></div>
<div class="col-md-4"><b>Fecha:</b> <?php echo $clase[0]['fecha']; ?></div><br/><br/>
<div class="col-md-8"><b>Tema:</b> <?php echo $clase[0]['tema']; ?></div><br/><br/>
<div class="col-md-1"></div>
<div class="col-md-10">
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Alumno</th>
                <th>Asistió</th>
                
            </tr>
        </thead>
        <tbody>
            <?php for($i=0; $i<count($alumnos); $i++){ ?>
            <tr>
                <td class="text-left"><?php echo utf8_decode($alumnos[$i]['alumno']); ?></td>
                <td><input type="checkbox" name="asistio[]" value="<?php echo $alumnos[$i]['idmatricula'] ?>"/></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div class="col-md-1"></div>
                <div  style="clear: both; padding: 10px; width: auto;text-align: center">
                    <a href="#" id="gsave" class="button">GRABAR</a>
                    <a href="index.php?controller=control_academico_cca" class="button">ATRAS</a>
                </div>
</div>
</form>
<style>
    .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
        padding: 3px 8px;
    }
</style>
