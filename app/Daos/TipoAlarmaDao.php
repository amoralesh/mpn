<?php
 
namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\TipoAlarma;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;  
  

class TipoAlarmaDao extends EntityRepository  
{ 

    protected $em;
    
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(TipoAlarma $tipoAlarma)
    {
       $this->em->persist($tipoAlarma);
       $this->em->flush();
    }

    public function update(TipoAlarma $tipoAlarma)
    {
        $this->em->merge($tipoAlarma);
        $this->em->flush();
    }
    

    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT tipoAlarma 
            FROM App\Entities\TipoAlarma tipoAlarma 
            WHERE tipoAlarma.id = :id');
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
            'SELECT tipoAlarma 
            FROM App\Entities\TipoAlarma tipoAlarma 
            order by tipoAlarma.id
             ');
        return $query->getResult();
    }


}