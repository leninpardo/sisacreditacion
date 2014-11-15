<?php  include("../lib/functions.php"); ?>
<script type="text/javascript" src="js/jquery.cleditor.min.js"></script>
<script type="text/javascript" src="js/app/evt_form_proyecto.js" ></script>
<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>

<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    theme: "modern",
    plugins: [
        //"advlist autolink lists link image charmap print preview hr anchor pagebreak",
        //"searchreplace wordcount visualblocks visualchars code fullscreen"
        "insertdatetime media nonbreaking save table contextmenu directionality"
        //"emoticons template paste textcolor colorpicker textpattern"
    ]
    //toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    //toolbar2: "print preview media | forecolor backcolor emoticons",
    //image_advtab: true,
//    templates: [
//        {title: 'Test template 1', content: 'Test 1'},
//        {title: 'Test template 2', content: 'Test 2'}
//    ]
});
</script>



<style>
    .required{
        border-color: #ff0000;
        border: 1px solid #ff0000;
    }
</style>

    <link href="css/formproyecto.css" rel="stylesheet" type="text/css" />
        <h6 class="ui-widget-header"><?php if($_GET['id']==''){     echo 'niger';
}else{
        echo 'white';}?>Registro de proyecto</h6>
<div class="container">
            <section>
                <div class="col-md-12">
                    <ul class="nav nav-tabs" style="font-size: 11px; font-family: Calibri">
  <li class="active"><a href="#1" data-toggle="tab">I. DATOS GENERALES</a></li>
    <li ><a href="#2" data-toggle="tab">II. PLANTEAMIENTO DE PROBLEMAS</a></li>
    <li><a href="#3" data-toggle="tab">III.OBJETIVOS</a></li>
  <li><a href="#4" data-toggle="tab">IV. MARCO TEORICO CONCEPTUAL</a></li>
  <li><a href="#5" data-toggle="tab">V. METODOLOGIA DE LA INVESTIGACION</a></li>
    <li><a href="#6" data-toggle="tab">VI. ASPECTOS ADINISTRATIVOS</a></li>
