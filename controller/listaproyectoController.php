<?php
require_once '../lib/Controller.php';
require_once '../lib/View.php';
require_once '../model/listaproyecto.php';
//require_once '../model/alumno.php';

class listaproyectoController extends Controller {

    
    
   
    public function index() {
            
        $data['tabla2']=  $this->grilla_proyecto();
          
        $view = new View();
        $view->setData($data);
        $view->setTemplate('../view/listaproyecto/_Index.php');
        $view->setLayout('../template/Layout.php');
        $view->render();
         }
         
         public function detalles_Pro($get) {
         $a=$_GET['idproyecto'];
            $envio=$this->Detalle_Proyecto_P(array('criterio' => $a));
      
         echo $envio;
         }
         
public function editar_estado() {
    $obj=new listaproyecto();
    $data=array();
    $data['lista']=$obj->lista_procesos($_REQUEST['idproyecto']);
    $data['proyecto']=$obj->getproyecto($_REQUEST['idproyecto']);
      $view = new View();
        $view->setData($data);
        $view->setTemplate('../view/listaproyecto/lista_procesos.php');
        $view->setLayout('../template/Layout.php');
        $view->render();
  
         }  
         
         public function get_procesos()
         {
            $obj=new listaproyecto();            
               $data=array();
    $data['lista_procesos']=$obj->lista_procesos_left($_REQUEST['id']);
      $view = new View();
        $view->setData($data);
        $view->setTemplate('../view/listaproyecto/frm_procesos.php');
      //  $view->setLayout('../template/Layout.php');
        echo $view->renderPartial();
         }
         
         public function get_procesos_all(){
             $obj=new listaproyecto();
             print_r(json_encode($obj->get_procesos_all($_REQUEST['id'])));
         }

         public function save_procesos()
         {
             $obj=new listaproyecto();
             //echo "22";
             print_r(json_encode($obj->save_procesos($_REQUEST)));
         }
         public function get_verificar_procesos()
         {
               $obj=new listaproyecto();            
               $data=array();
          
    $datos=$obj->lista_verificar_procesos_proyecto($_REQUEST['idproyecto'],$_REQUEST['idproceso']);
   $data['datos']=$datos;
   // $data['sub_procesos']=$obj->lista_subprocesos($_REQUEST['idproceso']);
    
    $data_docentes=$obj->get_docente();
    $select="<select name='docentes' id='docentes'><option value=''>::Seleccione::</option>";
    foreach ($data_docentes as $d)
    {
    if($datos[0][10]==$d[0]){
       $select.="<option selected value='$d[0]'>".utf8_encode($d[1])."</option>";
    }else{
     $select.="<option value='$d[0]'>".utf8_encode($d[1])."</option>";   
    }
    }
    $select.="</select>";
    
   $data['select_docente']=$select;
      $view = new View();
        $view->setData($data);
        if($datos[0][11]==0){
        $view->setTemplate('../view/listaproyecto/verificar_procesos.php');
        }else{
          $view->setTemplate('../view/listaproyecto/verificar_subprocesos.php');  
        }
        echo $view->renderPartial();  
         }
         public function update_procesos(){
           $obj=new listaproyecto();
          print_r(json_encode($obj->update_procesos($_REQUEST)));
         }
          public function update_subprocesos(){
           $obj=new listaproyecto();
          print_r(json_encode($obj->update_subprocesos($_REQUEST)));
         }
         ///
        public function getDetalleProyecto ()
       {
        $codproyecto=$_POST['idproyecto'];
        $envio=$this->Detalle_Proyecto_P(array('criterio' => $codproyecto));
      echo $envio; 
       } 
         public function getDetalleProyecto1 ()
       {
        $codproyecto=$_POST['idproyecto'];
        $envio=$this->Detalle_Proyecto1_P(array('criterio' => $codproyecto));
      echo $envio; 
       }
         
     public function getListaProyecto ()
       {
        $codproyecto=$_POST['idproyecto'];
        $envio=$this->ListaProyecto_P(array('criterio' => $codproyecto));
      echo $envio; 
       }
       
