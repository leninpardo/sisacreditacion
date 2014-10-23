<?php
include_once("../lib/dbfactory.php");
class solicitudes extends Main{    
    function index($query,$p,$c) 
    {       
        
            $sql = "SELECT
                    proyecto.idproyecto,
                    CONCAT(alumnos.NombreAlumno,' ',alumnos.ApellidoPaterno,' ',alumnos.ApellidoMaterno) as Alumno,
                    proyecto.nombre_proyecto,
                    detalleproyecto_matrixalumno.mensaje,
                    detalleproyecto_matrixalumno.fecha
                    FROM
                    detalleproyecto_matrixalumno
                    INNER JOIN alumnos ON alumnos.CodigoAlumno = detalleproyecto_matrixalumno.CodigoAlumno
                    INNER JOIN proyecto ON detalleproyecto_matrixalumno.idproyecto = proyecto.idproyecto
                    WHERE detalleproyecto_matrixalumno.estado=0";
     
        
        
        $param = array(array('key'=>':query' , 'value'=>"%$query%" , 'type'=>'STR' ),
                        array('key'=>':query1' , 'value'=>"%$query1%" , 'type'=>'STR' ));
        $data['total'] = $this->getTotal( $sql, $param );
        $data['rows'] =  $this->getRow($sql, $param , $p );        
        $data['rowspag'] = $this->getRowPag($data['total'], $p );        
        return $data;
    }
    
    function update($_P ) {
        $sql = $this->Query("sp_solicitudes_upda(:p1,:p2,:p3)");
        $stmt = $this->db->prepare($sql);
        if($_P['idpadre']==""){$_P['idpadre']=null;}
        $stmt->bindValue(':p1', $_P['estado'] , PDO::PARAM_INT);
        $stmt->bindValue(':p2', $_P['idalumno'] , PDO::PARAM_STR);
        $stmt->bindValue(':p3', $_P['idproyecto'] , PDO::PARAM_INT);

        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
    
    
    
}
?>