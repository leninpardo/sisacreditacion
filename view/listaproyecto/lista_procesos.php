<style type="text/css">


    .oddrowcolor{
        background-color:#ffffff;
    }
    .evenrowcolor{
        background-color:#e2e4ff;
    }

</style>
<h6 class="ui-widget-header">Verificacion de los procesos del proyectos</h6>
<br/>
<div class="container-fluid">
    <div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
       <table >
            <tr style="font-size: 16px;font-family: Calibri;">
                <td >
                    &nbsp;&nbsp;&nbsp; <b style="color: #ffffff;">NOMBRE DEL PROYECTO&nbsp;:&nbsp;&nbsp; </b>
                </td>
                <td>
                    <font style="text-transform: uppercase; color: #ffffff;"><?php echo $proyecto[0][1]; ?> </font>
                    <input type="hidden" id="idproyecto" name="idproyecto" value="<?php echo $proyecto[0][0];?>"/>

                </td>
            </tr>
            <tr style="font-size: 16px;font-family: Calibri;">
                <td>
                    &nbsp;&nbsp;&nbsp; <b style="color: #ffffff;">JEFE DEL PROYECTO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp; </b>
                </td>
                <td>
                    <font style="text-transform: uppercase; color: #ffffff; "><?php echo $proyecto[0][2]; ?> </font>
                </td>
            </tr>
        </table>

    </div>

    <table  class=" table table-bordered  table-responsive altrowstable  " id="alternatecolor"  aria-describedby="datatables_info">
        <tr>

            <b><th rowspan="2" bgcolor="#eaf4fd" class="ui-state-default" role="columnheader"  aria-controls="datatables" rowspan="1" colspan="1" style="width: 170px; text-align: center; vertical-align: middle;"><b>ACTIVIDAD</b></th>
                <th rowspan="2" bgcolor="#eaf4fd" class="ui-state-default" role="columnheader"  aria-controls="datatables" rowspan="1" colspan="1" style="width: 170px; text-align: center; vertical-align: middle;"><b>RESPONSABLE</b></th>
                <th rowspan="2" bgcolor="#eaf4fd" class="ui-state-default" role="columnheader"  aria-controls="datatables" rowspan="1" colspan="1" style="width: 170px; text-align: center; vertical-align: middle;"><b>FECHA INGRESOS/<br>INICIO</b></th>
                <th rowspan="2" bgcolor="#eaf4fd" class="ui-state-default" role="columnheader"  aria-controls="datatables" rowspan="1" colspan="1" style="width: 170px; text-align: center; vertical-align: middle;"><b>FECHA PLAZO</b></th>
                <th rowspan="2" bgcolor="#eaf4fd" class="ui-state-default" role="columnheader"  aria-controls="datatables" rowspan="1" colspan="1" style="width: 170px; text-align: center; vertical-align: middle;"><b>FECHA ENTREGA/<br>CULMINACIÓN</b></th>
                <th rowspan="2" bgcolor="#eaf4fd" class="ui-state-default" role="columnheader"  aria-controls="datatables" rowspan="1" colspan="1" style="width: 170px; text-align: center; vertical-align: middle;"><b>DESCRIPCIÓN</b></th>
                <th rowspan="2" bgcolor="#eaf4fd" class="ui-state-default" role="columnheader"  aria-controls="datatables" rowspan="1" colspan="1" style="width: 170px; text-align: center; vertical-align: middle;"><b>DÍAS RESTANTES</b></th>
                <th rowspan="2" bgcolor="#eaf4fd" class="ui-state-default" role="columnheader"  aria-controls="datatables" rowspan="1" colspan="1" style="width: 170px;text-align: center; vertical-align: middle;"><b>ESTADO</b></th>

        </tr>
        <tr>
            <th bgcolor="#eaf4fd" class="ui-state-default" role="columnheader"  aria-controls="datatables" rowspan="1" colspan="1" style="width: 170px; text-align: center; vertical-align: middle;"><b>VERIFICAR</b></th>
            <th bgcolor="#eaf4fd" class="ui-state-default" role="columnheader"  aria-controls="datatables" rowspan="1" colspan="1" style="width: 170px; text-align: center; vertical-align: middle;"><b>OTRO PROCESO</b></th>
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
   $idp=$$l[0];
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
              echo "<th><a class='btn btn-danger'>Proceso Retrasado</a></th>";
              }else{
                 echo "<th ><a class='btn btn-warning'>En proceso</a></th>";  
              }
          }else{
              //echo "<th>Finalizado el proceso</th>"; 
              $dias=dias_transcurridos($l[5],$l[4]);
               echo "<th> Se culmino ".$dias['estado1']." ".$dias['cantidad'] ." Dias</th>";
                if($l[5]>$l[4]){
              echo "<th><a class='btn btn-success'>Proceso Retrasado</a></th>";
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
                echo "<th><a  class='procesos btn btn-info glyphicon glyphicon-check' proyecto='".$proyecto[0][0]."' val='$l[0]' id='' href='#'></a></th>";
              
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
                       echo "<td>" . $ds[1] . "</td>";
                       echo "<td>" . utf8_encode($ds[9]) . "</td>";
                       echo "<td>" . $ds[3] . "</td>";
                       echo "<td>" . $ds[4] . "</td>";
                       echo "<td>" . $ds[5] . "</td>";
                       echo "<td>" . $ds[6] . "</td>";
                        if ($ds[7] == 1) {
                           $dias = dias_transcurridos(date("Y-m-d"), $ds[4]);
                           echo "<th><div></div>". $dias['estado'] . " " . $dias['cantidad'] . " dias  </th>";
                           if (date('Y-m-d') > $ds[4]) {
                               echo "<th><a class='btn btn-danger'>Proceso Retrasado</a></th>";
                           } else {
                               echo "<th><a class='btn btn-warning'>En proceso</a></th>";
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
                           if($_SESSION['idusuario']==$ds[8]||$_SESSION['perfil']=="PRESIDENTE DE PROYECTO DE INVESTIGACION"){
                           //if($)
                          if ($ds[7] == 1) {
                              ?>
          <input type='hidden' name='cls' id=cls'' value='1' class='cls<?php echo $l[0];?>'/>
          <?php
                           echo "<th><span class='btn btn-info procesos btn glyphicon glyphicon-unchecked' form-control-feedback' proyecto='" . $proyecto[0][0] . "' val='$ds[0]' id='' href='#'></span></th>";
                           echo "<th>*.*</th>";
                       } else {
                           ?>
          <input type="hidden" name="cls" id="" value="0" class="cls<?php echo $l[0]; ?>"/>
                               <?php
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
            <div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-bl ui-corner-br ui-helper-clearfix"><br><br></div>

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
              t=0;f=0;
              idproceso=$(this).attr("val");
              idproyecto=$("#idproyecto").val();
              fields = $("input[class='cls"+idproceso+"']").serializeArray();
              $("input[class='cls"+idproceso+"']").each(function ()
        {
            if($(this).val()==1){
                t=t+1;
            }else{
             f=f+1;   
            }
            //checked.push($(this).val());
        });
               /*fields = $("input[class='cls"+idproceso+"']").serializeArray();
             for(i=0;i<fields.length;i++)
             {
                 alert(fields[i][0]);
             }*/if(fields.length==0&t==fields.length)
        {
                e.preventDefault();
                
                str="idproceso="+idproceso+"&idproyecto="+idproyecto;
$("#emergente").load("index.php?controller=listaproyecto&action=get_verificar_procesos&"+str, function(){
			
			$.blockUI({
                          //  overlayCSS: { backgroundColor: 'white' },
				message: $("#emergente"),
				css:{
					top: '3%',
					width: '65%',
					height: '80%',
					left: '15%'
                                       //backgroundColor: '#5d881a'
				}
			}); 
		});  
            }else{
                alert("los subprocesos aun no se terminan, por favor exija a los reponsables a terminar o espere");
            }
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
<script type="text/javascript">
    function altRows(id){
        if(document.getElementsByTagName){
            var table = document.getElementById(id);
            var rows = table.getElementsByTagName("tr");
            for(i = 0; i < rows.length; i++){
                if(i % 2 == 0){
                    rows[i].className = "evenrowcolor";
                }else{
                    rows[i].className = "oddrowcolor";
                }
            }
        }
    }
    window.onload=function(){
        altRows('alternatecolor');
    }
</script>