<?php

namespace App\Daos\UsuariosMobile;

use App\Entities\UsuariosMobile\PermisoMobile;
use App\Entities\UsuariosMobile\UsuarioMobile;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
  
class UsuarioMobileDao extends EntityRepository
{
    protected $em;

    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(UsuarioMobile $usuarioMobile)
    {
       $this->em->persist($usuarioMobile);
       $this->em->flush();
       return $usuarioMobile;
    }

    public function update(UsuarioMobile $usuarioMobile)
    {
        $this->em->merge($usuarioMobile);
        $this->em->flush();
    }
    
    public function delete(UsuarioMobile $usuarioMobile)
    {
       $this->em->remove($usuarioMobile);
       $this->em->flush();
    }
      

    public function findById($id)
    {
        $query = $this->em->createQuery( 
            'SELECT user 
            FROM App\Entities\UsuariosMobile\UsuarioMobile user 
            WHERE user.id = :id');
        
        $query->setParameter('id', $id);
        
        try {
            return  $query->getSingleResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function findByUser($Usuario)
    {
        $query = $this->em->createQuery(
            'SELECT user 
            FROM App\Entities\UsuariosMobile\UsuarioMobile user 
            WHERE user.usuario = :Usuario');
        
        $query->setParameter('Usuario', $Usuario);

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
            'SELECT user
            FROM App\Entities\UsuariosMobile\UsuarioMobile user');
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
            'SELECT COUNT(user.id)
            FROM App\Entities\UsuariosMobile\UsuarioMobile user');
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
            "SELECT COUNT(user.id)
            FROM App\Entities\UsuariosMobile\UsuarioMobile user
            WHERE user.status = :idStatus");

        try {
            $query->setParameter('idStatus', $idStatus);
            return $query->getSingleScalarResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

}