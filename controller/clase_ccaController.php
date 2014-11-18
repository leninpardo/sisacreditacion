<?php

require_once '../lib/Controller.php';
require_once '../lib/View.php';
require_once '../model/clase_cca.php';

class clase_ccaController extends Controller {

    public function index() {
        if (!isset($_GET['p'])) {$_GET['p'] = 1;}
        if (!isset($_GET['q'])) {$_GET['q'] = "";}
        if (!isset($_GET['criterio'])) {$_GET['criterio'] = "clase_cca.tema";}
        $obj = new clase_cca();
        $data = array();
        $data['data'] = $obj->index($_GET['q'], $_GET['p'], $_GET['criterio']);
        $data['query'] = $_GET['q'];
        $data['pag'] = $this->Pagination(array('rows' => $data['data']['rowspag'], 'url' => 'index.php?controller=clase_cca&action=index', 'query' => $_GET['q']));
        $cols = array("Id", "Asignatura","Fecha","Tema",);
        $opt = array("clase_cca.tema" => "Tema");
        $data['grilla'] = $this->grilla_cca("clase_cca", NULL, NULL,$cols, $data['data']['rows'], $opt, $data['pag'], false, false,false, true);
        
        $view = new View();
        $view->setData($data);
        $view->setTemplate('../view/clase_cca/_Index.php');
        $view->setLayout('../template/Layout.php');
        $view->render();
    }

   public function edit() {
       $obj = new clase_cca();
        $data = array();
        $view = new View();
        $obj = $obj->edit($_GET['id']);
        $data['obj'] = $obj;
        $data['asignatura'] = $this->Select(array('id' => 'idasignatura', 'name' => 'idasigantura', 'table' => 'vista_asignatura_cca', 'code' => $obj->idasignatura));
        $view->setData($data);
        $view->setTemplate('../view/clase_cca/_Form.php');
        $view->setLayout('../template/Layout.php');
        $view->render();
    }

    public function save() {
        $obj = new clase_cca();
        if ($_POST['idclase'] == '') {
            $p = $obj->insert($_POST);
            if ($p[0]) {
                header('Location:index.php?controller=clase_cca');
            } else {
                $data = array();
                $view = new View();
                $data['msg'] = $p[1];
                $data['url'] = 'index.php?controller=clase_cca';
                $view->setData($data);
                $view->setTemplate('../view/_Error_App.php');
                $view->setLayout('../template/Layout.php');
                $view->render();
            }
        } else {
            $p = $obj->update($_POST);
            if ($p[0]) {
                header('Location: index.php?controller=clase_cca');
            } else {
                $data = array();
                $view = new View();
                $data['msg'] = $p[1];
                $data['url'] = 'index.php?controller=clase_cca';
                $view->setData($data);
                $view->setTemplate('../view/_Error_App.php');
                $view->setLayout('../template/Layout.php');
                $view->render();
            }
        }
    }

    public function delete() {
        $obj = new clase_cca();
        $p = $obj->delete($_GET['id']);
        if ($p[0]) {
            header('Location:index.php?controller=clase_cca');
        } else {
            $data = array();
            $view = new View();
            $data['msg'] = $p[1];
            $data['url'] = 'index.php?controller=clase_cca';
            $view->setData($data);
            $view->setTemplate('../view/_Error_App.php');
            $view->setLayout('../template/Layout.php');
            $view->render();
        }
    }

    public function create() {
        $data = array();
        $view = new View();
        $data['asignatura'] = $this->Select(array('id' => 'idasignatura', 'name' => 'idasignatura', 'table' => 'vista_asignatura_cca', 'code' => $obj->idasignatura));
        $view->setData($data);
        $view->setTemplate('../view/clase_cca/_Form.php');
        $view->setLayout('../template/Layout.php');
        $view->render();
    }
}
?>