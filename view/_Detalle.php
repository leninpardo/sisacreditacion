<?php
foreach ($rows as $key => $value) {
    $idp = strtoupper(utf8_encode($value[0]));
    $nombre_proyecto = strtoupper(utf8_encode($value[1]));
    $periodo_ejecucion= strtoupper(utf8_encode($value[2]));
    $Responsable = strtoupper(utf8_encode($value[3]));
    $DescripcionEscuela = strtoupper(utf8_encode($value[4]));
    $estado_proyecto = strtoupper(utf8_encode($value[5]));
    $Fecha_Inicio = strtoupper(utf8_encode($value[6]));
    $presupuesto = strtoupper(utf8_encode($value[7]));
    $nombre_tipo_proyecto= strtoupper(utf8_encode($value[8]));
    $DescripcionFacultad = strtoupper(utf8_encode($value[9]));
    $nombre_linea = strtoupper(utf8_encode($value[10]));
    $nombre_ejetematico = strtoupper(utf8_encode($value[11]));
    $nombre_grupo = strtoupper(utf8_encode($value[12]));
    $DISTRITO = strtoupper(utf8_encode($value[13]));
    $PROVINCIA = strtoupper(utf8_encode($value[14]));
    $DEPARTAM = strtoupper(utf8_encode($value[15]));
    $antecedentes_problema = strtoupper(utf8_encode($value[16]));
    $definicion_problema = strtoupper(utf8_encode($value[17]));
    $formulacion_problema= strtoupper(utf8_encode($value[18]));
    $justificacion = strtoupper(utf8_encode($value[19]));
    $importancia = strtoupper(utf8_encode($value[20]));
    $limitaciones = strtoupper(utf8_encode($value[21]));
    $objetivo_general= strtoupper(utf8_encode($value[22]));
    $antecedentes_investigacion = strtoupper(utf8_encode($value[23]));
    $defi_termino = strtoupper(utf8_encode($value[24]));
    $bases_teoricas = strtoupper(utf8_encode($value[25]));
    $Hipot= strtoupper(utf8_encode($value[26]));
    $sistema_vari= strtoupper(utf8_encode($value[27]));
    $escala_me = strtoupper(utf8_encode($value[28]));
    $tipo_inves= strtoupper(utf8_encode($value[29]));
    $nivel_inves= strtoupper(utf8_encode($value[30]));
    $diseño_inves= strtoupper(utf8_encode($value[31]));
    $cob_inves= strtoupper(utf8_encode($value[32]));
    $fuente_inves= strtoupper(utf8_encode($value[33]));
    $tecn_inves= strtoupper(utf8_encode($value[34]));
    $instru_inves= strtoupper(utf8_encode($value[35]));
    $presen_datos= strtoupper(utf8_encode($value[36]));
    $analis_datos= strtoupper(utf8_encode($value[37]));
    $interpre_datos= strtoupper(utf8_encode($value[38]));
    $presupuesto1= strtoupper(utf8_encode($value[39]));
    $asig_recursos= strtoupper(utf8_encode($value[40]));
    $fianan= strtoupper(utf8_encode($value[41]));
    $idesta_proy= strtoupper(utf8_encode($value[42]));
    
    ?>



 <?php /*
    if ($idesta_proy==1)  {?>
        <br><img src="../web/images/estado_proyecto/1.jpg"/><br>
<?php }
    elseif($idesta_proy==2) {?>
        <br><img src="../web/images/estado_proyecto/2.jpg"/><br>
<?php }
    elseif($idesta_proy==3) {?>
        <br><img src="../web/images/estado_proyecto/3.jpg"/><br>
<?php }
    elseif($idesta_proy==4) {?>
        <br><img src="../web/images/estado_proyecto/4.jpg"/><br>
<?php }
    elseif ($idesta_proy==5) {?>
        <br><img src="../web/images/estado_proyecto/5.jpg"/><br>
<?php }
    elseif($idesta_proy==6) {?>
        <br><img src="../web/images/estado_proyecto/6.jpg"/><br>
<?php }
    elseif($idesta_proy==7) {?>
        <br><img src="../web/images/estado_proyecto/7.jpg"/><br>
<?php }
    elseif($idesta_proy==8) {?>
        <br><img src="../web/images/estado_proyecto/8.jpg"/><br>
<?php }
    elseif($idesta_proy==9) {?>
        <br><img src="../web/images/estado_proyecto/9.jpg"/><br>
<?php } */ ?>

    <fieldset  style="width:100%;border: 0px; margin: auto; ">
    <h2 align="center"><p>UNIVERSIDAD NACIONAL DE SAN MARTIN - T</p></h2>
    <h3 align="center">OFICINA DE INVESTIGACIÓN Y DESARROLLO</h3>
    <h4 align="center">Facultad de <?php echo strtoupper(utf8_encode($value[9])); ?></h4>

   <div align="left" >
   <div class="col-md-12">
       <br>
       <table id="tabladetalle" border="0" >
           <tbody style=" font-size: 14px; text-align: left">

           <?php foreach ($rows as $key => $value) { ?>
               <tr class="fil">
                   <td> <b>1.- DATOS GENERALES</b></td>
               </tr>
               <tr class="fil">
                   <td>1.1 NOMBRE DE PROYECTO : <?php echo strtoupper(utf8_encode($value[1])); ?> </td>
               </tr>

               <tr class="fil">
                   <td><span>1.2 PERIODO EJECUCION :  <?php echo strtoupper(utf8_encode($value[2])); ?></span></td>

               </tr>
               <tr class="fil">
                   <td><span>1.3 UBICACION GEOGRAFICA : </span></td>

               </tr>
               <tr class="fil" >
                   <td width="90%">El proyecto se encuentra ubicado en el Departamento de <?php echo strtoupper(utf8_encode($value[15]));?>, en la Provincia de <?php echo strtoupper(utf8_encode($value[14])); ?> y en el distrito de <?php echo strtoupper(utf8_encode($value[13])); ?>
                   </td>

               </tr>
               <tr class="fil">
                   <td><span>1.4 FACULTAD : </span> </td>
               </tr>
               <tr class="fil">
                   <td>El Proyecto esta desarrolado por la Facultad de <?php echo strtoupper(utf8_encode($value[9])); ?></td>
               </tr>
               <tr class="fil">
                   <td><span>1.5 LINEA INVESTIGACION : </span> </td>

               </tr>
               <tr class="fil">
                   <td>El proyecto tiene una linea de investigacion que es la siguiente <?php echo strtoupper(utf8_encode($value[10])); ?> </td>
               </tr>
               <tr class="fil">
                   <td><b>2.- PLANTEAMIENTO DEL PROBLEMA</b></td>
               </tr>
               <tr class="fil">
                   <td><span>2.1 ANTECEDENTES DEL PROBLEMA : <?php echo strtoupper(utf8_encode($value[16])); ?></span></td>
               </tr>

               <tr class="fil">
                   <td><span>2.2 DEFINICION DEL PROBLEMA : <?php echo strtoupper(utf8_encode($value[17])); ?></span> </td>

               </tr>
               <tr class="fil">
                   <td><span>2.3 FORMULACION DEL PROBLEMA : <?php echo strtoupper(utf8_encode($value[18])); ?></span> </td>

               </tr>

               <tr class="fil">
                   <td><span>2.4 JUSTIFICACION DEL PROBLEMA : <?php echo strtoupper(utf8_encode($value[19])); ?></span> </td>

               </tr>
               <tr class="fil">
                   <td><span>2.5 IMPORTANCIA DEL PROBLEMA : <?php echo strtoupper(utf8_encode($value[20])); ?> </span> </td>

               </tr>
               <tr class="fil">
                   <td><span>2.6 LIMITACIONES : <?php echo strtoupper(utf8_encode($value[21])); ?> </span> </td>

               </tr>
               <tr class="fil">
                   <td><span><b>3.- MARCO TEORICO CONCEPTUAL</b></span> </td>

               </tr>
               <tr class="fil" >
                   <td><span>3.1 DEFINICION DEL PROBLEMA : <?php echo strtoupper(utf8_encode($value[22])); ?></span> </td>

               </tr>

               <tr class="fil">
                   <td><span>3.2 ANTECEDENTES DE LA INVESTIGACION : <?php echo strtoupper(utf8_encode($value[23])); ?></span></td>

               </tr>
               <tr class="fil">
                   <td><span>3.3 DEFINICION DE TERMINOS : <?php echo strtoupper(utf8_encode($value[24])); ?> </span></td>

               </tr>
               <tr class="fil">
                   <td><span>3.4 BASES TEORICAS : <?php echo strtoupper(utf8_encode($value[25])); ?></span></td>

               </tr>
               <tr class="fil">
                   <td><span>3.5 HIPOTESIS : <?php echo strtoupper(utf8_encode($value[26])); ?> </span> </td>

               </tr>
               <tr class="fil">
                   <td><span>3.6 SISTEMAS VARIABLES : <?php echo strtoupper(utf8_encode($value[27])); ?> </span> </td>

               </tr>
               <tr class="fil">
                   <td><span>3.7 ESCALA DE MEDICION : <?php echo strtoupper(utf8_encode($value[28])); ?> </span> </td>

               </tr>
               <tr class="fil">
                   <td><span> <b>4.- METODOLOGIA DE INVESTIGACION </b></span> </td>

               </tr>
               <tr class="fil">
                   <td><span>4.1 TIPO DE INVESTIGACION : <?php echo strtoupper(utf8_encode($value[29])); ?></span></td>

               </tr>
               <tr class="fil">
                   <td><span>4.2 NIVEL DE INVESTIGACION : <?php echo strtoupper(utf8_encode($value[30])); ?></span></td>

               </tr>
               <tr class="fil">
                   <td><span>4.3 DISEÑO DE INVESTIGACION : <?php echo strtoupper(utf8_encode($value[31])); ?></span></td>

               </tr>
               <tr class="fil">
                   <td><span>4.4 COBERTURA DE INVESTIGACION :<?php echo strtoupper(utf8_encode($value[32])); ?> </span> </td>

               </tr>

               <tr class="fil">
                   <td><span>4.5 FUENTES DE INVESTIGACION : <?php echo strtoupper(utf8_encode($value[33])); ?> </span> </td>

               </tr>
               <tr class="fil">
                   <td><span>4.6 TECNICAS DE INVESTIGACION : <?php echo strtoupper(utf8_encode($value[34])); ?></span> </td>

               </tr>

               <tr class="fil">
                   <td><span>4.7 INSTRUMENTOS DE INVESTIGACIÓN : <?php echo strtoupper(utf8_encode($value[35])); ?></span> </td>

               <tr>
               <tr class="fil">
                   <td><span>4.8 PRESENTACION DE DATOS : <?php echo strtoupper(utf8_encode($value[36])); ?></span> </td>

               </tr>

               <tr class="fil">
                   <td><span>4.9 ANALISIS DE DATOS E INTERPRETACION DE DATOS: <?php echo strtoupper(utf8_encode($value[37])); ?>, <?php echo strtoupper(utf8_encode($value[38])); ?> </span> </td>

               </tr>
               <tr class="fil">
                   <td><span> <b>5.- ASPECTOS ADMINISTRATIVOS</span> </td>

               </tr>
               <tr class="fil">
                   <td><span>5.1 ASIGNACION DE RECURSOS : <?php echo strtoupper(utf8_encode($value[40])); ?> </span></td>

               </tr>
               <tr class="fil">
                   <td><span>5.2 PRESUPUESTO DEL PROYECTO : <?php echo strtoupper(utf8_encode($value[39])); ?></span> </td>

               </tr>
               <tr class="fil">
                   <td><span>5.3 FINANCIAMIENTO : <?php echo strtoupper(utf8_encode($value[41])); ?> </strong></span> </td>

               </tr>
           <?php } ?>
           </tbody></table>
    </div>



       <?php
       /*echo '1.- DATOS GENERALES';
       echo '1.1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Perido de Ejecución:'.'<div >'.$periodo_ejecucion .'</div>';
       echo '1.2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Responsable del Proyecto: '.$Responsable .'<br>';
       echo '1.3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Escuela Profesional: '.$DescripcionEscuela .'<br>';
       echo '1.4&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Estado del Proyecto: '.$estado_proyecto .'<br>';
       echo '1.5&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha de Inicio del Proyecto: '.$Fecha_Inicio .'<br>';
       echo '6.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Presupuesto: '.$presupuesto .'<br>';
       echo '7.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tipo de Proyecto: '.$nombre_tipo_proyecto .'<br>';
       echo '8.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Facultad: '.$DescripcionFacultad .'<br>';
       echo '9.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Línea de Investigación: '.$nombre_linea .'<br>';
       echo '10.&nbsp;&nbsp;&nbsp;&nbsp;Nombre Eje Temático: '.$nombre_ejetematico .'<br>';
       echo '11.&nbsp;&nbsp;&nbsp;&nbsp;Grupo: '.$nombre_grupo .'<br>';
       echo '12.&nbsp;&nbsp;&nbsp;&nbsp;Distrito: '.$DISTRITO .'<br>';
       echo '13.&nbsp;&nbsp;&nbsp;&nbsp;Provincia: '.$PROVINCIA .'<br>';
       echo '14.&nbsp;&nbsp;&nbsp;&nbsp;Departamento: '.$DEPARTAM .'<br>';
       echo '15.&nbsp;&nbsp;&nbsp;&nbsp;Antecedentes: '.$antecedentes_problema .'<br>';
       echo '16.&nbsp;&nbsp;&nbsp;&nbsp;Definición del Problema'.$definicion_problema .'<br>';
       echo '17.&nbsp;&nbsp;&nbsp;&nbsp;Formulación del Problema: '.$formulacion_problema .'<br>';
       echo '18.&nbsp;&nbsp;&nbsp;&nbsp;Justificación: '.$justificacion .'<br>';
       echo '19.&nbsp;&nbsp;&nbsp;&nbsp;Importancia: '.$importancia .'<br>';
       echo '20.&nbsp;&nbsp;&nbsp;&nbsp;Limitaciones: '.$limitaciones .'<br>';
       echo '21.&nbsp;&nbsp;&nbsp;&nbsp;Objetivo General: '.$objetivo_general .'<br>';
       echo '22.&nbsp;&nbsp;&nbsp;&nbsp;Antecedentes Investigación'.$antecedentes_investigacion .'<br>';
       echo '23.&nbsp;&nbsp;&nbsp;&nbsp;Definición de Término: '.$defi_termino .'<br>';
       echo '24.&nbsp;&nbsp;&nbsp;&nbsp;Bases Teóricas: '.$bases_teoricas .'<br>';
       echo '25.&nbsp;&nbsp;&nbsp;&nbsp;Hipótesis: '.$Hipot.'<br>';
       echo '26.&nbsp;&nbsp;&nbsp;&nbsp;Sistema Variable: '.$sistema_vari .'<br>';
       echo '27.&nbsp;&nbsp;&nbsp;&nbsp;Escala Metodológica: '.$escala_me .'<br>';
       echo '28.&nbsp;&nbsp;&nbsp;&nbsp;Tipo de Investigación: '.$tipo_inves.'<br>';
       echo '29.&nbsp;&nbsp;&nbsp;&nbsp;Nivel de Investigación: '.$nivel_inves .'<br>';
       echo '30.&nbsp;&nbsp;&nbsp;&nbsp;Diseño de Investigación: '.$diseño_inves ."<br>";
       echo '31.&nbsp;&nbsp;&nbsp;&nbsp;Codigo Investigación: '.$cob_inves.'<br>';
       echo '32.&nbsp;&nbsp;&nbsp;&nbsp;Fuente de Investigación: '.$fuente_inves .'<br>';
       echo '33.&nbsp;&nbsp;&nbsp;&nbsp;Técnico de Investigación: '.$tecn_inves .'<br>';
       echo '34.&nbsp;&nbsp;&nbsp;&nbsp;Instumentos de Investigación: '.$instru_inves .'<br>';
       echo '35.&nbsp;&nbsp;&nbsp;&nbsp;Presentaciones de Datos: '.$presen_datos .'<br>';
       echo '36.&nbsp;&nbsp;&nbsp;&nbsp;Análisis de Datos: '.$analis_datos.'<br>';
       echo '37.&nbsp;&nbsp;&nbsp;&nbsp;Interpretación de Datos: '.$interpre_datos.'<br>';
       echo '38.&nbsp;&nbsp;&nbsp;&nbsp;Primer Presupuesto: '.$presupuesto1.'<br>';
       echo '39.&nbsp;&nbsp;&nbsp;&nbsp;Asignación de Recursos: '.$asig_recursos.'<br>';
       echo '40.&nbsp;&nbsp;&nbsp;&nbsp;Financiamiento: '.$fianan.'<br>';
       //echo 'Estado del Proyecto: '.$idesta_proy.'<br>';*/
       ?>
   </div>

    <div id='pdf'>
    </div>
    <div>
        <button onclick="window.location='index.php?controller=listaproyecto'" class="btn btn-success">Regresar</button>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a style="color: #ffffff; " class="btn btn-primary btn-sm" href="proyecto.pdf" TARGET="_blanc">PDF PROYECTO</a>
    </div>

    </fieldset>
 <?php }?>