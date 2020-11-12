<?php

namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\OficioIncorporacion;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;


class OficioIncorporacionDao extends EntityRepository
{

    protected $em;

    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(OficioIncorporacion $oficioIncorporacion)
    {
       $this->em->persist($oficioIncorporacion);
       $this->em->flush();
    }

    public function update(OficioIncorporacion $oficioIncorporacion)
    {
        $this->em->merge($oficioIncorporacion);
        $this->em->flush();
    }


    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT oficioInc
            FROM App\Entities\OficioIncorporacion oficioInc
            WHERE oficioInc.id = :id');
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
            'SELECT oficioInc
            FROM App\Entities\OficioIncorporacion oficioInc
            order by oficioInc.etiqueta
             ');
        return $query->getResult();
    }




    public function updateDocumento(OficioIncorporacion $oficioMPN)
    {
        $hoy = new \DateTime();
        $hoyFormat = $hoy->format('Y-m-d H:i:s');

        $sql = "UPDATE OficioIncorporacion
            SET documento = ".$oficioMPN->getDocumento()."
                ,nombreDocumento = '".$oficioMPN->getNombreDocumento()."'
                ,extensionDocumento = '".$oficioMPN->getExtensionDocumento()."'
                ,mimeTypeDocumento = '".$oficioMPN->getMimeTypeDocumento() ."'
                ,tamanoDocumento = '".$oficioMPN->getTamanoDocumento() ."'
                ,fechaAltaDocumento = '".$hoyFormat."' 
            WHERE id=".$oficioMPN->getId();

        $stmt = $this->em->getConnection()->prepare($sql);
        $result = $stmt->execute();
        
    }



}