        public function getMarco ()
       {
        $codproyecto=$_POST['idproyecto'];
        $envio=$this->Marco_P(array('criterio' => $codproyecto));
      echo $envio; 
       }
   
         public function getMetodologia ()
       {
        $codproyecto=$_POST['idproyecto'];
        $envio=$this->Metodologia_P(array('criterio' => $codproyecto));
      echo $envio; 
       }
          public function getAspectos()
       {
        $codproyecto=$_POST['idproyecto'];
        $envio=$this->Aspectos_P(array('criterio' => $codproyecto));
      echo $envio; 
       }
       
        public function getListaAlumno1 ()
       {
        $codproyecto=$_POST['idproyecto'];
        $envio=$this->ListaAlumno1_P(array('criterio' => $codproyecto));     
      echo $envio;
       }
       
   public function getListaDocente ()
       {
        $codproyecto=$_POST['idproyecto'];
        $envio=$this->ListaDocente_P(array('criterio' => $codproyecto));
      echo $envio;  
       }
         public function getDetallePdf ()
       {
        $codproyecto=$_POST['idproyecto'];
        $envio=$this->ListaPdf_P(array('criterio' => $codproyecto));
      echo $envio;  
       }
       
       public function save(){echo "<script>alert('Se ha enviado la solicitud');</script>";
                      echo header("Location: index.php?controller=listaproyecto");
       
        $obj = new listaproyecto();
        
            $p = $obj->insert($_POST);
            if ($p[0]){
                die("<script>alert()</script>");
              
            } else {
            $data = array();
            $view = new View();
            $data['msg'] = $p[1];
            $data['url'] =  'index.php?controller=listaproyecto';
            $view->setData($data);
            $view->setTemplate( '../view/_Error_App.php' );
            $view->setLayout( '../template/Layout.php' );
            $view->render();
            }
        
	}
       
    public function calcular_fecha() {
        $fecha_inicio = $_REQUEST['fecha_inicio'];
        
        $fecha_despues = self::operacion_fecha(self::validar_fecha2($fecha_inicio), $_REQUEST['n_dias']);
        $fechats = strtotime($fecha_despues); //a timestamp

//el parametro w en la funcion date indica que queremos el dia de la semana
//lo devuelve en numero 0 domingo, 1 lunes,....
switch (date('w', $fechats)){
    case 0: $nd= "Domingo"; $ret=1;break;
    case 1: $nd= "Lunes"; $ret=0;break;
    case 2: $nd= "Martes"; $ret=0; break;
    case 3: $nd= "Miercoles"; $ret=0; break;
    case 4: $nd= "Jueves"; $ret=0; break;
    case 5: $nd= "Viernes"; $ret=0; break;
    case 6: $nd= "Sabado"; $ret=2;break;
}
if($ret>0)
{
    $fecha_despues=self::operacion_fecha(self::validar_fecha2($fecha_despues), $ret);
}
print_r((self::validar_fecha($fecha_despues)));
    }

    public function operacion_fecha($fecha, $dias) {
     list ($dia,$mes,$ano)=explode("-",$fecha); 
if (!checkdate($mes,$dia,$ano)){return false;} 
$dia=$dia+$dias; 
$fecha=date( "d-m-Y", mktime(0,0,0,$mes,$dia,$ano) ); 
return $fecha;  
    }
    
    function validar_fecha($fecha){
$fecha = strtotime($fecha);
$anio = (date('Y',$fecha));
$mes = (date('m',$fecha));
$dia =(date('d',$fecha));
return $anio.'-'.$mes.'-'.$dia;
}
    function validar_fecha2($fecha){
$fecha = strtotime($fecha);
$anio = (date('Y',$fecha));
$mes = (date('m',$fecha));
$dia =(date('d',$fecha));
return $dia.'-'.$mes.'-'.$anio;
}
public function update_docente(){
    $obj=new listaproyecto();
    $datos=$obj->update_docentes($_REQUEST);
    print_r(json_encode($datos));
}
}
?>