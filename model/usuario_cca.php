<?php
include_once("../lib/dbfactory.php");
class usuario_cca extends Main{    
    function index($query,$p,$c) 
    {
       $sql = "   SELECT
                    usuario_cca.idusuario,
                    usuario_cca.nombres,
                    usuario_cca.apellidos,
                    usuario_cca.dni,
                    usuario_cca.direccion,
                    usuario_cca.telefono
                    FROM
                    usuario_cca

                        where " . $c . " like :query";

        $param = array(array('key' => ':query', 'value' => "%$query%", 'type' => 'STR'));
        $data['total'] = $this->getTotal($sql, $param);
        $data['rows'] = $this->getRow($sql, $param, $p);
        $data['rowspag'] = $this->getRowPag($data['total'], $p);
        return $data;
    }       
    function edit($id ) 
    {
        $stmt = $this->db->prepare("SELECT * FROM usuario_cca WHERE idusuario = :id");
        $stmt->bindValue(':id', $id , PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchObject();
    }
    function insert($_P ) {
         $sentencia=$this->db->query("SELECT COUNT(idusuario) as cant from usuario_cca");         
         $ct=$sentencia->fetch();      
          $xd=1+ (int)$ct['cant'];
         
        $sql = $this->Query("sp_usuario_iu_cca(0,:p1,:p2,:p3,:p4,:p5,:p6,:p7)");
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':p1', $xd, PDO::PARAM_INT);
        $stmt->bindValue(':p2', $_P['nombres'], PDO::PARAM_STR);
        $stmt->bindValue(':p3', $_P['apellidos'], PDO::PARAM_STR);
        $stmt->bindValue(':p4', $_P['dni'], PDO::PARAM_STR);
        $stmt->bindValue(':p5', $_P['direccion'], PDO::PARAM_STR);
        $stmt->bindValue(':p6', $_P['telefono'], PDO::PARAM_STR);
        $stmt->bindValue(':p7', $_P['dni'], PDO::PARAM_STR);
               
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();   
        return array($p1 , $p2[2]);
    }
    function update($_P ) {
               
        $sql = $this->Query("sp_usuario_iu_cca(1,:p1,:p2,:p3,:p4,:p5,:p6,:p7)");
        $stmt = $this->db->prepare($sql);
        if($_P['idpadre']==""){$_P['idpadre']=null;}
        $stmt->bindValue(':p1', $_P['idusuario'], PDO::PARAM_INT);
        $stmt->bindValue(':p2', $_P['nombres'], PDO::PARAM_STR);
        $stmt->bindValue(':p3', $_P['apellidos'], PDO::PARAM_STR);
        $stmt->bindValue(':p4', $_P['dni'], PDO::PARAM_STR);
        $stmt->bindValue(':p5', $_P['direccion'], PDO::PARAM_STR);
        $stmt->bindValue(':p6', $_P['telefono'], PDO::PARAM_STR);
        $stmt->bindValue(':p7', $_P['pass'], PDO::PARAM_STR);
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
    function delete($p) {
        $stmt = $this->db->prepare("DELETE FROM usuario_cca WHERE idusuario = :p1");
        $stmt->bindValue(':p1', $p, PDO::PARAM_STR);
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
   
    function editar_pass($p){
        $sql="UPDATE usuario_cca SET pass = $nuevopass WHERE idusuario = $p";
        return $nuevopass;
    }
}
?>