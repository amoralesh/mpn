<?php

namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\Delegacion;

use Doctrine\ORM\Query\ResultSetMapping;  
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;


class DelegacionDao extends EntityRepository 
{

    protected $em;
 
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(Delegacion $delegacion)
    {
       $this->em->persist($delegacion);
       $this->em->flush();
    }

    public function update(Delegacion $delegacion)
    {
        $this->em->merge($delegacion);
        $this->em->flush();
    }


    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT delegacion
            FROM App\Entities\Delegacion delegacion
            WHERE delegacion.id = :id');
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
            'SELECT delegacion
            FROM App\Entities\Delegacion delegacion
            order by delegacion.etiqueta
             ');
        return $query->getResult();
    }

}
