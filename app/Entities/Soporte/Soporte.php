<?php  

namespace App\Entities\Soporte;
  
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="Soporte",uniqueConstraints={
 * @ORM\UniqueConstraint(name="id", columns={"id"})})
 * 
*/
class Soporte
{
	/**
     * @var integer
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer",nullable=false)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=250, nullable=true) 
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=250, nullable=false) 
     */
    private $email;
    
    /**
     * @var string
     *
     * @ORM\Column(name="asunto", type="string", length=250, nullable=true) 
     */
    private $asunto;
 
    /**
     * @var text
     *
     * @ORM\Column(name="problema", type="text", nullable=true) 
     */
    private $problema;
    
     /**    
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="DocumentoSoporte", mappedBy="soporte",cascade={"All"})
     */
    private $documentosSoporte;  

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getAsunto(){
		return $this->asunto;
	}

	public function setAsunto($asunto){
		$this->asunto = $asunto;
	}

	public function getProblema(){
		return $this->problema;
	}

	public function setProblema($problema){
		$this->problema = $problema;
	}

	public function getDocumentosSoporte(){
		return $this->documentosSoporte;
	}

	public function setDocumentosSoporte($documentosSoporte){
		$this->documentosSoporte = $documentosSoporte;
    }
    

}
