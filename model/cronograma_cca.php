<?php

include_once("../lib/dbfactory.php");

class cronograma_cca extends Main {

    function index($query, $p, $c) {
        $sql = "    SELECT
                        alumno_cca.idalumno,
                        alumno_cca.nombres,
                        concat(alumno_cca.apellidop,' ',alumno_cca.apellidom) as apellidos,
                        alumno_cca.dni,
                        tipo_alumno_cca.descripcion
                        FROM
                        alumno_cca inner join  tipo_alumno_cca on alumno_cca.idtipo_alumno = tipo_alumno_cca.idtipo_alumno
                        where " . $c . " like :query";

        $param = array(array('key' => ':query', 'value' => "%$query%", 'type' => 'STR'));
        $data['total'] = $this->getTotal($sql, $param);
        $data['rows'] = $this->getRow($sql, $param, $p);
        $data['rowspag'] = $this->getRowPag($data['total'], $p);
        return $data;
    }

    function edit($id) {
        $stmt = $this->db->prepare("SELECT * FROM alumno_cca WHERE idalumno = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchObject();
    }
            
    
     function crono_alumno($id) {
         
      
        $stmt = $this->db->prepare("SELECT cronograma_cca.fecha, cronograma_cca.monto, cronograma_cca.estado FROM
                                    cronograma_cca
                                    INNER JOIN matricula_cca ON cronograma_cca.idmatricula = matricula_cca.idmatricula
                                    WHERE 
                                   matricula_cca.idmatricula= $id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchALL();
    }
    function nombre_alumno($ida){

         $stmt = $this->db->prepare("        SELECT
concat(alumno_cca.nombres,' ',
alumno_cca.apellidop,' ',
alumno_cca.apellidom)as alumno,
matricula_cca.nombre_proyecto,
alumno_cca.dni
FROM
alumno_cca
INNER JOIN matricula_cca ON matricula_cca.idalumno = alumno_cca.idalumno
where

matricula_cca.idmatricula= :id");
        $stmt->bindValue(':id', $ida, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchALL();
    }
   
    
      function pago_alumno($ida){

         $stmt = $this->db->prepare("         SELECT
sum(amortizacion_cca.monto)as monto
FROM
cronograma_cca
INNER JOIN amortizacion_cca ON amortizacion_cca.idcronograma = cronograma_cca.idcronograma
INNER JOIN matricula_cca ON cronograma_cca.idmatricula = matricula_cca.idmatricula

where matricula_cca.idmatricula=:id");
        $stmt->bindValue(':id', $ida, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchALL();
    }
    
    function insert($_G) {
        
//        var_dump($_GET['fechacrono']);
//        exit();
//        $A=sizeof($fecha);
//        die($A);
//        var_dump($A);
//        exit();
          for($i=0;$i<count($_GET['fechacrono']);$i++){
            
//              echo $_GET['fechacrono'][$i]."<br>";
//              echo strlen($_GET['fechacrono'][$i])."--<br>";
//              echo substr($_GET['fechacrono'][$i],-10)."<br>";
              
              if (strlen($_GET['fechacrono'][$i])==23){
                  
         
                             $sql ="insert into cronograma_cca values('',".$_GET['alumno'].",'".substr($_GET['fechacrono'][$i],-10)."',".$_GET['monto'].",0)";
           $sentencia = $this->db->prepare($sql);

        
   
        $sentencia->execute();
              }
               if (strlen($_GET['fechacrono'][$i])==10){
                  
         
                             $sql ="insert into cronograma_cca values('',".$_GET['alumno'].",'".$_GET['fechacrono'][$i]."',".$_GET['monto'].",0)";
           $sentencia = $this->db->prepare($sql);

        
   
        $sentencia->execute();
              }

     
                            
            
        }
    
       
        echo "<script>alert('Se inserto el cronograma de pagos');window.location='index.php?controller=matricula_cca'</script>";
    }

    function update($_P) {

        $sql = $this->Query("sp_alum_iu_cca(1,:p1,:p2,:p3,:p4,:p5,:p6,:p7,:p8,:p9,:p10)");
        $stmt = $this->db->prepare($sql);
        if ($_P['idpadre'] == "") {
            $_P['idpadre'] = null;
        }
        $stmt->bindValue(':p1', $_P['idalumno'], PDO::PARAM_INT);
        $stmt->bindValue(':p2', $_P['idtipo_alumno'], PDO::PARAM_INT);
        $stmt->bindValue(':p3', $_P['nombres'], PDO::PARAM_STR);
        $stmt->bindValue(':p4', $_P['apellidop'], PDO::PARAM_STR);
        $stmt->bindValue(':p5', $_P['apellidom'], PDO::PARAM_STR);
        $stmt->bindValue(':p6', $_P['dni'], PDO::PARAM_STR);
        $stmt->bindValue(':p7', $_P['sexo'], PDO::PARAM_STR);
        $stmt->bindValue(':p8', $_P['direccion'], PDO::PARAM_STR);
        $stmt->bindValue(':p9', $_P['procedencia'], PDO::PARAM_STR);
        $stmt->bindValue(':p10', $_P['telefono'], PDO::PARAM_STR);

        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1, $p2[2]);
    }

    function delete($p) {
        $stmt = $this->db->prepare("DELETE FROM alumno_cca WHERE idalumno = :p1");
        $stmt->bindValue(':p1', $p, PDO::PARAM_INT);
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1, $p2[2]);
    }
    
     function comision_asignaturas($id){
        
         $stmt = $this->db->prepare(" SELECT

CONCAT(docente_cca.nombres,' ',docente_cca.apellidop,' ',docente_cca.apellidom) as docente,
asignatura_cca.descripcion as curso,
asignatura_cca.creditaje as creditos

FROM
asignatura_cca
INNER JOIN docente_cca ON docente_cca.iddocente = asignatura_cca.iddocente

WHERE
asignatura_cca.idcomision=:id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchALL();
        
        
    }

    function buscar($query, $p, $c) {
//            $sql = "    SELECT * FROM
//                        (SELECT 
//                        nombres as nombres, 
//                        apellidop as apellidop, 
//                        apellidom as apellidom, 
//                        dni as dni, 
//                        sexo as sexo,
//                        1 as parametro 
//                        FROM alumno_cca
//                        UNION ALL
//                        SELECT 
//                        NombreAlumno as nombres, 
//                        ApellidoPaterno as apellidop, 
//                        ApellidoMaterno as apellidom, 
//                        NumDocumento as dni, 
//                        Sexo as sexo,
//                        2 as parametro 
//                        FROM alumnos)
//                        AS alumnon
//                        WHERE ".$c. " like :query";
        //die($sql);
        $sql = "    SELECT * FROM
                        (SELECT 
                        nombres as nombres, 
                        apellidop as apellidop, 
                        apellidom as apellidom, 
                        dni as dni, 
                        sexo as sexo,
                        1 as parametro 
                        FROM alumno_cca
                        UNION ALL
                        SELECT 
                        NombreAlumno as nombres, 
                        ApellidoPaterno as apellidop, 
                        ApellidoMaterno as apellidom, 
                        NumDocumento as dni, 
                        Sexo as sexo,
                        2 as parametro 
                        FROM alumnos
				where alumnos.CodigoSemestreEgreso <> ''
													)
                        AS alumnon
                        WHERE " . $c . " like :query";
        $param = array(array('key' => ':query', 'value' => "%$query%", 'type' => 'STR'));
        $data['total'] = $this->getTotal($sql, $param);
        /* var_dump($data['total']);
          exit(); */
        $data['rows'] = $this->getRow($sql, $param, $p);
        $data['rowspag'] = $this->getRowPag($data['total'], $p);

        return $data;
    }
    function monto_comision($id){
                $sql="SELECT 
                        sum(concepto_pension_cca.monto) as monto
                        FROM concepto_pension_cca 
                        inner join comision_cca on 
                        comision_cca.idcomision=concepto_pension_cca.idcomision 
                        WHERE concepto_pension_cca.idcomision = $id";
               
                
                  $sentencia = $this->db->prepare($sql);

        
   
        $sentencia->execute();
        
        return $sentencia->fetchAll();
   
            }
    function buscar2($query, $p, $c) {


        $sql = "    
                        SELECT
                        idalumno,
                        nombres as nombres, 
                        apellidop as apellidop, 
                        apellidom as apellidom, 
                        dni as dni, 
                        sexo as sexo,
                        1 as parametro 
                        FROM alumno_cca
                        
                        WHERE " . $c . " like :query";
        //die($sql);

        $param = array(array('key' => ':query', 'value' => "%$query%", 'type' => 'STR'));
        $data['total'] = $this->getTotal($sql, $param);
        /* var_dump($data['total']);
          exit(); */
        $data['rows'] = $this->getRow($sql, $param, $p);
        $data['rowspag'] = $this->getRowPag($data['total'], $p);

        return $data;
    }

}

?>
