
<h6 class="ui-widget-header">Verificacion de los procesos del proyectos</h6>
<div>
    <table>
        <tr>
            <td>
               Nombre Proyecto:
            </td>
            <td>
              <?php echo $proyecto[0][1]; ?>
                <input type="hidden" id="idproyecto" name="idproyecto" value="<?php echo $proyecto[0][0];?>"/>
               
            </td>
        </tr>
        <tr>
            <td>
                Jefe Proyecto:
            </td>
            <td>
                <?php echo $proyecto[0][2]; ?>
            </td>
        </tr>
    </table>
</div>
<div class="container-fluid">
    <table class="table table-bordered table-hover table-responsive">
        <tr>
            <th>Actividad</th>
            <th>Responsable</th>
            <th>Fecha Ingresos/inicio</th>
            <th>Fecha Plazo</th>
            <th>Fecha Entrega/Culminacion</th>
            <th>Descripcion</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    
    <?php 
  // echo count($lista);
    if($lista!=null){
    foreach ($lista as $l)
    {
     echo "<tr>";
    // echo "<td>".$l[0]."</td>";
      echo "<td>".$l[1]."</td>";
       echo "<td>".$l[2]."</td>";
        echo "<td>".$l[3]."</td>";
         echo "<td>".$l[4]."</td>";
          echo "<td>".$l[5]."</td>";
          echo "<td>".$l[6]."</td>";
          if($l[7]==1)
          {
              if(date('Y-m-d')>$l[4]){
              echo "<th>En proceso, con fecha retardada</th>";
              }else{
                 echo "<th>En proceso</th>";  
              }
          }else{
              //echo "<th>Finalizado el proceso</th>"; 
                if($l[5]>$l[4]){
              echo "<th>Finalizado, con fecha retrasada</th>";
              }else{
                 echo "<th>Finalizado el proceso</th>";  
              }
          }
          echo "<th><a class='btn btn-info'id='' href='#'>Verificar/culminar proceso</a></th>";
     echo '</tr>';
    }
    
    }
    else{
        echo "<tr><td>No se encontraron procesos en el proyecto agregue</td></tr>";
    }
    
        ?>
        </table>
</div>
<div>
    <a class="btn btn-default" id='agregar'>Agregar procesos al proyecto</a>
</div>



<!-- modal de asignar nueva proceso-->
 <div id="emergente" >
    
        
  </div>
<!--en modal-->
<script>
      $(function(){
    $("#agregar").click(function(e){
        
      e.preventDefault();
$("#emergente").load("index.php?controller=listaproyecto&action=get_procesos&id="+$("#idproyecto").val(), function(){
			//$.getScript('web/js/funciones.js');
			//boquea la pantalla
			$.blockUI({
                            //overlayCSS: { backgroundColor: '#00f' }
				message: $("#emergente"),
				css:{
					top: '10%',
					width: '77%',
					height: '80%',
					left: '15%'
                                       // backgroundColor: '#5d881a'
				}
			}); 
		});  
    });
    });
</script>