<?php
include_once("../lib/dbfactory.php");
class clase_cca extends Main{    
    function index($query,$p,$c) 
    {
              $sql = "  SELECT
                        clase_cca.idclase,
                        asignatura_cca.descripcion,
                        clase_cca.fecha,
                        clase_cca.tema,
                        asignatura_cca.descripcion
                      
                        FROM
                        clase_cca
                        INNER JOIN asignatura_cca ON asignatura_cca.idasignatura = clase_cca.idasignatura
                        where ".$c." like :query";
              
        $param = array(array('key'=>':query' , 'value'=>"%$query%" , 'type'=>'STR' ));
        $data['total'] = $this->getTotal( $sql, $param );
        $data['rows'] =  $this->getRow($sql, $param , $p );        
        $data['rowspag'] = $this->getRowPag($data['total'], $p );        
        return $data;
    }
    
    function edit($id ) 
    {
        $stmt = $this->db->prepare("SELECT * FROM clase_cca WHERE idclase = :id");
        $stmt->bindValue(':id', $id , PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchObject();
    }
    function insert($_P ) {
        $sentencia=$this->db->query("SELECT MAX(idclase) as cant from clase_cca");         
        $ct=$sentencia->fetch();      
        $xd=1+(int)$ct['cant'];
               
        $sql = $this->Query("sp_clase_iu_cca(0,:p1,:p2,:p3,:p4)");
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':p1', $xd , PDO::PARAM_INT);
        $stmt->bindValue(':p2', $_P['idasignatura'] , PDO::PARAM_INT);        
        $stmt->bindValue(':p3', $_P['fecha'] , PDO::PARAM_STR);
        $stmt->bindValue(':p4', $_P['tema'] , PDO::PARAM_STR);
       
        
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
    
    function idmax(){
        $sql = $this->db->query("SELECT MAX(idclase) as idclase from clase_cca"); 
        $consulta = $sql->fetch();
        $id = $consulta['idclase'];
        return $id;
    }
    
    function clase($id) {
        $sql = $this->db->query("SELECT c.idclase, a.idasignatura, a.descripcion as asignatura, c.tema, c.fecha from clase_cca as c inner join asignatura_cca as a on c.idasignatura=a.idasignatura WHERE c.idclase='$id'");
        $sql->execute();
        $consulta = $sql->fetchAll();
        return $consulta;
    }
    
    function alumnos() {
        $sql = $this->db->query("SELECT m.idmatricula, CONCAT(a.nombres,' ',a.apellidop,' ',a.apellidom) as alumno from matricula_cca as m inner join alumno_cca as a on m.idalumno=a.idalumno order by CONCAT(a.nombres,' ',a.apellidop,' ',a.apellidom) ASC"); 
        $sql->execute();
        return $sql->fetchAll();
    }
    function update($_P ) {
        
        $sql = $this->Query("sp_clase_iu_cca(1,:p1,:p2,:p3,:p4)");
        $stmt = $this->db->prepare($sql);
        if($_P['idpadre']==""){$_P['idpadre']=null;}  
        $stmt->bindValue(':p1', $_P['idclase'] , PDO::PARAM_INT);
        $stmt->bindValue(':p2', $_P['idasignatura'] , PDO::PARAM_INT);
        $stmt->bindValue(':p3', $_P['fecha'] , PDO::PARAM_STR);
        $stmt->bindValue(':p4', $_P['tema'] , PDO::PARAM_STR);
        
        
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
    function delete($p) {
        $stmt = $this->db->prepare("DELETE FROM clase_cca WHERE idclase = :p1");
        $stmt->bindValue(':p1', $p, PDO::PARAM_INT);
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
}
?>
