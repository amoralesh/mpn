<?php
 
namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\Direccion;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;
  

class DireccionDao extends EntityRepository  
{ 

    protected $em;
    
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(Direccion $direccion)
    {
       $this->em->persist($direccion);
       $this->em->flush();
    }

    public function update(Direccion $direccion)
    {
        $this->em->merge($direccion);
        $this->em->flush();
    }
    

    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT direccion 
            FROM App\Entities\Direccion direccion 
            WHERE direccion.id = :id');
        $query->setParameter('id', $id);
        
        try {
            return  $query->getSingleResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    }


    public function listAll()
    {
        $query = $this->em->createQuery(
            'SELECT direccion 
            FROM App\Entities\Direccion direccion 
            order by direccion.id
             ');
        return $query->getResult();
    }

 
}