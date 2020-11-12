<?php

namespace App\Daos\UsuariosPublico;

use App\Entities\UsuariosPublico\PermisoPublico;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;

class PermisoPublicoDao extends EntityRepository
{

    
    protected $em;
    
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(Permiso $permiso)
    {
       $this->em->persist($permiso);
       $this->em->flush();
    }

    public function update(Permiso $permiso)
    {
        $this->em->merge($permiso);
        $this->em->flush();
    }
    
    public function delete(Permiso $permiso)
    {
       $this->em->remove($permiso);
       $this->em->flush();
    }

    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT per 
            FROM App\Entities\UsuariosPublico\PermisoPublico per
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
            FROM App\Entities\UsuariosPublico\PermisoPublico per');
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
            FROM App\Entities\UsuariosPublico\PermisoPublico per');
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
            FROM App\Entities\UsuariosPublico\PermisoPublico per
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