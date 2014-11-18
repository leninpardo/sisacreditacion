<?php if ($opcion=="normal"){?>
<div class="row">
<div class=" col-md-11 " >
    <div class="container-fluid">
        <h4 style="font-family: comic; font-size:18px " >Alumnos Matriculados al curso</h4>
      <table class="table table-striped table-hover table-bordered" style="width: 75%; margin: auto; ">
         <thead>
          <tr   style="background-color:#eaf8fc;" > 
            <th style="text-align:center">N°</th>
            <th style="text-align:center">APELLIDOS Y NOMBRES</th>
            <th style="text-align:center">CÓDIGO</th>
          </tr>
        </thead>
        <tbody>
           <?php $i=1; foreach ($rows as $key => $value) { ?>
            <tr>
              
                <td width="30px"><?php echo $i; ?></td>
                <td align="left" width="170px">
                    <?php echo strtoupper(utf8_encode($value[1]));?>

                                   </td>
                <td width="20px">
                  <?php echo $value[2];?>

                </td>
            </tr>  
          <?php $i++; } ?>
        </tbody>
    </table>
<?php }else {
    if($opcion=="asistencia"){?>
        <br>
<div class="row">
<div class=" col-md-11 " >
    <div class="container-fluid" style="overflow-y: auto; max-height: 520px; ">
        <form id="formasis" method="post">
        <table class="table table-hover table-bordered" id="ola" align="center">
            <thead>
   
      <tr   style="background-color:#eaf8fc;" > 
          <td padding="25px 20px" rowspan="2">CODIGO</td>
          <td padding="25px 20px" rowspan="2">NOMBRE</td>
          <td padding="25px 20px" rowspan="2">ASISTENCIA</td>
          
          
            
    </tr>
       
  </thead>
   <?php foreach ($rows as $key => $value) { ?>
    <tr>    
        <td> 
            <?php echo $value[0];?>
            <input type="hidden" class="alumnos" id="<?php echo $value[0];?>" name="alumno[]" value="<?php echo $value[0];?>"/>
        </td>
        <td align="left">
            <?php echo strtoupper(utf8_encode($value[1]));?>
            <div class="daridclase">
                
            </div>
        </td>
 
        <td>
            Llego <input type="checkbox" id="asistio" class="asistencia" name="asisten[]" value="L" /> &nbsp; Llego tarde<input type="checkbox"id="llegoT" class="asistencia" name="asisten[]" value="LT"/>&nbsp; No llego <input type="checkbox" id="Nollego" class="asistencia" name="asisten[]" value="NT"/>
        </td>
        
    </tr>  
  <?php } ?>
    <tr><td colspan="3"><input type="button" value="Enviar" id="enviarA"/></td></tr>

</table>
            </form>
        <br>
        
<?php }}?>

<div id="asisss">
            
        </div>
