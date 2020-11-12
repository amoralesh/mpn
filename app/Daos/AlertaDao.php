<?php
 
namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\Alarma;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session; 
use File;  
  
 
class AlertaDao extends EntityRepository  
{ 
     
    protected $em;
    
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(Alarma $alarma)   
    {
       $this->em->persist($alarma);
       $this->em->flush();
       return $alarma;
    }

    public function update(Alarma $alarma)
    {
        $this->em->merge($alarma);
        $this->em->flush();
    }
    

    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT alarma 
            FROM App\Entities\Alarma alarma   
            WHERE alarma.id = :id');
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
            'SELECT alarma
            FROM App\Entities\Alarma alarma 
            LEFT JOIN alarma.negocio negocio    
            WHERE negocio.id = :id
            order by alarma.fechaAlta desc ');  
        try {

            $query->setParameter('id', $id);
            return  $query->getResult();
        }  
        catch(\Doctrine\ORM\NoResultException $e) {
            return NULL;
        }
    }

    public function listAllCCO( $ultimoId , $fechaInicio , $fechaFinal , $sectores  )
    {
        $fechaInicio = $fechaInicio->format('Y-m-d');
        $fechaFinal  = $fechaFinal->format('Y-m-d');
    
        $ultimaAlerta="";
        if( $ultimoId != null ){
            $ultimaAlerta = " AND alarma.id > :ultimoId ";
        }

        $sector="";
        if( $sectores != null ){
            $sector = " AND sect.id in (:sectores) ";
        }

        $query = $this->em->createQuery(
            "SELECT alarma
            FROM App\Entities\Alarma alarma
            INNER JOIN alarma.negocio negocio
            LEFT JOIN alarma.sector sect
            WHERE alarma.fechaAlta BETWEEN '" . $fechaInicio . " 00:00:00' AND '" . $fechaInicio . " 23:59:59' " . $ultimaAlerta . " " .  $sector . " ORDER BY alarma.id desc");
             
        if( $ultimoId != null ){
            $query->setParameter('ultimoId', $ultimoId );
        }

        if( $sectores != null ){
            $query->setParameter('sectores', $sectores );
        }

        try {
            //$query->setParameter('inicio', $fechaInicio );
            //$query->setParameter('fin', $fechaFinal );
            return $query->getResult(); //$query->getResult();
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
            tipoAlarma.etiqueta like :buscar
            or alarma.sector like :buscar 
            or alarma.zona like :buscar 
            or tipoStatus.etiqueta like :buscar 
            or motivoAlarma.etiqueta like :buscar 
            or informe.contenido like :buscar
            or negocio.nombre like :buscar
            or negocio.razonSocial like :buscar 
            or cadena.etiqueta like :buscar
            or tipoDispositivo.etiqueta like :buscar 
            or negocio.status like :buscar ) ";
        }

        $query = $this->em->createQuery(
            "SELECT alarma
            FROM App\Entities\Alarma alarma 
            LEFT JOIN alarma.negocio negocio
            LEFT JOIN negocio.cadenas cadena
            LEFT JOIN alarma.dispositivo dispositivo
            LEFT JOIN dispositivo.tipoDispositivo tipoDispositivo
            LEFT JOIN alarma.tipoAlarma tipoAlarma    
            LEFT JOIN alarma.tipoStatus tipoStatus   
            LEFT JOIN alarma.informe informe   
            LEFT JOIN informe.razon r
            LEFT JOIN alarma.motivoAlarma motivoAlarma   
            WHERE alarma.fechaAlta BETWEEN :inicio AND :fin " .$busqueda. " ORDER BY alarma.id desc " );

            $query->setParameter('inicio', $fechaInicio );
            $query->setParameter('fin', $fechaFin );

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