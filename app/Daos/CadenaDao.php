<?php
 
namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\Cadena;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;
   

class CadenaDao extends EntityRepository    
{ 

    protected $em;
    
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(Cadena $cadena)
    {
       $this->em->persist($cadena);
       $this->em->flush();
    }

    public function update(Cadena $cadena)
    {
        $this->em->merge($cadena);
        $this->em->flush();
    }
    

    public function findById($id)
    {
        $query = $this->em->createQuery( 
            'SELECT cadena 
            FROM App\Entities\Cadena cadena 
            WHERE cadena.id = :id');
        $query->setParameter('id', $id);
        
        try {
            return  $query->getSingleResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    }
    
    public function findByIdEstablecimiento($id)
    { 
        $query = $this->em->createQuery(
            'SELECT cadena
                FROM App\Entities\Cadena cadena  
                JOIN cadena.negocios negocios   
                WHERE negocios.id = :id
                order by cadena.id');
        try {
            $query->setParameter('id', $id);
            return  $query->getResult();
        }  
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    }
    
    public function findByIdAsociacion($id)
    { 
        $query = $this->em->createQuery(
            'SELECT cadena
                FROM App\Entities\Cadena cadena 
                JOIN cadena.asociacion asociacion   
                WHERE asociacion.id = :id
                order by cadena.id');
        try {
            $query->setParameter('id', $id);
            return  $query->getResult();
        }  
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    }
    
    public function findByIdEncargado($id)
    { 
        $query = $this->em->createQuery(
            'SELECT cadena
                FROM App\Entities\Cadena cadena 
                JOIN cadena.encargados encargados   
                WHERE encargados.id = :id
                order by cadena.id');
        try {
            $query->setParameter('id', $id);
            return  $query->getResult();
        }  
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    }

    public function listAll()
    {
        $query = $this->em->createQuery(
            'SELECT cadena 
            FROM App\Entities\Cadena cadena 
            order by cadena.id
             ');
        return $query->getResult();
    }
    

    public function findByEtiqueta($etiqueta)
    {
        $query = $this->em->createQuery(
            'SELECT cadena 
            FROM App\Entities\Cadena cadena 
            WHERE cadena.etiqueta = :etiqueta');
        $query->setParameter('etiqueta', $etiqueta);
        
        try {
            return  $query->getSingleResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    }

    
    public function listAllByIDS( $cadenas )
    {
        $query = $this->em->createQuery(
            'SELECT cadena 
            FROM App\Entities\Cadena cadena
            WHERE cadena.id in ( :cadenas)');    

        $query->setParameter('cadenas', $cadenas );
        
        return  $query->getResult();
    }



    public function listAllJson($draw,  $maxResult , $firstResult , $buscar)
    {

         $busqueda = "";
        if( trim( $buscar) != "" ){
            $busqueda = " WHERE 
            cadena.etiqueta like :buscar 
            or cadena.alias like :buscar
            or aso.etiqueta like :buscar ";
        }

        $query = $this->em->createQuery(
            "SELECT Distinct
                cadena.id,
                cadena.etiqueta as nombre,
                cadena.alias,
                aso.etiqueta as asociacion,
                (SELECT COUNT(negocio.id) 
                    FROM App\Entities\Cadena caden 
                    LEFT JOIN caden.negocios negocio WHERE caden.id = cadena.id ) as numeroNegocios,
                (SELECT COUNT(enc.id) 
                    FROM App\Entities\Cadena cade
                    LEFT JOIN cade.encargados enc WHERE cade.id = cadena.id) as numeroEncargados,
                cadena.fechaAlta,
                cadena.status
            FROM App\Entities\Cadena cadena 
            LEFT JOIN cadena.asociacion aso". $busqueda
            );

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