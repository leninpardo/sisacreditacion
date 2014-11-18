<?php
include_once("../lib/dbfactory.php");
class docente_cca extends Main{    
    function index($query,$p,$c) 
    {
            $sql = "    SELECT
                        docente_cca.iddocente,
                        docente_cca.nombres,
                        concat(docente_cca.apellidop,' ',docente_cca.apellidom) as apellidos,
                        docente_cca.dni,
                        docente_cca.telefono
                        FROM
                        docente_cca
                        where ".$c." like :query";
              
        $param = array(array('key'=>':query' , 'value'=>"%$query%" , 'type'=>'STR' ));
        $data['total'] = $this->getTotal( $sql, $param );
        $data['rows'] =  $this->getRow($sql, $param , $p );        
        $data['rowspag'] = $this->getRowPag($data['total'], $p );   
        
        //                print "<pre>"; print_r($maca); print "</pre>\n";exit();

        return $data;
    }
    
    function edit($id ) 
    {
        $stmt = $this->db->prepare("SELECT * FROM docente_cca WHERE iddocente = :id");
        $stmt->bindValue(':id', $id , PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchObject();
    }
    function insert($_P ) {
        
//          print "<pre>"; print_r($_POST['dni']); print "</pre>\n";exit();

        
        
        $sentencia=$this->db->query("SELECT MAX(iddocente) as cant from docente_cca");         
        $ct=$sentencia->fetch();      
        $xd=1+(int)$ct['cant'];
               
        
        $sql = $this->Query("sp_docente_iu_cca(0,:p1,:p2,:p3,:p4,:p5,:p6,:p7,:p8,:p9)");
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':p1', $xd , PDO::PARAM_INT);
        $stmt->bindValue(':p2', $_P['nombres'] , PDO::PARAM_STR);
        $stmt->bindValue(':p3', $_P['apellidop'] , PDO::PARAM_STR);
        $stmt->bindValue(':p4', $_P['apellidom'] , PDO::PARAM_STR);
        $stmt->bindValue(':p5', $_P['dni'] , PDO::PARAM_INT);
        $stmt->bindValue(':p6', $_P['sexo'] , PDO::PARAM_STR);
        $stmt->bindValue(':p7', $_P['direccion'] , PDO::PARAM_STR);
        $stmt->bindValue(':p8', $_P['telefono'] , PDO::PARAM_STR);
        $stmt->bindValue(':p9', $_P['pass'], PDO::PARAM_STR);
        
        
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
    function update($_P ) {
        
        $sql = $this->Query("sp_docente_iu_cca(1,:p1,:p2,:p3,:p4,:p5,:p6,:p7,:p8)");
        $stmt = $this->db->prepare($sql);
        if($_P['idpadre']==""){$_P['idpadre']=null;}       
        $stmt->bindValue(':p1', $_P['iddocente'] , PDO::PARAM_INT);
        $stmt->bindValue(':p2', $_P['nombres'] , PDO::PARAM_INT);
        $stmt->bindValue(':p3', $_P['apellidop'] , PDO::PARAM_STR);
        $stmt->bindValue(':p4', $_P['apellidom'] , PDO::PARAM_STR);
        $stmt->bindValue(':p5', $_P['dni'] , PDO::PARAM_STR);
        $stmt->bindValue(':p6', $_P['sexo'] , PDO::PARAM_STR);
        $stmt->bindValue(':p7', $_P['direccion'] , PDO::PARAM_STR);
        $stmt->bindValue(':p8', $_P['telefono'] , PDO::PARAM_STR);
        
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
    function delete($p) {
        $stmt = $this->db->prepare("DELETE FROM docente_cca WHERE iddocente = :p1");
        $stmt->bindValue(':p1', $p, PDO::PARAM_INT);
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
    
    function buscar($query,$p,$c) 
    {
            $sql = "    SELECT nombres, apellidop, apellidom , dni, sexo, parametro FROM (
                        SELECT 
                        nombres as nombres, 
                        apellidop as apellidop, 
                        apellidom as apellidom, 
                        dni as dni, 
                        sexo as sexo,
                        1 as parametro FROM docente_cca
                        UNION ALL
                        SELECT 
                        NombreProfesor as nombres,
                        ApellidoPaterno as apellidop, 
                        ApellidoMaterno as apellidom, 
                        NumDocumento as dni, 
                        Sexo as sexo,
                        2 as parametro 
                        FROM profesores)
                        AS docente
                        WHERE ".$c. " like :query";
            //die($sql);
              
        $param = array(array('key'=>':query' , 'value'=>"%$query%" , 'type'=>'STR' ));
        $data['total'] = $this->getTotal( $sql, $param );
        /*var_dump($data['total']);
        exit();*/
        $data['rows'] =  $this->getRow($sql, $param , $p );        
        $data['rowspag'] = $this->getRowPag($data['total'], $p ); 
        
        return $data;
    }
    
    function buscar2($query,$p,$c) 
    {
         
            
            $sql = "    
                        SELECT
                        iddocente,
                        nombres as nombres, 
                        apellidop as apellidop, 
                        apellidom as apellidom, 
                        dni as dni, 
                        sexo as sexo
                        FROM docente_cca
                        
                        WHERE ".$c. " like :query";
            //die($sql);
              
        $param = array(array('key'=>':query' , 'value'=>"%$query%" , 'type'=>'STR' ));
        $data['total'] = $this->getTotal( $sql, $param );
        /*var_dump($data['total']);
        exit();*/
        $data['rows'] =  $this->getRow($sql, $param , $p );        
        $data['rowspag'] = $this->getRowPag($data['total'], $p ); 
        
        return $data;
    }
}
?>
