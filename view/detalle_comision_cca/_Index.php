
<script type="text/javascript">
 
      function get2(p1,p2)
    {   
         opener.document.getElementById("iddocente").value=p1;
         opener.document.getElementById("nombres").value=p2;
         window.close();

    }
</script>
<div class="div_container">
    
<h6 class="ui-widget-header">Docentes de la comision</h6>
<?php echo $grilla;?>

</div>
