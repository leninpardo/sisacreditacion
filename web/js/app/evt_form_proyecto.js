$(function () {
    
   /* $(".elimina").click(function () {
        alert("hola");
    });*/
    var codigofacultad = $("#CodigoFacultad");
    var codigofaculta = $("#idejetematico");


    codigofaculta.change(function () {
        var ids = $(this).val();

        $.post('index.php', 'controller=linea_investigacion&action=getLinea_investigacion&idejetematico=' + ids, function (data) {
            $("#idlinea_investigacion").empty().append(data);
        });
    });

    codigofacultad.change(function () {
        var ids = $(this).val();

        $.post('index.php', 'controller=escuelaprofesional&action=getEscuelaProfesional&CodigoFacultad=' + ids, function (data) {
            $("#CodigoEscuela").empty().append(data);
        });
    });

    $("#departamento").change(function () {
        var ids = $(this).val();
        $.post('index.php', 'controller=proyecto&action=getListaProvincias&departamento=' + ids, function (data) {
//            console.log(data);
            //provincia
            $("#provincia").empty().append(data);
        });
    });


    $("#provincia").change(function () {
        var ids = $(this).val();
        $.post('index.php', 'controller=proyecto&action=getListaDistritos&provincia=' + ids, function (data) {
//            console.log(data);
            //distrito
            $("#distrito").empty().append(data);
        });
    });
    
    $("#distrito").change(function () {

        var ids = $(this).val();
        var valor = $("#distrito option:selected").html();

        var departamento = $("#departamento").val();
        var provincia = $("#provincia").val();
        html = "<tr id='"+ids+"'bgcolor='white' align='center'><td>" + departamento + "</td><td>" + provincia + "</td><td>" + valor + "<input type='hidden'  name='ubigeo[]' value='" + ids + "'/></td> <td><a  class='btn btn-danger' onclick='javascript:elimina("+ids+");' style='font-size: 10px;padding: 4px;'>Eliminar</a></td> </tr>";
        $("#datos").append(html);
        $("#tablaubi").attr({'style': ' '});
        var select1 = $('#departamento');
        var select2 = $('#provincia');
        var select3 = $('#distrito');
        select1.val($('option:first', select1).val());
        select2.val($('option:first', select2).val());
        select3.val($('option:first', select3).val());
    });


    /*cont = 1;
    $("#newobj").click(function () {
        var captura = $("#objetivos_especificos").val();
        if (captura == "") {
            $("#objetivos_especificos").focus();
        } else {

            html = "<tr><td><font><font>Objetivo Especifico " + cont + "</font></font></td><td><textarea id='objetivos_especificos" + cont + "' name='objetivos_especificos" + cont + "' class='form-control' rows='3' style='margin-bottom: 0px;'></textarea></td></tr>";

            $("#ooo").append(html);
            $("#objetivos_especificos" + cont + "").val(captura);
            $("#conta").val(cont);
            $("#objetivos_especificos").val("");
            cont++;
        }

    });
    $("#dltobj").click(function () {
        cont--;
        $("#objetivos_especificos" + cont + "").remove();


    });*/




});
var validarForm = function ()
{

    bval = true;
    bval = bval && $("#nombre_proyecto").required();
    bval = bval && $("#idtipo_proyecto").required();
    //bval = bval && $( "#departamento" ).required();
    //bval = bval && $( "#provincia" ).required();
    //bval = bval && $( "#distrito" ).required();
    bval = bval && $("#periodo_ejecucion").required();
    bval = bval && $("#CodigoFacultad").required();
    bval = bval && $("#CodigoEscuela").required();
    bval = bval && $("#idejetematico").required();
    bval = bval && $("#idlinea_investigacion").required();
    bval = bval && $("#Ubigeo").required();
    //bval = bval && $( "#antecedentes_problema" ).required();
    //bval = bval && $( "#definicion_problema" ).required();
    //bval = bval && $( "#formulacion_problema" ).required();
    //bval = bval && $( "#justificacion" ).required();
    //bval = bval && $( "#importancia" ).required();
    //bval = bval && $( "#limitaciones" ).required();
    //bval = bval && $( "#objetivo_general" ).required();
    //bval = bval && $( "#objetivos_especificos" ).required();
    //bval = bval && $( "#antecedentes_investigacion" ).required();
    //bval = bval && $( "#definicion_terminos" ).required();
    //bval = bval && $( "#bases_teoricas" ).required();
    //bval = bval && $( "#hipotesis" ).required();
    //bval = bval && $( "#sistema_variables" ).required();
    //bval = bval && $( "#escala_medicion" ).required();
    //bval = bval && $( "#tipo_investigacion" ).required();
    //bval = bval && $( "#nivel_investigacion" ).required();
    //bval = bval && $( "#disenio_investigacion" ).required();
    //bval = bval && $( "#cobertura_investigacion" ).required();
    //bval = bval && $( "#fuente_investigacion" ).required();
    //bval = bval && $( "#tecnicas_investigacion" ).required();
    //bval = bval && $( "#instrumentos_invesitgacion" ).required();
    //bval = bval && $( "#presentacion_investigacion" ).required();
    //bval = bval && $( "#analisis_datos" ).required();
    //bval = bval && $( "#interpretacion_datos" ).required();
    //val = bval && $( "#viabilidad_tecnica" ).required();
    bval = bval && $("#presupuesto").required();
    bval = bval && $("#financiamiento").required();
    //bval = bval && $( "#asignacion_recursos" ).required();
    bval = bval && $("#CodigoEscuela").required();
    if (bval) {
        $("#frm").submit();
    }
    return false;
}

function elimina(id){
   $("#"+id).remove();
}