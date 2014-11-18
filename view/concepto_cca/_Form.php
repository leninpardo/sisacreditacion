<?php  include("../lib/functions.php"); ?>
<script type="text/javascript" src="js/app/evt_form_concepto_cca.js" ></script>
<script type="text/javascript" src="js/validateradiobutton.js"></script>
<!--<script>
    /*function buscar() {
        var x=document.getElementById("buscar").value;
        window.open("index.php?controller=matricula_cca&par="+x,"", "width=550, height=300");
    
    }*/
       function get2(p1,p2)
    {   
         opener.document.getElementById("iddocente").value=p1;
         opener.document.getElementById("nombres").value=p2;
         window.close();

    }
</script>-->

<div class="div_container">
<!--<h6 class="ui-widget-header">Registro de alumnos CCA</h6>-->
<input id="parametro" type="hidden" name="parametro" class="text ui-widget-content ui-corner-all" style=" width: 250px; text-align: left;" value="" readonly>


<!--<button onclick='window.open("index.php?controller=alumno_cca&action=buscar","ventana2" , "width=860,height=400,top=150,left=250");'>BUSCAR</button>-->


<!--<button onclick='window.open("index.php?controller=alumno_cca&action=buscar","ventana2" , "width=860,height=400,top=150,left=250");'>BUSCAR</button>-->

<form id="frm" action="index.php" method="POST">
    <input type="hidden" name="controller" value="concepto_cca"/>
    <input type="hidden" name="action" value="save" />
    <div class="contFrm ui-corner-all" style="background: #fff;">
        <?php if ($a=="b"){?>
        <div class="contenido" style="margin:0 auto; width:450px; " align="center">
        <?php }else{?>
        <div class="contenido" style="margin:0 auto; width: 750px; " align="center">

                    <?php }?>

            <fieldset class="ui-corner-all" >
                <legend>Datos</legend>  
               <table border="0" cellpadding="3" cellspacing="1" style="background-color:#fff;" >
                   <tr class="fil">
                      <td width="20%" align="left">
                        <span for="idconcepto" ><strong>ID:</strong></label>
                      </td>
                      <td width="30%">
                        <input id="idconcepto" name="idconcepto" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->idconcepto; ?>" readonly />                
                      </td>
                      <td width="20%" align="left">
                         <strong for="nombres" >COMISION ACTUAL : </strong>
                      </td>  
                      <td width="30%" >

  <?php foreach ($comision as $value){ ?>
                          <input id="idcomision" type="hidden" class="text ui-widget-content ui-corner-all" name="idcomision" style=" width: 30px; text-align: left;" value="<?php echo $value[0];echo $obj->idcomision;?>" >
                                <?php echo $value[1];?>
                                <?php } ?>                      
                      
                      
                      </td>

                    </tr>
                    <tr class="fil">
                       <td> 
                         <strong for="apellidop" align="right" >Descripcion:</strong>
                       </td> 
                       <td>
                         <input id="descripcion" name="descripcion" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->descripcion; if (isset($_GET['descripcion'])){echo $_GET['descripcion'];}?>"  />           
                         <!--<div id="descripcion_error" class="error" name="descripcion_error" style="color: red">INGRESE DESCRIPCION</div>-->
                       </td>
                       <td align="left">
                           <strong for="apellidom"  >Monto:</strong>
                       </td>
                       <td>
                           <input id="monto" name="monto" class="text ui-widget-content ui-corner-all" style=" width: 150px; text-align: left;" value="<?php echo $obj->monto; if (isset($_GET['monto'])){echo $_GET['monto'];}?>"  />                
<!--                           <div id="monto_error" class="error" name="monto_error" style="color: red">INGRESE MONTO</div>
                           <div id="monto_numero" class="error" name="momto_numero" style="color: red">INGRESE DATOS CORRECTOS</div                     -->
                       </td>
                     </tr>
                     
                      
               </table>
                </fieldset>
                </div>
            
             <div class="contenido" style="margin:0 auto; width: 450px; " align="center">
             <fieldset class="ui-corner-all" >
                <legend>Accion</legend> 
                 <div  style="clear: both; padding: 10px; width: auto;text-align: center">
                     
                    <a href="#" id="save" class="button">GRABAR</a>
                    
<!--                    <a href="index.php?controller=concepto_cca" class="button">ATRAS</a>-->
                 </div> 
                
              </fieldset>
              </div>
         </div>
        </div>
    </form>
    </div>

