<?php
require_once '../lib/Controller.php';
require_once '../lib/View.php';
require_once '../model/clase_cca.php';
require_once '../model/asistencia_cca.php';
require_once '../model/evaluacion_cca.php';
class control_academico_ccaController extends Controller {    
    public function index() 
    { 
        $view = new View();
        $view->setTemplate( '../view/control_asistencia_cca/_Index.php' );
        $view->setLayout( '../template/Layout.php' );   
        $view->render();
    }
    
    public function clase_asistencia()
    {
        $data = array();  
        $view = new View();
        $data['asignaturas'] = $this->SelectAsig(array('id'=>'idasignatura','name'=>'idasignatura','table'=>'asignatura_cca','code'=>$obj->idasignatura,'idp'=>$_SESSION['idusuario']));
        $view->setData($data);
        $view->setTemplate( '../view/control_asistencia_cca/_Clase.php' );
        $view->setLayout( '../template/Layout.php' );   
        $view->render();
    }
    
    public function save()
    {
        $obj = new clase_cca();
        $p = $obj->insert($_POST);
        if ($p[0]){
            header('Location: index.php?controller=control_academico_cca&action=asistencia');
        } else {
            $data = array();
            $view = new View();
            $data['msg'] = $p[1];
            $data['url'] =  'index.php?controller=control_academico_cca&action=clase_asistencia';
            $view->setData($data);
            $view->setTemplate( '../view/_Error_App.php' );
            $view->setLayout( '../template/Layout.php' );
            $view->render();
        }
    }
    
    public function save_asistencia()
    {
        $obj = new asistencia_cca();
        $p = $obj->insert($_POST);
        if ($p[0]){
            header('Location: index.php?controller=control_academico_cca');
        } else {
            $data = array();
            $view = new View();
            $data['msg'] = $p[1];
            $data['url'] =  'index.php?controller=control_academico_cca&action=clase_asistencia';
            $view->setData($data);
            $view->setTemplate( '../view/_Error_App.php' );
            $view->setLayout( '../template/Layout.php' );
            $view->render();
        }
    }
    
    public function save_evaluacion()
    {
        $obj = new evaluacion_cca();
        $p = $obj->insert($_POST);
        if ($p[0]){
            header('Location: index.php?controller=control_academico_cca');
        } else {
            $data = array();
            $view = new View();
            $data['msg'] = $p[1];
            $data['url'] =  'index.php?controller=control_academico_cca';
            $view->setData($data);
            $view->setTemplate( '../view/_Error_App.php' );
            $view->setLayout( '../template/Layout.php' );
            $view->render();
        }
    }

    public function asistencia()
    {
        $obj = new clase_cca();
        $data = array();
        $view = new View();
        $idmax = $obj->idmax();
        $data['clase'] = $obj->clase($idmax);
        $data['alumnos'] = $obj->alumnos();
        $view->setData($data);
        $view->setTemplate( '../view/control_asistencia_cca/_Asistencia.php' );
        $view->setLayout( '../template/Layout.php' );   
        $view->render();
    }
    
    public function evaluacion()
    {
        $obj = new clase_cca();
        $data = array();
        $view = new View();
        $idmax = $obj->idmax();
        $data['tipo_evaluacion'] = $this->SelectTipoEva(array('id' => 'idtipo_evaluacion', 'name' => 'idtipo_evaluacion', 'table' => 'tipo_evaluacion_cca', 'code' => $obj->idtipo_evaluacion));
        $data['clase'] = $obj->clase($idmax);
        $data['alumnos'] = $obj->alumnos();
        $view->setData($data);
        $view->setTemplate( '../view/control_asistencia_cca/_Evaluacion.php' );
        $view->setLayout( '../template/Layout.php' );   
        $view->render();
    }
}