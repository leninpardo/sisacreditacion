<?php
require_once '../lib/Controller.php';
require_once '../lib/View.php';
require_once '../model/concepto_cca.php';
require_once '../model/matricula_cca.php';
class concepto_ccaController extends Controller {    
    public function index() 
    {
        $obj = new concepto_cca();
        $idc=$obj->comision_actual();
        foreach ($idc as $v1){
            $idcomic=$v1[0];
        }
        if (!isset($_GET['p'])){$_GET['p']=1;}
        if(!isset($_GET['q'])){$_GET['q']=$idcomic;}        
        if(!isset($_GET['criterio'])){$_GET['criterio']="concepto_pension_cca.idcomision";}
        
        
        $data = array();    
         $data['query'] =$idcomic;
        $data['data'] = $obj->index($_GET['q'],$_GET['p'],$_GET['criterio']);
       
        $data['pag'] = $this->Pagination(array('rows'=>$data['data']['rowspag'],'url'=>'index.php?controller=concepto_cca&action=index','query'=>$_GET['q']));                
            $cols = array("Id","Descripcion", "MONTO","COMISION");        
        $opt = array("concep_cca.comision"=>"Comision");
        $data['lista'] = $this->grilla_cca("concepto_cca",NULL, NULL,$cols, $data['data']['rows'],$opt,$data['pag'],false, false,true,true,false,true,true);
    

        
        $view = new View();
        $view->setData($data);
        $view->setTemplate( '../view/concepto_cca/_Index.php' );
        $view->setLayout( '../template/Layout.php' );   
        $view->render();
    }
    
    public function datos_Comision(){
        $id=$_GET['id'];
        $nombrecomi=$_GET['nombrecomi'];
        
//        die ($id);
        if (!isset($_GET['p'])){$_GET['p']=1;}
        if(!isset($_GET['q'])){$_GET['q']=$id;}        
        if(!isset($_GET['criterio'])){$_GET['criterio']="idcomision";}
        $obj = new comision_cca();
        $data = array();             
        $data['data'] = $obj->index($_GET['q'],$_GET['p'],$_GET['criterio']);
//        var_dump($data['data']);
//        exit();
        $data['query'] = $_GET['q'];
        
        $data['pag'] = $this->Pagination(array('rows'=>$data['data']['rowspag'],'url'=>'index.php?controller=comision_cca&action=index','query'=>$_GET['q']));                
        $cols = array("Id","Comision", "Descripcion","Fecha Inicio","Fecha Termino");        
        $opt = array("comision_cca.comision"=>"Comision");
        $data['lista'] = $this->lista_cca("comision_cca",NULL, NULL,$cols, $data['data']['rows'],$opt,$data['pag'],false, false,true,true,false,false,true);

        $view = new View();
        $view->setData($data);
        $view->setTemplate( '../view/comision_cca/_Lista.php' );
        $view->setLayout( '../template/Layout.php' );   
        $view->render();
        
    }


    public function edit() {
        $obj = new concepto_cca();
        $data = array();
        $view = new View();
        $obj = $obj->edit($_GET['id']);
        $data['obj'] = $obj;
        $view->setData($data);
        $view->setTemplate( '../view/concepto_cca/_Form.php' );
        $view->setLayout( '../template/Layout.php' );
        $view->render();
    }
    
    public function save(){
  
        $obj = new concepto_cca();
        if ($_POST['idconcepto']=='') {
            
            $p = $obj->insert($_POST);
            if ($p[0]){
                header("Location: index.php?controller=comision_cca&action=datos_Comision&id=".$_POST['idcomision']."");
            } else {
            $data = array();
            $view = new View();
            $data['msg'] = $p[1];
            $data['url'] ='index.php?controller=concepto_cca';
            $view->setData($data);
            $view->setTemplate( '../view/_Error_App.php' );
            $view->setLayout( '../template/Layout.php' );
            $view->render();
            }
        } else {
            $p = $obj->update($_POST);
            if ($p[0]){
                header('Location: index.php?controller=concepto_cca');
            } else {
            $data = array();
            $view = new View();
            $data['msg'] = $p[1];
            $data['url'] = 'index.php?controller=concepto_cca';
            $view->setData($data);
            $view->setTemplate( '../view/_Error_App.php' );
            $view->setLayout( '../template/Layout.php' );
            $view->render();
            }
        }
    }
    public function delete(){
//        echo($_GET["id"]);
//                exit();
        $obj = new concepto_cca();
        $p = $obj->delete($_GET['id']);
        if ($p[0]){
             header("Location:index.php?controller=comision_cca&action=datos_Comision&id=".$_GET["idcomi"]."");
        } else {
        $data = array();
        $view = new View();
        $data['msg'] = $p[1];
        $data['url'] =  'index.php?controller=concepto_cca';
        $view->setData($data);
        $view->setTemplate( '../view/_Error_App.php' );
        $view->setLayout( '../template/Layout.php' );
        $view->render();
        }
    }
    public function create($a) {
         $b=$_POST['a'];
         $data = array();
         $obj = new matricula_cca();
        $data['comision']=$obj->comision_actual();
        
        
        
        if(isset($b)){
            $data["a"]=$b;
             $view = new View();
        $view->setData($data);
            $view->setTemplate( '../view/concepto_cca/_Form.php');
           $view->setLayout( '../template/List.php' );
       return $view->render();  
        }else{
             $view = new View();
        $view->setData($data);
            $view->setTemplate( '../view/concepto_cca/_Form.php' );
        $view->setLayout( '../template/Layout.php' );
        $view->render();}
    }
//       public function create2($a) {
//       
//       $b=$_POST['a'];
//       
//        $data = array();
//        $view = new View();
//        $view->setData($data);
//        $view->setTemplate( '../view/comision_cca/_Form.php' );
//        $view->setLayout( '../template/List.php' );
//       return $view->render();
//    }
    
//    public function Mostrar_miembros($get){
//        $id=$_GET['id'];
//        $obj= new comision_cca;
//  
//        $data = $obj->lista_miembros($id);
//        echo $data;
//    }
//    
//    public function Mostrar_asignaturas($get){
//        $id=$_GET['id'];
//        $obj= new comision_cca;
//  
//        $data = $obj->lista_asignaturas($id);
//        echo $data;
//    }
    
}
?>