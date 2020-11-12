<?php  

namespace App\Entities\Chat;
  
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="Chat_Usuario_UsuarioPublico",uniqueConstraints={
 * @ORM\UniqueConstraint(name="id", columns={"id"})})
 * 
*/
class Chat_Usuario_UsuarioPublico
{

	/**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer",nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * 
     * @ORM\Column(name="emisor", type="string",nullable=false)
     *
     */
    private $emisor;

    /**
     * 
     * @ORM\Column(name="receptor", type="string",nullable=false)
     * 
     */
    private $receptor;

     /**
     * One Chat has Many Mensajes.
     * @ORM\OneToMany(targetEntity="ComentarioUsuarioPublico", mappedBy="chat_Usuario_UsuarioPublico",cascade={"All"})
     */   
    private $mensajes;
   


    public function getId(){
      return $this->id;
    }
  
    public function setId($id){
      $this->id = $id;
    }
  
    public function getEmisor(){
      return $this->emisor;
    }
  
    public function setEmisor($emisor){
      $this->emisor = $emisor;
    }
  
    public function getReceptor(){
      return $this->receptor;
    }
  
    public function setReceptor($receptor){
      $this->receptor = $receptor;
    }
  
    public function getMensajes(){
      return $this->mensajes;
    }
  
    public function setMensajes($mensajes){
      $this->mensajes = $mensajes;
    }
}
