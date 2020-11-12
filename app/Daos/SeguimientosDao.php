<?php
 
namespace App\Daos;

use Doctrine\ORM\EntityRepository;

use App\Entities\Seguimientos;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Tools\Pagination\Paginator;
//use DoctrineExtensions\Query\Mysql\YearWeek;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;
use Session;
use File;

class SeguimientosDao extends EntityRepository  
{

    protected $em;
    
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }

    public function create(Seguimientos $seguimientos)
    {
       $this->em->persist($seguimientos);
       $this->em->flush();
       return $seguimientos;
    }

    public function update(Seguimientos $seguimientos)
    {
        $this->em->merge($seguimientos);
        $this->em->flush();
       return $seguimientos;
    }

    public function listAll()
    {
        $query = $this->em->createQuery(
            'SELECT seg 
            FROM App\Entities\Seguimientos seg 
            order by  seg.fechaAlta asc
             ');
        return $query->getResult();
    }

    
    public function listAllByNegocio( $id )
    {
        $query = $this->em->createQuery(
            'SELECT seg 
            FROM App\Entities\Seguimientos seg 
            INNER JOIN seg.negocio neg
            WHERE neg.id = :id
            order by  seg.fechaAlta DESC');
        
        $query->setParameter('id', $id);

        try {
            return  $query->getResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
            
        }      
    }

    

    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT segui 
            FROM App\Entities\Seguimientos segui
            WHERE segui.id = :id
          ' );
            
        $query->setParameter('id', $id);
        
        try {
            return  $query->getSingleResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
            
        }        
    }
}