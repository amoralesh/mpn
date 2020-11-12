<?php

namespace App\Daos\Chat;

use App\Entities\Chat\Chat_Usuario_UsuarioMobile; 
use App\Entities\Chat\Chat_Usuario_UsuarioPublico; 

use App\Entities\Chat\ComentarioUsuarioPublico; 

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type; 
use Doctrine\Common\Persistence\ManagerRegistry;


class ChatDao extends EntityRepository
{

    protected $em;
    
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager('default');
    } 

    public function createPublico(Chat_Usuario_UsuarioPublico $chat_Usuario_UsuarioPublico)
    {
       $this->em->persist($chat_Usuario_UsuarioPublico);
       $this->em->flush();
       return $chat_Usuario_UsuarioPublico;
    }
    
    public function createMobile(Chat_Usuario_UsuarioMobile $chat_Usuario_UsuarioMobile)
    {
       $this->em->persist($chat_Usuario_UsuarioMobile);
       $this->em->flush();
    }
    
    
    public function updateComentarioUsuarioPublico(ComentarioUsuarioPublico $comentarioUsuarioPublico)
    {
        $this->em->merge($comentarioUsuarioPublico);
        $this->em->flush();
    }


    public function findComentarioUsuarioPublicoById($id)
    {
        $query = $this->em->createQuery(
           'SELECT comment 
            FROM App\Entities\Chat\ComentarioUsuarioPublico comment
            WHERE comment.id = :id');
        
        $query->setParameter('id', $id);

        return  $query->getSingleResult();
    }



   public function mensajesByIdUsersApp($id1,$id2,$num)
   {
       $row = "";
       $complement = "";
       $query = $this->em->createQuery(
           'SELECT 
               m.id as id,
               m.texto as texto,
               e.id as emisor,
               r.id as receptor,
               m.fechaAlta as fechaAlta
            FROM App\Entities\Chat\Chat_Usuario_UsuarioMobile ch
            JOIN ch.mensajes m   
            JOIN ch.emisor e 
            JOIN ch.receptor r 
            WHERE '.$row. ' (e.id=:id1 AND r.id =:id2) OR (e.id=:id2 AND r.id =:id1)
            ORDER BY fechaAlta DESC ');

       $query->setParameter('id1', $id1);
       $query->setParameter('id2', $id2);
       $query->setMaxResults(20);
       
        if( $num > 0 ){
            $query->setMaxResults($num);
            //$row = " comentariosUsuarioAdmin.id < ".$num." AND ";
        }

       return $query->getResult();
    }

    
   public function mensajesByEmailUsersAdmin($emailUser,$emailFriend,$num)
   {
       $row = "";

       $query = $this->em->createQuery(
           "SELECT 
               mensajes.id as id, 
               mensajes.texto as texto,
               ch.emisor,
               ch.receptor,
               mensajes.leido,    
               mensajes.fechaAlta as fechaAlta 
            FROM App\Entities\Chat\Chat_Usuario_UsuarioPublico ch   
            JOIN ch.mensajes mensajes
            WHERE " .$row. " ( ch.emisor =:EmailUser AND ch.receptor =:EmailFriend ) OR ( ch.emisor =:EmailFriend AND ch.receptor =:EmailUser ) 
            ORDER BY fechaAlta DESC ");

       $query->setParameter("EmailUser", $emailUser);
       $query->setParameter("EmailFriend", $emailFriend);
       
       $query->setMaxResults(20);
        if( $num > 0 ){
            $query->setMaxResults($num);
            //$row = " comentariosUsuarioAdmin.id < ".$num." AND ";
        }

       return $query->getResult();
    }

    
   public function mensajesByIdUsersPublic($id1,$id2,$num)
   {
       $row = "";
       $complement = ""; 
       if($num>0){
           $row = " m.id < ".$num." AND ";
       }

       $query = $this->em->createQuery(
           'SELECT 
               m.id as id,
               m.texto as texto,
               e.id as emisor,
               r.id as receptor,
               m.leido,
               m.fechaAlta as fechaAlta
            FROM App\Entities\Chat\Chat_UsuarioAdmin_UsuarioPublic ch
            JOIN ch.comentariosUsuarioApp m
            JOIN ch.emisor e 
            JOIN ch.receptor r 
            WHERE '.$row. ' (e.id=:id1 AND r.id =:id2) OR (e.id=:id2 AND r.id =:id1)
            ORDER BY fechaAlta DESC ');

       $query->setParameter('id1', $id1);
       $query->setParameter('id2', $id2);
       $query->setMaxResults(3);
       return $query->getResult();
    }

}