<?php
require_once '../lib/Controller.php';
require_once '../lib/View.php';
require_once '../model/matricula_cca.php';
require_once '../model/cronograma_cca.php';
class matricula_ccaController extends Controller {    
    public function index() 
    {
        if (!isset($_GET['p'])){$_GET['p']=1;}
        if(!isset($_GET['q'])){$_GET['q']="";}        
        if(!isset($_GET['criterio'])){$_GET['criterio']="matricula_cca.idmatricula";}
        $obj = new matricula_cca();
        $data = array();    
        $comision_actual=$obj->comision_actual();
//        var_dump($comision_actual);
//        exit();
//        var_dump($comision_actual);
//        exit();
        
//        $data['query'] = $_GET['q'];
//        $data['pag'] = $this->Pagination(array('rows'=>$data['data']['rowspag'],'url'=>'index.php?controller=matricula_cca&action=index','query'=>$_GET['q']));                
//        $cols = array("id","alumno","comision","proyecto","fecha");        
//        $opt = array("matricula_cca.nombre_proyecto"=>"matricula");
//        $data['grilla'] = $this->grilla_comision_cca("matricula_cca",$cols, $data['data']['rows'],$opt,$data['pag'],true,false,true,true);
        $a=$obj->comision_actual();
        foreach ($a as $vl){
            $idc=$vl[0];
            
        }
        
        $data['comision']=$comision_actual;
       
        //$data['alumno'] = $this->Select(array('id'=>'idalumno','name'=>'idalumno','table'=>'vista_alumno_cca','code'=>$obj->idalumno));
//        $data['comision'] = $this->Select(array('id'=>'idcomision','name'=>'idcomision','table'=>'comision_cca','code'=>$obj->idcomision));
        
        $obj2 = new cronograma_cca();
        $data['montocomi']=$obj2->monto_comision($idc);
      
        
        $view = new View();
        $view->setData($data);
        $view->setTemplate( '../view/matricula_cca/_Form.php' );
        $view->setLayout( '../template/Layout.php' );   
        $view->render();
    }
    
    public function edit() {
        $obj = new matricula_cca();
        $data = array();
        $view = new View();
        $obj = $obj->edit($_GET['id']);
        $data['obj'] = $obj;
        //$data['nomalumno'] = $this->Select(array('id'=>'idalumno','name'=>'nombres','table'=>'vista_alumno_cca','code'=>$obj->idalumno));
        //$data['comision'] = $this->Select(array('id'=>'idcomision','name'=>'idcomision','table'=>'comision_cca','code'=>$obj->idcomision));
        $view->setData($data);
        $view->setTemplate( '../view/matricula_cca/_Form.php' );
        $view->setLayout( '../template/Layout.php' );
        $view->render();
    }
    public function save(){
        $obj = new matricula_cca();
        if ($_POST['idmatricula']=='') {
          
            $p = $obj->insert($_POST);
            
            if ($p[0]){
                header('Location: index.php?controller=matricula_cca');
            } else {
            $data = array();
            $view = new View();
            $data['msg'] = $p[1];
            $data['url'] ='index.php?controller=matricula_cca';
            $view->setData($data);
            $view->setTemplate( '../view/_Error_App.php' );
            $view->setLayout( '../template/Layout.php' );
            $view->render();
            }
        } else {
            $p = $obj->update($_POST);
            if ($p[0]){
                header('Location: index.php?controller=matricula_cca');
            } else {
            $data = array();
            $view = new View();
            $data['msg'] = $p[1];
            $data['url'] = 'index.php?controller=matricula_cca';
            $view->setData($data);
            $view->setTemplate( '../view/_Error_App.php' );
            $view->setLayout( '../template/Layout.php' );
            $view->render();
            }
        }
    }
    public function delete(){
        $obj = new matricula_cca();
        $p = $obj->delete($_GET['id']);
        if ($p[0]){
            header('Location: index.php?controller=matricula_cca&action=lista_matriculados');
        } else {
        $data = array();
        $view = new View();
        $data['msg'] = $p[1];
        $data['url'] =  'index.php?controller=matricula_cca&action=lista_matriculados';
        $view->setData($data);
        $view->setTemplate( '../view/_Error_App.php' );
        $view->setLayout( '../template/Layout.php' );
        $view->render();
        }
    }
    
    /*public function create() {
        $data = array();
        $view = new View();
        $obj= new matricula_cca();
        //$data['alumno'] = $this->Select(array('id'=>'idalumno','name'=>'idalumno','table'=>'alumno_cca','code'=>$obj->idalumno));
//        $data['comision'] = $this->Select(array('id'=>'idcomision','name'=>'idcomision','table'=>'comision_cca','code'=>$obj->idcomision));
        
        $comision_actual=$obj->comision_actual();
        $data['comision'] =$comision_actual; 
        $view->setData($data);
        $view->setTemplate( '../view/matricula_cca/_Form.php' );
        $view->setLayout( '../template/Layout.php' );
        $view->render();
    }*/
    
    public function lista_matriculados() {
        if (!isset($_GET['p'])) {
            $_GET['p'] = 1;
        }
        if (!isset($_GET['q'])) {
            $_GET['q'] = "";
        }
        if (!isset($_GET['criterio'])) {
            $_GET['criterio'] = "matricula_cca.idmatricula";
        }
 if(isset($_GET['a'])){
        $obj = new matricula_cca();
        $data = array();
        $data['data'] = $obj->lista_mat($_GET['q'], $_GET['p'], $_GET['criterio']);
        $data['query'] = $_GET['q'];
        $data['pag'] = $this->Pagination(array('rows' => $data['data']['rowspag'], 'url' => 'index.php?controller=matricula_cca&action=lista_matriculados&a=b', 'query' => $_GET['q']));
        $cols = array("Id", "alumno", "comision", "proyecto", "Fecha");

        $opt = array("dni" => "DNI");
            
                 $data['grilla_cca'] = $this->grilla_cca("matricula_cca",NULL,NULL, $cols, $data['data']['rows'], $opt, $data['pag'], false,true, false, false, false,false,false);
                 
             }else{
                  $obj = new matricula_cca();
        $data = array();
        $data['data'] = $obj->lista_mat($_GET['q'], $_GET['p'], $_GET['criterio']);
        $data['query'] = $_GET['q'];
        $data['pag'] = $this->Pagination(array('rows' => $data['data']['rowspag'], 'url' => 'index.php?controller=matricula_cca&action=lista_matriculados', 'query' => $_GET['q']));
        $cols = array("Id", "alumno", "comision", "proyecto", "Fecha");

        $opt = array("dni" => "DNI");
                 $data['grilla_cca'] = $this->grilla_cca("matricula_cca",NULL,NULL, $cols, $data['data']['rows'], $opt, $data['pag'], false, false, false, false, true);
                 
             }   
        
        
        $view = new View();
        $view->setData($data);
        $view->setTemplate('../view/matricula_cca/_Index.php');
        $view->setLayout('../template/List.php');
        $view->render();
    }
    
    
}
?>