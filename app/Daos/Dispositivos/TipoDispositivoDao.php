<?php

namespace App\Daos\Dispositivos;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
 
class TipoDispositivoDao extends EntityRepository
{

    protected $em;
    
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT td 
            FROM App\Entities\DispositivosMobile\TipoDispositivoMobile td
            WHERE td.id = :id');
        
        $query->setParameter('id', $id);
        
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
            'SELECT td 
            FROM App\Entities\DispositivosMobile\TipoDispositivoMobile td');
        try {
            return  $query->getResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    
    public function countAll()
    {
        $query = $this->em->createQuery(
            'SELECT COUNT(td.id) 
            FROM App\Entities\DispositivosMobile\TipoDispositivoMobile td');
        try {
            return $query->getSingleScalarResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }


}