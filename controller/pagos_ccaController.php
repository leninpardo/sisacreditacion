<?php
require_once '../lib/Controller.php';
require_once '../lib/View.php';
require_once '../model/pagos_cca.php';
require_once '../model/matricula_cca.php';

class pagos_ccaController extends Controller {

    public function index() {
        
        if (!isset($_GET['p'])) {$_GET['p'] = 1;}
        if (!isset($_GET['q'])) {$_GET['q'] = "";}
        if (!isset($_GET['criterio'])) {$_GET['criterio'] = "alumno_cca.nombres";}
        $obj = new matricula_cca();
        $data = array();
   
        $data['idalumno']=$_GET['idalumno'];
        $data['nombre']=$_GET['nombre'];

        $a=$obj->comision_actual();
        foreach ($a as $vl){
            $idc=$vl[0];
            
        }
        
        
        $data['comision']=$a;
//        var_dump($data['comision']);
//        exit();
         $obj2 = new pagos_cca();
        $data['montocomi']=$obj2->monto_comision($idc);
        
//        
//        var_dump($data['montocomi']);
//        exit();
   
        $view = new View();
        $view->setData($data);
     
////        if(isset($_GET['a']))
////            {
////        $view->setTemplate('../view/cronograma_cca/_Form.php');
////        $view->setLayout('../template/List.php');
////        return $view->render();    
////            }
////        else{
            $view->setTemplate('../view/pagos_cca/_Form.php');
        $view->setLayout('../template/Layout.php');
         $view->render();
//        }
        
    }
    public  function insertar_pagos($_G){
        $monto=$_GET['monto'];
        $fecha_p=$_GET['fecha_p'];
        $alumno=$_GET['alumno'];
        $fecha_r=$_GET['fecha_r'];
        $voucher=$_GET['voucher'];
        $idusuario=$_GET['idusuario'];

//        var_dump($_GET['fechacrono']);
        
      
      
        
         
         $obj = new pagos_cca();
       $p = $obj->insert($_GET);
            if ($p[0]) {
                header('Location:index.php?controller=pagos_cca');
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
?>