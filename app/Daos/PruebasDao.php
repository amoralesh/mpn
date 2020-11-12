<?php
 
namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\Pruebas;


use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session; 
use File;  
  


class PruebasDao extends EntityRepository  
{ 

    protected $em;  
     
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(Pruebas $pruebas)
    {
       $this->em->persist($pruebas);
       $this->em->flush();
    }

    public function update(Pruebas $pruebas)
    {
        $this->em->merge($pruebas);
        $this->em->flush();
    }
    

    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT prueba 
            FROM App\Entities\Pruebas prueba   
            WHERE prueba.id = :id');
        $query->setParameter('id', $id);
        
        try {
            return  $query->getSingleResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return NULL;
        } 
    }

    public function findByNegocio($id)
    {
        $query = $this->em->createQuery(
            'SELECT prueba
            FROM App\Entities\Pruebas prueba   
            LEFT JOIN prueba.negocio negocio    
            WHERE negocio.id = :id
            order by prueba.fechaAlta desc ');  
        try {

            $query->setParameter('id', $id);
            return  $query->getResult();
        }  
        catch(\Doctrine\ORM\NoResultException $e) {
            return NULL;
        }
    }

  
    public function listAll( $fechaInicio , $fechaFin, $draw,  $maxResult , $firstResult , $buscar )
    {     
        $busqueda = "";
        if( trim( $buscar) != "" ){
            $busqueda = " AND (
               sector.etiqueta like :buscar 
            or zona.etiqueta like :buscar
            or negocio.nombre like :buscar
            or negocio.razonSocial like :buscar 
            or cadena.etiqueta like :buscar
            or tipoDispositivo.etiqueta like :buscar 
            or negocio.status like :buscar ) ";
        }

        $query = $this->em->createQuery(
            "SELECT pruebas
                FROM App\Entities\Pruebas pruebas 
                LEFT JOIN pruebas.dispositivo dispositivo  
                LEFT JOIN pruebas.sector sector 
                LEFT JOIN sector.zonas zona   
                LEFT JOIN dispositivo.tipoDispositivo tipoDispositivo
                LEFT JOIN dispositivo.negocio negocio     
                LEFT JOIN negocio.cadenas cadena
                where pruebas.fechaAlta BETWEEN :fechaInicio and :fechaFin "  .$busqueda. " ORDER BY pruebas.id desc " );

            $query->setParameter('fechaInicio', $fechaInicio );
            $query->setParameter('fechaFin', $fechaFin );

        if( trim( $buscar) != "" ){
            $query->setParameter('buscar', "%".$buscar."%");
        }
   
       try { 
            $paginator = $this->paginate( $query , $maxResult , $firstResult );
            $totalItems = count($paginator);
            return array(
              "draw"            => intval( $draw ),   
              "recordsTotal"    => intval( $totalItems ),  
              "recordsFiltered" => intval( $totalItems ),
              "data"            => $query->getResult()  // total data array
            );
        }  
        catch(\Doctrine\ORM\NoResultException $e) {
            return NULL;
        }
    }
    
    public function paginate($query, $maxResult = 10, $firstResult = 1)
    {
        $paginator = new Paginator($query);
        $paginator->setUseOutputWalkers(false);
        $paginator
            ->getQuery()
            ->setFirstResult($firstResult) // set the offset
            ->setMaxResults($maxResult); // set the limit
        return $paginator;
    }
    
    /*    ALERTAS
    ===============================================*/


 


  

}