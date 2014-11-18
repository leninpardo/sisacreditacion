<?php
require_once '../lib/Controller.php';
require_once '../lib/View.php';
require_once '../model/asistenciaseventoEU.php';

class asistenciaseventoEUController extends Controller {

    public function index() {
        if (!isset($_GET['p'])) {
            $_GET['p'] = 1;
        }
        if (!isset($_GET['q'])) {
            $_GET['q'] = "";
        }
        if (!isset($_GET['criterio'])) {
            $_GET['criterio'] = "evento.tema";
        }
        $obj = new asistenciaseventoEU();
        $semestre_ultimo = $this->mostrar_semestre_ultimo();
        $data = array();
        $data['data'] = $obj->index($_GET['q'], $_GET['p'], $_GET['criterio'], $semestre_ultimo, $_SESSION['idusuario']);
        $data['query'] = $_GET['q'];
        $data['pag'] = $this->Pagination2(array('rows' => $data['data']['rowspag'], 'url' => 'index.php?controller=asistenciaseventoEU&action=index', 'query' => $_GET['q']));
        $cols = array("CODIGO", "TEMA EVENTO","TEMA SUB EVENTO", "TIPO EVENTO", "Fecha");

        $data['grilla'] = $this->grilla("asistenciaalumnoPS", $cols, $data['data']['rows'], $opt, $data['pag'], false, false, false, false, true);


        $view = new View();
        $view->setData($data);
        $view->setTemplate('../view/asistenciaseventoEU/_Index.php');
        $view->setLayout('../template/Layout.php');
        $view->render();
    }
    public function lista_sub_evento() {
        $obj = new asistenciaseventoEU();
        $data = array();
        $data['sub_evento'] = $obj->sub_evento($_REQUEST['idevento']);
        $view = new View();
        $view->setData($data);
        $view->setTemplate('../view/asistenciaseventoEU/lista_sub_evento.php');
        echo $view->renderPartial();
    }

    public function asistenciaEU(){
        $obj=new asistenciaseventoEU();
        $data=array();
        $data['lis_doce']=$obj->mostar_lista_eu_docente($_REQUEST['idevento']);
         $data['lis_alum']=$obj->mostar_lista_eu_alumnos($_REQUEST['idevento']);
          $data['lis_exter']=$obj->mostar_lista_eu_externo($_REQUEST['idevento']);
          $data['idevento_sub']=$_REQUEST['idevento'];
        $view = new View();
         $view->setData($data);
         $view->setTemplate('../view/asistenciaseventoEU/tomar_asistencia_eventoEU.php');
          echo $view->renderPartial();
    }
        
public function save_asistencias_externos(){
        $obj = new asistenciaseventoEU();      
            $p = $obj->update_externos($_POST);
            if ($p[0]){
                header('Location: index.php?controller=asistenciaseventoEU');
            } else {
            $data = array();
            $view = new View();
            $data['msg'] = $p[1];
            $data['url'] =  'index.php?controller=asistenciaseventoEU';
            $view->setData($data);
            $view->setTemplate( '../view/_Error_App.php' );
            $view->setLayout( '../template/Layout.php' );
            $view->render();
            }
        
    }
    public function save_asistencias_alumnos(){
        $obj = new asistenciaseventoEU();      
            $pa = $obj->update_alumnos($_POST);
            if ($pa[0]){
                header('Location: index.php?controller=asistenciaseventoEU');
            } else {
            $data = array();
            $view = new View();
            $data['msg'] = $pa[1];
            $data['url'] =  'index.php?controller=asistenciaseventoEU';
            $view->setData($data);
            $view->setTemplate( '../view/_Error_App.php' );
            $view->setLayout( '../template/Layout.php' );
            $view->render();
            }
        
    }
         public function save_asistencias_docentes(){
//     echo 'hola';
//print_r($_POST);exit;
        $obj = new asistenciaseventoEU();      
            $pd = $obj->update_docentes($_POST);
            if ($pd[0]){
                header('Location: index.php?controller=asistenciaseventoEU');
            } else {
            $data = array();
            $view = new View();
            $data['msg'] = $pd[1];
            $data['url'] =  'index.php?controller=asistenciaseventoEU';
            $view->setData($data);
            $view->setTemplate( '../view/_Error_App.php' );
            $view->setLayout( '../template/Layout.php' );
            $view->render();
            }
        
    }
}

?>