<?php
require_once '../lib/Controller.php';
require_once '../lib/View.php';
require_once '../model/recepcion_cca.php';
require_once '../model/alumno_cca.php';
require_once '../model/matricula_cca.php';

class recepcion_ccaController extends Controller {

    public function index() {
        
        if (!isset($_GET['p'])) {$_GET['p'] = 1;}
        if (!isset($_GET['q'])) {$_GET['q'] = "";}
        if (!isset($_GET['criterio'])) {$_GET['criterio'] = "alumno_cca.nombres";}
        $obj = new alumno_cca();
        $data = array();
        //"alumno_cca.idalumno" => "codigo"
        
             
             $data['data'] = $obj->alumnos_matriculados($_GET['q'], $_GET['p'], $_GET['criterio']);
    
//                print "<pre>"; print_r($data); print "</pre>\n";exit();
        $data['query'] = $_GET['q'];
        $data['pag'] = $this->Pagination(array('rows' => $data['data']['rowspag'], 'url' => 'index.php?controller=recepcion_cca&action=index', 'query' => $_GET['q']));
        $cols = array("Id","Nombres y Apellidos", "Identificacion");
        $opt = array("alumno_cca.nombres" => "nombres");
             $data['a']=$_GET['a'];
                     $data['grilla_cca'] = $this->grilla_cca("alumno_cca","recepcion_cca","lista_requisitos", $cols, $data['data']['rows'], $opt, $data['pag'], true);

          
           
        
        $view = new View();
        $view->setData($data);
        
            $view->setTemplate('../view/recepcion_cca/_Index.php');
        $view->setLayout('../template/Layout.php');
         $view->render();
        
        
    }

   public function edit() {
       $obj = new alumno_cca();
        $data = array();
        $view = new View();
        $obj = $obj->edit($_GET['id']);
        $data['obj'] = $obj;
        $data['descripcion'] = $this->Select(array('id' => 'idtipo_alumno', 'name' => 'idtipo_alumno', 'table' => 'tipo_alumno_cca', 'code' => $obj->idtipo_alumno));
        $view->setData($data);
        $view->setTemplate('../view/alumno_cca/_Form.php');
        $view->setLayout('../template/Vacia.php');
        $view->render();
    }

    public function save() {
        $obj = new alumno_cca();
        if ($_POST['idalumno'] == '') {
            $p = $obj->insert($_POST);
            if ($p[0]) {
                header('Location:index.php?controller=alumno_cca&action=buscar2');
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
        } else {
            $p = $obj->update($_POST);
            if ($p[0]) {
                header('Location: index.php?controller=alumno_cca');
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



    public function create() {
        $data = array();
        $view = new View();
        
        $data['descripcion'] = $this->Select(array('id' => 'idtipo_alumno', 'name' => 'idtipo_alumno', 'table' => 'tipo_alumno_cca', 'code' => $obj->idtipo_alumno));
        $view->setData($data);
        $view->setTemplate('../view/alumno_cca/_Form.php');
        $view->setLayout('../template/Vacia.php');
        $view->render();
    }
    
  
    public function lista_requisitos() {
        
          $obj1 = new matricula_cca();
         $a=$obj1->comision_actual();
      
//     print "<pre>"; print_r($a); print "</pre>\n"; echo $a[0][0] ;exit();
        $obj = new recepcion_cca();
        $data = array();
        $data["id"]=$_GET["id"];
        $data['promedio']=$obj->promeido_alumno($_GET["id"]);
//          print "<pre>"; print_r($data); print "</pre>\n";exit();
        $data['requerimientos'] = $obj->list_requerimientos($_GET["id"]);
        $data["crequerimientos"]=$obj->list_requerimientos_alumno($_GET["id"]);
           
        $data["cantidadr"]=$obj->cantidad_requerimientos($a[0][0]);
        $data["cantidad_cursos"]=$obj->cantidad_asignaturas_alumno($a[0][0]);
//            print "<pre>"; print_r($data['cantidad_cursos']); print "</pre>\n";exit();
//          print "<pre>"; print_r($data['requerimientos']); print "</pre>\n";exit();
        $view = new View();
        $view->setData($data);
        $view->setTemplate('../view/recepcion_cca/_Lista.php');
        $view->setLayout('../template/Layout.php');
        $view->render();
    }
    
}
?>