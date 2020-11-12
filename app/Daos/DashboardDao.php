<?php
 
namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;   
  

class DashboardDao extends EntityRepository  
{ 

    protected $em;
    
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }


    public function listAllEstablecimientoJson(){
        $query = $this->em->createQuery(
            'SELECT COUNT(negocio.id)
             FROM App\Entities\Negocio negocio');
        return $query->getSingleScalarResult();
    }  

    public function listAllAsociacionesJson(){
        
        $query = $this->em->createQuery(
            'SELECT COUNT(asociaciones.id)
             FROM App\Entities\Asociacion asociaciones');
        return $query->getSingleScalarResult();
    }
    public function listAllCadenasJson(){
        
        $query = $this->em->createQuery(
            'SELECT COUNT(cadena.id)
             FROM App\Entities\Cadena cadena');
        return $query->getSingleScalarResult();
    }
    public function listAllPlazasJson(){
        
        $query = $this->em->createQuery(
            'SELECT COUNT(plaza.id)
             FROM App\Entities\Plaza plaza');
        return $query->getSingleScalarResult();
    }

    public function listAllEncargadosJson(){
        $query = $this->em->createQuery(
            'SELECT COUNT(encargado.id)
             FROM App\Entities\Encargado encargado');
        return $query->getSingleScalarResult();
        
    }
    public function listAllColoniasJson(){
        
        $query = $this->em->createQuery(
            'SELECT COUNT(colonia.id)
             FROM App\Entities\Colonia colonia');
        return $query->getSingleScalarResult();
    }


    public function listAllAlertasEmitidasJson(){
        
        $query = $this->em->createQuery(
            'SELECT COUNT(alarma.id)
             FROM App\Entities\Alarma alarma');
        return $query->getSingleScalarResult();
    }

    public function listAllAlertasEfectivasJson(){ 
    $query = $this->em->createQuery(
        'SELECT COUNT(alarma.id)
         FROM App\Entities\Alarma alarma  
         WHERE alarma.tipoAlarma = 2 ');
    return $query->getSingleScalarResult();
    }
    
    public function listAllAlertasNoEfectivasJson(){
        $query = $this->em->createQuery(
            'SELECT COUNT(alarma.id)
             FROM App\Entities\Alarma alarma  
             WHERE alarma.tipoAlarma = 3 ');
        return $query->getSingleScalarResult();
    }

    public function listAllTiempoPromedioJson(){
        
        $query = ( 'SELECT cast(cast(avg(cast(CAST(tiempoRespuesta as datetime) as float)) as datetime) as time) AvgTime,
  cast(cast(sum(cast(CAST(tiempoRespuesta as datetime) as float)) as datetime) as time) TotalTime
  FROM Informe ');
        $stmt = $this->em->getConnection()->prepare($query);
        $stmt->execute();
        $reultado = $stmt->fetch();
       return $reultado;
    }


    public function listAllPruebasEmitidasJson(){
        
        $query = $this->em->createQuery(
            'SELECT COUNT(pruebas.id)
             FROM App\Entities\Pruebas pruebas');
        return $query->getSingleScalarResult();
    }

    public function listAllDispositivosJson(){
        
        $query = $this->em->createQuery(
            'SELECT COUNT(dispositivos.id)
             FROM App\Entities\Dispositivo dispositivos');
        return $query->getSingleScalarResult();
    }



    public function obtenerEstablecimientosEstadisticas(){
                $query = (
                    "SELECT YEAR(negocio.fechaAlta) as anhoAlta , MONTH(negocio.fechaAlta) as mesAlta, COUNT(*) as totalAlta
                    FROM Negocio negocio
                    WHERE YEAR(fechaAlta)=2018 and negocio.status = 1
                    GROUP BY MONTH(negocio.fechaAlta), YEAR(negocio.fechaAlta)");
                $stmt = $this->em->getConnection()->prepare($query);
                $stmt->execute();
                $reultado = $stmt->fetchAll();
                return $reultado;
            }

     public function obtenerAsociacionesEstadisticas(){
                $query = (
                    "SELECT YEAR(asociaciones.fechaAlta) as anhoAlta , MONTH(asociaciones.fechaAlta) as mesAlta, COUNT(*) as totalAlta
                    FROM Asociacion asociaciones
                    WHERE YEAR(fechaAlta)=2018 and asociaciones.status = 1
                    GROUP BY MONTH(asociaciones.fechaAlta), YEAR(asociaciones.fechaAlta)");
                $stmt = $this->em->getConnection()->prepare($query);
                $stmt->execute();
                $reultado = $stmt->fetchAll();
                return $reultado;
            } 

    public function obtenerCadenasEstadisticas(){
                $query = (
                    "SELECT YEAR(cadena.fechaAlta) as anhoAlta , MONTH(cadena.fechaAlta) as mesAlta, COUNT(*) as totalAlta
                    FROM Cadena cadena
                    WHERE YEAR(fechaAlta)=2018 and cadena.status = 1
                    GROUP BY MONTH(cadena.fechaAlta), YEAR(cadena.fechaAlta)");
                $stmt = $this->em->getConnection()->prepare($query);
                $stmt->execute();
                $reultado = $stmt->fetchAll();
                return $reultado;
            }

    public function obtenerPlazasEstadisticas(){
                $query = (
                    "SELECT YEAR(plaza.fechaAlta) as anhoAlta , MONTH(plaza.fechaAlta) as mesAlta, COUNT(*) as totalAlta
                    FROM Plaza plaza
                    WHERE YEAR(fechaAlta)=2018 and plaza.status = 1
                    GROUP BY MONTH(plaza.fechaAlta), YEAR(plaza.fechaAlta)");
                $stmt = $this->em->getConnection()->prepare($query);
                $stmt->execute();
                $reultado = $stmt->fetchAll();
                return $reultado;
            }   
            
    public function totalesAlertas(){
                $query = (
                    "SELECT YEAR(alarma.fechaAlta) as anhoAlarma , MONTH(alarma.fechaAlta) as mesAlarma, COUNT(*) as totalAlarma
                    FROM Alarma alarma
                    WHERE YEAR(alarma.fechaAlta)=2018 
                    GROUP BY MONTH(alarma.fechaAlta), YEAR(alarma.fechaAlta)");
                $stmt = $this->em->getConnection()->prepare($query);
                $stmt->execute();
                $reultado = $stmt->fetchAll();
                return $reultado;
            }

     public function totalesPruebas(){
                $query = (
                    "SELECT YEAR(prueba.fechaAlta) as anhoPrueba , MONTH(prueba.fechaAlta) as mesPrueba, COUNT(*) as totalPrueba
                    FROM Pruebas prueba
                    WHERE YEAR(prueba.fechaAlta)=2018
                    GROUP BY MONTH(prueba.fechaAlta), YEAR(prueba.fechaAlta)");
                $stmt = $this->em->getConnection()->prepare($query);
                $stmt->execute();
                $reultado = $stmt->fetchAll();
                return $reultado;
            }

    public function ObtenerAlertasEfectivasEstadisticas(){
                $query = (
                    "SELECT YEAR(alarma.fechaAlta) as anhoEfectiva , MONTH(alarma.fechaAlta) as mesEfectiva, COUNT(*) as totalEfectiva
                    FROM Alarma alarma
                    LEFT JOIN TipoAlarma on alarma.id_TipoAlarma = TipoAlarma.id
                    WHERE YEAR(alarma.fechaAlta)=2018  and TipoAlarma.id = 2
                    GROUP BY MONTH(alarma.fechaAlta), YEAR(alarma.fechaAlta)");
                $stmt = $this->em->getConnection()->prepare($query);
                $stmt->execute();
                $reultado = $stmt->fetchAll();
                return $reultado;
            }

    public function ObtenerAlertasNoEfectivasEstadisticas(){
                $query = (
                    "SELECT YEAR(alarma.fechaAlta) as anhoNoEfectiva , MONTH(alarma.fechaAlta) as mesNoEfectiva, COUNT(*) as totalNoEfectiva
                    FROM Alarma alarma
                    LEFT JOIN TipoAlarma on alarma.id_TipoAlarma = TipoAlarma.id
                    WHERE YEAR(alarma.fechaAlta)=2018  and TipoAlarma.id = 3
                    GROUP BY MONTH(alarma.fechaAlta), YEAR(alarma.fechaAlta)");
                $stmt = $this->em->getConnection()->prepare($query);
                $stmt->execute();
                $reultado = $stmt->fetchAll();
                return $reultado;
            }

}