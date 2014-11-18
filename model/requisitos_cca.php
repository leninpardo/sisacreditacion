<?php
include_once("../lib/dbfactory.php");
class requisitos_cca extends Main{    
//    function index($query,$p,$c) 
//    {        
//              $sql = "      SELECT
//                            requisitos_cca.idrequisito,
//                            requisitos_cca.descripcion,
//                            comision_cca.comision
//                            
//                            FROM
//                            requisitos_cca
//                            INNER JOIN comision_cca ON comision_cca.idcomision = requisitos_cca.idcomision 
//                            where ".$c."like :query";
//              
//        $param = array(array('key'=>':query' , 'value'=>"%$query%" , 'type'=>'STR' ));
//        $data['total'] = $this->getTotal( $sql, $param );
//        $data['rows'] =  $this->getRow($sql, $param , $p );        
//        $data['rowspag'] = $this->getRowPag($data['total'], $p );        
//        return $data;
//    }
    
    function edit($id ) 
    {
        $stmt = $this->db->prepare("SELECT * FROM requisitos_cca WHERE idrequisito = :id");
        $stmt->bindValue(':id', $id , PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchObject();
    }
    function insert($_P ) {
        $sentencia=$this->db->query("SELECT MAX(idrequisito) as cant from requisitos_cca");         
        $ct=$sentencia->fetch();      
        $xd=1+(int)$ct['cant'];
              
        $sql = $this->Query("sp_requisitos_iu_cca(0,:p1,:p2,:p3)");
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':p1', $xd , PDO::PARAM_INT);
        $stmt->bindValue(':p2', $_P['idcomision'] , PDO::PARAM_INT);
        $stmt->bindValue(':p3', $_P['descripcion'] , PDO::PARAM_STR);
       
        
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
    
      function insert_estado($_P ) {
          
           $fechaA = date("Y-m-d");
          for($i=0;$i< count($_POST["requisitos"]);$i++){
              $sql="update requisito_alumno_cca set estado=1, fecha=' ".$fechaA."' where  idrequisito_alum=".$_POST["requisitos"][$i]."";
              
              $stmt = $this->db->prepare($sql);
                   $stmt->execute();
          }
     
       
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
    
    
    
    function update($_P ) {
        
        $sql = $this->Query("sp_requisitos_iu_cca(1,:p1,:p2,:p3)");
        $stmt = $this->db->prepare($sql);
        if($_P['idpadre']==""){$_P['idpadre']=null;}       
        $stmt->bindValue(':p1', $_P['idrequisito'] , PDO::PARAM_INT);
        $stmt->bindValue(':p2', $_P['idcomision'] , PDO::PARAM_INT);
        $stmt->bindValue(':p3', $_P['descripcion'] , PDO::PARAM_STR);
        
        
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
    function delete($p) {
        $stmt = $this->db->prepare("DELETE FROM requisitos_cca WHERE idrequisito = :p1");
        $stmt->bindValue(':p1', $p, PDO::PARAM_INT);
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
}
?>
