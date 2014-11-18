<script type="text/javascript" src="js/app/evt_form_comision_cca.js" ></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<h4 align="center">LISTA DE ASIGNATURAS</h4>
<a id="nuevaa" class="button">NUEVA</a><br><br>
<div style="width: 100%; height: 200px; overflow: scroll;">
    <table class="table table-bordered">
        <tr>
            <td>ASIGNATURA</td>
            <td>DOCENTE</td>
                        <td>ACCION</td>

        </tr>

        <?php  
        foreach ($asignaturas as $value){?>
        <tr>
            <td>
                <?php echo $value[0]?>
            </td>
            <td>   
                <?php echo $value[1]?> 
            </td>
                        <td><a class="button" href="index.php?controller=asignatura_cca&action=delete&id=<?php echo $value[2]?>&idcomi=<?php echo $value[3]?>">ELIMINAR</a></td>

        </tr>
        <input type="hidden" name="codigoc" class="codigoc" value="<?php echo $value[2]?>"/>
         <?php } ?>
    </table>
</div>
<!--<div id="formumi">
        
</div>-->

