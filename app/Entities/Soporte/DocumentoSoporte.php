<?php

namespace App\Entities\Soporte;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;
  
/**
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="DocumentoSoporte")
 * 
*/
class DocumentoSoporte
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
     * @var blob
     *
     * @ORM\Column(name="documento", type="blob")
     */
    private $documento; 
   
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=250, nullable=true) 
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="extension", type="string", length=50, nullable=true) 
     */
    private $extension;

    /**
     * @var string
     *
     * @ORM\Column(name="mimeType", type="string", length=100, nullable=true) 
     */
    private $mimeType;

    /**
     * @var string
     *
     * @ORM\Column(name="tamano", type="integer" , nullable=true) 
     */
    private $tamano;

      /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAlta", type="datetime" , nullable=false)
     */
    private $fechaAlta;

    /**
     * 
     * @ORM\ManytoOne(targetEntity="Soporte",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Soporte", referencedColumnName="id", nullable=false)
     */
    private $soporte;  

    /**
    * @ORM\PrePersist
    *
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

    public function getDocumento(){
        return $this->documento;
    }

    public function setDocumento($documento){
        $this->documento = $documento;
    }
    
    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getExtension(){
        return $this->extension;
    }

    public function setExtension($extension){
        $this->extension = $extension;
    }

    public function getMimeType(){
        return $this->mimeType;
    }

    public function setMimeType($mimeType){
        $this->mimeType = $mimeType;
    }

    public function getTamano(){
        return $this->tamano;
    }

    public function setTamano($tamano){
        $this->tamano = $tamano;
    }

    public function getFechaAlta(){
        return $this->fechaAlta;
    }

    public function setFechaAlta($fechaAlta){
        $this->fechaAlta = $fechaAlta;
    }
	public function getSoporte(){
		return $this->soporte;
	}

	public function setSoporte($soporte){
		$this->soporte = $soporte;
	}


}
