<?php

namespace App\Daos\PID;


use Doctrine\ORM\EntityRepository; 
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;

class EstablecimientoDao extends EntityRepository
{
   
    protected $em; 
    
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('PID');
    }


    public function create( $negocioCreado , $dispositivoCreado )  
    {

        $cadenaNombre = "Sin Cadena";
        if( $negocioCreado->getCadenas()->last() != null  ){
            $cadenaNombre = $negocioCreado->getCadenas()->last()->getEtiqueta();
        }

        $asociacionId = 8;
        if( $negocioCreado->getCadenas()->last() != null  ){
            $asociacionId = $negocioCreado->getAsociaciones()->last()->getId();
        }

        $query = "INSERT INTO tbEstablecimientos 
        (
         nombre
        ,latitud  
        ,longitud
        ,delegacion
        ,colonia
        ,calle
        ,numero
        ,calle1
        ,calle2
        ,cp
        ,hash
        ,cadena
        ,direccion
        ,telefono  
        ,celular
        ,idAsociacion
        ,idcd
        ,sector   
        ,activo
        ,no_tienda
        ,nivel
        ,plaza
        ,referencia 
        ,delegacionGeo
        ,llave
        ,idCadena
        ,id_municipio
        ,id_sector
        ,fecha_incorporacion
        ,app)
        VALUES  
        (" 
        . "'"      .$negocioCreado->getNombre() ."'"  
        . "," ."'" .$negocioCreado->getLatitud() ."'"  
        . "," ."'" .$negocioCreado->getLongitud() ."'"  
        . "," ."'" .$negocioCreado->getDireccion()->getColonia()->getDelegacion()->getEtiqueta() ."'" 
        . "," ."'" .$negocioCreado->getDireccion()->getColonia()->getEtiqueta() ."'" 
        . "," ."'" .$negocioCreado->getDireccion()->getCallePrincipal() ."'" 
        . "," ."'" .$negocioCreado->getDireccion()->getNumeroExterior() ."'" 
        . "," ."'" .$negocioCreado->getDireccion()->getCalle1() ."'" 
        . "," ."'" .$negocioCreado->getDireccion()->getCalle2() ."'" 
        . "," ."'" .$negocioCreado->getDireccion()->getCodigoPostal() ."'" 
        . "," ."'" .$dispositivoCreado->getToken() ."'"
        . "," ."'" . $cadenaNombre ."'" 
        . "," ."'CALLE: " .$negocioCreado->getDireccion()->getCallePrincipal() ."#:" ."'" 
        . "," ."'" .$negocioCreado->getTelefono() ."'" 
        . "," ."'" ."null" ."'" 
        . "," ."" . $asociacionId ."" 
        . "," ."'" ."null" ."'" 
        . "," ."'" .$negocioCreado->getSector()->getEtiqueta() ."'"  
        . "," ."'" ."1" ."'" 
        . "," ."'" ."null" ."'" 
        . "," ."'" .$negocioCreado->getPiso() ."'" 
        . "," ."'" .$negocioCreado->getPlaza()->getEtiqueta() ."'" 
        . "," ."'" .$negocioCreado->getReferencia() ."'" 
        . "," ."'" .$negocioCreado->getDireccion()->getColonia()->getDelegacion()->getEtiqueta() ."'" 
        . "," ."'" ."null" ."'" 
        . "," ."398" 
        . "," ."'" ."null" ."'" 
        . "," ."'" .$negocioCreado->getSector()->getId() ."'" 
        . "," ."'" .$negocioCreado->getFechaAlta()->format('Y-m-d') ."'" 
        . "," ."'" ."null" ."'" 
        .")";
        $result = $this->em->getConnection()->prepare($query)->execute(); 
        
        return $result;
    }



    public function findByToken( $token )
    {
        $query = "SELECT idEstablecimiento 
        FROM tbEstablecimientos
        WHERE hash = '". $token ."'";

        $result = $this->em->getConnection()->fetchAssoc($query);
        return $result;
    }


}