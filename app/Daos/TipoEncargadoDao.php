<?php

namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\TipoEncargado;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;  


class TipoEncargadoDao extends EntityRepository
{

    protected $em;

    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(TipoEncargado $tipoEncargado)
    {
       $this->em->persist($tipoEncargado);
       $this->em->flush();
    }

    public function update(TipoEncargado $tipoEncargado)
    {
        $this->em->merge($tipoEncargado);
        $this->em->flush();
    }

    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT tipoEncargado
            FROM App\Entities\TipoEncargado tipoEncargado
            WHERE tipoEncargado.id = :id');
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
            FROM App\Entities\TipoEncargado gn
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
            'SELECT tipoEncargado
            FROM App\Entities\TipoEncargado tipoEncargado
            order by tipoEncargado.etiqueta
             ');
        return $query->getResult();
    }



}
