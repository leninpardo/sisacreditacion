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
WHERE detalle_proceso_proyecto.idproyecto=".$id." and proceso_proyecto.subprocesos=0");
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
            //$imagen=empty($vars["documento"])? $vars["tmpdocumento"] : $vars["documento"];
             // if(move_uploaded_file($_FILES['documento']['temp_name'], 'web/documentos/')){
                   
              $stmt->bindValue(':p1', $_P["id_proyecto"] , PDO::PARAM_INT);
              $stmt->bindValue(':p2', $_P['select_proceso'], PDO::PARAM_INT);
              $stmt->bindValue(':p3', $_P['fecha_i'] , PDO::PARAM_STR);       
              $stmt->bindValue(':p4', $_P['fecha_l'] , PDO::PARAM_STR); 
              $stmt->execute();   
              $p2 = $stmt->errorInfo();
               $array= array("rep"=>1 , "msg"=>$p2);
               /*}else{
                    $array= array("rep"=>2 , "msg"=>"no se pudo cargar el archivo");
               }*/
           //$stmt->db->commit();            
             
                            
       
        }  catch (PDOException $e)
        {
           // $this->db->rollback();
           // $stmt->rollBack();
            $array= array("rep"=>2,"msg"=>$e->getMessage());
        }
        return $array;
    }
    
            function update_docentes($_P) {
                $st=  $this->db->prepare("SELECT CONCAT(NombreProfesor,' ',ApellidoPaterno,' ', ApellidoMaterno) as docente from profesores where CodigoProfesor='".$_P['docentes']."'");
                $st->execute();
                $data=$st->fetchAll();
        $sql2 = ("UPDATE detalle_proceso_proyecto set detalle_proceso_proyecto.Ingeniero=:p3,detalle_proceso_proyecto.nombre_ingeniero=:p4
where detalle_proceso_proyecto.idproyecto=:p1 and detalle_proceso_proyecto.idproceso_proyecto=:p2");
        $stmt = $this->db->prepare($sql2);
        $stmt->bindValue(':p1', $_P["id_proyecto"], PDO::PARAM_INT);
        $stmt->bindValue(':p2', $_P['idproceso'], PDO::PARAM_INT);
        $stmt->bindValue(':p3', $_P['docentes'], PDO::PARAM_STR);
        $stmt->bindValue(':p4', $data[0][0], PDO::PARAM_STR);
        $stmt->execute();
        $p2 = $stmt->errorInfo();
        return $array = array("rep" => 1, "msg" => $p2);
    }

    function update_procesos($_P)
    {
       $sql2 = ("UPDATE detalle_proceso_proyecto set detalle_proceso_proyecto.fecha_finalizacion=:p3,detalle_proceso_proyecto.estado=2 ,
           detalle_proceso_proyecto.descripcion=:p4
where detalle_proceso_proyecto.idproyecto=:p1 and detalle_proceso_proyecto.idproceso_proyecto=:p2");
          $stmt = $this->db->prepare($sql2);
  

              $stmt->bindValue(':p1', $_P["id_proyecto"] , PDO::PARAM_INT);
              $stmt->bindValue(':p2', $_P['idproceso'], PDO::PARAM_INT);
              $stmt->bindValue(':p3', $_P['fecha_e'], PDO::PARAM_STR);
              $stmt->bindValue(':p4', $_P['obs'], PDO::PARAM_STR);
             // $stmt->bindValue(':p5', $_P['docentes'], PDO::PARAM_STR);
              $stmt->execute();   
              $p2 = $stmt->errorInfo();
                 $array= array("rep"=>1 , "msg"=>$p2);
                 ////
                $id_proceso=$_P['idproceso']+1;
              $stmt4=  $this->db->prepare("select * from proceso_proyecto where idproceso_proyecto=".$id_proceso);
              $stmt4->execute();
              $datos_procesos=$stmt4->fetchAll();
              
              
              //hacemos automaticamnte que siguiente proceso
        $fecha_limite = self:: calcular_fecha(date('Y-m-d'), $datos_procesos[0][4]);
        $sql3 = $this->Query("usp_detalle_procesos(:p1,:p2,:p3,:p4,1)");
        $stmt3 = $this->db->prepare($sql3);
        $stmt3->bindValue(':p1', $_P["id_proyecto"], PDO::PARAM_INT);
        $stmt3->bindValue(':p2', $id_proceso, PDO::PARAM_INT);
        $stmt3->bindValue(':p3', date("Y-m-d"), PDO::PARAM_STR);
        $stmt3->bindValue(':p4', $fecha_limite, PDO::PARAM_STR);
        $stmt3->execute();
        $p3 = $stmt3->errorInfo();
        $array = array("rep" => 1, "msg" => $p3);
        
        ///verificamos si tiene subprocesos
                $stmt5=  $this->db->prepare("select * from proceso_proyecto where subprocesos=".$id_proceso);
              $stmt5->execute();
              $datos_sub_procesos=$stmt5->fetchAll();
              
    if($datos_sub_procesos!=null)
    {
        foreach ($datos_sub_procesos as $ds)
        {
              //hacemos automaticamnte que siguiente proceso
                   $fecha_limite = self:: calcular_fecha(date('Y-m-d'), $ds[4]);
        $sql3 = $this->Query("usp_detalle_procesos(:p1,:p2,:p3,:p4,1)");
        $stmt3 = $this->db->prepare($sql3);
        $stmt3->bindValue(':p1', $_P["id_proyecto"], PDO::PARAM_INT);
        $stmt3->bindValue(':p2', $ds[0], PDO::PARAM_INT);
        $stmt3->bindValue(':p3', date("Y-m-d"), PDO::PARAM_STR);
        $stmt3->bindValue(':p4', $fecha_limite, PDO::PARAM_STR);
        $stmt3->execute();
        //$p3 = $stmt3->errorInfo();
        //$array = array("rep" => 1, "msg" => $p3);
        }
        
    }
    
           //$stmt->db->commit();            
           
        return $array;
    }
    
           function update_subprocesos($_P)
    {
       $sql2 = ("UPDATE detalle_proceso_proyecto set detalle_proceso_proyecto.fecha_finalizacion=:p3,detalle_proceso_proyecto.estado=2 ,
           detalle_proceso_proyecto.descripcion=:p4,detalle_proceso_proyecto.ingeniero=:p5
where detalle_proceso_proyecto.idproyecto=:p1 and detalle_proceso_proyecto.idproceso_proyecto=:p2");
          $stmt = $this->db->prepare($sql2);
  

              $stmt->bindValue(':p1', $_P["id_proyecto"] , PDO::PARAM_INT);
              $stmt->bindValue(':p2', $_P['idproceso'], PDO::PARAM_INT);
              $stmt->bindValue(':p3', $_P['fecha_e'], PDO::PARAM_STR);
              $stmt->bindValue(':p4', $_P['obs'], PDO::PARAM_STR);
              $stmt->bindValue(':p5', $_P['docentes'], PDO::PARAM_STR);
              $stmt->execute();   
              $p2 = $stmt->errorInfo();
                 $array= array("rep"=>1 , "msg"=>$p2);      
           
        return $array;
    }
        public function ver_proyecto($id) {
        $stmt2 = $this->db->prepare("SELECT nombre_proyecto,concat(profesores.NombreProfesor,' ',profesores.ApellidoPaterno) as docente from proyecto
INNER JOIN detalle_profesor_proy_fun on(detalle_profesor_proy_fun.idproyecto=proyecto.idproyecto)
INNER JOIN profesores on(profesores.CodigoProfesor=detalle_profesor_proy_fun.CodigoProfesor)
 WHERE proyecto.idproyecto=:p1");
        $stmt2->bindValue(':p1', $id, PDO::PARAM_INT);
        $stmt2->execute();
        return $stmt2->fetchAll();
    }

    public function get_docente()
    {
        /*SELECT  CodigoProfesor,concat(NombreProfesor,' ', ApellidoPaterno,'  '  ,ApellidoPaterno) as nombre  from profesores*/
             $stmt2 = $this->db->prepare("SELECT  CodigoProfesor,concat(NombreProfesor,' ', ApellidoPaterno,'  '  ,ApellidoPaterno) as nombre  from profesores where CodigoDptoAcad=07 and EstadoProfesor='A'");
      
        $stmt2->execute();
        return $stmt2->fetchAll();
        
    }
    
      public function lista_subprocesos($id,$id_p) {
       /* $stmt2 = $this->db->prepare("
SELECT proceso_proyecto.* from proceso_proyecto INNER JOIN detalle_proceso_proyecto on(proceso_proyecto.idproceso_proyecto=detalle_proceso_proyecto.idproceso_proyecto)WHERE proceso_proyecto.subprocesos=$id
UNION
SELECT proceso_proyecto.*  from proceso_proyecto LEFT  JOIN detalle_proceso_proyecto on(proceso_proyecto.idproceso_proyecto=detalle_proceso_proyecto.idproceso_proyecto)WHERE proceso_proyecto.subprocesos=".$id);
    */
          $stmt2=  $this->db->prepare("SELECT
proceso_proyecto.idproceso_proyecto,
proceso_proyecto.nombre,
proceso_proyecto.responsable,
detalle_proceso_proyecto.fecha_ingreso,
detalle_proceso_proyecto.fecha_plazo,
detalle_proceso_proyecto.fecha_finalizacion,
detalle_proceso_proyecto.descripcion,
detalle_proceso_proyecto.estado,
detalle_proceso_proyecto.ingeniero,
detalle_proceso_proyecto.nombre_ingeniero
FROM
proceso_proyecto
INNER JOIN detalle_proceso_proyecto ON proceso_proyecto.idproceso_proyecto = detalle_proceso_proyecto.idproceso_proyecto
INNER JOIN proyecto ON proyecto.idproyecto = detalle_proceso_proyecto.idproyecto
WHERE   proceso_proyecto.subprocesos=$id  and detalle_proceso_proyecto.idproyecto=".$id_p);
          //$stmt2->bindValue(':p1', $id, PDO::PARAM_INT);
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
WHERE detalle_proceso_proyecto.idproyecto=:p1)and proceso_proyecto.subprocesos=0 limit 1");
              $stmt2->bindValue(':p1', $id , PDO::PARAM_INT);
              $stmt2->execute();
              return $stmt2->fetchAll();   
    }
    public function lista_verificar_procesos_proyecto($idproyecto,$idproceso)
    {
        /**/
             $stmt2 = $this->db->prepare("SELECT
proceso_proyecto.idproceso_proyecto,
proceso_proyecto.nombre,
proceso_proyecto.responsable,
proyecto.idproyecto,
proyecto.nombre_proyecto,
detalle_proceso_proyecto.fecha_ingreso,
detalle_proceso_proyecto.fecha_plazo,
detalle_proceso_proyecto.fecha_finalizacion,
detalle_proceso_proyecto.descripcion,
detalle_proceso_proyecto.estado,
detalle_proceso_proyecto.ingeniero,
proceso_proyecto.subprocesos
FROM
proceso_proyecto
INNER JOIN detalle_proceso_proyecto ON proceso_proyecto.idproceso_proyecto = detalle_proceso_proyecto.idproceso_proyecto
INNER JOIN proyecto ON proyecto.idproyecto = detalle_proceso_proyecto.idproyecto
WHERE detalle_proceso_proyecto.idproyecto=:p1 and detalle_proceso_proyecto.idproceso_proyecto=:p2");
              $stmt2->bindValue(':p1', $idproyecto , PDO::PARAM_INT);
               $stmt2->bindValue(':p2', $idproceso , PDO::PARAM_INT);
              $stmt2->execute();
              return $stmt2->fetchAll();     
    }
    public function get_procesos_all($id){
              $stmt2 = $this->db->prepare("SELECT *FROM proceso_proyecto WHERE idproceso_proyecto=:p1");
              $stmt2->bindValue(':p1', $id , PDO::PARAM_INT);
              $stmt2->execute();
              return $stmt2->fetchObject();
    }


}
?>