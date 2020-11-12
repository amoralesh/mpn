<?php

namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\GiroNegocioGeneral;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;


class GiroNegocioGeneralDao extends EntityRepository
{

    protected $em;

    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(GiroNegocioGeneral $giroNegocioGeneral)
    {
       $this->em->persist($giroNegocioGeneral);
       $this->em->flush();
    }

    public function update(GiroNegocioGeneral $giroNegocioGeneral)
    {
        $this->em->merge($giroNegocioGeneral);
        $this->em->flush();
    }

    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT giroNegocioGe
            FROM App\Entities\GiroNegocioGeneral giroNegocioGe
            WHERE giroNegocioGe.id = :id');
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
            'SELECT gn
            FROM App\Entities\GiroNegocioGeneral gn
            WHERE gn.etiqueta = :etiqueta');
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
            'SELECT giroNegocioG
            FROM App\Entities\GiroNegocioGeneral giroNegocioG
            order by giroNegocioG.etiqueta
             ');
        return $query->getResult();
    }

    public function listAllJson()
    {
        $query = $this->em->createQuery(
            'SELECT giroNegocioG.id
            ,giroNegocioG.etiqueta as nombre
            FROM App\Entities\GiroNegocioGeneral giroNegocioG
            order by giroNegocioG.etiqueta
             ');
        return $query->getResult();
    }

    public function listAllMercado()
    {
        $query = $this->em->createQuery(
            'SELECT giroNegocioG
            FROM App\Entities\GiroNegocioGeneral giroNegocioG
            where giroNegocioG.id  in (1) 
            order by giroNegocioG.etiqueta
             ');
        return $query->getResult();
    }

    public function listAllEscuela()
    {
        $query = $this->em->createQuery(
            'SELECT giroNegocioG
            FROM App\Entities\GiroNegocioGeneral giroNegocioG
            where giroNegocioG.id  in (2) 
            order by giroNegocioG.etiqueta
             ');
        return $query->getResult();
    }

    public function listAllPlazas()
    {
        $query = $this->em->createQuery(
            'SELECT giroNegocioG
            FROM App\Entities\GiroNegocioGeneral giroNegocioG
            where giroNegocioG.id  in (40) 
            order by giroNegocioG.etiqueta
             ');
        return $query->getResult();
    }


}
