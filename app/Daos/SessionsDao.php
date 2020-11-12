<?php

namespace App\Daos;

use App\Entities\Sessions;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Doctrine\Common\Persistence\ManagerRegistry;


class SessionsDao extends EntityRepository
{

    protected $em;
    
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    }


    public function create(Sessions $sessions)
    {
       $this->em->persist($sessions);
       $this->em->flush();
    }

    public function update(Sessions $sessions)
    {
        $this->em->merge($sessions);
        $this->em->flush();
    }

    public function remove(Sessions $sessions)
    {
        $this->em->remove($sessions);
        $this->em->flush();
    }
  
    public function findById($id)
    {
        $query = $this->em->createQuery(
            'SELECT sessions 
            FROM App\Entities\Sessions sessions 
            WHERE sessions.id = :id');
        
        $query->setParameter('id', $id);
        
        try {
            return  $query->getSingleResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    }


    public function findByUser($user_id)
    {
        $query = $this->em->createQuery(
            'SELECT sessions 
            FROM App\Entities\Sessions sessions 
            WHERE sessions.user_id = :user_id');

        $query->setParameter('user_id', $user_id);

        try {
            return  $query->getResult();
        }
        catch(\Doctrine\ORM\NoResultException $e) {
            return FALSE;
        }
    }

    
    public function listAllJson()
    {
        $query = $this->em->createQuery(
            'SELECT 
                sessions.id,
                sessions.user_id, 
                sessions.ip_address,
                sessions.user_agent,
                sessions.payload,
                sessions.last_activity
             FROM App\Entities\Sessions sessions');
        return $query->getResult();
    }

    
    public function listAll()
    {
        $query = $this->em->createQuery(
            'SELECT sessions
             FROM App\Entities\Sessions sessions');
        return $query->getResult();
    }


}