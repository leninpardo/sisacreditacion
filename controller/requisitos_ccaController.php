<?php

require_once '../lib/Controller.php';
require_once '../lib/View.php';
require_once '../model/requisitos_cca.php';

class requisitos_ccaController extends Controller {

//    public function index() {
//        $cod=$_REQUEST['id'];
//        if (!isset($_GET['p'])) {$_GET['p'] = 1;}
//        if (!isset($_GET['q'])) {$_GET['q'] = "";}
//        if (!isset($_GET['criterio'])) {$_GET['criterio'] = "requisitos_cca.descripcion";}
//        $obj = new requisitos_cca();
//        $data = array();
//        $data['data'] = $obj->index($_GET['q'], $_GET['p'], $_GET['criterio']);
//        $data['query'] = $_GET['q'];
//        $data['pag'] = $this->Pagination(array('rows' => $data['data']['rowspag'], 'url' => 'index.php?controller=requisitos_cca&action=index', 'query' => $_GET['q']));
//        $cols = array("Id","Requisito", "Comision");
//        $opt = array("requisitos_cca.descripcion" => "Requisitos");
//        $data['grilla'] = $this->grilla_detcom_cca("requisitos_cca", $cod, $cols, $data['data']['rows'], $opt, $data['pag'], false, true);
//        
//        $view = new View();
//        $view->setData($data);
//        $view->setTemplate('../view/requisitos_cca/_Index.php');
//        $view->setLayout('../template/Layout.php');
//        $view->render();
//    }

   public function edit() {
       $obj = new requisitos_cca();
        $data = array();
        $view = new View();
        $obj = $obj->edit($_GET['id']);
        $data['obj'] = $obj;
        //$data['comision'] = $this->Select(array('id' => 'idcomision', 'name' => 'idcomision', 'table' => 'comision_cca', 'code' => $obj->idcomision));
        $view->setData($data);
        $view->setTemplate('../view/requisitos_cca/_Form.php');
        $view->setLayout('../template/Layout.php');
        $view->render();
    }

    public function save() {
        $obj = new requisitos_cca();
      
//            print "<pre>"; print_r($_POST["descripcion"]); print "</pre>\n"; exit();
                   $p = $obj->insert_estado($_POST);
            if ($p[0]) {
                header("Location:index.php?controller=recepcion_cca&action=lista_requisitos&id=".$_POST['idalumno']."");
            } else {
                $data = array();
                $view = new View();
                $data['msg'] = $p[1];
                $data['url'] = "index.php?controller=recepcion_cca&action=lista_requisitos&id=".$_POST['idalumno'];
                $view->setData($data);
                $view->setTemplate('../view/_Error_App.php');
                $view->setLayout('../template/Layout.php');
                $view->render();
            }
         
    }
    
    
    public function save2() {
        $obj = new requisitos_cca();
      
//            print "<pre>"; print_r($_POST["descripcion"]); print "</pre>\n"; exit();
                   $p = $obj->insert($_POST);
            if ($p[0]) {
                header("Location:index.php?controller=comision_cca&action=datos_Comision&id=".$_POST['idcomision']."");
            } else {
                $data = array();
                $view = new View();
                $data['msg'] = $p[1];
                $data['url'] = "index.php?controller=comision_cca&action=datos_Comision&id=".$_POST['idcomision'];
                $view->setData($data);
                $view->setTemplate('../view/_Error_App.php');
                $view->setLayout('../template/Layout.php');
                $view->render();
            }
         
    }
    
    

    public function delete() {
        $obj = new requisitos_cca();
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

    
    public function actualizar_estado(){
        $obj = new requisitos_cca();
        
//        var_dump($_GET["estados"]);

         
       
        $p = $obj->insert_estado($_GET);
            if ($p[0]) {
                header("Location:index.php?controller=comision_cca&action=datos_Comision&id=".$_POST['idcomision']."");
            }
        
    }

        public function create() {
       
        $data = array();
        $view = new View();
        $data['idcargocomision'] = $this->Select(array('id' => 'idcargocomision', 'name' => 'idcargocomision', 'table' => 'cargo_comision_cca', 'code' => $obj->idcargocomision));
        //$data['docente'] = $this->Select(array('id' => 'iddocente', 'name' => 'iddocente', 'table' => 'docente_cca', 'code' => $obj->iddocente));
        $data["idcomi"]=$_GET["idcomi"];
        
        $view->setData($data);

        

       
            $view->setTemplate('../view/requisitos_cca/_Form.php');
            $view->setLayout('../template/List.php');
            return $view->render();
      
        
    }

}
?>