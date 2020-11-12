<?php
 
namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\PuertasMercado;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;
  

class PuertasMercadoDao extends EntityRepository  
{ 

    protected $em;
    
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(PuertasMercado $puertasMercado)
    {
       $this->em->persist($puertasMercado);
       $this->em->flush();
      
    }

    public function update(PuertasMercado $puertasMercado)
    {
        $this->em->merge($puertasMercado);
        $this->em->flush();
    }
    

    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT puertasM 
            FROM App\Entities\PuertasMercado puertasM 
            WHERE puertasM.id = :id');
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
            "SELECT puertasM
            FROM App\Entities\PuertasMercado puertasM 
            ");

        return $query->getResult();
    }

    public function findByNegocio($id)
    {
        $query = $this->em->createQuery(
            'SELECT puertasM.id,
                    puertasM.nombre,
                    puertasM.latitudPuerta,
                    puertasM.longitudPuerta,
                    puertasM.fechaAlta,
               dispositivo.id              as idDispositivos,
               dispositivo.etiqueta        as etiquetaDispositivos,
               dispositivo.token           as tokenDispositivos,
               tipoDispositivo.etiqueta    as tipoDispositivoDispositivos,
               dispositivo.fechaAlta       as fechaAltaDispositivos,
                tipoStatusD.etiqueta      as tipoStatusDispositivos
            FROM App\Entities\PuertasMercado puertasM 
            LEFT JOIN puertasM.negocio negocio   
            LEFT JOIN puertasM.dispositivos dispositivo
            LEFT JOIN dispositivo.tipoStatus tipoStatusD 
            LEFT JOIN dispositivo.tipoDispositivo tipoDispositivo
            WHERE negocio.id = :id
            order by puertasM.id');

        $query->setParameter('id', $id);
        
        try {
            return  $query->getResult();
        }  
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    }


}