<?php  include("../lib/functions.php"); ?>
<script type="text/javascript" src="js/app/evt_form_cronograma_cca.js" ></script>
<script type="text/javascript" src="js/validateradiobutton.js"></script>
<script>
    /*function buscar() {
        var x=document.getElementById("buscar").value;
        window.open("index.php?controller=matricula_cca&par="+x,"", "width=550, height=300");
    
    }*/
</script>
<div class="div_container">

<!--<form id="frm" action="index.php" method="POST">-->
    <input type="hidden" name="controller" value="alumno_cca" />
    <input type="hidden" name="action" value="save" />
    <div class="contFrm ui-corner-all" style="background: #fff;">
        <div class="contenido" style="margin:0 auto; width: 850px; " align="center">
            
            
            
            <div align="center" style="background-color: aliceblue">
                <table border="0" cellspacing="0" cellpadding="0" style="width: 850px;">
        <tbody>
            <tr>
                <td width="246" colspan="2" rowspan="3" valign="top">
                    <p align="center">
                    <h3><b><span class="label label-default"><span class="glyphicon glyphicon-user"></span>&nbsp;Alumno :  </span></b><br><br>&nbsp;&nbsp;&nbsp;&nbsp<?php if (isset($nombre)){
                    echo $nombre;}else{
                        
                    echo $nombre_session[0][0];}
                    ?></h3>
                    </p>
                </td>
                <td width="129" valign="top">
                    <p align="center">
                    <h4><b><span class="label label-default"><span class="glyphicon glyphicon-bookmark"></span>&nbsp;Comisión :</span></b></h4>
                    </p>
                </td>
                <td width="117" valign="top"><?php 
//                       var_dump(data['comision']);
//                       exit();
                    foreach ($comision as $val){?>
                    <h4>
                    <?php echo $val[1]?>
                    <input type="hidden" name="idcomision" value="<?php echo $val[0]?>"/>
                    </h4>
            <?php    }?>
                </td>
            </tr>
            <tr>
                <td width="129" valign="top">
                    <p align="center">
                    <h4><b><span class="label label-default"><span class="glyphicon glyphicon-calendar"></span>&nbsp;Fecha Inicio :</span></b></h4><u></u>
                    </p>
                </td>
                <td width="117" valign="top"><?php 
//                       var_dump(data['comision']);
//                       exit();
                    foreach ($comision as $val){?>
                    <h4>
                    <?php echo $val[2]?>
                    </h4>
            <?php    }?>
                </td>
            </tr>
            <tr>
                <td width="129" valign="top">
                    <p align="center">
                    <h4><b><span class="label label-default"><span class="glyphicon glyphicon-file"></span>&nbsp;Proyecto :</span></b></h4>
                    </p>
                </td>
                <td width="117" valign="top">
                    <h4>
                    <?php 
                    if ($nombre_session){
                        
                    echo $nombre_session[0][1];}
                    ?></h4>
                </td>
            </tr>
            <tr>
                <td width="246" colspan="2" valign="top">
                    <p align="center">
                    <h4><b><span class="label label-default"><span class="glyphicon glyphicon-time"></span>&nbsp;Cronograma de pagos :</span></b></h4>
                    </p>
                </td>
                <td width="246" colspan="2" valign="top">
                    <p align="center">
                    <h4><b><span class="label label-default"><span class="glyphicon glyphicon-book"></span>&nbsp;Asignaturas :</span></b></h4>
                    </p>
                </td>
            </tr>
            <tr>
               
                <td width="123" valign="top"colspan="2" align="center">
                    
                    <table border="0" width="123" valign="top"colspan="2" align="center">
                        
                     <?php  
//                 var_dump($crono_alumno);
//                 exit();
//print "<pre>"; print_r($crono_alumno); print "</pre>\n";exit(); 
                            
                    for ($i=0;$i < count($crono_alumno);$i++){?>   
                        <tr >
                            <td >
                                <h4>
                               <?php echo $crono_alumno[$i][0];?> - <?php echo $crono_alumno[$i][1];?>
                                </h4>
                            </td>  
                            <td> <h4>
                                   <?php if ($crono_alumno[$i][2]==1){?><span class="label label-danger">Falta pagar</span><?php }?>
                                  
                                    <?php if ($crono_alumno[$i][2]==0){?><span class="label label-success">Pago Completado</span><?php }?>
                                </h4>
                             </td>
                     <?php  }?>
                        </tr>
                        
                    </table>
                    
                
                
                
                
                </td>

                <td width="246" colspan="2" rowspan="2" valign="top">
                   
                    
                    <table border="0" align="center" width="246" colspan="2" rowspan="2" valign="top">
                        
                            
                        <?php  //print "<pre>"; print_r($asignatura_cca); print "</pre>\n";exit(); 
                        for ($i=0;$i< count($asignatura_cca);$i++){?>
                        <tr>
                                
                            <td><h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <?php echo $asignatura_cca[$i][1];?>(<strong><?php echo $asignatura_cca[$i][2];?></strong>)</h5></td>&nbsp;&nbsp;&nbsp;<td><h5></h5></td><td><td><h5><?php echo $asignatura_cca[$i][0];?>
                            </h5></td>
                            
                            </ul>
                        </tr>  
                        
                        <?php }?>
                        
                    </table>
                   
                </td>
            </tr>
            <tr>
                <td width="246" colspan="2" valign="top">
                    <h4>
                    <div class="alert alert-danger">    
                    <p align="center">
                        Monto Total:  <?php 
                      
                    foreach ($montocomi as $val2){?>
                    
                    <?php echo $val2[0]?>
                    <input type="hidden" name="montocomi" id="montocomi"value="<?php echo $val2[0]?>"/>
            <?php    }?>
                    </p>
                    </div>
                    <div class="alert alert-success">
                    <p align="center">
                    Total Pagado: <u><?php echo $pago_actual[0][0]?></u>
                    </p>
                    </div>
                    </h4>
                </td>
            </tr>
        </tbody>
    </table>
</div><BR>
            <table border="0" style="widows: 850px;">
                <tr>
                    <td style="width: 425px;">
                         <a class="button" href="index.php?controller=cronograma_cca&action=pdf_alumno&idalumno=<?php echo $idalumno;?>" target="new">
                    Imprimir Cronograma
                </a>
                    </td>
                     <td>
                          <?php if(isset($_SESSION["perfil"]) && ($_SESSION["perfil"] == 'USUARIO_CCA')){?>
                         <a class="button" href="index.php?controller=pagos_cca&action=index&idalumno=<?php echo $idalumno;?>&nombre=<?php 
                    if ($nombre_session){
                        
                    echo $nombre_session[0][0];}
                ?>">
                    PAGOS DE CUOTAS
                </a>
                          <?PHP }?>
                    </td>
                </tr>
            </table>
            <div align="left">
               
            </div>
            <div align="right">
               
            </div>
                </div>
            
<!--             <div class="contenido" style="margin:0 auto; width: 750px; " align="center">
             <fieldset class="ui-corner-all" >
                <legend>Accion</legend> 
                 <div  style="clear: both; padding: 10px; width: auto;text-align: center">
                    <a href="#" id="save" class="button">GRABAR</a>
                    <a href="index.php?controller=alumno_cca&action=create" class="button">ATRAS</a>
                 </div>   
              </fieldset>
              </div>-->
        </div>
    
<!--</form>-->
</div>