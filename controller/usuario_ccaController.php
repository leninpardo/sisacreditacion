<?php
require_once '../lib/Controller.php';
require_once '../lib/View.php';
require_once '../model/usuario_cca.php';

class usuario_ccaController extends Controller {

    public function index() {
        
        if (!isset($_GET['p'])) {$_GET['p'] = 1;}
        if (!isset($_GET['q'])) {$_GET['q'] = "";}
        if (!isset($_GET['criterio'])) {$_GET['criterio'] = "usuario_cca.dni";}
        $obj = new usuario_cca();
        $data = array();
        $data['data'] = $obj->index($_GET['q'], $_GET['p'], $_GET['criterio']);
        $data['query'] = $_GET['q'];
        $data['pag'] = $this->Pagination(array('rows' => $data['data']['rowspag'], 'url' => 'index.php?controller=alumno_cca&action=index', 'query' => $_GET['q']));
        $cols = array("Id","Nombres", "Apellidos", "Identificacion");
        $opt = array("usuario_cca.nombres" => "Nombres","usuario_cca.dni" => "DNI");//"alumno_cca.idalumno" => "codigo"
        $data['grilla_cca'] = $this->grilla_cca("usuario_cca", NULL, NULL,$cols, $data['data']['rows'], $opt, $data['pag'], false, false, true, true,false,true);
        
        $view = new View();
        $view->setData($data);
        if(isset($_GET['a']))
            {
        $view->setTemplate('../view/usuario_cca/_Index.php');
        $view->setLayout('../template/List.php');
        return $view->render();    
            }
        else{
            $view->setTemplate('../view/usuario_cca/_Index.php');
        $view->setLayout('../template/Layout.php');
         $view->render();
        }
        
    }

   public function edit() {
       $obj = new usuario_cca();
        $data = array();
        $view = new View();
        $obj = $obj->edit($_GET['id']);
        $data['obj'] = $obj;
//        $data['descripcion'] = $this->Select(array('id' => 'idtipo_alumno', 'name' => 'idtipo_alumno', 'table' => 'tipo_alumno_cca', 'code' => $obj->idtipo_alumno));
        $view->setData($data);
        $view->setTemplate('../view/usuario_cca/_Form.php');
        $view->setLayout('../template/Vacia.php');
        $view->render();
    }

    public function save() {
        $obj = new usuario_cca();
        if ($_POST['idusuario'] == '') {
            $p = $obj->insert($_POST);
            if ($p[0]) {
                header('Location:index.php?controller=usuario_cca');
            } else {
                $data = array();
                $view = new View();
                $data['msg'] = $p[1];
                $data['url'] = 'index.php?controller=usuario_cca';
                $view->setData($data);
                $view->setTemplate('../view/_Error_App.php');
                $view->setLayout('../template/Vacia.php');
                $view->render();
            }
        } else {
            $p = $obj->update($_POST);
            if ($p[0]) {
                header('Location: index.php?controller=usuario_cca');
            } else {
                $data = array();
                $view = new View();
                $data['msg'] = $p[1];
                $data['url'] = 'index.php?controller=usuario_cca';
                $view->setData($data);
                $view->setTemplate('../view/_Error_App.php');
                $view->setLayout('../template/Layout.php');
                $view->render();
            }
        }
    }

    public function delete() {
        $obj = new usuario_cca();
        $p = $obj->delete($_GET['id']);
        if ($p[0]) {
            header('Location:index.php?controller=usuario_cca');
        } 
        else {
            $data = array();
            $view = new View();
            $data['msg'] = $p[1];
            $data['url'] = 'index.php?controller=usuario_cca';
            $view->setData($data);
            $view->setTemplate('../view/_Error_App.php');
            $view->setLayout('../template/Layout.php');
            $view->render();
        }
    }

    public function create() {
        $data = array();
        $view = new View();
        
//        $data['descripcion'] = $this->Select(array('id' => 'idtipo_alumno', 'name' => 'idtipo_alumno', 'table' => 'tipo_alumno_cca', 'code' => $obj->idtipo_alumno));
        $view->setData($data);
        $view->setTemplate('../view/usuario_cca/_Form.php');
        $view->setLayout('../template/Vacia.php');
        $view->render();
    }
    
   
   
}
?>