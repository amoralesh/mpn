<?php
 
namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\Entrevistado;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;
  

class EntrevistadoDao extends EntityRepository  
{ 

    protected $em;
    
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(Entrevistado $entrevistado)
    {
       $this->em->persist($entrevistado);
       $this->em->flush();
    }

    public function update(Entrevistado $entrevistado)
    {
        $this->em->merge($entrevistado);
        $this->em->flush();
    }


    public function deleteByEntrevistado(Entrevistado $entrevistado)
    {
        try {
           $this->em->remove($entrevistado);
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
            FROM App\Entities\Entrevistado e 
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
            FROM App\Entities\Entrevistado e 
            order by e.id
             ');
        return $query->getResult();
    }

}