<?php

namespace App\Daos\PID;


use Doctrine\ORM\EntityRepository; 
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;

class AlertaDao extends EntityRepository
{  
   
    protected $em;
    
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('PID');
    }


    public function create( $negocio )
    { 
        if(  $negocio->getIdNegocio() == null){
            return false;
        }
        $query = "INSERT INTO dbAlarma.tbRegistros
        (
        id_establecimiento,
        gatewayIP,
        hostName,
        localIP,
        idRegistroTemporal,
        tiempo_respuesta_wasatch
        )
        VALUES
        (" 
        . $negocio->getIdNegocio()       
        . ",'10.13.9.190'" 
        . ",'10.13.9.190'" 
        . ",'10.13.9.190'" 
        . ",null"  
        . ",null" 
        . ")";
        $result = $this->em->getConnection()->prepare($query)->execute(); 
        
        return $result;
    }


}