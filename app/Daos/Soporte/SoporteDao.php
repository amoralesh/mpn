<?php

namespace App\Daos\Soporte;

use App\Entities\Soporte\Soporte; 

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;


class SoporteDao extends EntityRepository
{

    protected $em;
    
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }
      
    public function create(Soporte $soporte)
    {
       $this->em->persist($soporte);
       $this->em->flush();
       return $soporte;
    }

    public function update(Soporte $soporte)
    {
        $this->em->merge($soporte); 
        $this->em->flush();
    } 
    
    public function listAll()
    {
        $query = $this->em->createQuery(
            'SELECT sopor
             FROM App\Entities\Soporte\Soporte sopor');
        
        return  $query->getResult();
    }

    public function listAllJson()  
    {
        $query = $this->em->createQuery(
            'SELECT sopor.id,
                    sopor.nombre,
                    sopor.email,
                    sopor.asunto,
                    sopor.problema,
                    documentoS.documento
             FROM App\Entities\Soporte\Soporte sopor  
             JOIN sopor.documentosSoporte documentoS ');
        
        return  $query->getResult();
    }
    

}