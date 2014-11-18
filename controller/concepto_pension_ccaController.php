<?php

require_once '../lib/Controller.php';
require_once '../lib/View.php';
require_once '../model/concepto_pension_cca.php';

class concepto_pension_ccaController extends Controller {

    public function index() {
        $cod=$_REQUEST['id'];
        if (!isset($_GET['p'])) {$_GET['p'] = 1;}
        if (!isset($_GET['q'])) {$_GET['q'] = "";}
        if (!isset($_GET['criterio'])) {$_GET['criterio'] = "concepto_pension_cca.idconcepto";}
        $obj = new concepto_pension_cca();
        $data = array();
        $data['data'] = $obj->index($_GET['q'], $_GET['p'], $_GET['criterio']);
        $data['query'] = $_GET['q'];
        $data['pag'] = $this->Pagination(array('rows' => $data['data']['rowspag'], 'url' => 'index.php?controller=concepto_pension_cca&action=index', 'query' => $_GET['q']));
        $cols = array("Id","Concepto","Monto", "Comision");
        $opt = array("concepto_pension_cca.monto" => "Monto");
        $data['grilla'] = $this->grilla_detcom_cca("concepto_pension_cca", $cod, $cols, $data['data']['rows'], $opt, $data['pag'], false, true);
        
        $view = new View();
        $view->setData($data);
        $view->setTemplate('../view/concepto_pension_cca/_Index.php');
        $view->setLayout('../template/Layout.php');
        $view->render();
    }

   public function edit() {
       $obj = new concepto_pension_cca();
        $data = array();
        $view = new View();
        $obj = $obj->edit($_GET['id']);
        $data['obj'] = $obj;
        //$data['comision'] = $this->Select(array('id' => 'idcomision', 'name' => 'idcomision', 'table' => 'comision_cca', 'code' => $obj->idcomision));
        $view->setData($data);
        $view->setTemplate('../view/concepto_pension_cca/_Form.php');
        $view->setLayout('../template/Layout.php');
        $view->render();
    }

    public function save() {
        $obj = new concepto_pension_cca();
        if ($_POST['idconcepto'] == '') {
            $p = $obj->insert($_POST);
            if ($p[0]) {
                header('Location:index.php?controller=comision_cca');
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
        $obj = new concepto_pension_cca();
        $p = $obj->delete($_GET['id']);
        if ($p[0]) {
            header('Location:index.php?controller=comision_cca');
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
        $data = array();
        $view = new View();
        //$data['comision'] = $this->Select(array('id' => 'idcomision', 'name' => 'idcomision', 'table' => 'comision_cca', 'code' => $obj->idcomision));
        //$data['descripcion'] = $this->Select(array('id' => 'idrequisito', 'name' => 'idrequisito', 'table' => 'requisitos_cca', 'code' => $obj->idrequisito));
        $view->setData($data);
        $view->setTemplate('../view/concepto_pension_cca/_Form.php');
        $view->setLayout('../template/Layout.php');
        $view->render();
    }

}
?>