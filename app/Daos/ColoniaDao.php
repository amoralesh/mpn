<?php
 
namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\Colonia;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;
  
 
class ColoniaDao extends EntityRepository  
{ 

    protected $em;
    
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(Colonia $colonia)
    {   
       $this->em->persist($colonia);
       $this->em->flush();
    }

    public function update(Colonia $colonia)
    {
        $this->em->merge($colonia);
        $this->em->flush();
    }
    

    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT colonia 
            FROM App\Entities\Colonia colonia 
            WHERE colonia.id = :id');
        $query->setParameter('id', $id);
        
        try {
            return  $query->getSingleResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    }


    public function findByEtiquetaAndDelegacion($etiqueta,$delegacion)
    {
        $query = $this->em->createQuery(
            'SELECT colonia 
            FROM App\Entities\Colonia colonia
            JOIN colonia.delegacion d  
            WHERE colonia.etiqueta = :etiqueta AND d.etiqueta=:delegacion');
        $query->setParameter('etiqueta', $etiqueta);
        $query->setParameter('delegacion', $delegacion);
        
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
            'SELECT colonia 
            FROM App\Entities\Colonia colonia 
            WHERE colonia.etiqueta = :etiqueta');
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
            'SELECT colonia 
            FROM App\Entities\Colonia colonia 
            order by colonia.etiqueta
             ');
        return $query->getResult();
    }


    public function findByIdDelegacion($id)
    {
        $query = $this->em->createQuery(
            'SELECT colonia
            FROM App\Entities\Colonia colonia 
            JOIN colonia.delegacion del 
            WHERE del.id = :id
            order by colonia.id');

        
        try {
            $query->setParameter('id', $id);
            return  $query->getResult();
        }  
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    }

    public function findByDelegacionEntity($etiqueta)
    {
        $query = $this->em->createQuery(
            'SELECT colonia
            FROM App\Entities\Colonia colonia 
            JOIN colonia.delegacion del 
            WHERE del.etiqueta = :etiqueta  
            order by colonia.etiqueta asc');

        $query->setParameter('etiqueta', $etiqueta);
        
        try {
            return  $query->getResult();
        }  
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    }


    public function listAllJson( $draw,  $maxResult , $firstResult , $buscar )
    {
        $busqueda = "";
        if( trim( $buscar) != "" ){
            $busqueda = " WHERE 
            del.etiqueta like :buscar 
            or colonia.etiqueta like :buscar ";
        }

        $query = $this->em->createQuery(
            "SELECT colonia.id
            ,colonia.etiqueta as nombre
            ,del.etiqueta as delegacion
            FROM App\Entities\Colonia colonia 
            JOIN colonia.delegacion del ". $busqueda ." order by colonia.id");

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