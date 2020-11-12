<?php
 
namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\Encargado;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;
  

class EncargadoDao extends EntityRepository  
{ 

    protected $em;
    
    public function __construct(ManagerRegistry $em)
    { 
        $this->em = $em->getManager('default'); 
    }

    public function create(Encargado $encargado)
    {
       $this->em->persist($encargado);
       $this->em->flush();
       return $encargado;
    }

    public function update(Encargado $encargado)
    {
        $this->em->merge($encargado);
        $this->em->flush();
    }
    

    /** VALIDADA */
    public function findById($id) 
    { 
        $query = $this->em->createQuery(
            'SELECT encargado 
            FROM App\Entities\Encargado encargado 
            WHERE encargado.id = :id');
        $query->setParameter('id', $id);
        
        try {
            return  $query->getSingleResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE; 
        }
    }

    /** VALIDADA */
    public function findByCorreo($correo)
    {
        $query = $this->em->createQuery(
            'SELECT encargado 
            FROM App\Entities\Encargado encargado 
            WHERE encargado.correo = :correo');  
        $query->setParameter('correo', $correo);
        
        try {
            return  $query->getSingleResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    }


    /** VALIDADA */
    public function findByIdAsociacion($id)
    {   
        $query = $this->em->createQuery(   
            'SELECT encargado
                FROM App\Entities\Encargado encargado 
                JOIN encargado.asociaciones asociaciones   
                WHERE asociaciones.id = :id 
                order by encargado.id'); 
        try {
            $query->setParameter('id', $id);
            return  $query->getResult();
        }  
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    }


    /** VALIDADA */
    public function findByIdCadena($id)
    {   
        $query = $this->em->createQuery(   
            'SELECT encargado
                FROM App\Entities\Encargado encargado  
                JOIN encargado.cadenas cadenas   
                WHERE cadenas.id = :id 
                order by encargado.id');    
        try {
            $query->setParameter('id', $id);
            return  $query->getResult();
        }  
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    }

    /** VALIDADA */
    public function findByIdPlaza($id)
    {   
        $query = $this->em->createQuery(   
            'SELECT encargado  
                FROM App\Entities\Encargado encargado  
                JOIN encargado.plazas plazas   
                WHERE plazas.id = :id 
                order by encargado.id'); 
        try {
            $query->setParameter('id', $id);
            return  $query->getResult();
        }  
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    }
    

    /** VALIDADA */
    public function listAll()
    {
        $query = $this->em->createQuery(
            'SELECT encargado 
            FROM App\Entities\Encargado encargado 
            order by encargado.id
             '); 
        return $query->getResult();  
    }
     
    /** VALIDADA */
    public function listAllByIDS($encargados)
    {
        $query = $this->em->createQuery(
            'SELECT encargado 
            FROM App\Entities\Encargado encargado
            WHERE encargado.id in ( :encargados)');    

        $query->setParameter('encargados', $encargados );
        
        return  $query->getResult();
    }

    /** VALIDADA */
    public function obtenerEncargados($draw,  $maxResult , $firstResult , $buscar)
    {
        $busqueda = "";
        if( trim( $buscar) != "" ){
            $busqueda = " WHERE 
            encargado.correo like :buscar 
            or encargado.nombre like :buscar 
            or encargado.apellidoPaterno like :buscar 
            or encargado.apellidoMaterno like :buscar 
            or encargado.telefono like :buscar 
            or encargado.extension like :buscar 
            or encargado.celular like :buscar 
            or encargado.status like :buscar
            or negocio.nombre like :buscar   
            or negocio.razonSocial like :buscar   
            or asociacion.etiqueta like :buscar     
            or asociacion.alias like :buscar   
            or cadena.etiqueta like :buscar     
            or cadena.alias like :buscar   
            ";
        }

        $query = $this->em->createQuery(
            "SELECT DISTINCT 
                 encargado.id 
                ,encargado.nombre
                ,encargado.apellidoPaterno
                ,encargado.apellidoMaterno
                ,encargado.correo
                ,encargado.celular
                ,encargado.telefono
                ,encargado.extension
                ,tipoEn.etiqueta as tipoEncargado 
                ,encargado.fechaAlta
                ,encargado.status

            ,(SELECT COUNT(asociacione.id) 
                FROM App\Entities\Encargado encarga 
                LEFT JOIN encarga.asociaciones asociacione WHERE encarga.id = encargado.id) as asociaciones
                   
            ,(SELECT COUNT(caden.id) 
                FROM App\Entities\Encargado encargad 
                LEFT JOIN encargad.cadenas caden WHERE encargad.id = encargado.id ) as cadenas
            
            ,(SELECT COUNT(negoci.id) 
                FROM App\Entities\Encargado encarg
                LEFT JOIN encarg.negocios negoci WHERE encarg.id = encargado.id ) as establecimientos

            FROM App\Entities\Encargado encargado 
            INNER JOIN encargado.tipoEncargado tipoEn
            LEFT JOIN encargado.negocios negocio
            LEFT JOIN encargado.asociaciones asociacion 
            LEFT JOIN encargado.cadenas cadena ". $busqueda ."");

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

    
    /** VALIDADA */
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