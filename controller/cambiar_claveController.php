<?php

require_once '../lib/Controller.php';
require_once '../lib/View.php';
//require_once '../model/ubigeos.php';
require_once '../model/cambiar_clave.php';

class cambiar_claveController extends Controller {

    public function index() {
//        $cod=$_POST['cod'];
//        if (!isset($_GET['p'])) {$_GET['p'] = 1;}
//        if (!isset($_GET['q'])) {$_GET['q'] = "";}
//        if (!isset($_GET['criterio'])) {$_GET['criterio'] = "asignatura_cca.descripcion";}
        $obj = new cambiar_clave();
        $data = array();
//        $data['data'] = $obj->index($_GET['q'], $_GET['p'], $_GET['criterio']);
//        $data['query'] = $_GET['q'];
//        $data['pag'] = $this->Pagination(array('rows' => $data['data']['rowspag'], 'url' => 'index.php?controller=asignatura_cca&action=index', 'query' => $_GET['q']));
//        $cols = array("Id","Asignatura", "Creditaje","Docente","Comision");
//        $opt = array("asignatura_cca.descripcion" => "descripcion");//"alumno_cca.idalumno" => "codigo"
//        $data['grilla'] = $this->grilla_detcom_cca("asignatura_cca", $cod, $cols, $data['data']['rows'], $opt, $data['pag'], true, true);
//        
        $view = new View();
        $view->setData($data);
        $view->setTemplate('../view/cambiar_clave/_Form.php');
        $view->setLayout('../template/Layout.php');
        $view->render();
    }

//   public function edit() {
//       $obj = new asignatura_cca();
//        $data = array();
//        $view = new View();
//        $obj = $obj->edit($_GET['id']);
//        $data['obj'] = $obj;
//        //$data['comision'] = $this->Select(array('id' => 'idcomision', 'name' => 'idcomision', 'table' => 'comision_cca', 'code' => $obj->id_comision));
//        //$data['docente'] = $this->Select(array('id' => 'iddocente', 'name' => 'iddocente', 'table' => 'docente_cca', 'code' => $obj->iddocente));
//        $view->setData($data);
//        $view->setTemplate('../view/asignatura_cca/_Form.php');
//        $view->setLayout('../template/Layout.php');
//        $view->render();
//    }

    public function actualizar_clave() {
        $obj = new cambiar_clave();
        
        
            $p = $obj->insert($_G);
          
                header("Location:index.php");
           
        
    }

    public function delete() {
        $obj = new asignatura_cca();
        $p = $obj->delete($_GET['id']);
        if ($p[0]) {
            header("Location:index.php?controller=comision_cca&action=datos_Comision&id=".$_GET["idcomi"]."");
        } else {
            $data = array();
            $view = new View();
            $data['msg'] = $p[1];
            $data['url'] = 'index.php?controller=comision_cca';
            $view->setData($data);
            $view->setTemplate('../view/_Error_App.php');
            $view->setLayout('../template/Layout.php');
            $view->render();
        }
    }

    public function create() {
        $b = $_POST['a'];
        $data = array();
        $view = new View();
        
        //$data['comision'] = $this->Select(array('id' => 'idcomision', 'name' => 'idcomision', 'table' => 'comision_cca', 'code' => $obj->idcomision));
        $data['docente'] = $this->Select(array('id' => 'iddocente', 'name' => 'iddocente', 'table' => 'docente_cca', 'code' => $obj->iddocente));
        $view->setData($data);
        if (isset($b)) {
            $view->setTemplate('../view/asignatura_cca/_Form.php');
            $view->setLayout('../template/List.php');
            return $view->render();
        } else {
            $view->setTemplate('../view/asignatura_cca/_Form.php');
            $view->setLayout('../template/Layout.php');
            $view->render();
        }
    }
}
?>