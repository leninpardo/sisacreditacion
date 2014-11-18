<script type="text/javascript" src="js/app/evt_form_comision_cca.js" ></script>

<script type="text/javascript">
 
      function get2(p1,p2)
    {   
         opener.document.getElementById("iddocente").value=p1;
         opener.document.getElementById("nombres").value=p2;
         window.close();

    }
</script>
<!--<h4 align="center" id="lst">COMISION ACTUAL</h4>-->
<br>

<div  class="col-md-6" >
     <ul style="list-style: none;" id="scroll">

        <table class="table">
            <?php
                         //  print "<pre>"; print_r($data); print "</pre>\n";exit();
            foreach ($data as $value){?>
            <tr>
                <td>
                    <h2>     <?php echo $value[1]?></h2><br>&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $value[3]?> &nbsp / &nbsp <?php echo $value[4]?>
                </td>
                 </tr>
                 <tr>
                     
               
                <td>
                    <input type="hidden" id="cod" value="<?php echo $value[0]?>">
                    <div class="btn-group">
                        <a class='asig2' name='<?php echo $value[0]?>' value=""><button title="Lista de Miembros" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-user"></span></button></a>
                        <a class='vera' name='<?php echo $value[0]?>' value=""><button title="Lista de Asignaturas" type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-folder-open"></span></button></a>
                        <a class='conc' name='<?php echo $value[0]?>' value=""><button title="Lista de Conceptos de pago" type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-usd"></span></button></a>
                        <a class='req' name='<?php echo $value[0]?>' value=""><button title="Lista de Requisitos" type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-align-justify"></span></button></a>
                       
<!--                        <a href="index.php?controller=comision_cca&action=edit&id=<?php echo $value[0]?>"><button title="Editar" type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-edit"></span></button></a>-->
                    </div>  
                </td>
                  </tr>
                 
            <?php } ?>
                    
            
           
        </table>
    <div id="formu">
  
</div> 
        </div>  
    </ul>



<div  class="col-md-6" id="accioncomi">
  <div id="formumi">
        
</div>
 
</div>