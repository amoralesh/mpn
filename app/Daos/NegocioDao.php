<?php
 
namespace App\Daos;

use Doctrine\ORM\EntityRepository;
 
use App\Entities\Negocio;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Tools\Pagination\Paginator;
//use DoctrineExtensions\Query\Mysql\YearWeek;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;  
  
     
class NegocioDao extends EntityRepository  
{

    protected $em;
    
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(Negocio $negocio)  
    {
       $this->em->persist($negocio);
       $this->em->flush();
       return $negocio;
    }  

    public function update(Negocio $negocio)   
    {
        $this->em->merge($negocio);
        $this->em->flush();
       return $negocio;
    }

    public function findById($id)  
    {
        $query = $this->em->createQuery(
            'SELECT negocio 
            FROM App\Entities\Negocio negocio 
            WHERE negocio.id = :id' );
        $query->setParameter('id', $id);
        
        try {
            return $query->getSingleResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }        
    }
    
    public function findByIdPlaza($id)
    {
        $query = $this->em->createQuery(
            'SELECT negocio 
            FROM App\Entities\Negocio negocio     
            INNER JOIN negocio.plaza plaza 
            WHERE plaza.id = :id' );
            
        $query->setParameter('id', $id);
          
        try {
            return $query->getResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }        
    }

    public function findByIdEncargado($id)
    {
        $query = $this->em->createQuery(
            'SELECT negocio 
            FROM App\Entities\Negocio negocio  
            INNER JOIN negocio.encargados encar 
            WHERE encar.id = :id' );
            
        $query->setParameter('id', $id);
          
        try {
            return $query->getResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }        
    }


    public function listAllByIDS($negocios)
    {
        $query = $this->em->createQuery(
            'SELECT nego
             FROM App\Entities\Negocio nego
            WHERE nego.id in ( :negocios)');    

        $query->setParameter('negocios', $negocios );
        
        return  $query->getResult();
    }
    
    public function listAll()
    {
        $query = $this->em->createQuery(
            'SELECT negocio 
            FROM App\Entities\Negocio negocio 
            order by negocio.etiqueta
             ');
        return $query->getResult();
    }
    
    /** VALIDADO */
    public function listAllJson($draw,  $maxResult , $firstResult , $buscar)
    {

        $busqueda = "";
        if( trim( $buscar) != "" ){
            $busqueda = " WHERE 
            cade.etiqueta           like :buscar 
            or negocio.nombre       like :buscar 
            or negocio.id           like :buscar
            or negocio.razonSocial  like :buscar
            or tipoN.etiqueta       like :buscar 
            or giroNego.etiqueta    like :buscar 
            or giroNegoG.etiqueta   like :buscar
            or negocio.comentarios  like :buscar
            or negocio.referencia   like :buscar
            or negocio.telefono     like :buscar
            or negocio.extension    like :buscar
            or negocio.fechaAlta    like :buscar ";
        }
        
        $query = $this->em->createQuery(
            "SELECT DISTINCT   
            negocio.id
           ,negocio.codigoAguila
           ,sec.etiqueta as sector
           ,negocio.placaMPN
           ,negocio.nombre
           ,negocio.razonSocial   
           ,tipoN.etiqueta as tipoNegocio
           ,giroNego.etiqueta as giroNegocio  
           ,giroNegoG.etiqueta as giroNegocioGeneral
           ,negocio.telefono
           ,negocio.extension

           ,( SELECT COUNT(ala.id)    
                   FROM App\Entities\Alarma ala     
                   INNER JOIN ala.negocio neg3 WHERE neg3.id = negocio.id ) as alarmasEmitidas

           ,( SELECT COUNT(prueb.id)
                   FROM App\Entities\Pruebas prueb     
                   INNER JOIN prueb.negocio neg4 WHERE neg4.id = negocio.id ) as pruebasEmitidas

           ,srn.etiqueta as  statusRevision   
         
           ,tipoStat.etiqueta as tipoStatus
           ,negocio.fechaAlta   
           ,negocio.status 

           FROM App\Entities\Negocio negocio 
           LEFT JOIN negocio.cadenas cade  
           LEFT JOIN negocio.sector sec  
           LEFT JOIN negocio.alarmas alarma   
           LEFT JOIN negocio.pruebas prueba       
           LEFT JOIN negocio.statusRevisionNegocio srn    
           INNER JOIN negocio.tipoNegocio tipoN
           INNER JOIN negocio.giroNegocio giroNego
           INNER JOIN negocio.giroNegocioGeneral giroNegoG
           INNER JOIN negocio.tipoStatus tipoStat ". $busqueda ."
           order by negocio.id desc ");
            
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

        } catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE; 
        }
    
    }


      /** VALIDADO */
      public function listAllJsonMercados($draw,  $maxResult , $firstResult , $buscar)
      {


          $busqueda = "";
          if( trim( $buscar) != "" ){
              $busqueda = " 
                      AND (
                       cade.etiqueta       like :buscar 
                    or negocio.nombre       like :buscar 
                    or negocio.razonSocial  like :buscar
                    or tipoN.etiqueta       like :buscar 
                    or giroNego.etiqueta    like :buscar 
                    or giroNegoG.etiqueta   like :buscar
                    or negocio.comentarios  like :buscar
                    or plaz.etiqueta        like :buscar
                    or negocio.referencia   like :buscar
                    or negocio.telefono     like :buscar
                    or negocio.extension    like :buscar
                    or negocio.fechaAlta    like :buscar
              ) ";
          }
          
          $query = $this->em->createQuery(
              "SELECT DISTINCT
              negocio.id
             ,negocio.codigoAguila
             ,sec.etiqueta as sector
             ,negocio.placaMPN
             ,negocio.nombre
             ,negocio.razonSocial   
             ,tipoN.etiqueta as tipoNegocio
             ,giroNego.etiqueta as giroNegocio  
             ,giroNegoG.etiqueta as giroNegocioGeneral
             ,negocio.telefono
             ,negocio.extension
  
            ,( SELECT COUNT(ala.id)    
                    FROM App\Entities\Alarma ala     
                    INNER JOIN ala.negocio neg3 WHERE neg3.id = negocio.id ) as alarmasEmitidas

            ,( SELECT COUNT(prueb.id)
                    FROM App\Entities\Pruebas prueb     
                    INNER JOIN prueb.negocio neg4 WHERE neg4.id = negocio.id ) as pruebasEmitidas
                    
            ,( SELECT COUNT(pm.id)
                    FROM App\Entities\PuertasMercado pm   
                    INNER JOIN pm.negocio neg7 WHERE neg7.id = negocio.id ) as numeroPuertas
  
             ,srn.etiqueta as  statusRevision   
             ,tipoStat.etiqueta as tipoStatus
             ,negocio.fechaAlta        
             ,negocio.status 
  
             FROM App\Entities\Negocio negocio
             LEFT JOIN negocio.cadenas cade
             LEFT JOIN negocio.asociaciones asocia
             LEFT JOIN cade.asociacion aso
             LEFT JOIN negocio.sector sec
             LEFT JOIN negocio.dispositivos dispo
             LEFT JOIN negocio.alarmas alarma
             LEFT JOIN negocio.pruebas prueba
             LEFT JOIN negocio.statusRevisionNegocio srn
             LEFT JOIN negocio.tipoNegocio tipoN
             LEFT JOIN negocio.giroNegocio giroNego
             LEFT JOIN negocio.giroNegocioGeneral giroNegoG
             LEFT JOIN negocio.plaza plaz
             LEFT JOIN negocio.tipoStatus tipoStat ". " WHERE asocia.id = 26 OR aso.id = 26 " . $busqueda . "
             order by negocio.id desc ");
              
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
  
          } catch(\Doctrine\ORM\NoResultException $e) {
              return FALSE; 
          }  
    }




    /** VALIDADO */
    public function listAllEscuelasJson($draw,  $maxResult , $firstResult , $buscar)
    {
        $busqueda = "";
        if( trim( $buscar) != "" ){  
            $busqueda = "  
            AND ( cade.etiqueta         like :buscar  
            or negocio.nombre       like :buscar 
            or negocio.razonSocial  like :buscar
            or tipoN.etiqueta       like :buscar 
            or giroNego.etiqueta    like :buscar 
            or giroNegoG.etiqueta   like :buscar
            or negocio.comentarios  like :buscar
            or plaz.etiqueta        like :buscar
            or negocio.referencia   like :buscar
            or negocio.telefono     like :buscar
            or negocio.extension    like :buscar
            or negocio.fechaAlta    like :buscar ) ";
        }
        
        $query = $this->em->createQuery(
            " SELECT DISTINCT
             negocio.id
            ,negocio.codigoAguila
            ,negocio.placaMPN
            ,negocio.nombre
            ,negocio.razonSocial   
            ,tipoN.etiqueta as tipoNegocio
            ,giroNego.etiqueta as giroNegocio  
            ,giroNegoG.etiqueta as giroNegocioGeneral
            ,negocio.comentarios  
            ,plaz.etiqueta as plaza
            ,negocio.piso  
            ,negocio.referencia
            ,negocio.latitud
            ,negocio.longitud
            ,negocio.telefono
            ,negocio.extension
  
            ,( SELECT COUNT(enc.id)   
                    FROM App\Entities\Encargado enc     
                    INNER JOIN enc.negocios neg1 WHERE neg1.id = negocio.id ) as numeroEncargados
                    
            ,( SELECT COUNT(umobile.id) 
                    FROM App\Entities\UsuariosMobile\UsuarioMobile umobile     
                    INNER JOIN umobile.negocios neg2 WHERE neg2.id = negocio.id ) as numeroUsuariosMovil
    
            ,( SELECT SUM( dispositiv.cantidad ) 
                    FROM App\Entities\Dispositivo dispositiv     
                    INNER JOIN dispositiv.negocio neg0 WHERE neg0.id = negocio.id ) as numeroDispositivos

            ,( SELECT COUNT(ala.id)    
                    FROM App\Entities\Alarma ala     
                    INNER JOIN ala.negocio neg3 WHERE neg3.id = negocio.id ) as alarmasEmitidas

            ,( SELECT COUNT(prueb.id)
                    FROM App\Entities\Pruebas prueb     
                    INNER JOIN prueb.negocio neg4 WHERE neg4.id = negocio.id ) as pruebasEmitidas
                    
            ,( SELECT COUNT(cad.id) 
                    FROM App\Entities\Cadena cad   
                    INNER JOIN cad.negocios neg5 WHERE neg5.id = negocio.id ) as numeroCadenas
                    
            ,( SELECT COUNT(asoc.id)
                    FROM App\Entities\Asociacion asoc   
                    INNER JOIN asoc.negocios neg6 WHERE neg6.id = negocio.id ) as numeroAsociaciones

            ,( SELECT COUNT(pm.id)
                    FROM App\Entities\PuertasMercado pm   
                    INNER JOIN pm.negocio neg7 WHERE neg7.id = negocio.id ) as numeroPuertas
              
            ,srn.etiqueta as  statusRevision   
          
            ,tipoStat.etiqueta as tipoStatus
            ,negocio.fechaAlta   
            ,negocio.status 

            FROM App\Entities\Negocio negocio 
            LEFT JOIN negocio.cadenas cade  
            LEFT JOIN negocio.asociaciones asocia 
            INNER JOIN cade.asociacion aso  
            INNER JOIN negocio.dispositivos dispo   
            LEFT JOIN negocio.alarmas alarma   
            LEFT JOIN negocio.pruebas prueba       
            LEFT JOIN negocio.statusRevisionNegocio srn    
            INNER JOIN negocio.tipoNegocio tipoN
            INNER JOIN negocio.giroNegocio giroNego
            INNER JOIN negocio.giroNegocioGeneral giroNegoG   
            LEFT JOIN negocio.plaza plaz 
            INNER JOIN negocio.tipoStatus tipoStat ".
            " WHERE aso.id in ( 22,23,24,25 ) OR asocia.id in ( 22,23,24,25 )  "
            . $busqueda .
            " order by negocio.id desc ");
            
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

        } catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    
    }

    
    public function listAllJsonPlazasPuertas($draw,  $maxResult , $firstResult , $buscar)
    {

        $busqueda = "";
        if( trim( $buscar) != "" ){
            $busqueda = " AND 
            cade.etiqueta           like :buscar 
            or negocio.nombre       like :buscar 
            or negocio.razonSocial  like :buscar
            or tipoN.etiqueta       like :buscar 
            or giroNego.etiqueta    like :buscar 
            or giroNegoG.etiqueta   like :buscar
            or negocio.comentarios  like :buscar
            or plaz.etiqueta        like :buscar
            or negocio.referencia   like :buscar
            or negocio.telefono     like :buscar
            or negocio.extension    like :buscar
            or negocio.fechaAlta    like :buscar ";
        }
        
        $query = $this->em->createQuery(
            "SELECT DISTINCT
            negocio.id
           ,negocio.codigoAguila
           ,sec.etiqueta as sector
           ,negocio.placaMPN
           ,negocio.nombre
           ,negocio.razonSocial   
           ,tipoN.etiqueta as tipoNegocio
           ,giroNego.etiqueta as giroNegocio  
           ,giroNegoG.etiqueta as giroNegocioGeneral
           ,negocio.telefono
           ,negocio.extension

           ,( SELECT COUNT(ala.id)    
                   FROM App\Entities\Alarma ala     
                   INNER JOIN ala.negocio neg3 WHERE neg3.id = negocio.id ) as alarmasEmitidas

           ,( SELECT COUNT(prueb.id)
                   FROM App\Entities\Pruebas prueb     
                   INNER JOIN prueb.negocio neg4 WHERE neg4.id = negocio.id ) as pruebasEmitidas

           ,srn.etiqueta as  statusRevision   
         
           ,tipoStat.etiqueta as tipoStatus
           ,negocio.fechaAlta        
           ,negocio.status 

           FROM App\Entities\Negocio negocio 
           LEFT JOIN negocio.cadenas cade  
           LEFT JOIN negocio.asociaciones asocia      
           LEFT JOIN cade.asociacion aso  
           LEFT JOIN negocio.sector sec  
           LEFT JOIN negocio.dispositivos dispo   
           LEFT JOIN negocio.alarmas alarma   
           LEFT JOIN negocio.pruebas prueba       
           LEFT JOIN negocio.statusRevisionNegocio srn    
           LEFT JOIN negocio.tipoNegocio tipoN
           LEFT JOIN negocio.giroNegocio giroNego
           LEFT JOIN negocio.giroNegocioGeneral giroNegoG
           LEFT JOIN negocio.plaza plaz 
           LEFT JOIN negocio.tipoStatus tipoStat ". " WHERE giroNegoG.id = 40  " . $busqueda . "
           order by negocio.id desc ");
            
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

        } catch(\Doctrine\ORM\NoResultException $e) {
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





    /*   APP MOVIL
    )===================================================================*/


    
    public function findByUsuarioApp($usuario)
    {
        $query = $this->em->createQuery(
           'SELECT negocio
            FROM App\Entities\Negocio negocio
            JOIN negocio.usuariosApp usuApp
            WHERE usuApp.usuario = :usuario');

        $query->setParameter('usuario', $usuario);
           
        try {
            return  $query->getResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }                
    }


    public function findByUsuarioAppEstablecimientos($usuario)
    {
        $query = $this->em->createQuery(
           'SELECT 
                 negocio.id                      as idNegocio
                ,negocio.nombre                  as nombreNegocio
                ,negocio.razonSocial             as razonSocialNegocio
                ,tipoNegocio.etiqueta            as tipoNegocioNegocio
                ,negocio.piso                    as pisoNegocio
                ,negocio.referencia              as referenciaNegocio
                ,negocio.latitud                 as latitudNegocio
                ,negocio.longitud                as longitudNegocio
                ,negocio.telefono                as telefonoNegocio
                ,negocio.extension               as extensionNegocio
                ,tipoStatusN.etiqueta            as tipoStatusNegocio
                ,negocio.status                  as statusNegocio
                ,negocio.fechaAlta               as fechaAltaNegocio
                
                ,direccion.callePrincipal        as callePrincipalDireccion
                ,direccion.calle1                as calle1Direccion
                ,direccion.calle2                as calle2Direccion
                ,direccion.numeroInterior        as numeroInteriorDireccion 
                ,direccion.numeroExterior        as numeroExteriorDireccion

            FROM App\Entities\Negocio negocio
            LEFT JOIN negocio.tipoNegocio tipoNegocio
            LEFT JOIN negocio.tipoStatus tipoStatusN
            LEFT JOIN negocio.direccion direccion
            JOIN negocio.usuariosApp usuApp
            
            WHERE usuApp.usuario = :usuario');

        $query->setParameter('usuario', $usuario);
        
        try {
            return  $query->getResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }        
    }


    public function findByUsuarioAppInicio($usuario)
    {
        $query = $this->em->createQuery(
           'SELECT 
                 negocio.id                      as idNegocio
                ,negocio.nombre                  as nombreNegocio
                ,negocio.razonSocial             as razonSocialNegocio
                ,negocio.latitud                 as latitudNegocio
                ,negocio.longitud                as longitudNegocio
                ,tipoStatusN.etiqueta            as tipoStatusNegocio
                ,negocio.status                  as statusNegocio

            FROM App\Entities\Negocio negocio   
            LEFT JOIN negocio.tipoStatus tipoStatusN
            JOIN negocio.usuariosApp usuApp
            WHERE usuApp.usuario = :usuario'); 

        $query->setParameter('usuario', $usuario);
        
        try {
            return  $query->getResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }                
    }




    /*
    IMPORTANTE PARA BUSCAR ESTABLECIMIENTOS DESDE EL 201, NO MODIFIRCAR
    */
    public function findByToken($token)
    { 
        $query = $this->em->createQuery(
            'SELECT negocio
            FROM App\Entities\Negocio negocio
            JOIN negocio.dispositivos dispo  
            LEFT JOIN negocio.puertaMercado pm
            LEFT JOIN negocio.puertaPlazas pp   
            LEFT JOIN pm.dispositivos dispoMercado
            LEFT JOIN pp.dispositivos dispoPlaza
            WHERE dispo.token = :token or dispoMercado.token = :token or dispoPlaza.token = :token 
            order by negocio.id');  
    
        $query->setParameter('token', $token);

        try {
            return  $query->getSingleResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        } 
    }


       /** MODO PRUEBA DE DISPOSOTIVOS */
       public function listAllModoPruebaDispositivosJson($draw,  $maxResult , $firstResult , $buscar)
       {
           $busqueda = "";
           if( trim( $buscar) != "" ){
               $busqueda = "  
               AND ( cade.etiqueta         like :buscar  
               or negocio.nombre       like :buscar 
               or negocio.razonSocial  like :buscar
               or tipoN.etiqueta       like :buscar 
               or giroNego.etiqueta    like :buscar 
               or giroNegoG.etiqueta   like :buscar
               or negocio.comentarios  like :buscar
               or plaz.etiqueta        like :buscar
               or negocio.referencia   like :buscar
               or negocio.telefono     like :buscar
               or negocio.extension    like :buscar
               or negocio.fechaAlta    like :buscar ) ";
           }
           
           $query = $this->em->createQuery(
               " SELECT DISTINCT
                negocio.id
               ,negocio.codigoAguila
               ,negocio.placaMPN
               ,negocio.nombre
               ,negocio.razonSocial   
               ,tipoN.etiqueta as tipoNegocio
               ,giroNego.etiqueta as giroNegocio  
               ,giroNegoG.etiqueta as giroNegocioGeneral
               ,negocio.comentarios  
               ,plaz.etiqueta as plaza
               ,negocio.piso  
               ,negocio.referencia
               ,negocio.latitud
               ,negocio.longitud
               ,negocio.telefono
               ,negocio.extension
     
        
                       
               ,( SELECT COUNT(umobile.id) 
                       FROM App\Entities\UsuariosMobile\UsuarioMobile umobile     
                       LEFT JOIN umobile.negocios neg2 WHERE neg2.id = negocio.id ) as numeroUsuariosMovil
       
               ,( SELECT SUM( dispositiv.cantidad ) 
                       FROM App\Entities\Dispositivo dispositiv     
                       LEFT JOIN dispositiv.negocio neg0 WHERE neg0.id = negocio.id ) as numeroDispositivos
   
               ,( SELECT COUNT(ala.id)    
                       FROM App\Entities\Alarma ala     
                       LEFT JOIN ala.negocio neg3 WHERE neg3.id = negocio.id ) as alarmasEmitidas
   
               ,( SELECT COUNT(prueb.id)
                       FROM App\Entities\Pruebas prueb     
                       LEFT JOIN prueb.negocio neg4 WHERE neg4.id = negocio.id ) as pruebasEmitidas
                       
               ,( SELECT COUNT(cad.id) 
                       FROM App\Entities\Cadena cad   
                       LEFT JOIN cad.negocios neg5 WHERE neg5.id = negocio.id ) as numeroCadenas
                       
               ,( SELECT COUNT(asoc.id)
                       FROM App\Entities\Asociacion asoc   
                       LEFT JOIN asoc.negocios neg6 WHERE neg6.id = negocio.id ) as numeroAsociaciones
   
               ,( SELECT COUNT(pm.id)
                       FROM App\Entities\PuertasMercado pm   
                       LEFT JOIN pm.negocio neg7 WHERE neg7.id = negocio.id ) as numeroPuertas
                 
               ,srn.etiqueta as  statusRevision   
             
               ,tipoStat.etiqueta as tipoStatus
               ,negocio.fechaAlta   
               ,negocio.status 
   
               FROM App\Entities\Negocio negocio 
               LEFT JOIN negocio.cadenas cade  
               LEFT JOIN negocio.asociaciones asocia 
               LEFT JOIN cade.asociacion aso  
               LEFT JOIN negocio.dispositivos dispo  
               LEFT JOIN dispo.tipoStatus tipoS  
               LEFT JOIN negocio.alarmas alarma   
               LEFT JOIN negocio.pruebas prueba       
               LEFT JOIN negocio.statusRevisionNegocio srn    
               LEFT JOIN negocio.tipoNegocio tipoN
               LEFT JOIN negocio.giroNegocio giroNego
               LEFT JOIN negocio.giroNegocioGeneral giroNegoG   
               LEFT JOIN negocio.plaza plaz 
               LEFT JOIN negocio.tipoStatus tipoStat ".
               " WHERE  tipoS.id = 5 "
               . $busqueda .
               " order by negocio.id desc ");
               
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
   
           } catch(\Doctrine\ORM\NoResultException $e) {
               return FALSE;
           }
       
       }



       public function listAllEstablecimientosJson($draw,  $maxResult , $firstResult , $buscar)
       {
           
           $busqueda = "";
           if( trim( $buscar) != "" ){
               $busqueda = " WHERE 
               negocio.nombre like :buscar 
               or negocio.razonSocial like :buscar 
               or negocio.referencia like :buscar 
               or negocio.telefono like :buscar ";
   
   
           }
   
   
           
           $query = $this->em->createQuery(
               "SELECT DISTINCT 
                    negocio.id  as idNegocio
                   ,negocio.nombre                  as nombreNegocio
                   ,negocio.razonSocial             as razonSocialNegocio
                   ,tipoNegocio.etiqueta            as tipoNegocioNegocio
                   ,negocio.piso                    as pisoNegocio
                   ,negocio.referencia              as referenciaNegocio
                   ,negocio.latitud                 as latitudNegocio
                   ,negocio.longitud                as longitudNegocio
                   ,negocio.telefono                as telefonoNegocio
                   ,negocio.extension               as extensionNegocio
                   ,tipoStatusN.etiqueta            as tipoStatusNegocio
                   ,negocio.status                  as statusNegocio
                   ,negocio.fechaAlta               as fechaAltaNegocio
                   ,giroG.etiqueta                  as giroNegocioGeneral
                   
                   ,direccion.callePrincipal        as callePrincipalDireccion
                   ,direccion.calle1                as calle1Direccion
                   ,direccion.calle2                as calle2Direccion
                   ,direccion.numeroInterior        as numeroInteriorDireccion 
                   ,direccion.numeroExterior        as numeroExteriorDireccion
                   ,direccion.edificio              as edificioDireccion
                   ,tipoAsentamiento.etiqueta       as tipoAsentamientoDireccion
                   ,direccion.nombreAsentamiento    as nombreAsentamientoDireccion
                   ,colonia.etiqueta                as coloniaDireccion
                   ,direccion.codigoPostal          as codigoPostalDireccion
                   
                   ,plaza.id                        as idPlaza
                   ,plaza.etiqueta                  as etiquetaPlaza
                   ,plaza.telefono                  as telefonoPlaza
                   ,plaza.extension                 as extensionPlaza
   
               FROM App\Entities\Negocio negocio 
               LEFT JOIN negocio.tipoNegocio tipoNegocio
               LEFT JOIN negocio.tipoStatus tipoStatusN
               LEFT JOIN negocio.direccion direccion
               LEFT JOIN negocio.giroNegocioGeneral giroG
               LEFT JOIN negocio.plaza plaza
               LEFT JOIN direccion.tipoAsentamiento tipoAsentamiento
               LEFT JOIN direccion.colonia colonia
               order by  negocio.id desc". $busqueda ."");
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


   public function findByIdCodigoAguila( $ArrayIds)
   { 
       $query = $this->em->createQuery(
           "SELECT negocio
           FROM App\Entities\Negocio negocio
           WHERE negocio.id in (:ArrayIds) ");

      try {
           $query->setParameter('ArrayIds', $ArrayIds);
           return $query->getResult();   // total data array
       }  
       catch(\Doctrine\ORM\NoResultException $e) {
           return FALSE;
       }
   }


    /**
     * SELECT DISTINCT
             negocio.id
            ,negocio.codigoAguila
            ,negocio.placaMPN
            ,negocio.nombre
            ,negocio.razonSocial   
            ,tipoN.etiqueta as tipoNegocio
            ,giroNego.etiqueta as giroNegocio  
            ,giroNegoG.etiqueta as giroNegocioGeneral
            ,negocio.comentarios  
            ,plaz.etiqueta as plaza
            ,negocio.piso  
            ,negocio.referencia
            ,negocio.latitud
            ,negocio.longitud 
            ,negocio.telefono
            ,negocio.extension

            ,( SELECT COUNT(enc.id)   
                    FROM App\Entities\Encargado enc     
                    INNER JOIN enc.negocios neg1 WHERE neg1.id = negocio.id ) as numeroEncargados
                    
            ,( SELECT COUNT(umobile.id) 
                    FROM App\Entities\UsuariosMobile\UsuarioMobile umobile     
                    INNER JOIN umobile.negocios neg2 WHERE neg2.id = negocio.id ) as numeroUsuariosMovil
    
            ,( SELECT SUM( dispositiv.cantidad ) 
                    FROM App\Entities\Dispositivo dispositiv     
                    INNER JOIN dispositiv.negocio neg0 WHERE neg0.id = negocio.id ) as numeroDispositivos

            ,( SELECT COUNT(ala.id)    
                    FROM App\Entities\Alarma ala     
                    INNER JOIN ala.negocio neg3 WHERE neg3.id = negocio.id ) as alarmasEmitidas

            ,( SELECT COUNT(prueb.id)
                    FROM App\Entities\Pruebas prueb     
                    INNER JOIN prueb.negocio neg4 WHERE neg4.id = negocio.id ) as pruebasEmitidas
                    
            ,( SELECT COUNT(cad.id) 
                    FROM App\Entities\Cadena cad   
                    INNER JOIN cad.negocios neg5 WHERE neg5.id = negocio.id ) as numeroCadenas
                    
            ,( SELECT COUNT(asoc.id)
                    FROM App\Entities\Asociacion asoc   
                    INNER JOIN asoc.negocios neg6 WHERE neg6.id = negocio.id ) as numeroAsociaciones

            ,( SELECT COUNT(pm.id)
                    FROM App\Entities\PuertasMercado pm   
                    INNER JOIN pm.negocio neg7 WHERE neg7.id = negocio.id ) as numeroPuertas 
              
            ,srn.etiqueta as  statusRevision   
          
            ,tipoStat.etiqueta as tipoStatus
            ,negocio.fechaAlta   
            ,negocio.status 

            FROM App\Entities\Negocio negocio 
            LEFT JOIN negocio.cadenas cade  
            INNER JOIN negocio.dispositivos dispo   
            LEFT JOIN negocio.alarmas alarma   
            LEFT JOIN negocio.pruebas prueba       
            LEFT JOIN negocio.statusRevisionNegocio srn    
            INNER JOIN negocio.tipoNegocio tipoN
            INNER JOIN negocio.giroNegocio giroNego
            INNER JOIN negocio.giroNegocioGeneral giroNegoG
            LEFT JOIN negocio.plaza plaz 
            INNER JOIN negocio.tipoStatus tipoStat ". $busqueda ."
            order by negocio.id desc 
     * 
     */

    

}