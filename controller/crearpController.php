<?php

require_once '../lib/Controller.php';
require_once '../lib/View.php';
require_once '../model/ubigeos.php';
require_once '../model/alumno.php';

class crearpController extends Controller {

    public function index() {
        
        if (!isset($_GET['p'])) {
            $_GET['p'] = 1;
        }
        if (!isset($_GET['q'])) {
            $_GET['q'] = "";
        }
        if (!isset($_GET['criterio'])) {
            $_GET['criterio'] = "alumnos.NombreAlumno";
        }

//        $obj = new alumno();
//        $data = array();
//        $data['data'] = $obj->index($_GET['q'], $_GET['p'], $_GET['criterio']);
//        $data['query'] = $_GET['q'];
//        $data['pag'] = $this->Pagination(array('rows' => $data['data']['rowspag'], 'url' => 'index.php?controller=alumno&action=index', 'query' => $_GET['q']));
//        $cols = array("CODIGO", "Nombre", "Apellidos", "Documentos", "Fecha Ingreso", "CodAlumnoSira");
//
//        $opt = array("NombreAlumno" => "Nombre Alumno", "CodAlumnoSira" => "Codigo Sira ");
//
//        $data['grilla'] = $this->grilla("alumno", $cols, $data['data']['rows'], $opt, $data['pag'], true, true);
        
      
        $view = new View();
//        $view->setData($data);
        $view->setTemplate('../view/crearp/_Index.php');
        $view->setLayout('../template/Layout.php');
        $view->render();
    }
}

?>