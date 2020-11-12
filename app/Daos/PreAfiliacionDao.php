<?php

namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\PreAfiliacion;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;


class PreAfiliacionDao extends EntityRepository
{

    protected $em;

    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(PreAfiliacion $preAfiliacion)
    {
       $this->em->persist($preAfiliacion);
       $this->em->flush();
       return $preAfiliacion;
    }

    public function update(PreAfiliacion $preAfiliacion)
    {
        $this->em->merge($preAfiliacion);
        $this->em->flush();
        return $preAfiliacion;
    }

    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT PA
            FROM App\Entities\PreAfiliacion PA
            WHERE PA.id = :id');
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
            'SELECT PA
            FROM App\Entities\PreAfiliacion PA
            WHERE PA.etiqueta = :etiqueta');
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
            'SELECT PA
            FROM App\Entities\PreAfiliacion PA
            order by PA.etiqueta
             ');
        return $query->getResult();
    }




}
