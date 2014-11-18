<?php
include_once("../lib/dbfactory.php");
class tipo_evaluacion_cca extends Main{ 
    function index($query,$p,$c) {        
        $sql = "select t.idtipo_evaluacion,
                       t.descripcion,
                       CONCAT(d.nombres,' ',d.apellidop,' ',d.apellidom) as docente,
                       t.ponderado
                from tipo_evaluacion_cca as t inner join docente_cca as d on t.iddocente=d.iddocente
                where ".$c." like :query"; 
        
        $param = array(array('key'=>':query' , 'value'=>"%$query%" , 'type'=>'STR' ));
        $data['total'] = $this->getTotal( $sql, $param );
        $data['rows'] =  $this->getRow($sql, $param , $p );        
        $data['rowspag'] =  $this->getRowPag($data['total'], $p );        
        return $data;
    }     
    function insert($_P ) {
        $sentencia=$this->db->query("SELECT MAX(idtipo_evaluacion) as ide from tipo_evaluacion_cca");         
        $ct=$sentencia->fetch();
        $xd=1+(int)$ct['idte'];
        $stmt = $this->db->prepare("INSERT INTO tipo_evaluacion_cca SET idtipo_evaluacion=:idte, iddocente=:idd, descripcion=:d, ponderado=:p");
        $stmt->bindValue(':idte', $xd, PDO::PARAM_INT);
        $stmt->bindValue(':idd', $_SESSION['idusuario'] , PDO::PARAM_INT);
        $stmt->bindValue(':d', $_P['descripcion'] , PDO::PARAM_STR);        
        $stmt->bindValue(':p', $_P['ponderado'] , PDO::PARAM_STR);
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }   
    function update($_P ) {
        $stmt = $this->db->prepare("UPDATE tipo_evaluacion_cca SET descripcion=:d, ponderado=:p WHERE idtipo_evaluacion=:idte");
        $stmt->bindValue(':idte', $_P['idtipo_evaluacion'], PDO::PARAM_INT);
        $stmt->bindValue(':d', $_P['descripcion'] , PDO::PARAM_STR);        
        $stmt->bindValue(':p', $_P['ponderado'] , PDO::PARAM_STR);
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    } 
    function edit($id ) {
        $stmt = $this->db->prepare("SELECT * FROM tipo_evaluacion_cca WHERE idtipo_evaluacion = :id");
        $stmt->bindValue(':id', $id , PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchObject();
    }
    function delete($p) {
        $stmt = $this->db->prepare("DELETE FROM tipo_evaluacion_cca WHERE idtipo_evaluacion = :p1");
        $stmt->bindValue(':p1', $p, PDO::PARAM_INT);
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
}