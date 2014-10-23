<link href="../web/css/bootstrap.css" rel="stylesheet" type="text/css"/>
<link href="../web/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src='../web/js/bootstrap-modal.js'></script>
<h6 class="ui-widget-header">Verificacion de los procesos del proyectos</h6>
<div>
    <table>
        <tr>
            <td>
               Nombre Proyecto:
            </td>
            <td>
                <?php echo $proyecto[0]; ?>
            </td>
        </tr>
        <tr>
            <td>
                Jefe Proyecto:
            </td>
            <td>
                <?php echo $proyecto[1]; ?>
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
            <th>Estado</th>
        </tr>
    </table>
    <?php 
    if($lista!=null){
    foreach ($lista as $l)
    {
     echo "<tr>";
     echo "<td>".$l[0]."</td>";
     echo '</tr>';
    }
    
    }
    else{
        echo "<tr><td>No se encontraron procesos en el proyecto agregue</td></tr>";
    }
    
        ?>
</div>
<div>
    <a class="btn btn-default" id='agregar'>Agregar procesos al proyecto</a>
</div>



<!-- modal de asignar nueva proceso-->
<div id="procesos" class="modal hide fade" tabindex="-1" data-width="1020">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Procesos </h3>
  </div>
  <div class="modal-body">
    <div class="row-fluid">
        
        <div class="span6">
            <label>Huesped a Facturar:</label>   
            
               <select name="cliente_a" id="cliente_a">
                       
                        </select>  
            <button id="add_cliente" class="btn btn-info">+</button>
            <label>CODIGO HAB:</label>
            <input type="text" name="codh_a" id="codh_a" value="" readonly=""/>
            <label>NUMERO HAB:</label>
            <input type="text" name="nroh_a" id="nroh_a" value="" readonly=""/>
            <label>DESCRIPCION:</label>
            <input type="text" name="descriph_a" id="descriph_a" value="" readonly=""/>
             </div>
        
        <div class=" span6">
            <label>FECHA ENTRADA:</label>  
            <input type="text" name="fechae_a" id="fechae_a" value="${fecha}" class="fechas_calculo">
          
              <label>FECHA SALIDA:</label>
              <input type="text" name="fechas_a" id="fechas_a" value="${fecha}" class="fechas_calculo">
              
               <label>COSTO:</label>
              <input type="hidden" name="costo_oculto" id="costo_oculto">
              <input type="text" name="costo_a" id="costo_a" value="">
              <br>
              <br>
             
        
  </div>
             
 
</div>
</div>
<!--en modal-->
<script>
      $(function(){
    $("#agregar").click(function(){
      alert("hola");
        $('#procesos').modal('show'); 
    });
    });
</script>