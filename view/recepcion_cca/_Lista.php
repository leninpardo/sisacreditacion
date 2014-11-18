<?php  include("../lib/functions.php"); ?>
<script type="text/javascript" src="js/app/evt_form_requisitos_cca.js" ></script>
<script type="text/javascript" src="js/validateradiobutton.js"></script>
<h1 align="center" id="lst">LISTA DE REQUISITOS</h1>
<br>
<br>
<div  class="col-md-12" >
  
    <div  class="col-md-6 center">
        <form id="frm" action="index.php" method="POST" >
              <input type="hidden" name="controller" value="requisitos_cca" />
    <input type="hidden" name="action" value="save" />
    <input type="hidden" name="idalumno" value="<?php echo $id;?>" />
       
         
           <ul style="list-style: none;" id="scroll">
<li>
    <table align="center" class="table table-striped">
        
    <?php 
    
    
    for($i=0;$i< count($requerimientos);$i++){?>
               <?php if($requerimientos[$i][4]==0){?>
        <tr><td><?php echo $requerimientos[$i][3]?> </td><td><input  type="checkbox" name="requisitos[]"   value="<?php echo $requerimientos[$i][0]?>"/></td></tr>

               <?php }else{?>
                <tr><td><?php echo $requerimientos[$i][3]?> </td><td><input  type="checkbox" name="listo" checked onclick="return false"/></td></tr>

        
               <?php }?>
 <?php }?>
                <tr>
                    <td>
                        <?php if($crequerimientos[0][0]==$cantidadr[0][0]){?>
                   
                    
                        <h3>  <span class="label label-success">Cumplio con sus Requisitos</span></h3>
                     
                <?php }else{?>
                
                        <h3> <span class="label label-danger">No cumple con algun Requisitos</span></h3>
                <?php }?>
                    </td>
                </tr>
                
                   
           </table>   
            
         </li>         
                       
            
           
  
    </ul>
        <a class="button" id="save">GUARDAR</a>
            
      </form>
    </div>

    <div  class="col-md-6" >
        <h2> <strong><span class="label label-primary"> PONDERADO GENERAL</span></strong></h2>
        <div class="alert alert-link"><center><?php 
        
//                var_dump($promedio);
//                                exit();
        echo $promediof=$promedio[0][0] / $cantidad_cursos[0][0]?></center></div>
        <?php if($promediof <= 14){?>
                    
        <h3> <span class="label label-danger">Usted no tiene suficiente ponderado</span></h3>
        <?php }else{?>
    
        <h3><span class="label label-success">Punderado superado</span></h3>
        <?php }?>
    </div>

 
</div>