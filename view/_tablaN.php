<script type="text/javascript" src="lib/alertify.js"></script>
<link rel="stylesheet" href="themes/alertify.core.css" />
<link rel="stylesheet" href="themes/alertify.default.css" />
<style>
	 #ola .tnota{
		padding: 0px;
		width: 38px; 
		
	}
	#ola .tnota input{
		font-size: 10px;
		padding: 1px 8px;
		height: 30px;
		border: none;
	}
</style>
<div class="row">
    <div class="col-md-12" id="aumentar">
		<div class='container-fluid' id="grande">
			<form id="formnotas" method="post">
				<table class="table table-hover table-bordered" id="ola" >
					<thead>   
						<tr style="background-color:#eaf8fc;" > 
							<th>Código</th>
							<th >NOMBRE</th>
							<?php $cont=0;foreach ($rows2 as $key => $value) { ?>
							<th>
								<?php 
									/*$new_array=explode(' ',$value[7]);
									$acr='';
									$contad=count($new_array);
									if($contad>1){
										foreach($new_array as $key=>$val){											
											echo $val[0];
										}
									}else{
										echo substr($value[7],0,3);
									}*/
									echo $cont+1;
								?>
							</th>
							<?php $cont=$cont+1;}?>
							<th padding="25px 20px" >Promedio</th>
						</tr>
       
					</thead>
					<tbody style="width:100%;">
						<?php foreach ($rows as $key => $value) { ?>
						<tr> 
							<td>
								<?php echo strtoupper(utf8_encode($value[2]));?>
								<input type="hidden" name="idalumno[]" value="<?php echo $value[0] ?>" >
							</td>   
							<td style="font-size:11px;" align="left">
								<?php echo strtoupper(utf8_encode($value[1]));?>
							</td>

							<?php $alum= $value[0];
								if (isset($rows2)){
									foreach ($rows2 as $key => $value) {  $ie= $value[3];?>
										<td class="campo<?php echo $value[3];?> tnota" name="<?php echo $value[3];?>">
											<?php if (isset($rows3)){
											 foreach ($rows3 as $key => $value) { ?>
											 	<?php if (($value[0]==$alum) && ($value[2]==$ie)){ ?>
											 	<input type='text' maxlength='2'  pattern='{0-9}+'  class='form-control nota' type="number" id="<?php echo $alum;?>,<?php echo $ie;?>" value="<?php echo $value[1];?>" onblur='hi(this)'/>	
											<?php } } } ?>
										</td>
							<?php   }
								}
							?>
							<td>
								falta
							</td>
						</tr>
					<?php } ?>
					</tbody>
					<!---
					<tfoot style="display: inline-block;width:100%">
						<tr>
							<td style="border:0;">
								<div class="button" id="enviarn">Enviar</div>
							</td>
						</tr>
					</tfoot>
   					-->
				</table>
			</form>
		</div>
    </div>             
</div>
<script>
	function hi(control){
		//alert(control.value);
		cl2= $(control).attr('id');
		myArray = cl2.split(',');
		idAlumno=myArray[0];
		idTipEvaluacion=myArray[1];
		campoInput= $(control).val();

		$.post('index.php', 'controller=cursosemestre&action=editarNota&CodAlumno=' +idAlumno+'&CodTipEvaluacion='+idTipEvaluacion+'&campo='+campoInput, function(data) {
        });

       curso= $('#tablaevaluaciones .pn4 .codcurso').val();
    VerRegistro(curso);
    alertify.log("se inserto nota");
		/*
        $.post('index.php','controller=cursosemestre&action=getCalificaciones&idsemestre='+codsemestre+'&idcurso='+codcurso+'&idalumno='+idAlumno, function(data) {
        $(".vernot").empty().append(data);
        $(".vernot input[type=number]").css("display","");
	    });*/
	}
/*
	$('#ola .tnota').click(function(){
		cl= $(this).attr('id');
		$('input[type=text]').attr('id',''+cl);
		$('<div class="vernot"></div>').appendTo(''+this);

	});
*/
</script>