</ul>
<form id="frm" action="index.php" method="POST" class="form-horizontal" >
    <input type="hidden" name="controller" value="proyecto" />
    <input type="hidden" name="action" value="save" />

 <div class="tab-content col-md-12" style="height: auto;background-color: #F7F7F7; margin-bottom: 15px;font-family: Calibri;text-align: left;padding-left: 0; padding-right: 0; border-bottom:1px solid #ddd ; border-left: 1px solid #ddd;border-right:1px solid #ddd; border-bottom-left-radius: 4px;  border-bottom-right-radius: 4px;">

         <br><div class="tab-pane active" id="1">

                   <div class="col-md-12">

					<div class="col-md-4">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><strong for="idproyecto" >CODIGO</strong></span>
					</div>
					<div class="col-md-12 colpad">
                    <input  id="idproyecto" name="idproyecto" type="text" class="form-control" style="background-color: white;" placeholder="Codigo proyecto" value="<?php echo $obj->idproyecto; ?>" readonly  />
                    </div>
					</div>
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="tipo_proyecto">TIPO PROYECTO: </strong></label></span>
					</div>
					<div class="col-md-12 colpad">
                                        <?php echo $tipo_proyecto;?>
                    </div>
					</div>
                    </div>

					<div class="col-md-8">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="nombre_proyecto">NOMBRE DE PROYECTO:</strong></label></span>
					</div>
					<div class="col-md-12 colpad ">
                        <input id="nombre_proyecto" name="nombre_proyecto" type="text" class="form-control" placeholder="Nombre proyecto"  value="<?php /*echo $obj->nombre_proyecto; */?>" />
                  <!-- <textarea id="nombre_proyecto" name="nombre_proyecto" class="form-control" rows="2" placeholder="Nombre proyecto"><?php /*echo $obj->nombre_proyecto; */?></textarea>-->

                    </div>
					</div>
                    </div>


                    </div>

                    <div class="col-md-12">

					<div class="col-md-4">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="$iddepartamento">DEPARTAMENTO:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
                                        <?php echo $departamento;?>
                    </div>
					</div>
                    </div>

					<div class="col-md-4">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="provincia">PROVINCIA: </strong></label></span>
					</div>
					<div class="col-md-12 colpad">
                                        <?php echo $provincia;?>
                    </div>
					</div>
                    </div>

					<div class="col-md-4">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="distrito">DISTRITO:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
                    <?php echo $distrito;?>
                    </div>
					</div>
                    </div>


                        <table id="tablaubi" width="60%" class="tablaubigeo" border="0px" cellpadding="1px" cellspacing="1px" style="" align="center">
                            <thead>   
                            <tr style="font-size: 16px; color: #555;background: #e8dceb" >
                                    <td width="20%" align="center">
                                       <b>DEPARTAMENTO</b>
                                    </td>
                                    <td width="20%" align="center">
                                       <b>PROVINCIA</b>
                                    </td>
                                    <td width="20%" align="center">
                                      <b>DISTRITO</b>
                                    </td>
                                    <td width="20%" align="center">
                                        <b>ELIMINAR</b>
                                    </td>
                                    
                                </tr>
                            </thead>
                            <tbody id="datos">
                                
                            </tbody>
                            
                            </table>
                        <br>
                        <br>
                    </div>

                    <div class="col-md-12">

					<div class="col-md-4">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="periodo_ejecucion">PERIODO DE EJECUCION:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
                    <input id="periodo_ejecucion" name="periodo_ejecucion" type="text" class="form-control" placeholder="Periodo de ejecucion"  value="<?php echo $obj->periodo_ejecucion; ?>" />
                    </div>
					</div>
                    </div>

					<div class="col-md-4">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="CodigoFacultad">FACULTAD:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
                    <?php echo $facultad;?>
                    </div>
					</div>
                    </div>

					<div class="col-md-4">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="CodigoEscuela">ESCUELA:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
                    <?php echo $escuela;?>
                    </div>
					</div>
                    </div>

                    </div>

                <div class="col-md-12">
                    <div class="col-md-1"></div>

					<div class="col-md-5">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="idejetematico">EJE TEMATICO:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
                    <?php echo $eje_tematico;?>
                    </div>
					</div>
                    </div>

                    <div class="col-md-5">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="$idlinea_investigacion">LINEA DE INVESTIGACION:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
                    <?php echo $linea_investigacion;?>
                    </div>
					</div>
                    </div>

                    <div class="col-md-1"></div>
                </div>
                </div>

                <div class="tab-pane" id="2">
                    <div class="col-md-12">

					<div class="col-md-12">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="antecedentes_problema">ANTECEDENTES DEL PROBLEMA:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
					<textarea id="antecedentes_problema" name="antecedentes_problema" class="form-control" rows="4" placeholder="Antecedentes del Problema"><?php echo $obj->antecedentes_problema; ?></textarea>
                    </div>
					</div>
                    </div>
                        </div>

                        <div class="col-md-12">

					<div class="col-md-12">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="definicion_problema">DEFINICION DEL PROBLEMA:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
					<textarea id="definicion_problema" name="definicion_problema" class="form-control" rows="4" placeholder="Definicion del Problema"><?php echo $obj->definicion_problema; ?></textarea>
                    </div>
					</div>
                    </div>

                    </div>

					<div class="col-md-12">

					<div class="col-md-12">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="formulacion_problema">FORMULACION DE PROBLEMA:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
					<textarea id="formulacion_problema" name="formulacion_problema" class="form-control" rows="4" placeholder="Formulacion del Problema"><?php echo $obj->formulacion_problema; ?></textarea>
                    </div>
					</div>
                    </div>

					<div class="col-md-12">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="justificacion">JUSTIFICACION:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
					<textarea id="justificacion" name="justificacion" class="form-control" rows="4" placeholder="Justificacion"><?php echo $obj->justificacion; ?></textarea>
                    </div>
					</div>
                    </div>

                    </div>

					<div class="col-md-12">

					<div class="col-md-12">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="importancia">IMPORTANCIA:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
					<textarea id="importancia" name="importancia" class="form-control" rows="4" placeholder="Importancia"><?php echo $obj->importancia; ?></textarea>
                    </div>
					</div>
                    </div>
                                             </div>
			<div class="col-md-12">

					<div class="col-md-12">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="limitaciones">LIMTACIONES:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
					<textarea id="limitaciones" name="limitaciones" class="form-control" rows="4" placeholder="Limitaciones"><?php echo $obj->limitaciones; ?></textarea>
                    </div>
					</div>
                    </div>

                    </div>

                </div>
				<div class="tab-pane" id="3">
                    <div class="col-md-12">

					<div class="col-md-12">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="objetivo_general">OBJETIVO GENERAL:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
					<textarea id="objetivo_general" name="objetivo_general" class="form-control" rows="4" placeholder="Objetivo General"><?php echo $obj->objetivo_general; ?></textarea>
                    </div>
					</div>
                    </div>
                        </div>
           <div class="col-md-12">
					<div class="col-md-12">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="objetivos_especificos">OBJETIVOS ESPECIFICOS:</strong></label></span>
					</div>
                        <div class="col-md-12 colpad" id="objesp">
                                            <textarea id="objetivos_especificos" name="objetivos_especificos" class="form-control" rows="4" placeholder="Objetivos Especificos"></textarea>

                        </div>

                    </div>
                    </div>

                    </div>

                </div>

                <div class="tab-pane" id="4">
					<div class="col-md-12">

					<div class="col-md-12">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="antecedentes_investigacion">ANTECEDENTES DE LA INVESTIGACION:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
					<textarea id="antecedentes_investigacion" name="antecedentes_investigacion" class="form-control" rows="4" placeholder="Antecedentes de la Investigacion"><?php echo $obj->antecedentes_investigacion; ?></textarea>
                    </div>
					</div>
                    </div>
                                            </div>

			<div class="col-md-12">

					<div class="col-md-12">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="definicion_terminos">DEFINICION DE TERMINOS:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
					<textarea id="definicion_terminos" name="definicion_terminos" class="form-control" rows="4" placeholder="Definicion de Terminos"><?php echo $obj->definicion_terminos; ?></textarea>
                    </div>
					</div>
                    </div>

                    </div>

					<div class="col-md-12">

					<div class="col-md-12">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="bases_teoricas">BASES TEORICAS:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
					<textarea id="bases_teoricas" name="bases_teoricas" class="form-control" rows="4" placeholder="Bases Teoricas"><?php echo $obj->bases_teoricas; ?></textarea>
                    </div>
					</div>
                    </div>
                                            </div>
			<div class="col-md-12">
					<div class="col-md-12">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="hipotesis">HIPOTESIS:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
					<textarea id="hipotesis" name="hipotesis" class="form-control" rows="4" placeholder="Hipotesis"><?php echo $obj->hipotesis; ?></textarea>
                    </div>
					</div>
                    </div>

                    </div>

                    <div class="col-md-12">

                    <div class="col-md-12">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="sistema_variables">SISTEMA DE VARIABLES:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
					<textarea id="sistema_variables" name="sistema_variables" class="form-control" rows="4" placeholder="Sistema de Variables"><?php echo $obj->sistema_variables; ?></textarea>
                    </div>
					</div>
                    </div>
                      </div>
                    <div class="col-md-12">

                    <div class="col-md-12">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="escala_medicion">ESCALA DE MEDICION:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
					<textarea id="escala_medicion" name="escala_medicion" class="form-control" rows="4" placeholder="Escala de Medicion"><?php echo $obj->escala_medicion; ?></textarea>
                    </div>
					</div>
                    </div>

                    </div>

                </div>

                <div class="tab-pane" id="5">

                    <div class="col-md-12">

                    <div class="col-md-12">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="tipo_investigacion">TIPO DE INVESTIGACION:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
					<textarea id="tipo_investigacion" name="tipo_investigacion" class="form-control" rows="4" placeholder="Tipo de Investigacion"><?php echo $obj->tipo_investigacion; ?></textarea>
                    </div>
					</div>
                    </div>
                        </div>
		 <div class="col-md-12">
                    <div class="col-md-12">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="nivel_investigacion">NIVEL DE INVESTIGACION:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
					<textarea id="nivel_investigacion" name="nivel_investigacion" class="form-control" rows="4" placeholder="Nivel de Investigacion"><?php echo $obj->nivel_investigacion; ?></textarea>
                    </div>
					</div>
                    </div>

                    </div>

                    <div class="col-md-12">

                    <div class="col-md-12">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="disenio_investigacion">DISEÑO DE INVESTIGACION:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
					<textarea id="disenio_investigacion" name="disenio_investigacion" class="form-control" rows="4" placeholder="Diseño de Investigacion"><?php echo $obj->disenio_investigacion; ?></textarea>
                    </div>
					</div>
                    </div>
                         </div>
		<div class="col-md-12">
                    <div class="col-md-12">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="cobertura_investigacion">COBERTURA DE INVESTIGACION:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
					<textarea id="cobertura_investigacion" name="cobertura_investigacion" class="form-control" rows="4" placeholder="Cobertura de Investigacion"><?php echo $obj->cobertura_investigacion; ?></textarea>
                    </div>
					</div>
                    </div>

                    </div>

                    <div class="col-md-12">

                    <div class="col-md-12">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="fuente_investigacion">FUENTE DE INVESTIGACION:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
					<textarea id="fuente_investigacion" name="fuente_investigacion" class="form-control" rows="4" placeholder="Fuente de Investigacion"><?php echo $obj->fuente_investigacion; ?></textarea>
                    </div>
					</div>
                    </div>
                        </div>
                <div class="col-md-12">
                    <div class="col-md-12">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="tecnicas_investigacion">TECNICAS DE INVESTIGACION:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
					<textarea id="tecnicas_investigacion" name="tecnicas_investigacion" class="form-control" rows="4" placeholder="Tecnicas de Investigacion"><?php echo $obj->tecnicas_investigacion; ?></textarea>
                    </div>
					</div>
                    </div>

                    </div>

                    <div class="col-md-12">

                    <div class="col-md-12">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="instrumentos_invesitgacion">INSTRUMENTOS DE INVESTIGACION:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
					<textarea id="instrumentos_invesitgacion" name="instrumentos_invesitgacion" class="form-control" rows="4" placeholder="Instrumentos de Investigacion"><?php echo $obj->instrumentos_investigacion; ?></textarea>
                    </div>
					</div>
                    </div>
                        </div>
			<div class="col-md-12">
                    <div class="col-md-12">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="presentacion_datos">PRESENTACION DE DATOS:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
					<textarea id="presentacion_investigacion" name="presentacion_datos" class="form-control" rows="4" placeholder="Presentacion de Datos"><?php echo $obj->presentacion_datos; ?></textarea>
                    </div>
					</div>
                    </div>

                    </div>

                    <div class="col-md-12">

                    <div class="col-md-12">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="analisis_datos">ANALISIS DE DATOS:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
					<textarea id="analisis_datos" name="analisis_datos" class="form-control" rows="4" placeholder="Analisis de Datos"><?php echo $obj->analisis_datos; ?></textarea>
                    </div>
					</div>
                    </div>
                        </div>
		 <div class="col-md-12">
                    <div class="col-md-12">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="interpretacion_datos">INTERPRETACION DE DATOS</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
					<textarea id="interpretacion_datos" name="interpretacion_datos" class="form-control" rows="4" placeholder="Interpretacion de Datos"><?php echo $obj->interpretacion_datos; ?></textarea>
                    </div>
					</div>
                    </div>

                    </div>



                </div>

                <div class="tab-pane" id="6">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-8">

					<div class="col-md-4">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="presupuesto">PRESUPUESTO:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
                    <input id="presupuesto" name="presupuesto" type="text" class="form-control" placeholder="Presupuesto"  value="<?php echo $obj->presupuesto; ?>" />
                    </div>
					</div>
                    </div>

                        <div class="col-md-4">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="financiamiento">FINANCIAMIENTO:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
                    <input id="financiamiento" name="financiamiento" type="text" class="form-control" placeholder="Financiamiento"  value="<?php echo $obj->financiamiento; ?>" />
                    </div>
					</div>
                    </div>
                    </div>
                    <div class="col-md-4">
                    </div>

                    <div class="col-md-12">

                    <div class="col-md-12">
                    <div class="form-group">
					<div class="col-md-12 colpad">
					<span class="input-group-addon"><label class="control-label"><strong for="asignacion_recursos">ASIGNACION RECURSOS:</strong></label></span>
					</div>
					<div class="col-md-12 colpad">
                    <textarea id="asignacion_recursos" name="asignacion_recursos" class="form-control" rows="4" placeholder="Interpretacion de Datos"><?php echo $obj->asignacion_recursos; ?></textarea>
                    </div>
					</div>
                    </div>
                        </div>



            </div>
				</div>

				<div class="form-group">
                            <div class="col-lg-6 col-lg-offset-3">

                        <a id="save" style="font-size: 10px;padding: 4px; " class="btn btn-success" onclick="validarForm()">GRABAR</a> <!--//tinyMCE.execCommand('mceSave')-->
                        <a href="index.php?controller=proyecto" style="color: #fff;background-color: #d9534f;border-color: #d43f3a;" class="button">ATRAS</a>
                        <button type="button" style="font-size: 10px;padding: 4px;" class="btn push_button_warning btn-warning" id="resetBtn">LIMPIAR FORM</button>
                            </div>
                        </div>


                    </form>
                </div>
            </section>
    </div>
    
   