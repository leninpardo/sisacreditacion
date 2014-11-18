<?php include("../lib/functions.php"); ?>
<script type="text/javascript" src="js/app/evt_form_alumnocurso.js" ></script>
<script type="text/javascript" src="js/validateradiobutton.js"></script>


<div class="div_container">
    <div class="row">
        
              <!-- IZQUIERDA-->
        <div  class="col-md-3 toggler" >
            <div id="cursoalumno">
                <?php echo $cursoalumno; ?>
            </div>       
        </div> 

        <!-- DERECHA-->
        
        <div class="col-md-9" style="margin-left: -90px;" id="datos" >
        <?php echo $semestreacademico; ?>
            <div id="silabus">
                
            </div>
            
            <div id="notas">
                
            </div>
            <img src="http://carpenoctem2012.files.wordpress.com/2012/03/silabo2.jpeg" class="silaboo" style="margin-bottom: -250px;" >
        </div>
    
</div>
</div>
