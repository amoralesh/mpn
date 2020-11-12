<?php

namespace App\Daos\UsuariosMobile;

use App\Entities\UsuariosMobile\PermisoMobile;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;

class PermisoMobileDao extends EntityRepository
{
    protected $em;
    
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(PermisoMobile $permisoMobile)
    {
       $this->em->persist($permisoMobile);
       $this->em->flush();
    }

    public function update(PermisoMobile $permisoMobile)
    {
        $this->em->merge($permisoMobile);
        $this->em->flush();
    }
    
    public function delete(PermisoMobile $permisoMobile)
    {
       $this->em->remove($permisoMobile);
       $this->em->flush();
    }

    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT permiso 
            FROM App\Entities\UsuariosMobile\PermisoMobile permiso 
            WHERE permiso.id = :id');
        
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
            'SELECT permiso 
             FROM App\Entities\UsuariosMobile\PermisoMobile permiso ');
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
            'SELECT COUNT(permiso.id)
             FROM App\Entities\UsuariosMobile\PermisoMobile permiso');
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
            'SELECT permiso
             FROM App\Entities\UsuariosMobile\PermisoMobile permiso
            WHERE permiso.id in ( :ArrayIds)');

        try {
            $query->setParameter('ArrayIds', $ArrayIds );
            return  $query->getResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }


}