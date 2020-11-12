<?php

namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\TipoNegocio;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;


class TipoNegocioDao extends EntityRepository
{

    protected $em;

    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(TipoNegocio $tipoNegocio)
    {
       $this->em->persist($tipoNegocio);
       $this->em->flush();
    }

    public function update(TipoNegocio $tipoNegocio)
    {
        $this->em->merge($tipoNegocio);
        $this->em->flush();
    }

    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT tipoNegocio
            FROM App\Entities\TipoNegocio tipoNegocio
            WHERE tipoNegocio.id = :id');
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
            'SELECT tn
            FROM App\Entities\TipoNegocio tn
            WHERE tn.etiqueta = :etiqueta');
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
            'SELECT tipoNegocio
            FROM App\Entities\TipoNegocio tipoNegocio
            order by tipoNegocio.etiqueta
             ');
        return $query->getResult();
    }

    public function listAllEscuela()
    {
        $query = $this->em->createQuery(
            'SELECT tipoNegocio
            FROM App\Entities\TipoNegocio tipoNegocio
            WHERE tipoNegocio.id = 16
            order by tipoNegocio.etiqueta');
        return $query->getResult();
    }

    public function listAllMercados()
    {
        $query = $this->em->createQuery(
            'SELECT tipoNegocio
            FROM App\Entities\TipoNegocio tipoNegocio
            WHERE tipoNegocio.id = 7
            order by tipoNegocio.etiqueta');
        return $query->getResult();
    }

    public function listAllPlazas()
    {
        $query = $this->em->createQuery(
            'SELECT tipoNegocio
            FROM App\Entities\TipoNegocio tipoNegocio
            WHERE tipoNegocio.id = 12
            order by tipoNegocio.etiqueta');
        return $query->getResult();
    }
    

}
