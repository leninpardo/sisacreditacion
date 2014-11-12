
        
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
            <th rowspan="2">Actividad</th>
            <th rowspan="2">Responsable</th>
            <th rowspan="2">Fecha Ingresos/inicio</th>
            <th rowspan="2">Fecha Plazo</th>
            <th rowspan="2">Fecha Entrega/Culminacion</th>
            <th rowspan="2">Descripcion</th>
            <th rowspan="2" >Dias restantes</th>
            <th rowspan="2">Estado</th>
            <th colspan="2">Acciones</th>
            
        </tr>
        <tr>
            <th>Verificar</th>
            <th>Siguiente proceso</th>
        </tr>
    
    <?php 
    function dias_transcurridos($fecha_i,$fecha_f)
{
	$dias	= (strtotime($fecha_f)-strtotime($fecha_i))/86400;// para sacar en dias los segundos
//	$dias 	= abs($dias);
        $dias = floor($dias);	
        //$n_dias=(strtotime($fecha_p)-strtotime($fecha_i))/86400;
        //$n_dias=  floor($n_dias);
        if($dias<0){$dias_data['estado']='pasó';$dias_data['estado1']='pasando';}
        elseif($dias==0){$dias_data['estado']='Hoy';$dias_data['estado1']='En fecha de Plazo';}
        else{$dias_data['estado']='faltan';$dias_data['estado1']='faltando';}
        
        $dias_data['cantidad']= abs($dias);
        //$dias_data['n_dias']=abs($n_dias);
	return $dias_data;
}
  // echo count($lista);
    if($lista!=null){
        
    foreach ($lista as $k=>$l)
    {
     echo "<tr>";
   
      echo "<td>".$l[1]."</td>";
       echo "<td>".$l[2]."</td>";
        echo "<td>".$l[3]."</td>";
         echo "<td>".$l[4]."</td>";
          echo "<td>".$l[5]."</td>";
          
          echo "<td>".$l[6]."</td>";
          
          
          if($l[7]==1)
          {
              $dias=dias_transcurridos(date("Y-m-d"),$l[4]);
              echo "<th>".$dias['estado']." ".$dias['cantidad'] ." dias </th>";
              if(date('Y-m-d')>$l[4]){
              echo "<th><a class='btn btn-danger'>En proceso,Fecha Retrasada</a></th>";
              }else{
                 echo "<th ><a class='btn btn-warning'>En proceso</a></th>";  
              }
          }else{
              //echo "<th>Finalizado el proceso</th>"; 
              $dias=dias_transcurridos($l[5],$l[4]);
               echo "<th> Se culmino ".$dias['estado1']." ".$dias['cantidad'] ." Dias</th>";
                if($l[5]>$l[4]){
              echo "<th><a class='btn btn-success'>Finalizado,Fecha Retrasada</a></th>";
              }else{
                 echo "<th><a class='btn btn-success'>Finalizado</a></th>";  
              }
          }
          
        if($_SESSION['perfil']=="PRESIDENTE DE PROYECTO DE INVESTIGACION"){
          if($l[7]==1)
          {
                echo "<th><span class='btn btn-info procesos btn glyphicon glyphicon-unchecked' form-control-feedback' proyecto='".$proyecto[0][0]."' val='$l[0]' id='' href='#'></span></th>";
          echo "<th>*.*</th>";
          }  else {
                echo "<th><a class='procesos btn btn-info glyphicon glyphicon-check' proyecto='".$proyecto[0][0]."' val='$l[0]' id='' href='#'></a></th>";
              
                ?>
        <th>
           
                <?php if($k+1==count($lista)){?>
                <a class="btn btn-default  " id='agregar'><i class="glyphicon glyphicon-plus-sign"></i></a>
          <?php }else{echo "*.*";}?>
                
           
        </th>
        <?php 
        }
        
          }
          
     echo '</tr>';
     ?>
        <?php 
           $model=new listaproyecto();
          $datos_sub=$model->lista_subprocesos($l[0],$proyecto[0][0]);
          if($datos_sub!=null){
        ?>
        <tr>
            <td colspan="10">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $l[0]; ?>" aria-expanded="false" aria-controls="collapse<?php echo $l[0]; ?>">
            Ver subprocesos de <?php echo $l[1];?>  
        </a>
      </h4>
    </div>
    <div id="collapse<?php echo $l[0]; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $l[0]; ?>">
      <div class="panel-body">
       <?php 
           // require_once 'model/listaproyecto.php';
           
              if($datos_sub==null)
              {
               echo "no hay subprocesos";   
              }else{
              
                  echo "<table class='table table-bordered table-hover table-responsive'>";
                  foreach ($datos_sub as $ds)
                  {
                     echo "<tr>";
                       echo "<td><input type='hidden' name='' id='' />" . $ds[1] . "</td>";
                       echo "<td>" . $ds[2] . "</td>";
                       echo "<td>" . $ds[3] . "</td>";
                       echo "<td>" . $ds[4] . "</td>";
                       echo "<td>" . $ds[5] . "</td>";
                       echo "<td>" . $ds[6] . "</td>";
                        if ($ds[7] == 1) {
                           $dias = dias_transcurridos(date("Y-m-d"), $ds[4]);
                           echo "<th>" . $dias['estado'] . " " . $dias['cantidad'] . " dias </th>";
                           if (date('Y-m-d') > $ds[4]) {
                               echo "<th><a class='btn btn-danger'>En proceso,Fecha Retrasada</a></th>";
                           } else {
                               echo "<th ><a class='btn btn-warning'>En proceso</a></th>";
                           }
                       } else {
                           //echo "<th>Finalizado el proceso</th>"; 
                           $dias = dias_transcurridos($ds[5], $ds[4]);
                           echo "<th> Se culmino " . $dias['estado1'] . " " . $dias['cantidad'] . " Dias</th>";
                           if ($ds[5] > $ds[4]) {
                               echo "<th><a class='btn btn-success'>Finalizado,Fecha Retrasada</a></th>";
                           } else {
                               echo "<th><a class='btn btn-success'>Finalizado</a></th>";
                           }
                       }
                       if($_SESSION['perfil']=="PRESIDENTE DE PROYECTO DE INVESTIGACION" || $_SESSION['idperil']==3){
                           if($_SESSION['idusuario']==$ds[8]){
                           //if($)
                          if ($ds[7] == 1) {
                           echo "<th><span class='btn btn-info procesos btn glyphicon glyphicon-unchecked' form-control-feedback' proyecto='" . $proyecto[0][0] . "' val='$ds[0]' id='' href='#'></span></th>";
                           echo "<th>*.*</th>";
                       } else {
                           echo "<th><a class='procesos btn btn-info glyphicon glyphicon-check' proyecto='" . $proyecto[0][0] . "' val='$ds[0]' id='' href='#'></a></th>";
                           }
                           
                       }
                  }
                       echo "</tr>";
                   }
                   echo "</table>";
               }
       ?>
      </div>
    </div>
  </div>
        </div>
            </td>
        </tr>
        <?php
    }
    }
    
    }
    else{
        ?>
        <tr>
            <th colspan="8"></th>
            <th>
                <a class="btn btn-default" id='agregar'><i class="glyphicon glyphicon-plus-sign"></i></a>
</div></a>
            </th>
        </tr>
        <?php 
        ///echo "<tr><td>No se encontraron procesos en el proyecto agregue</td></tr>";
    }
    
        ?>
        </table>
</div>
	
<!-- modal de asignar nueva proceso-->
 <div id="emergente" >
    
        
  </div>
<!--en modal-->
<script>
      $(function(){
          $(".procesos1").click(function(){
             alert("Se encuentra finalizado");
          });
          $(".procesos").click(function(e){
              idproceso=$(this).attr("val");
              idproyecto=$("#idproyecto").val();
                e.preventDefault();
                str="idproceso="+idproceso+"&idproyecto="+idproyecto;
$("#emergente").load("index.php?controller=listaproyecto&action=get_verificar_procesos&"+str, function(){
			
			$.blockUI({
                          //  overlayCSS: { backgroundColor: 'white' },
				message: $("#emergente"),
				css:{
					top: '3%',
					width: '77%',
					height: '80%',
					left: '15%'
                                        //backgroundColor: '#5d881a'
				}
			}); 
		});  
    });
   
         
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