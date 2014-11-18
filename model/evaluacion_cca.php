<?php
include_once("../lib/dbfactory.php");
class evaluacion_cca extends Main{ 
    
    function insert($p)
    {
        for($i=0; $i<count($p['alumnos']); $i++)
        {
            $sentencia=$this->db->query("SELECT MAX(idevaluacion) as ide from evaluacion_cca");         
            $ct=$sentencia->fetch();
            $xd=1+(int)$ct['ide'];
            $stmt = $this->db->prepare("INSERT INTO evaluacion_cca SET idevaluacion=:ide, idmatricula=:idm, idasignatura=:ida, idtipo_evaluacion=:idte, nota=:n");
            $stmt->bindValue(':ide', $xd, PDO::PARAM_INT);
            $stmt->bindValue(':idm', $p['alumnos'][$i], PDO::PARAM_INT);
            $stmt->bindValue(':n', $p['notas'][$i], PDO::PARAM_INT);
            $stmt->bindValue(':ida', $p['idasignatura'] , PDO::PARAM_INT);
            $stmt->bindValue(':idte', $p['idtipo_evaluacion'] , PDO::PARAM_INT);
            $p1 = $stmt->execute();
            $p2 = $stmt->errorInfo();
        }
        return array($p1 , $p2[2]);
    }
    
}