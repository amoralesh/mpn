<?php

namespace App\Daos\Dispositivos;

use App\Entities\DispositivosMobile\DispositivoMobile;
use App\Entities\DispositivosMobile\PermisosDispositivos;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Hash;   

  
class DispositivoDao extends EntityRepository
{
    protected $em;
    
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(DispositivoMobile $dispositivo)
    {
       $this->em->persist($dispositivo);
       $this->em->flush();
       return $dispositivo;
    }

    public function update(DispositivoMobile $dispositivo)
    {
        $this->em->merge($dispositivo);
        $this->em->flush();
    }
    
    public function delete(DispositivoMobile $dispositivo)
    {
       $this->em->remove($dispositivo);
       $this->em->flush();
    }
    

    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT dispo 
            FROM App\Entities\DispositivosMobile\DispositivoMobile dispo
            WHERE dispo.id = :id');
        
        $query->setParameter('id', $id);
        
        try {
            return  $query->getSingleResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function findByIdUnico($id) 
    {
        $query = $this->em->createQuery(
            'SELECT dispo 
            FROM App\Entities\DispositivosMobile\DispositivoMobile dispo
            WHERE dispo.idUnico = :idUnico');
           
        $query->setParameter('idUnico', $id);
        
        try {
            return  $query->getSingleResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function listAll()
    {
        $query = $this->em->createQuery(
            'SELECT dispo
            FROM App\Entities\DispositivosMobile\DispositivoMobile dispo');
        try {
            return $query->getResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) { 
            return null;
        }
    }   
    
    public function countAll()
    {
        $query = $this->em->createQuery(
            'SELECT COUNT(dispo.id)
            FROM App\Entities\DispositivosMobile\DispositivoMobile dispo');
        try {
            return $query->getSingleScalarResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function countAllByStatus( $idStatus )
    {
        $query = $this->em->createQuery(
            "SELECT COUNT(dispo.id)
            FROM App\Entities\DispositivosMobile\DispositivoMobile dispo
            WHERE dispo.status = :idStatus");

        try {
            $query->setParameter('idStatus', $idStatus);
            return $query->getSingleScalarResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }



}