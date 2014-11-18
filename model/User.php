<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("../lib/dbfactory.php");

class User extends Main {

    function Start($user, $pass) {
        $statement = $this->db->prepare("select * from 
                                        (
select
                                                detalle_profesor_comision.CodigoProfesor as Codigo,
                                                concat( detalle_profesor_comision.CodigoProfesor) as usuario,
                                                Concat(NombreProfesor,' ',ApellidoPaterno,' ',ApellidoMaterno ) as nombres,

                                                5 as idperfil,
                                                'PRESIDENTE DE PROYECTO DE INVESTIGACION' as perfil,
                                               profesores.contrasena as contrasenia
                                                from
                                                detalle_profesor_comision
                                                inner join profesores on profesores.CodigoProfesor = detalle_profesor_comision.CodigoProfesor
                                                inner join cargo on cargo.idcargo = detalle_profesor_comision.idcargo
					inner join comision on comision.idcomision = detalle_profesor_comision.idcomision
					where comision.idcomision = 1 and cargo.idcargo = 1
                                        union all
                                          


select CodigoAlumno as Codigo,CodAlumnoSira as usuario, CONCAT(NombreAlumno,' ',ApellidoPaterno,' ',ApellidoMaterno) as  nombres, 2  as idperfil,'ALUMNO'as perfil,contrasena as  contrasenia
                                        from alumnos
                                        union all
                                        select CodigoProfesor as Codigo,CodigoProfesor as usuario, CONCAT(NombreProfesor,' ',ApellidoPaterno,' ',ApellidoMaterno) as nombres, 3 as idperfil,'PROFESOR' as perfil,contrasena as contrasenia
                                         from profesores
                                        union all
                                        select idempleado as Codigo,usuario,concat(nombres,'',apellidos)as nombres,1 as idperfil,'ADMIN'as perfil,clave as contrasenia
                                        from empleado
                                        union all
                                        SELECT
                                            matricula_cca.idmatricula as Codigo,
                                           alumno_cca.dni as usuario,
                                           CONCAT(alumno_cca.nombres,' ',
                                           alumno_cca.apellidop,' ',
                                           alumno_cca.apellidom) as nombres,
                                           8 as idperfil,
                                           'ALUMNO_CCA' as perfil,
                                           alumno_cca.pass as contrasenia
                                           FROM
                                           matricula_cca
                                           INNER JOIN alumno_cca ON matricula_cca.idalumno = alumno_cca.idalumno     


                                        union all
                                        select iddocente as Codigo, dni as usuario, CONCAT(nombres, ' ', apellidop, ' ', apellidom) as nombres,9 as idperfil, 'DOCENTE_CCA' as perfil, pass as contrasenia from docente_cca
                                        union all
                                        select idusuario as Codigo, dni as usuario, CONCAT(nombres, ' ', apellidos) as nombres, 10 as idperfil, 'USUARIO_CCA' as perfil, pass as contrasenia from usuario_cca
                                       union all
                                        select
                                                detalle_profesor_comision.CodigoProfesor as Codigo,
                                                concat( detalle_profesor_comision.CodigoProfesor) as usuario,
                                                Concat(NombreProfesor,' ',ApellidoPaterno,' ',ApellidoMaterno ) as nombres,

                                                4 as idperfil,
                                                'PRESIDENTE DE LA COMISION DE TUTORIA' as perfil,
                                                profesores.contrasena as contrasenia
                                                from
                                                detalle_profesor_comision
                                                inner join profesores on profesores.CodigoProfesor = detalle_profesor_comision.CodigoProfesor
                                                inner join cargo on cargo.idcargo = detalle_profesor_comision.idcargo
                                                inner join comision on comision.idcomision = detalle_profesor_comision.idcomision
					where comision.idcomision = 12 and cargo.idcargo = 1
																				union all
                                        select
                                                detalle_profesor_comision.CodigoProfesor as Codigo,
                                                concat( detalle_profesor_comision.CodigoProfesor) as usuario,
                                                Concat(NombreProfesor,' ',ApellidoPaterno,' ',ApellidoMaterno ) as nombres,

                                                6 as idperfil,
                                                'COMISION DE EXTENSION  Y PROYECCION UNIVERSIT' as perfil,
                                                profesores.contrasena as contrasenia
                                                from
                                                detalle_profesor_comision
                                                inner join profesores on profesores.CodigoProfesor = detalle_profesor_comision.CodigoProfesor
                                                inner join cargo on cargo.idcargo = detalle_profesor_comision.idcargo
                                                inner join comision on comision.idcomision = detalle_profesor_comision.idcomision
					where comision.idcomision = 6 and cargo.idcargo = 1
                                        union all


                                         select CodigoProfesor as Codigo, concat('admin',CodigoProfesor) as usuario, CONCAT(NombreProfesor,' ',ApellidoPaterno,' ',ApellidoMaterno) as nombres, 6 as idperfil,'PRESIDENTE EVALUACION FORMATIVA' as perfil,profesores.contrasena as contrasenia
                                        from profesores
                                        where CodigoProfesor = 0700004
                                        ) Usuarios
                                        WHERE usuario =:user AND contrasenia = :password");
        $statement->bindParam(":user", $user, PDO::PARAM_STR);
        $statement->bindParam(":password", $pass, PDO::PARAM_STR);
        $statement->execute();
        $obj = $statement->fetchAll();

        return array('flag' => $statement->rowCount(), 'obj' => $obj);
    }

    function inser_contrasena() {
        if ($_REQUEST['perfil'] == 'docente') {
            $sql = "UPDATE profesores SET contrasena='" . $_REQUEST['nueva_contracena'] . "' WHERE CodigoProfesor = '" . $_REQUEST['codigo'] . "'";
            $this->db->query($sql);
            die("<script> window.location='index.php'; </script>");
        } else {
            $sql = "UPDATE alumnos SET contrasena='" . $_REQUEST['nueva_contracena'] . "' WHERE CodAlumnoSira = '" . $_REQUEST['codigo'] . "'";
            $this->db->query($sql);
            die("<script> window.location='../web/index.php'; </script>");
        }
    }

    function verificar_contrasena_siTiene($usuario) {
        $sql = "SELECT
        profesores.CodigoProfesor,
        'docente' as perfil,
        profesores.contrasena ,
        profesores.NombreProfesor,
        case when (profesores.contrasena is not null )then 1 else 0 end verifi
        FROM
        profesores
        where profesores.CodigoProfesor='" . $usuario . "'
        union 
        select
        alumnos.CodAlumnoSira,
        'alumno' as perfil,
        alumnos.contrasena ,
        alumnos.NombreAlumno,
        case when (alumnos.contrasena is not null )then ' si tiene ' else 'no tiene' end verifi
        from alumnos
        where alumnos.CodAlumnoSira='" . $usuario . "'
        union 
        SELECT empleado.usuario, 'admin' as perfil, empleado.clave as contrasena , empleado.nombres, 
        case when (empleado.clave is not null )then 1 else 0 end verifi FROM empleado 
        where empleado.usuario='".$usuario."'
        ";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $obj = $statement->fetchAll();
        return $obj;
    }

    function cargo_profesor($user) {
        $statement = $this->db->prepare("SELECT
                                cargo.descripcion as cargo,
                                comision.decripcioncomision as comicion,
                                detalle_profesor_comision.CodigoProfesor 
                                FROM
                                detalle_profesor_comision
                                Inner Join comision ON comision.idcomision = detalle_profesor_comision.idcomision
                                Inner Join cargo ON cargo.idcargo = detalle_profesor_comision.idcargo
                                WHERE detalle_profesor_comision.CodigoProfesor =" . $user . " and detalle_profesor_comision.idcargo=1
                                ");

        $statement->execute();
        $obj = $statement->fetchAll();
        return array('flag' => $statement->rowCount(), 'obj2' => $obj);
    }

//    function getOficinas()
//    {
//        $stmt = $this->db->prepare("select oficina.idoficina,sucursal.descripcion,oficina.descripcion
//                                    from oficina inner join sucursal on 
//                                    oficina.idsucursal = sucursal.idsucursal");
//        $stmt->execute();
//        return $stmt->fetchAll();
//    }
//    function getCaja($p)
//    {
//        $stmt = $this->db->prepare("select idcaja,fecha,saldo from caja where idoficina = :p1 and estado = 1");
//        $stmt->bindValue(':p1',$_SESSION['idoficina'],PDO::PARAM_INT);
//        $stmt->execute();
//        return $stmt->fetchObject();
//    }
    function index($query, $p, $c) {
        $sql = "select  empleado.idempleado as idempleado,
                        concat(empleado.nombres,' ',empleado.apellidos) as nombres,        
                        empleado.celular,
                        empleado.rpm,
                        sucursal.descripcion as sucursal,
                        perfil.descripcion as perfil
                from empleado inner join oficina on empleado.idoficina = oficina.idoficina
                inner join sucursal on sucursal.idsucursal = oficina.idsucursal inner join perfil on
                perfil.idperfil = empleado.idperfil 
                where " . $c . " like :query";
        $param = array(array('key' => ':query', 'value' => "%$query%", 'type' => 'STR'));
        $data['total'] = $this->getTotal($sql, $param);
        $data['rows'] = $this->getRow($sql, $param, $p);
        $data['rowspag'] = $this->getRowPag($data['total'], $p);
        return $data;
    }

    function edit($id) {
        $stmt = $this->db->prepare("SELECT empleado.*,oficina.idsucursal FROM empleado inner join oficina on empleado.idoficina = oficina.idoficina WHERE empleado.idempleado = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchObject();
    }

    function insert($_P) {
        $stmt = $this->db->prepare('insert into empleado (idempleado,idoficina,idperfil,nombres,apellidos,usuario,clave,celular,rpm,email,estado)
                                    values(:p1,:p2,:p3,:p4,:p5,:p6,:p7,:p8,:p9,:p10,:p11)');
        $stmt->bindValue(':p1', $_P['idempleado'], PDO::PARAM_STR);
        $stmt->bindValue(':p2', $_P['idoficina'], PDO::PARAM_INT);
        $stmt->bindValue(':p3', $_P['idperfil'], PDO::PARAM_STR);
        $stmt->bindValue(':p4', $_P['nombres'], PDO::PARAM_STR);
        $stmt->bindValue(':p5', $_P['apellidos'], PDO::PARAM_STR);
        $stmt->bindValue(':p6', $_P['login'], PDO::PARAM_STR);
        $stmt->bindValue(':p7', $_P['password'], PDO::PARAM_STR);
        $stmt->bindValue(':p8', $_P['celular'], PDO::PARAM_STR);
        $stmt->bindValue(':p9', $_P['rpm'], PDO::PARAM_STR);
        $stmt->bindValue(':p10', $_P['email'], PDO::PARAM_STR);
        $stmt->bindValue(':p11', $_P['estado'], PDO::PARAM_BOOL);
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1, $p2[2]);
    }

    function update($_P) {

        $stmt = $this->db->prepare('update empleado set idoficina = :p2,idperfil = :p3,nombres=:p4,apellidos=:p5,usuario=:p6,clave=:p7,celular=:p8,rpm=:p9,email=:p10,estado=:p11
                                    where idempleado = :p1');
        $stmt->bindValue(':p1', $_P['idempleado'], PDO::PARAM_STR);
        $stmt->bindValue(':p2', $_P['idoficina'], PDO::PARAM_INT);
        $stmt->bindValue(':p3', $_P['idperfil'], PDO::PARAM_STR);
        $stmt->bindValue(':p4', $_P['nombres'], PDO::PARAM_STR);
        $stmt->bindValue(':p5', $_P['apellidos'], PDO::PARAM_STR);
        $stmt->bindValue(':p6', $_P['login'], PDO::PARAM_STR);
        $stmt->bindValue(':p7', $_P['password'], PDO::PARAM_STR);
        $stmt->bindValue(':p8', $_P['celular'], PDO::PARAM_STR);
        $stmt->bindValue(':p9', $_P['rpm'], PDO::PARAM_STR);
        $stmt->bindValue(':p10', $_P['email'], PDO::PARAM_STR);
        $stmt->bindValue(':p11', $_P['estado'], PDO::PARAM_BOOL);
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1, $p2[2]);
    }

}

?>