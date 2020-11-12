<?php

namespace App\Daos\UsuariosPublico;

use App\Entities\UsuariosPublico\UsuarioPublico;
use App\Entities\UsuariosPublico\PermisoPublico;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;


class UsuarioPublicoDao extends EntityRepository
{

    protected $em;
    
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(UsuarioPublico $usuarioPublico)
    {
       $this->em->persist($usuarioPublico);
       $this->em->flush();
       return $usuarioPublico;
    }

    public function update(UsuarioPublico $usuarioPublico)
    {
        $this->em->merge($usuarioPublico);
        $this->em->flush();
    }
    
    public function delete(UsuarioPublico $usuarioPublico)
    {
       $this->em->remove($usuarioPublico);
       $this->em->flush();
    }
    

    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT user 
            FROM App\Entities\UsuariosPublico\UsuarioPublico user 
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
            FROM App\Entities\UsuariosPublico\UsuarioPublico user 
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
            FROM App\Entities\UsuariosPublico\UsuarioPublico user ');
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
            FROM App\Entities\UsuariosPublico\UsuarioPublico user ');
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
            FROM App\Entities\UsuariosPublico\UsuarioPublico user 
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