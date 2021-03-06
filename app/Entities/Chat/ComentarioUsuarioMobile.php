<?php  

namespace App\Entities\Chat;
  
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="ComentarioUsuarioMobile",uniqueConstraints={
 * @ORM\UniqueConstraint(name="id", columns={"id"})})
 * 
*/
class ComentarioUsuarioMobile
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
     * @var text
     *
     * @ORM\Column(name="texto", type="text", nullable=true) 
     */
    private $texto;
  
    /**
     * Many Mensaje have One Chat.
     * @ORM\ManyToOne(targetEntity="Chat_Usuario_UsuarioMobile", inversedBy="mensajes")
     * @ORM\JoinColumn(name="id_Chat_Usuario_UsuarioMobile", referencedColumnName="id")
     */   
    private $chat_Usuario_UsuarioMobile;
       
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAlta", type="datetime" , nullable=false)
     */
    private $fechaAlta;
    
    /**
     * @var binary
     * 
     * @ORM\Column(name="leido", type="boolean", nullable=false, options={"default":"0"})
     */
    private $leido;
    
    /**
    * @ORM\PrePersist
    */
    public function prePersist()
    {
      $this->fechaAlta = new \DateTime();
    }

    public function getId(){
      return $this->id;
    }
  
    public function setId($id){
      $this->id = $id;
    }
  
    public function getTexto(){
      return $this->texto;
    }
  
    public function setTexto($texto){
      $this->texto = $texto;
    }
  
    public function getChat_Usuario_UsuarioMobile(){
      return $this->chat_Usuario_UsuarioMobile;
    }
  
    public function setChat_Usuario_UsuarioMobile($chat_Usuario_UsuarioMobile){
      $this->chat_Usuario_UsuarioMobile = $chat_Usuario_UsuarioMobile;
    }
  
    public function getFechaAlta(){
      return $this->fechaAlta;
    }
  
    public function setFechaAlta($fechaAlta){
      $this->fechaAlta = $fechaAlta;
    }

    public function getLeido(){
      return $this->leido;
    }
  
    public function setLeido($leido){
      $this->leido = $leido;
    }
    
	
}
