<?php

namespace App\Daos\UsuariosPublico;

use App\Entities\UsuariosPublico\InstitucionPublico;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;

class InstitucionPublicoDao extends EntityRepository
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
            FROM App\Entities\UsuariosPublico\InstitucionPublico inst 
            WHERE inst.id = :id');
        
        $query->setParameter('id', $id);

        //var_dump($query->getSingleResult());
        return  $query->getSingleResult();
    }


    public function listAll()
    {
        $query = $this->em->createQuery(
            'SELECT inst 
             FROM App\Entities\UsuariosPublico\InstitucionPublico inst');
        try {
            return $query->getResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) { 
            return null;
        }
    }


 

}