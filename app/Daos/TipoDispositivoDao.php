<?php

namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\TipoDispositivo;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;


class TipoDispositivoDao extends EntityRepository
{

    protected $em;

    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(TipoDispositivo $tipoDispositivo)
    {
       $this->em->persist($tipoDispositivo);
       $this->em->flush();
    }

    public function update(TipoDispositivo $tipoDispositivo)
    {
        $this->em->merge($tipoDispositivo);
        $this->em->flush();
    }


    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT tipoDispositivo
            FROM App\Entities\TipoDispositivo tipoDispositivo
            WHERE tipoDispositivo.id = :id');
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
            'SELECT tipoDispositivo
            FROM App\Entities\TipoDispositivo tipoDispositivo
            order by tipoDispositivo.id
             ');
        return $query->getResult();
    }  

    

}
