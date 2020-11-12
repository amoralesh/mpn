<?php  

namespace App\Entities\Chat;
  
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="Chat_Usuario_UsuarioMobile",uniqueConstraints={
 * @ORM\UniqueConstraint(name="id", columns={"id"})}) 
 * 
*/
class Chat_Usuario_UsuarioMobile
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
     * Many mensajes have one Emisor(usuario)
     * @ORM\ManyToOne(targetEntity="App\Entities\Usuarios\Usuario",cascade={"merge"})
     * @ORM\JoinColumn(name="id_emisor", referencedColumnName="id", nullable=false)
     */
    private $emisor;

    /**
     * Many mensajes have one Receptor(usuario)
     * @ORM\ManyToOne(targetEntity="App\Entities\UsuariosMobile\UsuarioMobile",cascade={"merge"})
     * @ORM\JoinColumn(name="id_receptor", referencedColumnName="id", nullable=false)
     */
    private $receptor;

     /**
     * One Chat has Many Mensajes.
     * @ORM\OneToMany(targetEntity="ComentarioUsuarioMobile", mappedBy="chat_Usuario_UsuarioMobile",cascade={"All"})
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
