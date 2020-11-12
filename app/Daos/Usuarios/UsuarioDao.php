<?php

namespace App\Daos\Usuarios;

use App\Entities\Usuarios\Usuario;
use App\Entities\Usuarios\Permiso;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;


class UsuarioDao extends EntityRepository
{

    protected $em;
    
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(Usuario $usuario)
    {
       $this->em->persist($usuario);
       $this->em->flush();
       return $usuario;
    }

    public function update(Usuario $usuario)
    {
        $this->em->merge($usuario);
        $this->em->flush();
    }
    
    public function delete(Usuario $usuario)
    {
       $this->em->remove($usuario);
       $this->em->flush();
    }
    

    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT user 
            FROM App\Entities\Usuarios\Usuario user 
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
            FROM App\Entities\Usuarios\Usuario user 
            WHERE user.usuario = :Usuario');
        
        $query->setParameter('Usuario', $Usuario);

        try {
            return  $query->getSingleResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function findByPermiso($permiso)
    {
        $query = $this->em->createQuery(
            'SELECT user 
            FROM App\Entities\Usuarios\Usuario user 
            JOIN user.permisos permiso   
            WHERE permiso.nombre = :permiso');
        
        $query->setParameter('permiso', $permiso);

        try {
            return  $query->getResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }


    public function listAll()
    {
        $query = $this->em->createQuery(
            'SELECT user
            FROM App\Entities\Usuarios\Usuario user ');
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
            FROM App\Entities\Usuarios\Usuario user ');
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
            FROM App\Entities\Usuarios\Usuario user 
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