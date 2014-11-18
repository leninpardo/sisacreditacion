<?php
require_once '../lib/Controller.php';
require_once '../lib/View.php';
require_once '../model/eventoT.php';

class eventoTController extends Controller {    
    public function index() 
    {
        if (!isset($_GET['p'])){$_GET['p']=1;}
        if(!isset($_GET['q'])){$_GET['q']="";}        
        if(!isset($_GET['criterio'])){$_GET['criterio']="evento.tema";}
        $obj = new eventoT();
        $data = array();  
        $semestre_ultimo = $this->mostrar_semestre_ultimo();
         if($_SESSION['cargo']=='Presidente' && $_SESSION['comicion']=='COMISION ESPECIAL DE TUTORIA'){$presidente=true;}
        $data['data'] = $obj->index($_GET['q'],$_GET['p'],$_GET['criterio'],$semestre_ultimo,$_SESSION['idusuario']);
        $data['query'] = $_GET['q'];
      
        $cols = array("CODIGO","Tema","Tipo Evento","Fecha","Hora");        
        $opt = array("evento.Tema"=>"Tema","evento.fecha"=>"Fecha ","evento.hora"=>"Hora");
        
        $data['grilla'] = $this->grilla("eventoT",$cols, $data['data']['rows'],$opt,$data['pag'],FALSE,FALSE,false,false,false,false,$presidente);
        $view = new View();
        $view->setData($data);
        $view->setTemplate( '../view/eventoT/_Index.php' );
        $view->setLayout( '../template/Layout.php' );
        $view->render();
    }
    
  
   
 
    
}