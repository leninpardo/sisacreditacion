<?php
include_once("../lib/dbfactory.php");
class calificacion extends Main{    
 function insert($_P) {
      echo "<pre>"; print_r ($_P);
        $idTipEva  = $_P["CodTipEvaluacion"];
        $nota = $_P["campo"];
        $t= $_P['tamano'];
       for ($i=0; $i < $t ; $i++) { 
            $IdAlumno    = $_P['idalumno'][$i];
            $sentencia=$this->db->query("SELECT MAX(idcalificacion) as cant from calificacion");         
            $ct=$sentencia->fetch();      
            $xd=1+(int)$ct['cant'];
            $sql = $this->Query("sp_calificacion_iu(0,:p1,:p2,:p3,:p4)");
            $stmt2 = $this->db->prepare($sql);
            $stmt2->bindValue(':p1', $xd , PDO::PARAM_INT);
            $stmt2->bindValue(':p2', $idTipEva , PDO::PARAM_INT);
            $stmt2->bindValue(':p3', $IdAlumno , PDO::PARAM_STR);
            $stmt2->bindValue(':p4', $nota , PDO::PARAM_INT);
            $p1 = $stmt2->execute();
       }


}
     
function update($_P ) {
 echo "<pre>"; print_r ($_P);
        $idTipEva  = $_P["CodTipEvaluacion"];
        $nota = $_P["campo"];
        $IdAlumno  = $_P["CodAlumno"];

        $stmt = $this->db->prepare("UPDATE calificacion SET nota = :p2
                                    WHERE idevaluacion = :p1 AND CodigoAlumno = :p3");
        $stmt->bindValue(':p1', $idTipEva, PDO::PARAM_INT);
        $stmt->bindValue(':p2', $nota, PDO::PARAM_INT);
        $stmt->bindValue(':p3', $IdAlumno, PDO::PARAM_INT);
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
 }
}
?>


