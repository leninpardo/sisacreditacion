<?php
include_once("../lib/dbfactory.php");
class proyecto extends Main{    
    function index($query,$p,$c) 
    {
        $sql = "    SELECT
                        proyecto.idproyecto,
                        proyecto.nombre_proyecto,
                        proyecto.periodo_ejecucion,
                        proyecto.presupuesto
                        FROM
                        proyecto
                        where ".$c." like :query";         
        $param = array(array('key'=>':query' , 'value'=>"%$query%" , 'type'=>'STR' ));
        $data['total'] = $this->getTotal( $sql, $param );
        $data['rows'] =  $this->getRow($sql, $param , $p );        
        $data['rowspag'] = $this->getRowPag($data['total'], $p );        
        return $data;
    }
    
    
    function edit($id ) 
    {
        $stmt = $this->db->prepare("SELECT * FROM proyecto WHERE idproyecto = :id");
        $stmt->bindValue(':id', $id , PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchObject();
    }
    
    function insert($_P ) {        
        $sentencia=$this->db->query("SELECT MAX(idproyecto) as cant from proyecto");         
        $ct=$sentencia->fetch();      
        $xd=1+(int)$ct['cant'];
               
        $sql = $this->Query("sp_proyec_iu(0,:p1,:p2,:p3,:p4,:p5,:p6,:p7,:p8,:p9,:p10,:p11,:p12,:p13,:p14,:p15,:p16,:p17,:p18,:p19,:p20,:p21,:p22,:p23,:p24,:p25,:p26,:p27,:p28,:p29,:p30,:p31,:p32,:p33,:p34)");
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':p1', $xd , PDO::PARAM_INT);
        $stmt->bindValue(':p2', $_P['nombre_proyecto'] , PDO::PARAM_STR);
        $stmt->bindValue(':p3', $_P['periodo_ejecucion'] , PDO::PARAM_STR);
        $stmt->bindValue(':p4', $_P['idtipo_proyecto'] , PDO::PARAM_INT);
        $stmt->bindValue(':p5', $_P['distrito'] , PDO::PARAM_INT);
        $stmt->bindValue(':p6', $_P['idlinea_investigacion'] , PDO::PARAM_INT);
        $stmt->bindValue(':p7', $_P['antecedentes_problema'] , PDO::PARAM_STR);
        $stmt->bindValue(':p8', $_P['definicion_problema'] , PDO::PARAM_STR);
        $stmt->bindValue(':p9', $_P['formulacion_problema'] , PDO::PARAM_STR);
        $stmt->bindValue(':p10', $_P['justificacion'] , PDO::PARAM_STR);
        $stmt->bindValue(':p11', $_P['importancia'] , PDO::PARAM_STR);
        $stmt->bindValue(':p12', $_P['limitaciones'] , PDO::PARAM_STR);
        $stmt->bindValue(':p13', $_P['objetivo_general'] , PDO::PARAM_STR);
        $stmt->bindValue(':p14', $_P['antecedentes_investigacion'] , PDO::PARAM_STR);
        $stmt->bindValue(':p15', $_P['definicion_terminos'] , PDO::PARAM_STR);
        $stmt->bindValue(':p16', $_P['bases_teoricas'] , PDO::PARAM_STR);
        $stmt->bindValue(':p17', $_P['hipotesis'] , PDO::PARAM_STR);
        $stmt->bindValue(':p18', $_P['sistema_variables'] , PDO::PARAM_STR);
        $stmt->bindValue(':p19', $_P['escala_medicion'] , PDO::PARAM_INT);
        $stmt->bindValue(':p20', $_P['tipo_investigacion'] , PDO::PARAM_STR);
        $stmt->bindValue(':p21', $_P['nivel_investigacion'] , PDO::PARAM_STR);
        $stmt->bindValue(':p22', $_P['disenio_investigacion'] , PDO::PARAM_STR);
        $stmt->bindValue(':p23', $_P['cobertura_investigacion'] , PDO::PARAM_STR);
        $stmt->bindValue(':p24', $_P['fuente_investigacion'] , PDO::PARAM_STR);
        $stmt->bindValue(':p25', $_P['tecnicas_investigacion'] , PDO::PARAM_STR);
        $stmt->bindValue(':p26', $_P['instrumentos_invesitgacion'] , PDO::PARAM_STR);
        $stmt->bindValue(':p27', $_P['presentacion_datos'] , PDO::PARAM_STR);
        $stmt->bindValue(':p28', $_P['analisis_datos'], PDO::PARAM_STR);
        $stmt->bindValue(':p29', $_P['interpretacion_datos'] , PDO::PARAM_STR);
        $stmt->bindValue(':p30', $_P['presupuesto'] , PDO::PARAM_INT);
        $stmt->bindValue(':p31', $_P['asignacion_recursos'] , PDO::PARAM_STR);
        $stmt->bindValue(':p32', $_P['financiamiento'] , PDO::PARAM_INT);
        $stmt->bindValue(':p33', $_P['CodigoEscuela'] , PDO::PARAM_INT);
        $stmt->bindValue(':p34', 0, PDO::PARAM_INT);
         $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
   ///
  foreach ($_P['ubigeo'] as $u)
   {
      $stmt2=  $this->db->prepare("insert into detalle_proyecto_ubigeo(idproyecto,ubigeo)values(:p1,:p2)");
      $stmt2->bindValue(":p1", $xd, PDO::PARAM_INT);
      $stmt2->bindValue(":p2", $u, PDO::PARAM_STR);
      $p1=$stmt2->execute();
       $p2 = $stmt->errorInfo();
   }
   ///    
   $sent = $this->db->prepare("select max(idcontrol_proyecto)+1 from control_proyecto");
        $sent->execute();
        $data = $sent->fetchAll();

        $stmt3 = $this->db->prepare("insert into control_proyecto(idcontrol_proyecto,CodigoProfesor,fecha,idestado_proyecto,idproyecto,observaciones)
values(:p1,:p2,:p3,1,:p5,'Inicio del proyecto')");
        $stmt3->bindValue(":p1", $data[0][0], PDO::PARAM_INT);
        $stmt3->bindValue(":p2", $_SESSION['idusuario'], PDO::PARAM_INT);
        $stmt3->bindValue(":p3", date('Y-m-d'), PDO::PARAM_STR);
        $stmt3->bindValue(":p5", $xd, PDO::PARAM_INT);
        $p1 = $stmt3->execute();
        $p2 = $stmt3->errorInfo();
        ////
         $fecha_limite = self:: calcular_fecha(date('Y-m-d'), $datos_procesos[0][4]);
        $sql2 = $this->Query("usp_detalle_procesos(:p1,:p2,:p3,:p4,1)");
        $stmt4 = $this->db->prepare($sql2);
        $stmt4->bindValue(':p1', $xd, PDO::PARAM_INT);
        $stmt4->bindValue(':p2', 1, PDO::PARAM_INT);
        $stmt4->bindValue(':p3', date("Y-m-d"), PDO::PARAM_STR);
        $stmt4->bindValue(':p4', $fecha_limite, PDO::PARAM_STR);
        $stmt4->execute();
        $p = $stmt4->errorInfo();
    
               $array= array("rep"=>1 , "msg"=>$p2);
        return array($p1 , $p2);
    }
    
       public function calcular_fecha($fecha,$n_dias) {
        $fecha_inicio = $fecha;
        
        $fecha_despues = self::operacion_fecha(self::validar_fecha2($fecha_inicio), $n_dias);
        $fechats = strtotime($fecha_despues); //a timestamp

//el parametro w en la funcion date indica que queremos el dia de la semana
//lo devuelve en numero 0 domingo, 1 lunes,....
switch (date('w', $fechats)){
    case 0: $nd= "Domingo"; $ret=1;break;
    case 1: $nd= "Lunes"; $ret=0;break;
    case 2: $nd= "Martes"; $ret=0; break;
    case 3: $nd= "Miercoles"; $ret=0; break;
    case 4: $nd= "Jueves"; $ret=0; break;
    case 5: $nd= "Viernes"; $ret=0; break;
    case 6: $nd= "Sabado"; $ret=2;break;
}
if($ret>0)
{
    $fecha_despues=self::operacion_fecha(self::validar_fecha2($fecha_despues), $ret);
}
return ((self::validar_fecha($fecha_despues)));
    }
    
       public function operacion_fecha($fecha, $dias) {
     list ($dia,$mes,$ano)=explode("-",$fecha); 
if (!checkdate($mes,$dia,$ano)){return false;} 
$dia=$dia+$dias; 
$fecha=date( "d-m-Y", mktime(0,0,0,$mes,$dia,$ano) ); 
return $fecha;  
    } 
        public function validar_fecha($fecha){
$fecha = strtotime($fecha);
$anio = (date('Y',$fecha));
$mes = (date('m',$fecha));
$dia =(date('d',$fecha));
return $anio.'-'.$mes.'-'.$dia;
}
       public function validar_fecha2($fecha){
$fecha = strtotime($fecha);
$anio = (date('Y',$fecha));
$mes = (date('m',$fecha));
$dia =(date('d',$fecha));
return $dia.'-'.$mes.'-'.$anio;
}
    function insert_ob_esp($_P ) {
        
        $sentencia=$this->db->query("SELECT MAX(idobjetivo_proyecto) as cant from objetivo_proyecto");         
        $ct=$sentencia->fetch();      
        $xd=1+(int)$ct['cant'];
        
        $sentencia1=$this->db->query("SELECT MAX(idproyecto) as cant from proyecto");         
        $ct1=$sentencia1->fetch();      
        $xd1=(int)$ct1['cant'];
        
           
        $sql = $this->Query("sp_objproyec_iu(0,:p1,:p2,:p3)");
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':p1', $xd , PDO::PARAM_INT);
        $stmt->bindValue(':p2', $_P , PDO::PARAM_STR);
        $stmt->bindValue(':p3', $xd1 , PDO::PARAM_INT);
        
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
         return array($p1 , $p2[2]); 
       
    }
    function insert_det_proy_prof_fun($_P ) {
        
        
        $sentencia1=$this->db->query("SELECT MAX(idproyecto) as cant from proyecto");         
        $ct1=$sentencia1->fetch();      
        $xd1=(int)$ct1['cant'];
        
           
        $sql = $this->Query("sp_det_prof_insert(:p1,:p2,:p3)");
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':p1', $_SESSION['idusuario'] , PDO::PARAM_INT);
        $stmt->bindValue(':p2', $xd1 , PDO::PARAM_STR);
        $stmt->bindValue(':p3', 2 , PDO::PARAM_INT);
        
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
         return array($p1 , $p2[2]); 
       
    }
    
    
