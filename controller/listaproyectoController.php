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
    $data['lista']=$obj->lista_procesos($_REQUEST['id']);
      $view = new View();
        $view->setData($data);
        $view->setTemplate('../view/listaproyecto/lista_procesos.php');
        $view->setLayout('../template/Layout.php');
        $view->render();
    ///lista de procesos del poyecto je
        /* $a=$_GET['idproyecto'];
         $obj = new listaproyecto();
           $p = $obj->modificar_estado($a);
          
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
            }*/
         }         
         
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