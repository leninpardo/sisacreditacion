<?php

require_once '../lib/Controller.php';
require_once '../lib/View.php';
//require_once '../model/ubigeos.php';
require_once '../model/docente_cca.php';

class docente_ccaController extends Controller {

    public function index() {
        if (!isset($_GET['p'])) {$_GET['p'] = 1;}
        if (!isset($_GET['q'])) {$_GET['q'] = "";}
        if (!isset($_GET['criterio'])) {$_GET['criterio'] = "docente_cca.nombres";}
        $obj = new docente_cca();
        $data = array();
        $data['data'] = $obj->index($_GET['q'], $_GET['p'], $_GET['criterio']);
        $data['query'] = $_GET['q'];
        $data['pag'] = $this->Pagination(array('rows' => $data['data']['rowspag'], 'url' => 'index.php?controller=docente_cca&action=index', 'query' => $_GET['q']));
        $cols = array("Id","Nombres", "Apellidos", "Identificacion", "Telefono ");
        $opt = array("docente_cca.nombres" => "nombres");//"alumno_cca.idalumno" => "codigo"
                $data['grilla_cca'] = $this->grilla("docente_cca",$cols, $data['data']['rows'],$opt,$data['pag'],true,true);

        
        //$data['tipo_alumno_cca'] = $this->Select(array('id' => 'idtipo_alumno', 'name' => 'idtipo_alumno', 'table' => 'tipo_alumno_cca', 'code' => $obj->idtipo_alumno));
        $view = new View();
        $view->setData($data);
        $view->setTemplate('../view/docente_cca/_Index.php');
        $view->setLayout('../template/Layout.php');
        $view->render();
    }

   public function edit() {
       $obj = new docente_cca();
        $data = array();
        $view = new View();
        $obj = $obj->edit($_GET['id']);
        $data['obj'] = $obj;
        $view->setData($data);
        $view->setTemplate('../view/docente_cca/_Form.php');
        $view->setLayout('../template/Layout.php');
        $view->render();
    }

    public function save() {
        $obj = new docente_cca();
        if ($_POST['iddocente'] == '') {
            
            $p = $obj->insert($_POST);
            if ($p[0]) {
                header('Location:index.php?controller=docente_cca');
            } else {
                $data = array();
                $view = new View();
                $data['msg'] = $p[1];
                $data['url'] = 'index.php?controller=docente_cca';
                $view->setData($data);
                $view->setTemplate('../view/_Error_App.php');
                $view->setLayout('../template/Layout.php');
                $view->render();
            }
        } else {
            $p = $obj->update($_POST);
            if ($p[0]) {
                header('Location: index.php?controller=docente_cca');
            } else {
                $data = array();
                $view = new View();
                $data['msg'] = $p[1];
                $data['url'] = 'index.php?controller=docente_cca';
                $view->setData($data);
                $view->setTemplate('../view/_Error_App.php');
                $view->setLayout('../template/Layout.php');
                $view->render();
            }
        }
    }

    public function delete() {
        $obj = new docente_cca();
        $p = $obj->delete($_GET['id']);
        if ($p[0]) {
            header('Location:index.php?controller=docente_cca');
        } else {
            $data = array();
            $view = new View();
            $data['msg'] = $p[1];
            $data['url'] = 'index.php?controller=docente_cca';
            $view->setData($data);
            $view->setTemplate('../view/_Error_App.php');
            $view->setLayout('../template/Layout.php');
            $view->render();
        }
    }

    public function create() {
        $data = array();
        $view = new View();
        
        //$data['tipo_alumno_cca'] = $this->Select(array('id' => 'idtipo_alumno', 'name' => 'idtipo_alumno', 'table' => 'tipo_alumno_cca', 'code' => $obj->idtipo_alumno));
        $view->setData($data);
        $view->setTemplate('../view/docente_cca/_Form.php');
        $view->setLayout('../template/Layout.php');
        $view->render();
    }
    
    public function buscar() {
        if (!isset($_GET['p'])) {$_GET['p'] = 1;}
        $obj = new docente_cca();
        $data = array();
        if (!isset($_GET['q'])) {$_GET['q'] = "";}
        if (!isset($_GET['p'])) {$_GET['p'] = "";}
        if (!isset($_GET['criterio'])) {$_GET['criterio'] = "dni";}
        $data['data']=$obj->buscar($_GET['q'], $_GET['p'], $_GET['criterio']);
        /*var_dump($data);
        exit();*/
        $data['query'] = $_GET['q'];
        $data['pag'] = $this->Pagination(array('rows' => $data['data']['rowspag'], 'url' => 'index.php?controller=docente_cca&action=buscar', 'query' => $_GET['q']));
        $cols = array("Nombres", "Apellidop","Apellidom", "Identificacion", "Sexo","Parametro");
        $opt = array("dni" => "DNI", "nombres" =>"NOMBRE");
        $data['grilla_cca'] = $this->grilla_cca("docente_cca", NULL, NULL,$cols, $data['data']['rows'], $opt, $data['pag'], false, false, true, true);
        
        $view = new View();
        $view->setData($data);
        $view->setTemplate('../view/docente_cca/_Lista.php');
        $view->setLayout('../template/Vacia.php');
        $view->render();
    }
    
    public function buscar2() {
        if (!isset($_GET['p'])) {$_GET['p'] = 1;}
        $obj = new docente_cca();
        $data = array();
        if (!isset($_GET['q'])) {$_GET['q'] = "";}
        if (!isset($_GET['p'])) {$_GET['p'] = "";}
        if (!isset($_GET['criterio'])) {$_GET['criterio'] = "dni";}
        $data['data']=$obj->buscar2($_GET['q'], $_GET['p'], $_GET['criterio']);
        /*var_dump($data);
        exit();*/
        $data['query'] = $_GET['q'];
        $data['pag'] = $this->Pagination(array('rows' => $data['data']['rowspag'], 'url' => 'index.php?controller=docente_cca&action=buscar2', 'query' => $_GET['q']));
        $cols = array("Id","Nombres", "Apellidop","Apellidom", "Identificacion");
        $opt = array("dni" => "DNI", "nombres" =>"NOMBRE");
        $data['grilla_cca'] = $this->grilla_cca("docente_cca", NULL, NULL,$cols, $data['data']['rows'], $opt, $data['pag'],false, true, false,false,false,false,false);
        
        $view = new View();
        $view->setData($data);
        $view->setTemplate('../view/docente_cca/_Lista_2.php');
        $view->setLayout('../template/Vacia.php');
        $view->render();
    }

}
?>