<?php include("../lib/functions.php"); ?>
<script type="text/javascript" src="js/app/evt_form_asistenciaalumnoPS.js" ></script>
<script type="text/javascript" src="js/validateradiobutton.js"></script>
<script>
    $(function() {
        $(".wrapper-search").html('');
    })
</script>

<div class="div_container">
    <h6 class="ui-widget-header">Asistencia Proyeccion Universitaria</h6>
    <div id="lista_eventos">
        <div class="col-lg-12" id="asistencia_evento">
            <div><span style="color:blue;font-size: 18px;">LISTA DE EVENTOS:</span>
                <div align="left">
                    <span id="tabla">

                        <?php echo $grilla; ?>
                    </span>


                </div>
            </div>
        </div>
    </div>

</div>
