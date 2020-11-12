<?php

namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\Participacion;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;


class ParticipacionDao extends EntityRepository
{

    protected $em;

    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(Participacion $participacion)
    {
       $this->em->persist($participacion);
       $this->em->flush();
    }

    public function update(Participacion $participacion)
    {
        $this->em->merge($participacion);
        $this->em->flush();
    }


    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT p
            FROM App\Entities\Participacion p
            WHERE p.id = :id');
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
            'SELECT p
            FROM App\Entities\Participacion p
            order by p.id
             ');
            return  $query->getResult();

    }


}
