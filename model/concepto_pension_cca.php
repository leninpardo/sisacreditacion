<?php
include_once("../lib/dbfactory.php");
class concepto_pension_cca extends Main{    
    function index($query,$p,$c) 
    {
        $cod=$_REQUEST['id'];        
              $sql = "      SELECT
                            concepto_pension_cca.idconcepto,
                            concepto_pension_cca.descripcion,
                            concepto_pension_cca.monto,
                            comision_cca.comision
                            
                            FROM
                            concepto_pension_cca
                            INNER JOIN comision_cca ON concepto_pension_cca.idcomision = comision_cca.idcomision 
                            where concepto_pension_cca.idcomision=$cod";
              
        $param = array(array('key'=>':query' , 'value'=>"%$query%" , 'type'=>'STR' ));
        $data['total'] = $this->getTotal( $sql, $param );
        $data['rows'] =  $this->getRow($sql, $param , $p );        
        $data['rowspag'] = $this->getRowPag($data['total'], $p );        
        return $data;
    }
    
    function edit($id ) 
    {
        $stmt = $this->db->prepare("SELECT * FROM concepto_pension_cca WHERE idconcepto = :id");
        $stmt->bindValue(':id', $id , PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchObject();
    }
    function insert($_P ) {
        $sentencia=$this->db->query("SELECT MAX(idconcepto) as cant from concepto_pension_cca");         
        $ct=$sentencia->fetch();      
        $xd=1+(int)$ct['cant'];
               
        $sql = $this->Query("sp_concepto_pension_iu_cca(0,:p1,:p2,:p3,:P4)");
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':p1', $xd , PDO::PARAM_INT);
        $stmt->bindValue(':p2', $_P['idcomision'] , PDO::PARAM_INT);
        $stmt->bindValue(':p3', $_P['descripcion'] , PDO::PARAM_STR);
        $stmt->bindValue(':p4', $_P['monto'] , PDO::PARAM_STR);
       
        
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
    function update($_P ) {
        
        $sql = $this->Query("sp_concepto_pension_iu_cca(1,:p1,:p2,:p3,:p4)");
        $stmt = $this->db->prepare($sql);
        if($_P['idpadre']==""){$_P['idpadre']=null;}       
        $stmt->bindValue(':p1', $_P['idrequisito'] , PDO::PARAM_INT);
        $stmt->bindValue(':p2', $_P['idcomision'] , PDO::PARAM_INT);
        $stmt->bindValue(':p3', $_P['descripcion'] , PDO::PARAM_STR);
        $stmt->bindValue(':p4', $_P['monto'] , PDO::PARAM_STR);
        
        
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
    function delete($p) {
        $stmt = $this->db->prepare("DELETE FROM concepto_pension_cca WHERE idconcepto = :p1");
        $stmt->bindValue(':p1', $p, PDO::PARAM_INT);
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
}
?>