//    function update_ob_esp($_P ) {
//        
//        $sql = $this->Query("sp_objproyec_iu(1,:p1,:p2,:p3)");
//        $stmt = $this->db->prepare($sql);
//        if($_P['idpadre']==""){$_P['idpadre']=null;}
////        El idobjetivo_proyecto no me trae del form
//        $stmt->bindValue(':p1', $xd , PDO::PARAM_INT);
//        $stmt->bindValue(':p2', $_P , PDO::PARAM_STR);
//        $stmt->bindValue(':p3', $_P['idproyecto'] , PDO::PARAM_INT);
//        
//        $p1 = $stmt->execute();
//        $p2 = $stmt->errorInfo();
//         return array($p1 , $p2[2]); 
//       
//        
//        
//    }
    function update($_P ) {
        
        $sql = $this->Query("sp_proyec_iu(1,:p1,:p2,:p3,:p4,:p5,:p6,:p7,:p8,:p9,:p10,:p11,:p12,:p13,:p14,:p15,:p16,:p17,:p18,:p19,:p20,:p21,:p22,:p23,:p24,:p25,:p26,:p27,:p28,:p29,:p30,:p31,:p32,:p33,:p34))");
        $stmt = $this->db->prepare($sql);
        if($_P['idpadre']==""){$_P['idpadre']=null;}
        $stmt->bindValue(':p1', $_P['idproyecto'] , PDO::PARAM_INT);
        $stmt->bindValue(':p2', $_P['nombre_proyecto'] , PDO::PARAM_STR);
        $stmt->bindValue(':p3', $_P['periodo_ejecucion'] , PDO::PARAM_STR);
        $stmt->bindValue(':p4', $_P['idtipo_proyecto'] , PDO::PARAM_INT);
        $stmt->bindValue(':p5', $_P['distrito'] , PDO::PARAM_INT);
        $stmt->bindValue(':p6', $_P['idlinea_investigacion'] , PDO::PARAM_INT);
        $stmt->bindValue(':p7', $_P['antecedentes_problema'] , PDO::PARAM_STR);
        $stmt->bindValue(':p8', $_P['definicion_problema'] , PDO::PARAM_STR);
        $stmt->bindValue(':p9', $_P['formulacion_problema'] , PDO::PARAM_STR);
        $stmt->bindValue(':p10', $_P['justificacion'] , PDO::PARAM_STR);
        $stmt->bindValue(':p11', $_P['importancia'] , PDO::PARAM_STR);
        $stmt->bindValue(':p12', $_P['limitaciones'] , PDO::PARAM_STR);
        $stmt->bindValue(':p13', $_P['objetivo_general'] , PDO::PARAM_STR);
        $stmt->bindValue(':p14', $_P['antecedentes_investigacion'] , PDO::PARAM_STR);
        $stmt->bindValue(':p15', $_P['definicion_terminos'] , PDO::PARAM_STR);
        $stmt->bindValue(':p16', $_P['bases_teoricas'] , PDO::PARAM_STR);
        $stmt->bindValue(':p17', $_P['hipotesis'] , PDO::PARAM_STR);
        $stmt->bindValue(':p18', $_P['sistema_variables'] , PDO::PARAM_STR);
        $stmt->bindValue(':p19', $_P['escala_medicion'] , PDO::PARAM_INT);
        $stmt->bindValue(':p20', $_P['tipo_investigacion'] , PDO::PARAM_STR);
        $stmt->bindValue(':p21', $_P['nivel_investigacion'] , PDO::PARAM_STR);
        $stmt->bindValue(':p22', $_P['disenio_investigacion'] , PDO::PARAM_STR);
        $stmt->bindValue(':p23', $_P['cobertura_investigacion'] , PDO::PARAM_STR);
        $stmt->bindValue(':p24', $_P['fuente_investigacion'] , PDO::PARAM_STR);
        $stmt->bindValue(':p25', $_P['tecnicas_investigacion'] , PDO::PARAM_STR);
        $stmt->bindValue(':p26', $_P['instrumentos_invesitgacion'] , PDO::PARAM_STR);
        $stmt->bindValue(':p27', $_P['presentacion_datos'] , PDO::PARAM_STR);
        $stmt->bindValue(':p28', $_P['analisis_datos'], PDO::PARAM_STR);
        $stmt->bindValue(':p29', $_P['interpretacion_datos'] , PDO::PARAM_STR);
        $stmt->bindValue(':p30', $_P['presupuesto'] , PDO::PARAM_INT);
        $stmt->bindValue(':p31', $_P['asignacion_recursos'] , PDO::PARAM_STR);
        $stmt->bindValue(':p32', $_P['financiamiento'] , PDO::PARAM_INT);
        $stmt->bindValue(':p33', $_P['CodigoEscuela'] , PDO::PARAM_INT);

        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
    function delete($p) { 	
        $stmt1 = $this->db->prepare("DELETE FROM objetivo_proyecto WHERE idproyecto = :p1");
        $stmt1->bindValue(':p1', $p, PDO::PARAM_INT);
        $p1 = $stmt1->execute();
        $p2 = $stmt1->errorInfo();
        
        $stmt = $this->db->prepare("DELETE FROM proyecto WHERE idproyecto = :p1");
        $stmt->bindValue(':p1', $p, PDO::PARAM_INT);
        $p3 = $stmt->execute();
        $p4 = $stmt->errorInfo();
        return array($p1 , $p2[2], $p3 , $p4[2]);
    }
}
?>
