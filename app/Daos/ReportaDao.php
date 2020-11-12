<?php

namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\Reporta;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;


class ReportaDao extends EntityRepository
{

    protected $em;

    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(Reporta $reporta)
    {
       $this->em->persist($reporta);
       $this->em->flush();
    }

    public function update(Reporta $reporta)
    {
        $this->em->merge($reporta);
        $this->em->flush();
    }

    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT r
            FROM App\Entities\Reporta r
            WHERE r.id = :id');
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
            'SELECT r
            FROM App\Entities\Reporta r
            order by r.id
             ');
            return  $query->getResult();

    }

}
