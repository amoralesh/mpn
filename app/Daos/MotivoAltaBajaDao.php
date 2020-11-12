<?php
 
namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\MotivoAltaBaja;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;
  

class MotivoAltaBajaDao extends EntityRepository  
{ 

    protected $em; 
    
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(MotivoAltaBaja $motivoAltaBaja)
    {
       $this->em->persist($motivoAltaBaja);
       $this->em->flush();
    }

    public function update(MotivoAltaBaja $motivoAltaBaja)
    {
        $this->em->merge($motivoAltaBaja);
        $this->em->flush();
    }
    

    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT motivoAltaBaja 
            FROM App\Entities\MotivoAltaBaja motivoAltaBaja 
            WHERE motivoAltaBaja.id = :id');
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
            'SELECT motivoAltaBaja 
            FROM App\Entities\MotivoAltaBaja motivoAltaBaja 
            order by motivoAltaBaja.id
             ');
        return $query->getResult();
    }

}