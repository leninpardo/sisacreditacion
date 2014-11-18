<script>
    function get2(p1,p2)
    {   
         opener.document.getElementById("idalumno").value=p1;
         opener.document.getElementById("nombres").value=p2;
         window.close();

    }
   
</script>
<div class="div_container">
    
<h6 class="ui-widget-header">Alumnos CCA Matriculados</h6>
<?php  echo $grilla_cca;?>

</div>
