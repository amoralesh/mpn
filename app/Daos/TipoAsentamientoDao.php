<?php

namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\TipoAsentamiento;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;


class TipoAsentamientoDao extends EntityRepository
{

    protected $em;

    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(TipoAsentamiento $tipoAsentamiento)
    {
       $this->em->persist($tipoAsentamiento);
       $this->em->flush();
    }

    public function update(TipoAsentamiento $tipoAsentamiento)
    {
        $this->em->merge($tipoAsentamiento);
        $this->em->flush();
    }


    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT tipoAsentamiento
            FROM App\Entities\TipoAsentamiento tipoAsentamiento
            WHERE tipoAsentamiento.id = :id');
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
            'SELECT tipoAsentamiento
            FROM App\Entities\TipoAsentamiento tipoAsentamiento
            WHERE tipoAsentamiento.etiqueta = :etiqueta');
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
            'SELECT tipoAsentamiento
            FROM App\Entities\TipoAsentamiento tipoAsentamiento
            order by tipoAsentamiento.id
             ');
        return $query->getResult();
    }



}
