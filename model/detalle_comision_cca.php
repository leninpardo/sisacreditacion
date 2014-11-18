<?php
include_once("../lib/dbfactory.php");

class detalle_comision_cca extends Main{
//    function index($query,$p,$c) 
//    {
//        $cod=$_POST['id'];
//            $sql = "    SELECT
//                        detalle_comision_cca.iddetalle_comision,
//                        comision_cca.comision,
//                      detalle_comision_cca.idcomision,
//                        detalle_comision_cca.iddocente,
//                        detalle_comision_cca.cargo_comision,
//                     
//                        docente_cca.nombres
//                       
//                        FROM
//                        comision_cca 
//                        INNER JOIN detalle_comision_cca ON comision_cca.idcomision = detalle_comision_cca.idcomision 
//                        INNER JOIN  DOCENTE_CCA ON docente_cca.iddocente = detalle_comision_cca.iddocente 
//                         WHERE
//                        comision_cca.idcomision =$cod";//.$c." like :query";
//            
//           
//              
//        $param = array(array('key'=>':query' , 'value'=>"%$query%" , 'type'=>'STR' ));
//        $data['total'] = $this->getTotal( $sql, $param );
//        $data['rows'] =  $this->getRow($sql, $param , $p );        
//        $data['rowspag'] = $this->getRowPag($data['total'], $p );        
//        return $data;
//    }
    
    function edit($id ) 
    {
        $stmt = $this->db->prepare("SELECT * FROM detalle_comision_cca WHERE iddetalle_comision = :id");
        $stmt->bindValue(':id', $id , PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchObject();
    }
    function insert($_P ) {
//        $sentencia=$this->db->query("SELECT MAX(iddetalle_comision) as cant from detalle_comision_cca");         
//        $ct=$sentencia->fetch();      
//        $xd=1+(int)$ct['cant'];      
        $sql = $this->Query("sp_detalle_comision_iu_cca(0,:p1,:p2,:p3,:p4)");
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':p1', '' , PDO::PARAM_INT);
        $stmt->bindValue(':p2', $_P['idcomision'] , PDO::PARAM_INT);
        $stmt->bindValue(':p3', $_P['iddocente'] , PDO::PARAM_INT);
        $stmt->bindValue(':p4', $_P['idcargocomision'] , PDO::PARAM_STR);
        
        
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
    function update($_P ) {
        
        $sql = $this->Query("sp_detalle_comision_iu_cca(1,:p1,:p2,:p3,:p4)");
        $stmt = $this->db->prepare($sql);
        if($_P['idpadre']==""){$_P['idpadre']=null;}
        $stmt->bindValue(':p1', $_P['iddetalle_comision'] , PDO::PARAM_INT);
        $stmt->bindValue(':p2', $_P['idcomision'] , PDO::PARAM_INT);
        $stmt->bindValue(':p3', $_P['iddocente'] , PDO::PARAM_INT);
        $stmt->bindValue(':p4', $_P['idcargocomision'] , PDO::PARAM_STR);
        
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
    function delete($p) {
        $stmt = $this->db->prepare("DELETE FROM detalle_comision_cca WHERE iddetalle_comision = :p1");
        $stmt->bindValue(':p1', $p, PDO::PARAM_INT);
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
}
?>
