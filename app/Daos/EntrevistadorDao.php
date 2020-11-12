<?php
 
namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\Entrevistador;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;
  

class EntrevistadorDao extends EntityRepository  
{ 

    protected $em;
    
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(Entrevistador $entrevistador)
    {
       $this->em->persist($entrevistador);
       $this->em->flush();
    }

    public function update(Entrevistador $entrevistador)
    {
        $this->em->merge($entrevistador);
        $this->em->flush();
    }


    public function deleteByEntrevistador(Entrevistador $entrevistador)
    {
        try {
           $this->em->remove($entrevistador);
           $this->em->flush();
           return true;
        
        } catch (\Doctrine\ORM\EntityNotFoundException $ex) {
            return  false;
        }
    }
    

    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT e 
            FROM App\Entities\Entrevistador e 
            WHERE e.id = :id');
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
            'SELECT e 
            FROM App\Entities\Entrevistador e 
            order by e.id
             ');
        return $query->getResult();
    }

}