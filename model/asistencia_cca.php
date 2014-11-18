<?php
include_once("../lib/dbfactory.php");
class asistencia_cca extends Main{ 
    
    function insert($p)
    {
        for($i=0; $i<count($p['asistio']); $i++)
        {
            $sentencia=$this->db->query("SELECT MAX(idasistencia) as ida from asistencia_cca");         
            $ct=$sentencia->fetch();
            $xd=1+(int)$ct['ida'];
            $stmt = $this->db->prepare("INSERT INTO asistencia_cca SET idasistencia= :ida, idmatricula = :idm, idclase = :idc");
            $stmt->bindValue(':ida', $xd, PDO::PARAM_INT);
            $stmt->bindValue(':idm', $p['asistio'][$i], PDO::PARAM_INT);
            $stmt->bindValue(':idc', $p['idclase'] , PDO::PARAM_INT);
            $p1 = $stmt->execute();
            $p2 = $stmt->errorInfo();
        }
        return array($p1 , $p2[2]);
    }
    
}