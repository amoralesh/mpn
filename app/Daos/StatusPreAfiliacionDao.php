<?php

namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\StatusPreAfiliacion;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;


class StatusPreAfiliacionDao extends EntityRepository
{

    protected $em;

    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(StatusPreAfiliacion $statusPreAfiliacion)
    {
       $this->em->persist($statusPreAfiliacion);
       $this->em->flush();
    }

    public function update(StatusPreAfiliacion $statusPreAfiliacion)
    {
        $this->em->merge($statusPreAfiliacion);
        $this->em->flush();
    }

    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT statusPA
            FROM App\Entities\StatusPreAfiliacion statusPA
            WHERE statusPA.id = :id');
        $query->setParameter('id', $id);

        try {
            return  $query->getSingleResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    }

     public function findByEtiqueta($etiqueta)
    {
        $query = $this->em->createQuery(
            'SELECT statusPA
            FROM App\Entities\StatusPreAfiliacion statusPA
            WHERE statusPA.etiqueta = :etiqueta');
        $query->setParameter('etiqueta', $etiqueta);

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
            'SELECT statusPA
            FROM App\Entities\StatusPreAfiliacion statusPA
            order by statusPA.etiqueta
             ');
        return $query->getResult();
    }




}
