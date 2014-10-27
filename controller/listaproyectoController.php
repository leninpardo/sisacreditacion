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
    $data['datos']=$obj->lista_verificar_procesos_proyecto($_REQUEST['idproyecto'],$_REQUEST['idproceso']);
      $view = new View();
        $view->setData($data);
        $view->setTemplate('../view/listaproyecto/verificar_procesos.php');
        echo $view->renderPartial();  
         }
         public function update_procesos(){
           $obj=new listaproyecto();
          print_r(json_encode($obj->update_procesos($_REQUEST)));
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
       
    

}

 
?>