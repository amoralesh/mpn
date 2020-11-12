<?php
 
namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\Dispositivo;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;
  

class DispositivoDao extends EntityRepository  
{ 

    protected $em;   
    
    public function __construct(ManagerRegistry $em) 
    {
        $this->em = $em->getManager('default');
    }

    public function create(Dispositivo $dispositivo)
    {
       $this->em->persist($dispositivo);
       $this->em->flush();
       return $dispositivo; 
    }

    public function update(Dispositivo $dispositivo)
    {
        $this->em->merge($dispositivo);
        $this->em->flush();
        return $dispositivo;
    }
    

    public function findById( $id )
    {
        $query = $this->em->createQuery(
            "SELECT dispositivo
            FROM App\Entities\Dispositivo dispositivo
            WHERE dispositivo.id =:id ");
            
        $query->setParameter('id', $id);
        try {
            return  $query->getSingleResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    }



    public function findByToken( $token )
    {
        $query = $this->em->createQuery(
            "SELECT dispositivo
            FROM App\Entities\Dispositivo dispositivo
            WHERE dispositivo.token =:token ");
            
        $query->setParameter('token', $token);
        try {
            return  $query->getSingleResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    }


    public function findByIdNegocio($id,$idNegocio)
    {
        $query = $this->em->createQuery(
            "SELECT dispositivo
            FROM App\Entities\Dispositivo dispositivo 
            JOIN dispositivo.negocio negocio
            JOIN dispositivo.tipoDispositivo tipoDispositivo
            WHERE negocio.id = :idNegocio AND tipoDispositivo.id =:id ");

        $query->setParameter('id', $id);
        $query->setParameter('idNegocio', $idNegocio);
        
        try {
            return  $query->getSingleResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    }




    public function getLast()
    {
        $query = $this->em->createQuery(
            "SELECT dispositivo FROM App\Entities\Dispositivo dispositivo
            ORDER BY dispositivo.id DESC"); 

        $query->setMaxResults(1);       

        try {
            return  $query->getSingleResult();
        }

        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    }


}