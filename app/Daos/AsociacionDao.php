<?php
 
namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\Asociacion;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;
  
 
class AsociacionDao extends EntityRepository  
{      

    protected $em;
    
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(Asociacion $asociacion)
    { 
       $this->em->persist($asociacion);
       $this->em->flush();
    }

    public function update(Asociacion $asociacion)
    {
        $this->em->merge($asociacion);
        $this->em->flush();
    }
    

    public function findById($id)
    { 
        $query = $this->em->createQuery(
            'SELECT asociacion 
            FROM App\Entities\Asociacion asociacion 
            WHERE asociacion.id = :id');
        $query->setParameter('id', $id);
        
        try {
            return  $query->getSingleResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    }   
    

    public function findByEstablecimientoId($id)
    { 
        $query = $this->em->createQuery(
            'SELECT asociacion 
            FROM App\Entities\Asociacion asociacion 
            INNER JOIN asociacion.negocios negocios  
            WHERE negocios.id = :id');
        
        try {
            $query->setParameter('id', $id);
            return $query->getResult(); 
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    }

    public function findByCadenaId($id)
    { 
        $query = $this->em->createQuery(
            'SELECT asociacion 
            FROM App\Entities\Asociacion asociacion 
            INNER JOIN asociacion.cadenas cadenas
            WHERE cadenas.id = :id');
        
        try {
            $query->setParameter('id', $id);
            return $query->getSingleResult(); 
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    }
    
    public function findByEncargadoId($id)
    { 
        $query = $this->em->createQuery(
            'SELECT asociacion 
            FROM App\Entities\Asociacion asociacion 
            INNER JOIN asociacion.encargados encargados  
            WHERE encargados.id = :id');
        
        try {
            $query->setParameter('id', $id);
            return $query->getResult(); 
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    }


    public function listAllEntity()
    {
        $query = $this->em->createQuery(
            "SELECT asociacion
            FROM App\Entities\Asociacion asociacion 
            ");

        return $query->getResult();
    }


    public function listAllByIDS( $asociaciones )
    {
        $query = $this->em->createQuery(
            'SELECT asociacion 
            FROM App\Entities\Asociacion asociacion
            WHERE asociacion.id in ( :asociaciones)');    

        $query->setParameter('asociaciones', $asociaciones );
        
        return  $query->getResult();
    }


    public function listAll($draw,  $maxResult , $firstResult , $buscar)
    {

        $busqueda = "";
        if( trim( $buscar) != "" ){
            $busqueda = " WHERE 
            asociacion.etiqueta like :buscar 
            or asociacion.alias like :buscar
            or asociacion.fechaAlta like :buscar ";
        }
        
        $query = $this->em->createQuery(
            "SELECT Distinct
                asociacion.id,
                asociacion.etiqueta as nombre,
                asociacion.alias,
  
                (SELECT COUNT(cad.etiqueta) 
                    FROM App\Entities\Asociacion asoc 
                    LEFT JOIN asoc.cadenas cad WHERE asoc.id = asociacion.id ) as numeroCadenas,

                (SELECT COUNT(enc.nombre) 
                    FROM App\Entities\Asociacion asoci 
                    LEFT JOIN asoci.encargados enc WHERE asoci.id = asociacion.id) as numeroEncargados,

                asociacion.fechaAlta,
                asociacion.status  

            FROM App\Entities\Asociacion asociacion 
            LEFT JOIN asociacion.cadenas cadenas 
            LEFT JOIN asociacion.encargados encargado ". $busqueda);

         if( trim( $buscar) != "" ){ 
            $query->setParameter('buscar', "%".$buscar."%");
        }

       try {
            $paginator = $this->paginate($query, $maxResult , $firstResult );
            $totalItems = count($paginator);
            return array(
              "draw"            => intval( $draw ),   
              "recordsTotal"    => intval( $totalItems ),  
              "recordsFiltered" => intval( $totalItems ),
              "data"            => $paginator->getQuery()->getResult()   // total data array
            );
        }  
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    }

    public function listAllAsociacionesEscuelas ($draw,  $maxResult , $firstResult , $buscar)
    {

        $busqueda = "";
        if( trim( $buscar) != "" ){
            $busqueda = " WHERE 
            asociacion.etiqueta like :buscar 
            or asociacion.alias like :buscar
            or asociacion.fechaAlta like :buscar ";
        }
        
        $query = $this->em->createQuery(
            "SELECT Distinct
                asociacion.id,
                asociacion.etiqueta as nombre,
                asociacion.alias,
  
                (SELECT COUNT(cad.etiqueta) 
                    FROM App\Entities\Asociacion asoc 
                    LEFT JOIN asoc.cadenas cad WHERE asoc.id = asociacion.id ) as numeroCadenas,

                (SELECT COUNT(enc.nombre) 
                    FROM App\Entities\Asociacion asoci 
                    LEFT JOIN asoci.encargados enc WHERE asoci.id = asociacion.id) as numeroEncargados,

                asociacion.fechaAlta,
                asociacion.status  

            FROM App\Entities\Asociacion asociacion 
            LEFT JOIN asociacion.cadenas cadenas 
            LEFT JOIN asociacion.encargados encargado ".   " WHERE asociacion.id in ( 22,23,24,25 ) ".$busqueda);

         if( trim( $buscar) != "" ){ 
            $query->setParameter('buscar', "%".$buscar."%");
        }

       try {
            $paginator = $this->paginate($query, $maxResult , $firstResult );
            $totalItems = count($paginator);
            return array(
              "draw"            => intval( $draw ),   
              "recordsTotal"    => intval( $totalItems ),  
              "recordsFiltered" => intval( $totalItems ),
              "data"            => $paginator->getQuery()->getResult()   // total data array
            );
        }  
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    }

    public function listAllAsociacionesMercados ($draw,  $maxResult , $firstResult , $buscar)
    {

        $busqueda = "";
        if( trim( $buscar) != "" ){
            $busqueda = " WHERE 
            asociacion.etiqueta like :buscar 
            or asociacion.alias like :buscar
            or asociacion.fechaAlta like :buscar ";
        }
        
        $query = $this->em->createQuery(
            "SELECT Distinct
                asociacion.id,
                asociacion.etiqueta as nombre,
                asociacion.alias,
  
                (SELECT COUNT(cad.etiqueta) 
                    FROM App\Entities\Asociacion asoc 
                    LEFT JOIN asoc.cadenas cad WHERE asoc.id = asociacion.id ) as numeroCadenas,

                (SELECT COUNT(enc.nombre) 
                    FROM App\Entities\Asociacion asoci 
                    LEFT JOIN asoci.encargados enc WHERE asoci.id = asociacion.id) as numeroEncargados,

                asociacion.fechaAlta,
                asociacion.status  

            FROM App\Entities\Asociacion asociacion 
            LEFT JOIN asociacion.cadenas cadenas 
            LEFT JOIN asociacion.encargados encargado ".   " WHERE asociacion.id in (26 ) ".$busqueda);

         if( trim( $buscar) != "" ){ 
            $query->setParameter('buscar', "%".$buscar."%");
        }

       try {
            $paginator = $this->paginate($query, $maxResult , $firstResult );
            $totalItems = count($paginator);
            return array(
              "draw"            => intval( $draw ),   
              "recordsTotal"    => intval( $totalItems ),  
              "recordsFiltered" => intval( $totalItems ),
              "data"            => $paginator->getQuery()->getResult()   // total data array
            );
        }  
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
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


}