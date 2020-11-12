<?php
 
namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\Plaza;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;
  

class PlazaDao extends EntityRepository   
{

    protected $em;
    
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(Plaza $plaza)
    {
       $this->em->persist($plaza);
       $this->em->flush();
    }

    public function update(Plaza $plaza)
    {
        $this->em->merge($plaza);
        $this->em->flush();
    }
    
    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT plaza 
            FROM App\Entities\Plaza plaza 
            WHERE plaza.id = :id');
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
            'SELECT plaza 
            FROM App\Entities\Plaza plaza 
            INNER JOIN plaza.negocios negocios
            WHERE negocios.id = :id');  
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
            'SELECT plaza 
            FROM App\Entities\Plaza plaza 
            order by plaza.id
             ');
        return $query->getResult();
    }

    public function listAllJson($draw,  $maxResult , $firstResult , $buscar)
    {
        $busqueda = "";
        if( trim( $buscar) != "" ){
            $busqueda = " WHERE 
            plaza.etiqueta like :buscar 
            or plaza.alias like :buscar 
            or plaza.telefono like :buscar 
            or plaza.extension like :buscar ";
        }

        $query = $this->em->createQuery(
            "SELECT 
                 plaza.id
                ,plaza.etiqueta
                ,plaza.alias
                ,plaza.telefono
                ,plaza.extension

                ,( SELECT COUNT(enc.id)   
                    FROM App\Entities\Encargado enc     
                    INNER JOIN enc.plazas plazas1 WHERE plazas1.id = plaza.id ) as numeroEncargados
                        
                ,( SELECT COUNT(neg.id)   
                    FROM App\Entities\Negocio neg     
                    INNER JOIN neg.plaza plazas2 WHERE plazas2.id = plaza.id ) as numeroNegocios

                ,plaza.status
                ,plaza.fechaAlta

            FROM App\Entities\Plaza plaza ". $busqueda ."
            order by plaza.id
             ");

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