<?php

namespace App\Daos\Usuarios;

use App\Entities\Usuarios\Institucion;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;

class InstitucionDao extends EntityRepository
{
   
    protected $em;
    
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }


    public function findById($id)
    {
        $query = $this->em->createQuery(
           'SELECT inst 
            FROM App\Entities\Usuarios\Institucion inst 
            WHERE inst.id = :id');
        
        $query->setParameter('id', $id);

        //var_dump($query->getSingleResult());
        return  $query->getSingleResult();
    }


    public function listAll()
    {
        $query = $this->em->createQuery(
            'SELECT inst 
             FROM App\Entities\Usuarios\Institucion inst');
        try {
            return $query->getResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) { 
            return null;
        }
    }


 

}