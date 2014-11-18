<?php

include_once("../lib/dbfactory.php");

class pagos_cca extends Main {

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

    function insert($_G) {
        
        
         $sql5 = "SELECT
                        sum(amortizacion_cca.monto) as motnA
                        FROM
                        cronograma_cca
                        INNER JOIN amortizacion_cca ON amortizacion_cca.idcronograma = cronograma_cca.idcronograma
                    where cronograma_cca.idmatricula=".$_GET['alumno']."";
//        die($sql2);
        $montoA = $this->db->prepare($sql5);
        $montoA->execute();
        $montoAF = $montoA->fetchAll();
        $montoAF=  floatval($montoAF);
//                  print "<pre>"; print_r($montoAF[0]); print "</pre>\n";exit();
           $sql6 = "SELECT
                        sum(cronograma_cca.monto) as montoC
                        FROM
                        cronograma_cca
                        where cronograma_cca.idmatricula=".$_GET['alumno']."";
//        die($sql2);
        $montoC = $this->db->prepare($sql6);
        $montoC->execute();
        $montoCF = $montoC->fetchAll();
       
$montoCF=floatval($montoCF);
//$row=  count($CA);
//                          print "<pre>"; print_r($montoCF[0]); print "</pre>\n";exit();
        
//        if ($montoA==$montoCF){
//            echo "ola";
//            
//        }
//exit();
//    if ($montoA!= $montoCF){
//    
//    
//        die($_GET['monto']."-".$_GET['fecha_p']."-".$_GET['alumno']."-".$_GET['fecha_r']."-".$_GET['voucher']."-".$_GET['idusuario']);

        $sentencia = $this->db->query("SELECT MAX(idpago) as cant from pago_cca");
        $ct = $sentencia->fetch();
        $xd = 1 + (int) $ct['cant'];

//        echo $xd;
//        exit();
        $sql = $this->Query("sp_pago_cca(0,:p1,:p2,:p3,:p4,:p5,:p6,:p7)");
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':p1', $xd, PDO::PARAM_INT);
        $stmt->bindValue(':p2', $_GET['alumno'], PDO::PARAM_INT);
        $stmt->bindValue(':p3', $_GET['idusuario'], PDO::PARAM_INT);
        $stmt->bindValue(':p4', $_GET['voucher'], PDO::PARAM_STR);
        $stmt->bindValue(':p5', $_GET['monto'], PDO::PARAM_INT);
        $stmt->bindValue(':p6', $_GET['fecha_p'], PDO::PARAM_STR);
        $stmt->bindValue(':p7', $_GET['fecha_r'], PDO::PARAM_STR);



        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();

        $sentencia2 = $this->db->query("SELECT MAX(idpago) as cant from pago_cca");
        $ct2 = $sentencia2->fetch();
        $idpago = (int) $ct2['cant'];
        $idalumno = $_GET['alumno'];
        $sql2 = "SELECT cronograma_cca.idcronograma,cronograma_cca.monto FROM matricula_cca 
                    INNER JOIN cronograma_cca ON cronograma_cca.idmatricula = matricula_cca.idmatricula
                    WHERE
                    matricula_cca.idmatricula=$idalumno";
//        die($sql2);
        $cronogramas = $this->db->prepare($sql2);
        $cronogramas->execute();
        $CA = $cronogramas->fetchAll();
//$row=  count($CA);
//var_dump($CA);
//echo $CA[0][1];
//    exit();
//            $DCA=array();
        $mi =$_GET['monto'];
//        die($idpago."-".$idalumno."-".$mi);
        for ($i = 0; $i < count($CA); $i++) {
//            $DCA=array('idcronograma'=>$CA[$i]['idcronograma'],'monto'=>$CA[$i]['monto']);
//            echo $CA[$i][0] . "<br>";

            $mac = "SELECT sum(amortizacion_cca.monto) as monto FROM amortizacion_cca
                    where
                        amortizacion_cca.idcronograma=" . $CA[$i][0] . "";
            $montoca = $this->db->prepare($mac);
            $montoca->execute();
            $maca = $montoca->fetchALL(PDO::FETCH_COLUMN);
//        var_dump($maca);
//        exit();
//                       print "<pre>"; print_r($maca); print "</pre>\n";exit();
            if ($maca[0] == null) {
                $MCA1 = 0;
            } else {
                $MCA1= $maca[0];
            }
                 
            if($MCA1==0){
                $MCA=0;
            }else{
            $MCA=$MCA1-($MCA1-$CA[$i][1]);
            }
//                $MCA3=$MCA1-$CA[$i][1];
//                echo $MCA3;
//                    exit();
//            echo $MCA."-".$CA[$i][1];
//                exit();
            if($MCA == $CA[$i][1]) {
                
                       $sql4="update cronograma_cca set estado=1 where idcronograma=".$CA[$i][0]."";
                      $updatecrono = $this->db->prepare($sql4);
                     $updatecrono->execute();
            }
                
                  if($MCA < $CA[$i][1] || $MCA=0 ){
                
                  $sql4="update cronograma_cca set estado=0 where idcronograma=".$CA[$i][0]."";
                      $updatecrono = $this->db->prepare($sql4);
                  $updatecrono->execute();
                  
                  }
                
           
            
            
            if($MCA !=$CA[$i][1] || $MCA !=$CA[$i+1][1]){
                
//           print "<pre>"; print_r($maca); print "</pre>\n";exit();
                
                
                 if ( $mi <= $CA[$i][1]) {
//                                 echo($mi);
//                                                                  exit();
                $sql3="insert into amortizacion_cca values('',".$CA[$i][0].",$idpago,$mi);";
//                die($sql3);
                 $iamorti = $this->db->prepare($sql3);
                 $iamorti->execute();
//                die($sql3);
//                  $sql4="update cronograma_cca set estado=0 where idcronograma=".$CA[$i][0]."";
//                die($sql3);
//                 $updatecrono = $this->db->prepare($sql4);
//                 $updatecrono->execute();
//                die($sql3);
            }
                
                 if ($mi > $CA[$i][1]) {
                 
                 $ms=$mi-$CA[$i][1];
                 
                                  $mif=$mi-$ms;
//   die($ms."- ".$mif);
             
                $sql4="insert into amortizacion_cca values('',".$CA[$i][0].",$idpago,$mif);";
                 $iamorti2 = $this->db->prepare($sql4);
                 $iamorti2->execute();
                 
                  $sql5="insert into amortizacion_cca values('',".$CA[$i+1][0].",$idpago,$ms);";
                 $iamorti3 = $this->db->prepare($sql5);
                 $iamorti3->execute();
//                die($sql3);
            
//                  $sql4="update cronograma_cca set estado=1 where idcronograma=".$CA[$i][0]."";
//                   $sql4="update cronograma_cca set estado=0 where idcronograma=".$CA[$i+1][0]."";
//                die($sql3);
//                 $updatecrono = $this->db->prepare($sql4);
//                 $updatecrono->execute();
                 
                 
                 
                 }
                
                
                
                
           
           


            break;
//             echo "<script>alert('Se inserto el pagos');window.location='index.php?controller=pagos_cca'</script>";
        }
       

        
            }
            return array($p1, $p2[2]);
//    }
//    
//        echo "<script>alert('El Alumno ya cancelo toda su Deuda y no necesita pagar :". $_GET['monto']."');window.location='index.php?controller=pagos_cca';</script>";
//   
//        
        
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

    function monto_comision($id) {
        $sql = "SELECT 
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
