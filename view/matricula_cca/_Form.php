<?php  include("../lib/functions.php"); ?>
<script type="text/javascript" src="js/app/evt_form_matricula_cca.js" ></script>
<script type="text/javascript" src="js/app/evt_form_cronograma_cca.js" ></script>
<script type="text/javascript" src="js/validateradiobutton.js"></script>
<script>
    function get2(p1,p2)
    {   
         opener.document.getElementById("idalumno").value=p1;
         opener.document.getElementById("nombres").value=p2;
         window.close();

    }
   
</script>
    
<div class="div_container">
    
    
    
        <div id="grilla">
            
        </div>
    

    
<h6 class="ui-widget-header">Registro de Matricula</h6>

<button  class="button" id="buscaralumno" onclick='window.open("index.php?controller=alumno_cca&action=buscar2","ventana1" , "width=860,height=400,top=150,left=250");'>BUSCAR ALUMNO</button>
<button class="button" id="veralumnos_cca">LISTA DE  ALUMNOS</button>

<!--<a hfre="index.php?controller=matricula_cca&action=lista_matriculados"  id="vermatriculados"class="button">VER MATRICULADOS</a>-->
<!--<button class="button" onclick='window.open("index.php?controller=alumno_cca&action=buscar2","ventana1" , "width=860,height=400,top=150,left=250");'>BUSCAR ALUMNO</button>-->
<div class="col-md-12" id="contenedor">
<form id="frm" action="index.php" method="POST" accept-charset="UTF-8">
    <input type="hidden" name="controller" value="matricula_cca" />
    <input type="hidden" name="action" value="save" />
    <div class="contFrm ui-corner-all" style="background: #fff;" >
        <div class="contenido" style="margin:0 auto; width: 750px; " align="center">         
            <fieldset class="ui-corner-all" >
                <legend>Datos</legend>
                    <table border="0" cellpadding="3" cellspacing="1" style="background-color:#fff; margin-left:8%" >
                        <tr class="fil">
                            <td>
                                <label for="idmatricula">ID:</label>
                            </td>
                            <td>
                                <input id="idmatricula" name="idmatricula" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->idmatricula; ?>"readonly />
                            </td>
                            <td width="20%" align="left">
                                <label >Alumno:</label>
                            </td>
                            <td>
                                <input id="idalumno" class="text ui-widget-content ui-corner-all" name="idalumno" style=" width: 30px; text-align: left;" value="<?php echo $obj->idmatricula;?>" readonly >
                                <input id="nombres" class="text ui-widget-content ui-corner-all" name="nombres" style=" width: 116px; text-align: left;" value="<?php echo $obj->nombres;?>" readonly >
                                
<!--                                <a  onclick='window.open("index.php?controller=alumno_cca&action=buscar2","ventana1" , "width=860,height=400,top=150,left=250");' /><img alt="" src="images/lupa.gif" /></a>-->
                            </td>

                        </tr>
                        <tr>
                            <td width="20%" align="left">
                                <label for="idcomision" >Comision:</label>
                            </td>
                            <td>
                                
                                <?php foreach ($comision as $value){ ?>
                                <input id="idcomision" class="text ui-widget-content ui-corner-all" name="idcomision" style=" width: 30px; text-align: left;" value="<?php echo $value[0];?>" readonly >
                                <input id="comision" class="text ui-widget-content ui-corner-all" name="comision" style=" width: 116px; text-align: left;" value="<?php echo $value[1];?>" readonly >  
                                <?php } ?>
                            </td>
                            <td width="20%" align="left">
                                <label for="nombre_proyecto">Nombre Proyecto:</label>
                            </td>
                            <td width="30%">
                               <input id="nombre_proyecto" name="nombre_proyecto" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->nombre_proyecto; ?>" />                  
                               
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="fecha">Fecha:</label>
                            </td> 
                            <td width="30%" >
                                <input id="fecha" name="fecha" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->fecha; ?>" />   
                                
                            </td>
                        </tr> 

                    </table>
       <!--                <a class="button" id="agregarmi">Agregar</a>-->
       <!--                <table id="tabmatriula" border="1" >
                           <tr><td>Alumno</td><td>Proyecto</td><td>Proyecto</td></tr>
       
       </table>-->
      
                Cuotas
                <select id="partes" required>
                    <option>......</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    
                    
                </select>
                <br><br>
                <div id="cronograma">
                    
                </div>
                 <h4>Monto total: 
                    <?php 
                      
                    foreach ($montocomi as $val2){?>
                    
                    <?php echo $val2[0]?>
                    <input type="hidden" name="montocomi" id="montocomi" value="<?php echo $val2[0]?>"/>
            <?php    }?>
                
                </h4>
            </fieldset>
        </div>

        <div style="margin:0 auto; width: 660px; height: 70px;">
            <fieldset class="ui-corner-all" >
                <legend>Accion</legend>
                <div  style="clear: both; padding: 10px; width: auto;text-align: center">
                    <a href="#" id="save" class="button">GRABAR</a>
                    <!--<a href="index.php?controller=matricula_cca" class="button">ATRAS</a>-->
                </div>
            </fieldset>
        </div>
    </div>
</form>
</div>
    
    </div>
