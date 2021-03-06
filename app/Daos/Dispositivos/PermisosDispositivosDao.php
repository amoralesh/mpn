<?php

namespace App\Daos\Dispositivos;

use App\Entities\DispositivosMobileMobile\PermisoDispositivo;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;

class PermisosDispositivosDao extends EntityRepository
{

    protected $em;
    
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(PermisoDispositivo $permisoDispositivo)
    {
       $this->em->persist($permisoDispositivo);
       $this->em->flush();
    }

    public function update(PermisoDispositivo $permisoDispositivo)
    {
        $this->em->merge($permisoDispositivo);
        $this->em->flush();
    }
    
    public function delete(PermisoDispositivo $permisoDispositivo)
    {
       $this->em->remove($permisoDispositivo);
       $this->em->flush();
    }

    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT per 
            FROM App\Entities\DispositivosMobile\PermisoDispositivo per
            WHERE per.id = :id');
        
        $query->setParameter('id', $id);
        
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
            'SELECT per 
            FROM App\Entities\DispositivosMobile\PermisoDispositivo per');
        try {
            return  $query->getResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    
    public function countAll()
    {
        $query = $this->em->createQuery(
            'SELECT COUNT(per.id)
            FROM App\Entities\DispositivosMobile\PermisoDispositivo per');
        try {
            return $query->getSingleScalarResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function listAllByMultipleIds( $ArrayIds )
    {
        $query = $this->em->createQuery(
            'SELECT per
            FROM App\Entities\DispositivosMobile\PermisoDispositivo per
            WHERE per.id in ( :ArrayIds)');

        try {
            $query->setParameter('ArrayIds', $ArrayIds );
            return  $query->getResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}