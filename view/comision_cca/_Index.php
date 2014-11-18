<?php  include("../lib/functions.php"); ?>
<script type="text/javascript" src="js/app/evt_form_comision_cca.js" ></script>
<script type="text/javascript" src="js/validateradiobutton.js"></script>

<script type="text/javascript">
 
      function get2(p1,p2)
    {   
         opener.document.getElementById("iddocente").value=p1;
         opener.document.getElementById("nombres").value=p2;
         window.close();

    }
</script>

<div class="div_container">
<h6 class="ui-widget-header">Comisiones CCA Registradas</h6>
<div class="col-md-12">
<?php
    echo $lista;
?>

</div>
<!--<div class="col-md-6" id="miembro">
    <ul style="list-style: none;">

    </ul>
</div> -->
<div  class="col-md-6" id="asignatura">
    <ul style="list-style: none;" >

    </ul>
</div>
</div>
