<?php
include_once("../lib/dbfactory.php");
class listaproyecto extends Main{  
    function getproyecto($id)
    {
    $stmt = $this->db->prepare("select proyecto.idproyecto,proyecto.nombre_proyecto,concat(profesores.NombreProfesor,'  ',profesores.ApellidoPaterno) from proyecto 
INNER JOIN detalle_profesor_proy_fun on(proyecto.idproyecto=detalle_profesor_proy_fun.idproyecto)
INNER JOIN profesores on(profesores.CodigoProfesor=detalle_profesor_proy_fun.CodigoProfesor)
WHERE proyecto.idproyecto=:id");
 $stmt->bindValue(':id', $id , PDO::PARAM_INT);
 $stmt->execute();
 return $stmt->fetchAll();
       
    }
    
    function index($query,$p,$c) 
    {       
        
            $sql = "   SELECT 
                        proyecto.nombre_proyecto,
                        proyecto.tema_proyecto,
                        proyecto.periodo_ejecucion,
                        CONCAT(profesores.ApellidoPaterno,' ',profesores.ApellidoMaterno,' ',profesores.NombreProfesor) AS Responsable,
                        estado_proyecto.descripcion,
                        MAX(DISTINCT(control_proyecto.fecha)) as Fecha_Inicio
                        FROM
                        proyecto
                        INNER JOIN detalle_profesor_proy_fun ON proyecto.idproyecto = detalle_profesor_proy_fun.idproyecto
                        INNER JOIN profesores ON profesores.CodigoProfesor = detalle_profesor_proy_fun.CodigoProfesor
                        INNER JOIN control_proyecto ON proyecto.idproyecto = control_proyecto.idproyecto
                        INNER JOIN estado_proyecto ON control_proyecto.idestado_proyecto = estado_proyecto.idestado_proyecto
                        where detalle_profesor_proy_fun.idfuncion=2 AND ((proyecto.nombre_proyecto LIKE'%a%')or (proyecto.tema_proyecto LIKE'%a%')or (profesores.NombreProfesor 

                        LIKE'%a%') or (profesores.ApellidoPaterno LIKE'%a%') or (profesores.ApellidoMaterno LIKE'%a%'))
                        GROUP BY proyecto.idproyecto";
     
        
        
        $param = array(array('key'=>':query' , 'value'=>"%$query%" , 'type'=>'STR' ),
                        array('key'=>':query1' , 'value'=>"%$query1%" , 'type'=>'STR' ));
        $data['total'] = $this->getTotal( $sql, $param );
        $data['rows'] =  $this->getRow($sql, $param , $p );        
        $data['rowspag'] = $this->getRowPag($data['total'], $p );        
        return $data;
    }
    
    function insert($_P ) {                 
        $sql2 = $this->Query("sp_det_proy_alum_iu(0,:p1,:p2,:p3,:p4,:p5,:p6)");     
        $stmt2 = $this->db->prepare($sql2);
        $fecha=date("Y-m-d");
        $estado=0;            
        $semestre="20132";    
              
              $stmt2->bindValue(':p1', $_P["idproyecto"] , PDO::PARAM_STR);
              $stmt2->bindValue(':p2', $fecha, PDO::PARAM_STR);
              $stmt2->bindValue(':p3', $estado , PDO::PARAM_STR);       
              $stmt2->bindValue(':p4', $_P['idalumno'] , PDO::PARAM_STR); 
              $stmt2->bindValue(':p5', $semestre, PDO::PARAM_STR);               
              $stmt2->bindValue(':p6', $_P['mensaje'], PDO::PARAM_STR);
              $stmt2->execute();          
               
            
            $this->db->commit();            
            $p1 = true;
            $p2[2] = "";     
                            
        return array($p1 , $p2[2]);
    }
    
    function modificar_estado($_P){
        
        $sql2 = $this->Query("sp_det_proy_alum_iu(0,:p1,:p2,:p3,:p4,:p5,:p6)");     
        $stmt2 = $this->db->prepare($sql2);
        $fecha=date("Y-m-d");
        $estado=0;            
        $semestre="20132";
              
              $stmt2->bindValue(':p1', $_P["idproyecto"] , PDO::PARAM_STR);
              $stmt2->bindValue(':p2', $fecha, PDO::PARAM_STR);
              $stmt2->bindValue(':p3', $estado , PDO::PARAM_STR);       
              $stmt2->bindValue(':p4', $_P['idalumno'] , PDO::PARAM_STR); 
              $stmt2->bindValue(':p5', $semestre, PDO::PARAM_STR);               
              $stmt2->bindValue(':p6', $_P['mensaje'], PDO::PARAM_STR);
              $stmt2->execute();          
               
            
            $this->db->commit();            
            $p1 = true;
            $p2[2] = "";     
                            
        return array($p1 , $p2[2]);
        
    }
    
    public  function lista_procesos($id){
            $stmt = $this->db->prepare("SELECT
proceso_proyecto.idproceso_proyecto,
proceso_proyecto.nombre,
proceso_proyecto.responsable,
detalle_proceso_proyecto.fecha_ingreso,
detalle_proceso_proyecto.fecha_plazo,
detalle_proceso_proyecto.fecha_finalizacion,
detalle_proceso_proyecto.descripcion,
detalle_proceso_proyecto.estado
FROM
proceso_proyecto
INNER JOIN detalle_proceso_proyecto ON proceso_proyecto.idproceso_proyecto = detalle_proceso_proyecto.idproceso_proyecto
INNER JOIN proyecto ON proyecto.idproyecto = detalle_proceso_proyecto.idproyecto
WHERE detalle_proceso_proyecto.idproyecto=".$id);
              //$stmt2->bindValue(':p1', $id , PDO::PARAM_INT);
              $stmt->execute();
              return $stmt->fetchAll();
    }
    function save_procesos($_P)
    {
       $sql2 = $this->Query("usp_detalle_procesos(:p1,:p2,:p3,:p4,1)");
          $stmt = $this->db->prepare($sql2);
       
        try{
 //$stmt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //$stmt->beginTransaction();

              $stmt->bindValue(':p1', $_P["id_proyecto"] , PDO::PARAM_INT);
              $stmt->bindValue(':p2', $_P['select_proceso'], PDO::PARAM_INT);
              $stmt->bindValue(':p3', $_P['fecha_i'] , PDO::PARAM_STR);       
              $stmt->bindValue(':p4', $_P['fecha_l'] , PDO::PARAM_STR); 
              $stmt->execute();   
              $p2 = $stmt->errorInfo();
           //$stmt->db->commit();            
             
                            
        $array= array("rep"=>1 , "msg"=>$p2);
        }  catch (PDOException $e)
        {
           // $this->db->rollback();
           // $stmt->rollBack();
            $array= array("rep"=>2,"msg"=>$e->getMessage());
        }
        return $array;
    }
        public  function ver_proyecto($id){
            $stmt2 = $this->db->prepare("SELECT nombre_proyecto,concat(profesores.NombreProfesor,' ',profesores.ApellidoPaterno) as docente from proyecto
INNER JOIN detalle_profesor_proy_fun on(detalle_profesor_proy_fun.idproyecto=proyecto.idproyecto)
INNER JOIN profesores on(profesores.CodigoProfesor=detalle_profesor_proy_fun.CodigoProfesor)
 WHERE proyecto.idproyecto=:p1");
              $stmt2->bindValue(':p1', $id , PDO::PARAM_INT);
              $stmt2->execute();
              return $stmt2->fetchAll();
    }
    public  function lista_procesos_left($id)
    {
         $stmt2 = $this->db->prepare("
             SELECT
proceso_proyecto.idproceso_proyecto,
proceso_proyecto.nombre,
proceso_proyecto.responsable,
$id idproyecto
FROM
proceso_proyecto
left JOIN detalle_proceso_proyecto 
ON detalle_proceso_proyecto.idproceso_proyecto = proceso_proyecto.idproceso_proyecto
where proceso_proyecto.idproceso_proyecto not in(SELECT
proceso_proyecto.idproceso_proyecto
FROM
proceso_proyecto
right JOIN detalle_proceso_proyecto 
ON detalle_proceso_proyecto.idproceso_proyecto = proceso_proyecto.idproceso_proyecto
WHERE detalle_proceso_proyecto.idproyecto=:p1)");
              $stmt2->bindValue(':p1', $id , PDO::PARAM_INT);
              $stmt2->execute();
              return $stmt2->fetchAll();   
    }
    
}
?>