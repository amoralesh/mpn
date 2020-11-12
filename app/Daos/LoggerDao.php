<?php

namespace App\Daos;

use App\Entities\Logger;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

use SplFileObject;
use Predis\Connection\ConnectionException;
use Session; 
use Auth;
use Redis;
  
class LoggerDao extends EntityRepository
{
     
    protected $em;
    
    public function __construct(ManagerRegistry $em)
    { 
        $this->em = $em->getManager('default');
    }


    public function create(Logger $logger)  
    {  
       $this->notify($logger);
       $this->em->persist($logger);
       $this->em->flush();
    }   
     
    public function notify(Logger $logger)
    { 
        try{
            $redis = Redis::connection(); 
            $data = ['modo' => 'bitacora', 'usuario' => $logger->getUsuario(), 'accion' => $logger->getAccion()];
            $redis->publish('bitacora', json_encode($data));
        } catch ( ConnectionException $ce) { }
    }


    public function onlyNotify( $texto )
    { 
        try{
            $redis = Redis::connection(); 
            $data = ['modo' => 'notify', 'texto' => $texto ];
            $redis->publish( 'notify', json_encode($data) );
                
        } catch ( ConnectionException $ce) { }
    }
    


    
    public function update(Logger $logger)
    {
        $this->em->merge($logger);
        $this->em->flush();
    }

    function compararCadenas($cadena1,$cadena2)
    {
        if( strcmp(  $cadena1 , $cadena2   )  === 0 ) {
        //echo "Son iguales: " . $cadena1 . " == " . $cadena2 . "</br></br>";
        return TRUE;  
        } else {
        //echo "NO Son iguales: " . $cadena1 . " == " . $cadena2 . "</br></br>";
        return FALSE;
        }
    }

    function validarFecha($date) { 
      $format = "d/m/Y";
      if (date ( $format, strtotime ( $date ) ) == date ( $date )) {
        return TRUE;
      } else {
        return FALSE;
      }
    }
    
    function getFileDelimiter($file, $checkLines = 2){

        $file = new SplFileObject($file);
        $delimiters = array(
          ',',
          ';',
          '|',
        ); 
        $results = array();
        $i = 0;
         while($file->valid() && $i <= $checkLines){
            $line = $file->fgets();
            foreach ($delimiters as $delimiter){
                $regExp = '/['.$delimiter.']/';
                $fields = preg_split($regExp, $line);
                if(count($fields) > 1){
                    if(!empty($results[$delimiter])){
                        $results[$delimiter]++;
                    } else {
                        $results[$delimiter] = 1;
                    }   
                }
            }
           $i++;
        }
        $results = array_keys($results, max($results));
        return $results[0];
    }





    
    
       
       
    /* SERVICIOS WEB         SERVICIOS WEB         SERVICIOS WEB         SERVICIOS WEB
    ================================================================================== */
    public function findByDates( $fechaInicio , $fechaFin )
    { 

        $query = $this->em->createQuery(
            "SELECT 
                     log.id
                    ,log.fecha
                    ,log.usuario
                    ,log.accion
            FROM App\Entities\Logger log
            WHERE log.fecha between :fechaInicio and :fechaFin ");
 
        try {
            $query->setParameter('fechaInicio', $fechaInicio);
            $query->setParameter('fechaFin', $fechaFin);
            return  $query->getResult();
        }  
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    }



}