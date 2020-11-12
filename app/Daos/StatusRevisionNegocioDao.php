<?php

namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\StatusRevisionNegocio;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;


class StatusRevisionNegocioDao extends EntityRepository
{

    protected $em;

    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(StatusRevisionNegocio $statusRevisionNegocio)
    {
       $this->em->persist($statusRevisionNegocio);
       $this->em->flush();
    }

    public function update(StatusRevisionNegocio $statusRevisionNegocio)
    {
        $this->em->merge($statusRevisionNegocio);
        $this->em->flush();
    }


    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT staRevNeg
            FROM App\Entities\StatusRevisionNegocio staRevNeg
            WHERE staRevNeg.id = :id');
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
            'SELECT staRevNeg
            FROM App\Entities\StatusRevisionNegocio staRevNeg
            order by staRevNeg.etiqueta
             ');
        return $query->getResult();
    }

    public function listAllJson()
    {
        $query = $this->em->createQuery(
            'SELECT staRevNeg.id
            ,staRevNeg.etiqueta as delegacion
            FROM App\Entities\StatusRevisionNegocio staRevNeg
            order by staRevNeg.etiqueta
             ');
        return $query->getResult();
    }

}
