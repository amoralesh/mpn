<?php  

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;
  
/**
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="ComprobanteDomicilio")
 * 
*/
class ComprobanteDomicilio
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
     * @ORM\ManyToOne(targetEntity="Negocio")
     * @ORM\JoinColumn(name="id_Negocio", referencedColumnName="id")
     */
    protected $negocio;

    /**
     * @var blob
     *
     * @ORM\Column(name="documento", type="blob", nullable=true)
     */
    private $documento;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_documento", type="string", length=200, nullable=true) 
     */
    private $nombreDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="extension_documento", type="string", length=200, nullable=true) 
     */
    private $extensionDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="mime_type_documento", type="string", length=200, nullable=true) 
     */
    private $mimeTypeDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="tamano_documento", type="integer" , nullable=true) 
     */
    private $tamanoDocumento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAlta_documento", type="datetime" , nullable=true)
     */
    private $fechaAltaDocumento;
    
    /**
    *
    * @ORM\PrePersist
    *
    */
    public function prePersist()
    {
      $this->fechaAltaDocumento = new \DateTime();
    }
    
    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getNegocio(){
		return $this->negocio;
	}

	public function setNegocio($negocio){
		$this->negocio = $negocio;
	}

    public function getDocumento(){
        return $this->documento;
    }

    public function setDocumento($documento){
        $this->documento = $documento;
    }

    public function getNombreDocumento(){
        return $this->nombreDocumento;
    }

    public function setNombreDocumento($nombreDocumento){
        $this->nombreDocumento = $nombreDocumento;
    }

    public function getExtensionDocumento(){
        return $this->extensionDocumento;
    }

    public function setExtensionDocumento($extensionDocumento){
        $this->extensionDocumento = $extensionDocumento;
    }

    public function getMimeTypeDocumento(){
        return $this->mimeTypeDocumento;
    }

    public function setMimeTypeDocumento($mimeTypeDocumento){
        $this->mimeTypeDocumento = $mimeTypeDocumento;
    }

    public function getTamanoDocumento(){
        return $this->tamanoDocumento;
    }

    public function setTamanoDocumento($tamanoDocumento){
        $this->tamanoDocumento = $tamanoDocumento;
    }

    public function getFechaAltaDocumento(){
        return $this->fechaAltaDocumento;
    }

    public function setFechaAltaDocumento($fechaAltaDocumento){
        $this->fechaAltaDocumento = $fechaAltaDocumento;
    }


}
