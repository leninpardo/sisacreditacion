<?php
include_once("../lib/dbfactory.php");
class comision_cca extends Main{    
    function index($query,$p,$c) 
    {
        $sql = "SELECT
                        comision_cca.idcomision,
			comision_cca.comision,	
                        comision_cca.descripcion,
			comision_cca.fecha_inicio,
			comision_cca.fecha_termino
			
                        FROM
			comision_cca
			
                        WHERE ".$c." like :query ";         
        $param = array(array('key'=>':query' , 'value'=>"%$query%" , 'type'=>'STR' ));
        $data['total'] = $this->getTotal( $sql, $param );
        $data['rows'] =  $this->getRow($sql, $param , $p );        
        $data['rowspag'] =  $this->getRowPag($data['total'], $p );        
        return $data;
    }   
    function datos_comision($id) 
    {
        $sql = "SELECT
                        comision_cca.idcomision,
			comision_cca.comision,	
                        comision_cca.descripcion,
			comision_cca.fecha_inicio,
			comision_cca.fecha_termino
			
                        FROM
			comision_cca
			
                        WHERE comision_cca.idcomision = :id ";   
//        die($sql);
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id , PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    } 
    
    function edit($id ) 
    {
        $stmt = $this->db->prepare("SELECT * FROM comision_cca WHERE idcomision = :id");
        $stmt->bindValue(':id', $id , PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchObject();
    }
    function insert($_P ) {
        
        $sentencia2=$this->db->query("SELECT count(idcomision) as cantidad FROM comision_cca where comision_cca.fecha_termino='".$_P['fecha_inicio']."'");         
         $ct3=$sentencia2->fetch();
        $row=(int)$ct3['cantidad'];
        
        if($row >=1 ){
            echo "<script>alert('Ya existe su comision vigente');</script>";
             header('Location: index.php?controller=comision_cca');
        }else{
        
         $sentencia=$this->db->query("SELECT MAX(idcomision) FROM comision_cca");         
         $ct=$sentencia->fetch();      
         $xd=1+ (int)$ct['cant'];
          $sql = $this->Query("sp_comision_iu_cca(0,:p1,:p2,:p3,:p4,:p5)");
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':p1', $xd , PDO::PARAM_INT);
        $stmt->bindValue(':p2', $_P['comision'] , PDO::PARAM_STR);
        $stmt->bindValue(':p3', $_P['descripcion'] , PDO::PARAM_STR);
        $stmt->bindValue(':p4', $_P['fecha_inicio'] , PDO::PARAM_INT);
        $stmt->bindValue(':p5', $_P['fecha_termino'] , PDO::PARAM_INT);
       
               
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();   
        return array($p1 , $p2[2]);
        }
    }
    function update($_P ) {
        $sql = $this->Query("sp_comision_iu_cca(1,:p1,:p2,:p3,:p4,:p5)");
        $stmt = $this->db->prepare($sql);
        if($_P['idpadre']==""){$_P['idpadre']=null;}
        $stmt->bindValue(':p1', $_P['idcomision'] , PDO::PARAM_STR);
        $stmt->bindValue(':p2', $_P['comision'] , PDO::PARAM_STR);
        $stmt->bindValue(':p3', $_P['descripcion'] , PDO::PARAM_STR);
        $stmt->bindValue(':p4', $_P['fecha_inicio'] , PDO::PARAM_INT);
        $stmt->bindValue(':p5', $_P['fecha_termino'] , PDO::PARAM_INT);
               
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
    function delete($p) {
        $stmt = $this->db->prepare("DELETE FROM comision_cca WHERE idcomision = :p1");
        $stmt->bindValue(':p1', $p, PDO::PARAM_STR);
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
    
    function lista_miembros($a){
        $sql="
                SELECT
 concat(docente_cca.nombres,'',
 docente_cca.apellidop,'',
 docente_cca.apellidom) as docente,
 comision_cca.comision,
 cargo_comision_cca.descripcion,
 detalle_comision_cca.iddetalle_comision,
 detalle_comision_cca.iddocente,
 detalle_comision_cca.idcomision,
 detalle_comision_cca.idcargocomision
 FROM
 detalle_comision_cca
 INNER JOIN comision_cca ON comision_cca.idcomision = detalle_comision_cca.idcomision 
 INNER JOIN docente_cca ON docente_cca.iddocente = detalle_comision_cca.iddocente
 INNER JOIN cargo_comision_cca ON cargo_comision_cca.idcargocomision = detalle_comision_cca.idcargocomision
 WHERE
 comision_cca.idcomision = $a";
//        die($sql);
        $sth = $this->db->prepare($sql);
        $sth->execute();
        
        $datos['miembros']=$sth->fetchAll();
        $view = new View();
        $view->setData($datos);
        $view->setTemplate('../view/comision_cca/_Miembro.php');
        $view->setLayout('../template/Layout.php');
        return $view->renderPartial();
        
    }
    
    function lista_asignaturas($a){
        $sql="
                SELECT
                        asignatura_cca.descripcion,
                        docente_cca.nombres,
                        asignatura_cca.idasignatura,
                        asignatura_cca.idcomision,
                        asignatura_cca.iddocente,
                        
                        asignatura_cca.creditaje,
                      
                        comision_cca.comision
                        FROM
                        asignatura_cca
                        INNER JOIN comision_cca ON comision_cca.idcomision = asignatura_cca.idcomision
                        INNER JOIN docente_cca ON docente_cca.iddocente = asignatura_cca.iddocente WHERE
                comision_cca.idcomision = $a";
                    
//        die($sql);
        $sth = $this->db->prepare($sql);
        $sth->execute();
        
        $datos['asignaturas']=$sth->fetchAll();
        $view = new View();
        $view->setData($datos);
        $view->setTemplate('../view/comision_cca/_Asignatura.php');
        $view->setLayout('../template/Layout.php');
        return $view->renderPartial();
        
    }
    
     function lista_conceptos($a){
        $sql="
                SELECT
                
                concepto_pension_cca.descripcion,
                concepto_pension_cca.monto,
                concepto_pension_cca.idconcepto,
                concepto_pension_cca.idcomision
                FROM
                concepto_pension_cca

                where 
                concepto_pension_cca.idcomision= $a";
                    
//        die($sql); 
        $sth = $this->db->prepare($sql);
        $sth->execute();
        
        $datos['concepto']=$sth->fetchAll();
        $view = new View();
        $view->setData($datos);
        $view->setTemplate('../view/comision_cca/_Concepto.php');
        $view->setLayout('../template/Layout.php');
        return $view->renderPartial();
        
    }
    
        function lista_requisitos($a){
        $sql="
                SELECT
                requisitos_cca.idrequisito,
                requisitos_cca.idcomision,
                requisitos_cca.descripcion
         
                FROM
                requisitos_cca

                where 
                requisitos_cca.idcomision= $a";
                    
//        die($sql); 
        $sth = $this->db->prepare($sql);
        $sth->execute();
        
        $datos['requisitos']=$sth->fetchAll();
        $view = new View();
        $view->setData($datos);
        $view->setTemplate('../view/comision_cca/_Requisito.php');
        $view->setLayout('../template/Layout.php');
        return $view->renderPartial();
        
    }
    
    
    
    
}
?>
