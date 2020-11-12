<?php

namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\Razon;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;


class RazonDao extends EntityRepository
{

    protected $em;

    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(Razon $razon)
    {
       $this->em->persist($razon);
       $this->em->flush();
    }

    public function update(Razon $razon)
    {
        $this->em->merge($razon);
        $this->em->flush();
    }

    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT r
            FROM App\Entities\Razon r
            WHERE r.id = :id');
        $query->setParameter('id', $id);

        try {
            return  $query->getSingleResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return NULL;
        }
    }

    public function listAll()
    {
        $query = $this->em->createQuery(
            'SELECT r
            FROM App\Entities\Razon r
            order by r.id');

        try {
            return $query->getResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return NULL;
        }
    }

        
    public function listAllByTipoAlarma($idTipoAlarma)
    {
        $query = $this->em->createQuery(
            'SELECT r
            FROM App\Entities\Razon r
            JOIN r.tipoAlarma tA
            WHERE tA.id =:idTipoAlarma
            order by r.id');

        try {
            $query->setParameter('idTipoAlarma', $idTipoAlarma);
            return $query->getResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return NULL;
        }
    }

//WS CCO //WS CCO  //WS CCO  //WS CCO  //WS CCO 

    public function listAllEfectiva()
    {
        $query = $this->em->createQuery(
            'SELECT r
            FROM App\Entities\Razon r
            WHERE r.id < 7
            order by r.id');

        try {
            return $query->getResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return NULL;
        }
    }

    public function listAllNoEfectiva()
    {
        $query = $this->em->createQuery(
            'SELECT r
            FROM App\Entities\Razon r
            WHERE r.id > 6
            order by r.id');

        try {
            return $query->getResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return NULL;
        }
    }


}
