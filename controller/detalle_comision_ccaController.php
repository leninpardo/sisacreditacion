<?php

require_once '../lib/Controller.php';
require_once '../lib/View.php';
require_once '../model/detalle_comision_cca.php';

class detalle_comision_ccaController extends Controller {

//    public function index() {
//        $cod = $_post['cod'];
//        if (!isset($_GET['p'])) {
//            $_GET['p'] = 1;
//        }
//        if (!isset($_GET['q'])) {
//            $_GET['q'] = "";
//        }
//        if (!isset($_GET['criterio'])) {
//            $_GET['criterio'] = "detalle_comision_cca.idcomision";
//        }
//        $obj = new detalle_comision_cca();
//        $data = array();
//        $data['data'] = $obj->index($_GET['q'], $_GET['p'], $_GET['criterio']);
//        $data['query'] = $_GET['q'];
//        $data['pag'] = $this->Pagination(array('rows' => $data['data']['rowspag'], 'url' => 'index.php?controller=detalle_comision_cca&action=index', 'query' => $_GET['q']));
//        $cols = array("Id", "Comision", "Docente", "Cargo");
//        $opt = array("detalle_comision_cca.iddetalle_comision" => "Detalle"); //"alumno_cca.idalumno" => "codigo"
//        $data['grilla'] = $this->grilla_detcom_cca("detalle_comision_cca", $cod, $cols, $data['data']['rows'], $opt, $data['pag'], false, true);
//        $view = new View();
//        $view->setData($data);
//        $view->setTemplate('../view/detalle_comision_cca/_Index.php');
//        $view->setLayout('../template/Layout.php');
//        $view->render();
//    }

    public function edit() {
        $obj = new detalle_comision_cca();
        $data = array();
        $view = new View();
        $obj = $obj->edit($_GET['id']);
        $data['obj'] = $obj;
        $data['cargo'] = $this->Select(array('id' => 'idcargo_comision', 'name' => 'idcargo_comision', 'table' => 'cargo_comision_cca', 'code' => $obj->idcargo_comision));
        $view->setData($data);
        $view->setTemplate('../view/detalle_comision_cca/_Form.php');
        $view->setLayout('../template/Layout.php');
        $view->render();
    }

    public function save() {
        $obj = new detalle_comision_cca();
        if ($_POST['iddetalle_comision'] == '') {
            $p = $obj->insert($_POST);
            if ($p[0]) {
                header("Location:index.php?controller=comision_cca&action=datos_Comision&id=".$_POST["idcomision"]."");
               
            } else {
                $data = array();
                $view = new View();
                $data['msg'] = $p[1];
                $data['url'] = "index.php?controller=comision_cca";
                $view->setData($data);
                $view->setTemplate('../view/_Error_App.php');
                $view->setLayout('../template/Layout.php');
                $view->render();
            }
        } else {
            $p = $obj->update($_POST);
            if ($p[0]) {
                header('Location: index.php?controller=comision_cca');
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
    }

    public function delete() {
        $obj = new detalle_comision_cca();
        $p = $obj->delete($_GET['id']);
        if ($p[0]) {
            header("Location:index.php?controller=comision_cca&action=datos_Comision&id=".$_GET["idcomi"]."");
        } else {
            $data = array();
            $view = new View();
            $data['msg'] = $p[1];
            $data['url'] = "index.php?controller=comision_cca";
            $view->setData($data);
            $view->setTemplate('../view/_Error_App.php');
            $view->setLayout('../template/Layout.php');
            $view->render();
        }
    }

    public function create($a) {
        $b = $_POST['a'];
        $data = array();
        $view = new View();
        $data['idcargocomision'] = $this->Select(array('id' => 'idcargocomision', 'name' => 'idcargocomision', 'table' => 'cargo_comision_cca', 'code' => $obj->idcargocomision));
        //$data['docente'] = $this->Select(array('id' => 'iddocente', 'name' => 'iddocente', 'table' => 'docente_cca', 'code' => $obj->iddocente));
        $view->setData($data);


        if (isset($b)) {
            $view->setTemplate('../view/detalle_comision_cca/_Form.php');
            $view->setLayout('../template/List.php');
            return $view->render();
        } else {
            $view->setTemplate('../view/detalle_comision_cca/_Form.php');
            $view->setLayout('../template/Layout.php');
            $view->render();
        }
    }

}

?>