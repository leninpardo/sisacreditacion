<?php
include_once("../lib/dbfactory.php");
class concepto_cca extends Main{    
    function index($query,$p,$c) 
    {
        
        $sql = "SELECT
                    concepto_pension_cca.idconcepto,
                    concepto_pension_cca.descripcion,
                    concepto_pension_cca.monto,
                    comision_cca.comision
                    FROM
                    concepto_pension_cca
                    inner join comision_cca on comision_cca.idcomision=concepto_pension_cca.idcomision
			
                        WHERE ".$c." = $query ";         
        
       
        $param = array(array('key'=>':query' , 'value'=>"%$query%" , 'type'=>'STR' ));
        $data['total'] = $this->getTotal( $sql, $param );
        $data['rows'] =  $this->getRow($sql, $param , $p );        
        $data['rowspag'] =  $this->getRowPag($data['total'], $p );        
        return $data;
    }  
    
    
    
      
    function comision_actual()
    {
         $fechaA= date("Y-m-d");       
        
         $sql="SELECT
                    comision_cca.idcomision
                    FROM
                    comision_cca
                    WHERE
                    comision_cca.fecha_inicio <= '".$fechaA."' AND
                    comision_cca.fecha_termino >= '$fechaA'";
              
        $sth = $this->db->prepare($sql);
        $sth->execute();
        
        return $sth->fetchAll();
    
    }
    function datos_comision($query,$p,$c) 
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
    
    function edit($id ) 
    {
        $stmt = $this->db->prepare("SELECT * FROM concepto_pension_cca WHERE idconcepto = :id");
        $stmt->bindValue(':id', $id , PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchObject();
    }
    function insert($_P ) {
      
         $sentencia=$this->db->query("SELECT MAX(idconcepto) as cant FROM concepto_pension_cca");         
           
         $ct=$sentencia->fetch();   
          
         $xd=1+(int) $ct['cant'];
//    echo $xd;
//    exit();
//       die ($_P['monto']);
          $sql = $this->Query("sp_concepto_pension_iu_cca(0,:p1,:p2,:p3,:p4)");
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':p1', $xd , PDO::PARAM_INT);
        $stmt->bindValue(':p2', $_P['idcomision'] , PDO::PARAM_INT);
        $stmt->bindValue(':p3', $_P['descripcion'] , PDO::PARAM_STR);
        $stmt->bindValue(':p4', $_P['monto'] , PDO::PARAM_INT);
         
         
      
               
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();   
        return array($p1 , $p2[2]);
    }
    function update($_P ) {
        $sql = $this->Query("sp_concepto_pension_iu_cca(1,:p1,:p2,:p3,:p4)");
        $stmt = $this->db->prepare($sql);
        if($_P['idpadre']==""){$_P['idpadre']=null;}
       $stmt->bindValue(':p1', $_P['idconcepto'] , PDO::PARAM_INT);
        $stmt->bindValue(':p2', $_P['idcomision'] , PDO::PARAM_INT);
        $stmt->bindValue(':p3', $_P['descripcion'] , PDO::PARAM_STR);
        $stmt->bindValue(':p4', $_P['monto'] , PDO::PARAM_INT);
               
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
    
    function lista_miembros($a){
        $sql="
                SELECT
                concat(docente_cca.nombres,'',
                docente_cca.apellidop,'',
                docente_cca.apellidom) as docente,
                comision_cca.comision,
                n_det_com_cca.nombre_detalle_cargo,
                detalle_comision_cca.iddetalle_comision,
                detalle_comision_cca.iddocente,
                detalle_comision_cca.idcomision,
                detalle_comision_cca.idcargocomision
                FROM
                detalle_comision_cca
                INNER JOIN comision_cca ON comision_cca.idcomision = detalle_comision_cca.idcomision 
                INNER JOIN  docente_cca ON docente_cca.iddocente = detalle_comision_cca.iddocente
                INNER JOIN n_det_com_cca ON n_det_com_cca.idcargocomision = detalle_comision_cca.idcargocomision
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
        
        $sth = $this->db->prepare($sql);
        $sth->execute();
        
        $datos['asignaturas']=$sth->fetchAll();
        $view = new View();
        $view->setData($datos);
        $view->setTemplate('../view/comision_cca/_Asignatura.php');
        $view->setLayout('../template/Layout.php');
        return $view->renderPartial();
        
    }
}
?>
