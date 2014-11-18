<?php
include_once("../lib/dbfactory.php");
class asignatura_cca extends Main{    
//    function index($query,$p,$c) 
//    {
//            $sql = "    SELECT
//                asignatura_cca.idasignatura,
//                asignatura_cca.descripcion,
//                asignatura_cca.creditaje,
//                concat(docente_cca.nombres,' ',docente_cca.apellidop,' ',docente_cca.apellidom) as docente,
//                comision_cca.comision
//                
//
//                FROM
//                comision_cca
//                INNER JOIN asignatura_cca ON comision_cca.idcomision = asignatura_cca.idcomision
//                INNER JOIN docente_cca ON docente_cca.iddocente = asignatura_cca.iddocente 
//                where comision_cca.idcomision =$cod";//".$c." like :query";
//              
//        $param = array(array('key'=>':query' , 'value'=>"%$query%" , 'type'=>'STR' ));
//        $data['total'] = $this->getTotal( $sql, $param );
//        $data['rows'] =  $this->getRow($sql, $param , $p );        
//        $data['rowspag'] = $this->getRowPag($data['total'], $p );        
//        return $data;
//    }
    
    function edit($id ) 
    {
        $stmt = $this->db->prepare("SELECT * FROM asignatura_cca WHERE idasignatura = :id");
        $stmt->bindValue(':id', $id , PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchObject();
    }
    function insert($_P ) {
//        $sentencia=$this->db->query("SELECT MAX(idasignatura) as cant from asignatura_cca");         
//        $ct=$sentencia->fetch();      
//        $xd=1+(int)$ct['cant'];
//               
        $sql = $this->Query("sp_asignatura_iu_cca(0,:p1,:p2,:p3,:p4,:p5)");
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':p1', '' , PDO::PARAM_INT);
        $stmt->bindValue(':p2', $_P['idcomision'] , PDO::PARAM_INT);
        $stmt->bindValue(':p3', $_P['iddocente'] , PDO::PARAM_STR);
        $stmt->bindValue(':p4', $_P['descripcion'] , PDO::PARAM_STR);
        $stmt->bindValue(':p5', $_P['creditaje'] , PDO::PARAM_STR);
             
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
    function update($_P ) {
        
        $sql = $this->Query("sp_asignatura_iu_cca(1,:p1,:p2,:p3,:p4,:p5)");
        $stmt = $this->db->prepare($sql);
        if($_P['idpadre']==""){$_P['idpadre']=null;}  
        $stmt->bindValue(':p1', $_P['idasignatura'] , PDO::PARAM_INT);
        $stmt->bindValue(':p2', $_P['idcomision'] , PDO::PARAM_INT);
        $stmt->bindValue(':p3', $_P['iddocente'] , PDO::PARAM_INT);
        $stmt->bindValue(':p4', $_P['descripcion'] , PDO::PARAM_STR);
        $stmt->bindValue(':p5', $_P['creditaje'] , PDO::PARAM_STR);
     
        
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
    function delete($p) {
        $stmt = $this->db->prepare("DELETE FROM asignatura_cca WHERE idasignatura = $p");
        $stmt->bindValue(':p1', $p, PDO::PARAM_INT);
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
}
?>
