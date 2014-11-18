<?php

include_once("../lib/dbfactory.php");

class recepcion_cca extends Main {

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
    
      function alumnos_matriculados($query, $p, $c) {
        $sql = "    SELECT DISTINCT
                    matricula_cca.idmatricula,
                    concat(alumno_cca.nombres,' ',
                    alumno_cca.apellidop,' ',
                    alumno_cca.apellidom) as alumno,
                    alumno_cca.dni
                    FROM
                    alumno_cca
                    INNER JOIN matricula_cca ON matricula_cca.idalumno = alumno_cca.idalumno
                    INNER JOIN cronograma_cca ON cronograma_cca.idmatricula = matricula_cca.idmatricula
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

    function insert($_P) {
         $compro = $this->db->query("SELECT count(*) as numero from alumno_cca where alumno_cca.dni=".$_POST['dni']."");
        $rows = $compro->fetch();
//        var_dump($rows);
//        echo "-";
//     die ($rows['numero']);
//        exit();
//        die (count($a));
        if ($rows['numero']>=1){
            
            echo "<script>alert('El alumno ya se encuentra  registrado');window.close();</script>";
            
        }else{
        
        $sentencia = $this->db->query("SELECT MAX(idalumno) as cant from alumno_cca");
        $ct = $sentencia->fetch();
        $xd = 1 + (int) $ct['cant'];

        $sql = $this->Query("sp_alumno_iu_cca(0,:p1,:p2,:p3,:p4,:p5,:p6,:p7,:p8,:p9,:p10)");
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':p1', $xd, PDO::PARAM_INT);
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
    }

    function update($_P) {

        $sql = $this->Query("sp_alumno_iu_cca(1,:p1,:p2,:p3,:p4,:p5,:p6,:p7,:p8,:p9,:p10)");
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


    
    
    
    
     function list_requerimientos($id) {
        
         
         $stmt = $this->db->prepare("
SELECT
requisito_alumno_cca.idrequisito_alum,
requisito_alumno_cca.idmatricula,
requisito_alumno_cca.idrequisito,
requisitos_cca.descripcion,
requisito_alumno_cca.estado
FROM
requisito_alumno_cca
INNER JOIN requisitos_cca ON requisitos_cca.idrequisito = requisito_alumno_cca.idrequisito

where requisito_alumno_cca.idmatricula=$id");

         
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchALL();
    }
    
       
     function list_requerimientos_alumno($id) {
        
         
         $stmt = $this->db->prepare("
SELECT
count(requisito_alumno_cca.estado)as cantidad
FROM
requisito_alumno_cca
INNER JOIN requisitos_cca ON requisitos_cca.idrequisito = requisito_alumno_cca.idrequisito

where requisito_alumno_cca.estado=1 and requisito_alumno_cca.idmatricula=$id");

         
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchALL();
    }
    
    
         function cantidad_requerimientos($id) {
        
         
         $stmt = $this->db->prepare("
SELECT
count(requisitos_cca.descripcion) as cantidadc
FROM
requisitos_cca

where requisitos_cca.idcomision=$id");

         
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchALL();
    }
    
    

    
    
        
     function promeido_alumno($id) {
        $stmt = $this->db->prepare("
SELECT

Sum(tipo_evaluacion_cca.ponderado*evaluacion_cca.nota)as suma_ponderados,

evaluacion_cca.idmatricula
FROM
evaluacion_cca
INNER JOIN asignatura_cca ON asignatura_cca.idasignatura = evaluacion_cca.idasignatura
INNER JOIN tipo_evaluacion_cca ON tipo_evaluacion_cca.idtipo_evaluacion = evaluacion_cca.idtipo_evaluacion
WHERE evaluacion_cca.idmatricula=$id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchALL();
    }
    
    function cantidad_asignaturas_alumno($id){
            $stmt = $this->db->prepare(" SELECT COUNT(asignatura_cca.idasignatura) as cursos,

asignatura_cca.idcomision
FROM
asignatura_cca
INNER JOIN comision_cca ON comision_cca.idcomision = asignatura_cca.idcomision
where asignatura_cca.idcomision=$id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchALL();
        
    }
    
    
    

}

?>
