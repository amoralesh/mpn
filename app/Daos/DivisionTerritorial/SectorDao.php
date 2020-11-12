<?php
 
namespace App\Daos\DivisionTerritorial;




use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;  
use File;

class SectorDao extends EntityRepository  
{ 

    protected $em;
    
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }
 

    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT sector 
            FROM App\Entities\DivisionTerritorial\Sector sector 
            WHERE sector.id = :id');
        $query->setParameter('id', $id);
        
        try {
            return  $query->getSingleResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return NULL;
        } 
    }
    
    public function listAll( )
    {
        $query = $this->em->createQuery(
            'SELECT sector 
            FROM App\Entities\DivisionTerritorial\Sector sector');
        try {
            return  $query->getResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return NULL;
        } 
    }


    public function findByLatLng( $lng , $lat )
    {
        $query = "SELECT 
         sector.id
        ,sector.etiqueta as sector
        ,z.etiqueta as zona
        FROM Sector sector 
        INNER JOIN Zona_Sector zs on zs.id_Sector = sector.id
        INNER JOIN Zona z on z.id = zs.id_Zona 
        WHERE geometry::STGeomFromText( sector.geometry , 4326 ).STIntersects( geometry::STGeomFromText('POINT(".$lng." ".$lat.")', 4326 ) ) = 1";
        $result = $this->em->getConnection()->fetchAssoc($query);
        return $result;
    } 

    
}