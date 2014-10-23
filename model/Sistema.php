<?php
include_once("../lib/dbfactory.php");
class Sistema extends Main
{
    function menu()
    {
        $stmt = $this->db->prepare("select * from view_menupadres where idperfil = :p1");
        $stmt->bindValue(':p1', $_SESSION['idperil'] , PDO::PARAM_INT);
        $stmt->execute();        
        $items = $stmt->fetchAll();
        $cont = 0;
        $cont2 = 0;
       
        foreach ($items as $valor)
        {
            $stmt = $this->db->prepare("select * from view_menuhijos where idpadre=".$valor['idmodulo']." and idperfil=:p1");
            $stmt->bindValue(':p1', $_SESSION['idperil'] , PDO::PARAM_INT);
            $stmt->execute();
            $hijos = $stmt->fetchAll();
//            var_dump($hijos);
//            exit();
            
            if($valor['url']=="") {$url = "#";}
                else {$url = $valor['url'];}
            $menu[$cont] = array(
            'texto' => $valor['descripcion'],
            'url' => $url,
            'icon' => $valor['icono'],
            'enlaces' => array()
                );
            $cont2 = 0;
            foreach($hijos as $h)
            {
              $menu[$cont]['enlaces'][$cont2] = array('idmodulo'=>$h['idmodulo'],'texto' => $h['descripcion'], 'icon' => $h['icono'],'url' => $h['url']);
            
              $cont2 ++;
            }
           
            
            $cont ++;
            
            
        }
        
        return $menu;
    }
    function submenu($p){
        $stmt=  $this->db->prepare("SELECT *  FROM sisacreditacion.modulo where modulo.estadoh3=1 and idpadre=:p1 ");
        $stmt->bindValue(':p1', $p , PDO::PARAM_INT);
            $stmt->execute();
            $subhijos=$stmt->fetchAll();
            $menu[]=array();
            $cont=0;
        foreach($subhijos as $h)
            {
             $menu[$cont]=array("<ul><li><a>".$h['descripcion']."</a></li></ul>");
             $cont ++;
            }
            return $menu;
    }
    
}
?>