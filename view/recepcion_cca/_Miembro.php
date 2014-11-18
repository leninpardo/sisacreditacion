<script type="text/javascript" src="js/app/evt_form_comision_cca.js" ></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<h4 align="center">LISTA DE MIEMBROS</h4>
<a id="nuevom" class="button">NUEVO</a><br><br>
<div style="width: 100%; height: 200px; overflow: scroll;">
    <table class="table table-bordered">
        <tr>
            <td>MIEMBRO</td>
            <td>CARGO</td>
            <td>ACCION</td>
        </tr>        
        <?php  
        foreach ($miembros as $value){?>
        <tr>
            <td>
                <?php echo $value[0]?>
            </td>
            <td>   
                <?php echo $value[2]?>  
            </td>     
            <td><a class="button" href="index.php?controller=detalle_comision_cca&action=delete&id=<?php echo $value[3]?>&idcomi=<?php echo $value[5]?>">ELIMINAR</a></td>
        </tr>
        <input type="hidden" name="codigoc" class="codigoc" value="<?php echo $value[4]?>"/>
        <?php } ?>
    </table>
</div>
