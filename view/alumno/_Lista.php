<script type="text/javascript">
    $(function () {
        $("#q").focus();
        $(".cheket_estado_asignacion").click(function () {
//            var n = $( "input:checked" ).length; alert(n);
            CodigoAlumno = $(this).attr("name");
            nombre = $(this).attr("id");
            array_click = $("#array_click").val();
                array_click = array_click + ',' + CodigoAlumno+'-'+nombre;
                $("#array_click").val(array_click);
                parent.document.getElementById('array_click2').value = array_click;
            $.post('index.php', 'controller=asignaciontutoria&action=asignar_estado_temporal_asignacion&CodigoAlumno=' + CodigoAlumno, function (data) {
//                console.log(data);
//                $("#msj").empty().append(data);
                
                
            });


        });

    });
    function get(p1, p2, p3, p4, p5, p6)
    {
        parent.document.getElementById('CodigoAlumno').value = p1;
        parent.document.getElementById('NombreAlumno').value = p2 + " " + p3;
        var ifr = parent.document.getElementById("iframe_buscar_alumno");
//            ifr.parentNode.removeChild(ifr);
//            parent.googlewin.hide();
        ifr.style.display = 'none';

    }

</script>
<input type="hidden" id="array_click" name="array_click" value="">
<div id="msj"></div>
<div class="div_container"><?php if ($sinCab = false) { ?>
    <h6 class="ui-widget-header">Alumnos Por Asignar</h6>
    <div id="grilla_alumnos">
        <?php } echo $grilla; ?>
    </div>

</div>