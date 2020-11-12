<?php

namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\GiroNegocio;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;


class GiroNegocioDao extends EntityRepository
{

    protected $em;

    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(GiroNegocio $giroNegocio)
    {
       $this->em->persist($giroNegocio);
       $this->em->flush();
    }

    public function update(GiroNegocio $giroNegocio)
    {
        $this->em->merge($giroNegocio);
        $this->em->flush();
    }

    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT giroNegocio
            FROM App\Entities\GiroNegocio giroNegocio
            WHERE giroNegocio.id = :id');
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
            FROM App\Entities\GiroNegocio gn
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
            'SELECT giroNegocio
            FROM App\Entities\GiroNegocio giroNegocio
            order by giroNegocio.etiqueta
             ');
        return $query->getResult();
    }

    public function listAllEscuelas()
    {
        $query = $this->em->createQuery(
            'SELECT giroNegocio
            FROM App\Entities\GiroNegocio giroNegocio
            where giroNegocio.id  in ( 110,113,117,120,123,127,132,134,140,142,145,150,154,157,160,163,166,168,170,171,176,180,182,185,190,192,194,195,198,200,202,204,205,206,212,213,215,572) 
            order by giroNegocio.etiqueta
             ');
        return $query->getResult();
    }


    public function listAllEscuela()
    {
        $query = $this->em->createQuery(
            'SELECT giroNegocio
            FROM App\Entities\GiroNegocio giroNegocio
            where giroNegocio.id  in ( 2) 
            order by giroNegocio.etiqueta
             ');
        return $query->getResult();
    }
    public function listAllJson()
    {
        $query = $this->em->createQuery(
            'SELECT giroNegocio.id
            ,giroNegocio.etiqueta as nombre
            FROM App\Entities\GiroNegocio giroNegocio
            order by giroNegocio.etiqueta
             ');
        return $query->getResult();
    }


}
