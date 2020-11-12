<?php

namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\TipoStatus;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;


class TipoStatusDao extends EntityRepository
{

    protected $em;

    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(TipoStatus $tipoStatus)
    {
       $this->em->persist($tipoStatus);
       $this->em->flush();
    }

    public function update(TipoStatus $tipoStatus)
    {
        $this->em->merge($tipoStatus);
        $this->em->flush();
    }


    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT tipoStatus
            FROM App\Entities\TipoStatus tipoStatus
            WHERE tipoStatus.id = :id');
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
            'SELECT tipoStatus
            FROM App\Entities\TipoStatus tipoStatus
            order by tipoStatus.id
             ');
        return $query->getResult();
    }

}
