<?php
require_once '../lib/Controller.php';
require_once '../lib/View.php';
require_once '../model/alumno_cca.php';

class alumno_ccaController extends Controller {

    public function index() {
        
        if (!isset($_GET['p'])) {$_GET['p'] = 1;}
        if (!isset($_GET['q'])) {$_GET['q'] = "";}
        if (!isset($_GET['criterio'])) {$_GET['criterio'] = "alumno_cca.nombres";}
        $obj = new alumno_cca();
        $data = array();
        //"alumno_cca.idalumno" => "codigo"
         if(isset($_GET['a']))
            {
             
             $data['data'] = $obj->alumnos_matriculados($_GET['q'], $_GET['p'], $_GET['criterio']);
        $data['query'] = $_GET['q'];
        $data['pag'] = $this->Pagination(array('rows' => $data['data']['rowspag'], 'url' => 'index.php?controller=alumno_cca&action=index&a=b', 'query' => $_GET['q']));
        $cols = array("Id","Nombres y Apellidos", "Identificacion");
        $opt = array("alumno_cca.nombres" => "nombres");
             $data['a']=$_GET['a'];
                     $data['grilla_cca'] = $this->grilla_cca("alumno_cca","cronograma_cca","index", $cols, $data['data']['rows'], $opt, $data['pag'], true);

            }
            else{
                $data['data'] = $obj->index($_GET['q'], $_GET['p'], $_GET['criterio']);
        $data['query'] = $_GET['q'];
        $data['pag'] = $this->Pagination(array('rows' => $data['data']['rowspag'], 'url' => 'index.php?controller=alumno_cca&action=index', 'query' => $_GET['q']));
        $cols = array("Id","Nombres", "Apellidos", "Identificacion", "Tipo alumno   ");
        $opt = array("alumno_cca.nombres" => "nombres");
                        $data['grilla_cca'] = $this->grilla_cca("alumno_cca",NULL,NULL, $cols, $data['data']['rows'], $opt, $data['pag'], false,false,true, true);

            }
        
        $view = new View();
        $view->setData($data);
        if(isset($_GET['a']))
            {
        $view->setTemplate('../view/alumno_cca/_Index.php');
        $view->setLayout('../template/List.php');
        return $view->render();    
            }
        else{
            $view->setTemplate('../view/alumno_cca/_Index.php');
        $view->setLayout('../template/Layout.php');
         $view->render();
        }
        
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

    public function delete() {
        $obj = new alumno_cca();
        $p = $obj->delete($_GET['id']);
        if ($p[0]) {
            header('Location:index.php?controller=alumno_cca');
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

    public function create() {
        $data = array();
        $view = new View();
        
        $data['descripcion'] = $this->Select(array('id' => 'idtipo_alumno', 'name' => 'idtipo_alumno', 'table' => 'tipo_alumno_cca', 'code' => $obj->idtipo_alumno));
        $view->setData($data);
        $view->setTemplate('../view/alumno_cca/_Form.php');
        $view->setLayout('../template/Vacia.php');
        $view->render();
    }
    
    public function buscar() {
        if (!isset($_GET['p'])) {$_GET['p'] = 1;}
        $obj = new alumno_cca();
        $data = array();
        if (!isset($_GET['q'])) {$_GET['q'] = "";}
        if (!isset($_GET['p'])) {$_GET['p'] = "";}
        if (!isset($_GET['criterio'])) {$_GET['criterio'] = "dni";}
        $data['data']=$obj->buscar($_GET['q'], $_GET['p'], $_GET['criterio']);
        /*var_dump($data);
        exit();*/
        $data['query'] = $_GET['q'];
        $data['pag'] = $this->Pagination(array('rows' => $data['data']['rowspag'], 'url' => 'index.php?controller=alumno_cca&action=buscar', 'query' => $_GET['q']));
        $cols = array("id","Nombres", "Apellidop","Apellidom", "Identificacion","Sexo", "Parametro");
        $opt = array("dni" => "DNI", "nombres" =>"NOMBRE");
        $data['grilla_cca'] = $this->grilla_cca("alumno_cca", NULL,NULL,$cols, $data['data']['rows'], $opt, $data['pag'], false, false, true, true);
        
        $view = new View();
        $view->setData($data);
        $view->setTemplate('../view/alumno_cca/_Lista.php');
        $view->setLayout('../template/Vacia.php');
        $view->render();
    }
    public function buscar2() {
        if (!isset($_GET['p'])) {$_GET['p'] = 1;}
        $obj = new alumno_cca();
        $data = array();
        if (!isset($_GET['q'])) {$_GET['q'] = "";}
        if (!isset($_GET['p'])) {$_GET['p'] = "";}
        if (!isset($_GET['criterio'])) {$_GET['criterio'] = "alumnon.dni";}
        $data['data']=$obj->buscar2($_GET['q'], $_GET['p'], $_GET['criterio']);
     
        $data['query'] = $_GET['q'];
        $data['pag'] = $this->Pagination(array('rows' => $data['data']['rowspag'], 'url' => 'index.php?controller=alumno_cca&action=buscar2', 'query' => $_GET['q']));
        $cols = array("Id","Nombres", "Apellidop","Apellidom", "Identificacion","Sexo", "Parametro");
        $opt = array("alumnon.dni" => "DNI", "alumnon.nombres" =>"NOMBRE");
        $data['grilla_cca'] = $this->grilla_cca("alumno_cca",NULL,NULL, $cols, $data['data']['rows'], $opt, $data['pag'], false, false, false, false, true);
        
        $view = new View();
        $view->setData($data);
        $view->setTemplate('../view/alumno_cca/_Lista_2.php');
        $view->setLayout('../template/Vacia.php');
        $view->render();
    }
    
}
?>