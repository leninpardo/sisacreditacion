<?php

include_once("../lib/dbfactory.php");

class matricula_cca extends Main {

//    function index($query,$p,$c) 
//    {
//        
//       
//        $sql = " SELECT
//                matricula_cca.idmatricula,
//                alumno_cca.nombres,
//                comision_cca.comision,
//                matricula_cca.nombre_proyecto,
//                matricula_cca.fecha
//                FROM
//                alumno_cca
//                INNER JOIN matricula_cca ON alumno_cca.idalumno = matricula_cca.idalumno
//                INNER JOIN comision_cca ON comision_cca.idcomision = matricula_cca.idcomision 
//
//                        WHERE ".$c." like :query ";         
//        $param = array(array('key'=>':query' , 'value'=>"%$query%" , 'type'=>'STR' ));
//        $data['total'] = $this->getTotal( $sql, $param );
//        $data['rows'] =  $this->getRow($sql, $param , $p );        
//        $data['rowspag'] =  $this->getRowPag($data['total'], $p );        
//        return $data;
//    }       
    function edit($id) {
        $stmt = $this->db->prepare("SELECT * FROM matricula_cca WHERE idmatricula = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchObject();
    }

    function insert($_P) {
            
            
         $compro = $this->db->query("SELECT count(*) as numero from matricula_cca where idalumno=".$_POST['idalumno']."");
        $rows = $compro->fetch();
          if ($rows['numero']>=1){
            
            echo "<script>alert('El alumno ya se encuentra  matriculado');window.location='index.php?controller=matricula_cca';</script>";
             return array($p1, $p2[2]);
        }else{

        $sentencia = $this->db->query("SELECT MAX(idmatricula) as cant FROM matricula_cca");
        $ct = $sentencia->fetch();
        $xd = (int) $ct['cant'] + 1;

        $id = $xd;

        $sql = $this->Query("sp_matricula_iu_cca(0,:p1,:p2,:p3,:p4,:p5)");
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':p1', $id, PDO::PARAM_INT);
        $stmt->bindValue(':p2', $_P['idalumno'], PDO::PARAM_INT);
        $stmt->bindValue(':p3', $_P['idcomision'], PDO::PARAM_INT);
        $stmt->bindValue(':p4', $_P['nombre_proyecto'], PDO::PARAM_STR);
        $stmt->bindValue(':p5', $_P['fecha'], PDO::PARAM_INT);

        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();

        $sentencia2 = $this->db->query("SELECT MAX(idmatricula) as cant FROM matricula_cca");
        $ct2 = $sentencia2->fetch();
        $idalumno = (int) $ct2['cant'];
 
//         echo $idalumno;
//         exit();

        
                       $sentencia3 = $this->db->query("SELECT
requisitos_cca.idrequisito

FROM
comision_cca
INNER JOIN requisitos_cca ON comision_cca.idcomision = requisitos_cca.idcomision
 where requisitos_cca.idcomision=".$_P['idcomision']."");
//                       die("SELECT
//requisitos_cca.idrequisito
//
//FROM
//comision_cca
//INNER JOIN requisitos_cca ON comision_cca.idcomision = requisitos_cca.idcomision
// where requisitos_cca.idcomision=".$_P['idcomision']."");
        $requerimientos = $sentencia3->fetchALL();
//        print "<pre>"; print_r($requerimientos); print "</pre>\n";exit();
         for ($j = 0; $j < count($requerimientos); $j++) {
             
             $sql="insert into requisito_alumno_cca values('',".$idalumno.",".$requerimientos[$j][0].",'',0)";
               
                $sentencia = $this->db->prepare($sql);


                
                $sentencia->execute();
         }
//        $sql="insert into requisito_alumno_cca values('',".$idalumno.",".$requerimientos[0][0].",'".$_P['fecha']."',0)";
        
//         $sql="insert into requisito_alumno_cca values('',".$idalumno.",".$requerimientos[$i][0].",'',0)";
//         die($sql);
        
        
        for ($i = 0; $i < count($_POST['fechacrono']); $i++) {

//              echo $_GET['fechacrono'][$i]."<br>";
//              echo strlen($_GET['fechacrono'][$i])."--<br>";
//              echo substr($_GET['fechacrono'][$i],-10)."<br>";

            if (strlen($_POST['fechacrono'][$i]) == 23) {


                $sql = "insert into cronograma_cca values(''," . $idalumno . ",'" . substr($_POST['fechacrono'][$i], -10) . "'," . $_POST['montoc'] . ",'bien')";
//                             die($sql);
                $sentencia = $this->db->prepare($sql);



                $sentencia->execute();
            }
            if (strlen($_POST['fechacrono'][$i]) == 10) {


                $sql = "insert into cronograma_cca values(''," . $idalumno . ",'" . $_POST['fechacrono'][$i] . "'," . $_POST['montoc'] . ",'bien')";
//                             die($sql);
                $sentencia = $this->db->prepare($sql);



                $sentencia->execute();
            }
//
//     
//                            
//            
        }
        echo "<script>alert('Se inserto el cronograma de pagos');window.location='index.php?controller=matricula_cca'</script>";
        return array($p1, $p2[2]);
        }
       
    }
   
    function update($_P) {
        $sql = $this->Query("sp_matricula_iu_cca(1,:p1,:p2,:p3,:p4,:p5)");
        $stmt = $this->db->prepare($sql);
        if ($_P['idpadre'] == "") {
            $_P['idpadre'] = null;
        }
        $stmt->bindValue(':p1', $_P['idmatricula'], PDO::PARAM_STR);
        $stmt->bindValue(':p2', $_P['idalumno'], PDO::PARAM_INT);
        $stmt->bindValue(':p3', $_P['idcomision'], PDO::PARAM_INT);
        $stmt->bindValue(':p4', $_P['nombre_proyecto'], PDO::PARAM_STR);
        $stmt->bindValue(':p5', $_P['fecha'], PDO::PARAM_INT);

        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1, $p2[2]);
    }

    function delete($p) {
        $stmt = $this->db->prepare("DELETE FROM matricula_cca WHERE idmatricula = :p1");
        $stmt->bindValue(':p1', $p, PDO::PARAM_STR);
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1, $p2[2]);
    }

    function comision_actual() {
        $fechaA = date("Y-m-d");

        $sql = "SELECT
            comision_cca.idcomision,
            comision_cca.comision,
            comision_cca.fecha_inicio
            FROM
            comision_cca
            WHERE
            comision_cca.fecha_inicio <= '" . $fechaA . "' AND
            comision_cca.fecha_termino >= '$fechaA'";

        $sth = $this->db->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }

    function lista_mat($query, $p, $c) {

        $sql = " SELECT
                matricula_cca.idmatricula as idalumno,
                alumno_cca.nombres as nombres,
                comision_cca.comision,
                matricula_cca.nombre_proyecto,
                matricula_cca.fecha
                FROM
                alumno_cca
                INNER JOIN matricula_cca ON alumno_cca.idalumno = matricula_cca.idalumno
                INNER JOIN comision_cca ON comision_cca.idcomision = matricula_cca.idcomision 

                        WHERE " . $c . " like :query ";
        $param = array(array('key' => ':query', 'value' => "%$query%", 'type' => 'STR'));
        $data['total'] = $this->getTotal($sql, $param);
        $data['rows'] = $this->getRow($sql, $param, $p);
        $data['rowspag'] = $this->getRowPag($data['total'], $p);
        return $data;
    }

}

?>
