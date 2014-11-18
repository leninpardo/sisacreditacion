<h4>EVALUACIÓN</h4> <button id="" type="button" class="btn btn-default" onClick="eva()">Agregar</button> <br>
<table class="table eva" id="eval">
	<thead>
		<tr>
			<th>tipo Evaluacion</th>
			<th>Descripcion</th>
			<th>fecha</th>
			<th>ponderado</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($rows as $key => $value) { ?>
			<tr class="dtp1">
				<td >
					<input type="hidden" id="ideva" value="<?php echo $value[4]?>" />
				 <?php 
                mysql_connect("localhost", "root", "");
                mysql_select_db("sisacreditacion");
               $consulta=mysql_query("SELECT idtipo_evaluacion,descripcion from tipo_evaluacion  ");
               echo "<select style='border:none; background:#EAF8FC; width:300px;' class='form-control k2' id='idtipo_evaluacion'>";
                   while($registro=mysql_fetch_row($consulta)){
                   	 if ($value[0] != $registro[0] ) {
                       echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
                   }else{
                   		echo "<option selected value='".$registro[0]."'>".$registro[1]."</option>";
                   }
                    }
                echo "</select>";   
         ?>    
				</td>
				<td>
				<textarea class="k2" style="border: none; resize: none; background-color: rgb(249, 249, 249);" id="descripcionevaluacion"><?php echo (utf8_encode($value[1]));?></textarea>
				</td>
				<td>
				<?php echo (utf8_encode($value[2]));?>
				</td>
				<td>
				<?php echo (utf8_encode($value[3]));?>
				</td>
			</tr>
<?php } ?>
	</tbody>
</table>

<script type="text/javascript">
    $(document).ready(function(){
        $('.eva select').change(function(){
	        edit= $(this).val();
	        campo= $(this).attr('id');
	        ide=$('#ideva').val();
	        //alert(edit + " "+campo + " " + ide);
	        $.post('index.php', 'controller=cursosemestre&action=editarEva_tipo&Campo=' +campo+
	                                                '&Evaluacion='+ide+'&Editar='+edit, function(data) {
	                          });
        });

        $('.eva .k2').blur(function(){
	        edit= $(this).val();
	        campo= $(this).attr('id');
	        ide=$('#ideva').val();
	        //alert(edit + " "+campo + " " + ide);
	        $.post('index.php', 'controller=cursosemestre&action=editarEva_tipo&Campo=' +campo+
	                                                '&Evaluacion='+ide+'&Editar='+edit, function(data) {
	                          });
        });
    });
</script>