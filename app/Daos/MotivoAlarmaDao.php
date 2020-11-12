<?php

namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\MotivoAlarma;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;


class MotivoAlarmaDao extends EntityRepository
{

    protected $em; 
 
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(MotivoAlarma $motivoAlarma)
    {
       $this->em->persist($motivoAlarma);
       $this->em->flush();
    }

    public function update(MotivoAlarma $motivoAlarma)
    {
        $this->em->merge($motivoAlarma);
        $this->em->flush();
    }


    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT motivoAlarma
            FROM App\Entities\MotivoAlarma motivoAlarma
            WHERE motivoAlarma.id = :id');
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
            'SELECT motivoAlarma
            FROM App\Entities\MotivoAlarma motivoAlarma
            order by motivoAlarma.id
             ');
        return $query->getResult();
    }


    


}
