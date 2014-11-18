<?php
require_once '../lib/Controller.php';
require_once '../lib/View.php';
require_once '../model/cargo_cca.php';

class cargo_ccaController extends Controller {    
    public function index() 
    {
        if (!isset($_GET['p'])){$_GET['p']=1;}
        if(!isset($_GET['q'])){$_GET['q']="";}        
        if(!isset($_GET['criterio'])){$_GET['criterio']="cargo_cca.descripcion";}
        $obj = new cargo_cca();
        $data = array();             
        $data['data'] = $obj->index($_GET['q'],$_GET['p'],$_GET['criterio']);
        $data['query'] = $_GET['q'];
        $data['pag'] = $this->Pagination(array('rows'=>$data['data']['rowspag'],'url'=>'index.php?controller=cargo_cca&action=index','query'=>$_GET['q']));                
        $cols = array("CODIGO","DESCRIPCION");               
        
        $opt = array("cargo_cca.descripcion"=>"Nombre Cargo");
        $data['grilla_cca'] = $this->grilla_cca("cargo_cca",$cols, $data['data']['rows'],$opt,$data['pag'],true,true);
        $view = new View();
        $view->setData($data);
        $view->setTemplate( '../view/cargo_cca/_Index.php' );
        $view->setLayout( '../template/Layout.php' );
        $view->render();
    }
    
    public function edit() {
        $obj = new cargo_cca();
        $data = array();
        $view = new View();
        $obj = $obj->edit($_GET['id']);
        $data['obj'] = $obj;
        $view->setData($data);
        $view->setTemplate( '../view/cargo_cca/_Form.php' );
        $view->setLayout( '../template/Vacia.php' );
        $view->render();
    }
    public function save(){
        $obj = new cargo_cca();
        if ($_POST['idcargo']=='') {
            $p = $obj->insert($_POST);
            if ($p[0]){
                header('Location: index.php?controller=cargo_cca');
            } else {
            $data = array();
            $view = new View();
            $data['msg'] = $p[1];
            $data['url'] =  'index.php?controller=cargo_cca';
            $view->setData($data);
            $view->setTemplate( '../view/_Error_App.php' );
            $view->setLayout( '../template/Layout.php' );
            $view->render();
            }
        } else {
            $p = $obj->update($_POST);
            if ($p[0]){
                header('Location: index.php?controller=cargo_cca');
            } else {
            $data = array();
            $view = new View();
            $data['msg'] = $p[1];
            $data['url'] =  'index.php?controller=cargo_cca';
            $view->setData($data);
            $view->setTemplate( '../view/_Error_App.php' );
            $view->setLayout( '../template/Layout.php' );
            $view->render();
            }
        }
    }
    public function delete(){
        $obj = new cargo_cca();
        $p = $obj->delete($_GET['id']);
        if ($p[0]){
            header('Location: index.php?controller=cargo_cca');
        } else {
        $data = array();
        $view = new View();
        $data['msg'] = $p[1];
        $data['url'] =  'index.php?controller=cargo_cca';
        $view->setData($data);
        $view->setTemplate( '../view/_Error_App.php' );
        $view->setLayout( '../template/Layout.php' );
        $view->render();
        }
    }
    public function create() {
        $data = array();
        $view = new View();
        $view->setData($data);
        $view->setTemplate( '../view/cargo_cca/_Form.php' );
        $view->setLayout( '../template/Vacia.php' );
        $view->render();
    }
   
}
?>
