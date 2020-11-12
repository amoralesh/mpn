<?php
 
namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\PuertasPlazas;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;
  

class PuertasPlazasDao extends EntityRepository  
{ 

    protected $em;
    
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(PuertasPlazas $puertasPlazas)
    {
       $this->em->persist($puertasPlazas);
       $this->em->flush();
      
    }

    public function update(PuertasPlazas $puertasPlazas)
    {
        $this->em->merge($puertasPlazas);
        $this->em->flush();
    }
    

    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT puertasM 
            FROM App\Entities\PuertasPlazas puertasP 
            WHERE puertasP.id = :id');
        $query->setParameter('id', $id);
        
        try {
            return  $query->getSingleResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    }
  

    public function listAllEntity()
    {
        $query = $this->em->createQuery(
            "SELECT puertasP
            FROM App\Entities\PuertasPlazas puertasP 
            ");

        return $query->getResult();
    }

    public function findByNegocio($id)
    {
        $query = $this->em->createQuery(
            'SELECT puertasP.id,
                    puertasP.nombre,
                    puertasP.latitudPuerta,
                    puertasP.longitudPuerta,
                    puertasP.fechaAlta,
               dispositivo.id              as idDispositivos,
               dispositivo.etiqueta        as etiquetaDispositivos,
               dispositivo.token           as tokenDispositivos,
               tipoDispositivo.etiqueta    as tipoDispositivoDispositivos,
               dispositivo.fechaAlta       as fechaAltaDispositivos,
                tipoStatusD.etiqueta      as tipoStatusDispositivos
            FROM App\Entities\PuertasPlazas puertasP 
            LEFT JOIN puertasP.negocio negocio   
            LEFT JOIN puertasP.dispositivos dispositivo
            LEFT JOIN dispositivo.tipoStatus tipoStatusD 
            LEFT JOIN dispositivo.tipoDispositivo tipoDispositivo
            WHERE negocio.id = :id
            order by puertasP.id');

        $query->setParameter('id', $id);
        
        try {
            return  $query->getResult();
        }  
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    }


}