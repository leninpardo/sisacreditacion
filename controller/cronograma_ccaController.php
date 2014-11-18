<?php
require_once '../lib/Controller.php';
require_once '../lib/View.php';
require_once '../model/cronograma_cca.php';
require_once '../model/matricula_cca.php';

class cronograma_ccaController extends Controller {

    public function index($_G) {
        
        if (!isset($_GET['p'])) {$_GET['p'] = 1;}
        if (!isset($_GET['q'])) {$_GET['q'] = "";}
        if (!isset($_GET['criterio'])) {$_GET['criterio'] = "alumno_cca.nombres";}
        
        
        
        
        $obj = new matricula_cca();
        $data = array();

        
        

      
        $data['idalumno']=$_GET['idalumno'];
               

        $a=$obj->comision_actual();
        foreach ($a as $vl){
            $idc=$vl[0];
            
        }
        
        
        $data['comision']=$a;
//        var_dump($data['comision']);
//        exit();
         $obj2 = new cronograma_cca();
        $data['montocomi']=$obj2->monto_comision($idc);
        
//        
        if(isset($_GET['idalumno_cca']))
            {
            $data['idalumno']=$_GET['idalumno'];
            $id=$_GET['idalumno_cca'];
            }
            
            if(isset($_SESSION["perfil"]) && ($_SESSION["perfil"] == 'USUARIO_CCA')){
                    
                       $data['idalumno']=$_GET['id'];
                $id=$_GET['id'];
                
                }
                
               if(isset($_SESSION["perfil"]) && ($_SESSION["perfil"] == 'ALUMNO_CCA'))
                {
                
                $data['idalumno']=$_SESSION['idusuario'];
                $id=$_SESSION['idusuario'];
                }
            
            
                    
                
                $cronograma=$obj2->crono_alumno($id);
                
                $data['crono_alumno']=$cronograma;
                $data["asignatura_cca"]=$obj2->comision_asignaturas($idc);
              
                    $data['nombre']=$_GET['nombre'];
               
                    $data["nombre_session"]=$obj2->nombre_alumno($id);
                    
                    $data["pago_actual"]=$obj2->pago_alumno($id);
                    
               
                
        $view = new View();
        $view->setData($data);

            $view->setTemplate('../view/cronograma_cca/_Form.php');
        $view->setLayout('../template/Layout.php');
         $view->render();

        
    }
    
    
    public function pdf_alumno($_G){
   
          $obj = new matricula_cca();
        $data = array();

        
        
      
        $data['idalumno']=$_GET['idalumno'];
               
 
        $a=$obj->comision_actual();
        foreach ($a as $vl){
            $idc=$vl[0];
            
        }
       
        
        $data['comision']=$a;

        
         $obj2 = new cronograma_cca();
        $data['montocomi']=$obj2->monto_comision($idc);
          
//        
        if(isset($_GET['idalumno_cca']))
            {
            $id=$_GET['idalumno_cca'];
            }
            
         
                
                if(isset($_GET['idalumno_cca']))
            {
            $data['idalumno']=$_GET['idalumno'];
            $id=$_GET['idalumno_cca'];
            }
            
            if(isset($_SESSION["perfil"]) && ($_SESSION["perfil"] == 'USUARIO_CCA')){
                    
                       $data['idalumno']=$_GET['id'];
                $id=$_GET['id'];
                
                }
                
               if(isset($_SESSION["perfil"]) && ($_SESSION["perfil"] == 'ALUMNO_CCA'))
                {
                
                $data['idalumno']=$_SESSION['idusuario'];
                $id=$_SESSION['idusuario'];
                }
            
                
                
                
        
                $cronograma=$obj2->crono_alumno($id);
                
                $data['crono_alumno']=$cronograma;
            
                $data["asignatura_cca"]=$obj2->comision_asignaturas($idc);
              
              
                    $data['nombre']=$_GET['nombre'];
               
                    $data["nombre_session"]=$obj2->nombre_alumno($id);
                    
                    $data["pago_actual"]=$obj2->pago_alumno($id);
                      
           
               
                
        $view = new View();
        $view->setData($data);

            $view->setTemplate('../view/cronograma_cca/_PDF.php');
        $view->setLayout('../template/List.php');
         $view->render();
                
        
    }
    public  function insertar_cronograma($_G){
        $monto=$_GET['monto'];
        $fechas=$_GET['fechacrono'];
        $alumno=$_GET['alumno'];

//        var_dump($_GET['fechacrono']);
//        exit();
      
      
        
         
         $obj = new cronograma_cca();
       $p = $obj->insert($_GET);
            if ($p[0]) {
                header('Location:index.php?controller=cronograma_cca');
            } else {
                $data = array();
                $view = new View();
                $data['msg'] = $p[1];
                $data['url'] = 'index.php?controller=alumno_cca';
                $view->setData($data);
                $view->setTemplate('../view/_Error_App.php');
                $view->setLayout('../template/Layout.php');
                $view->render();
            }
    }
   
    
}
?>