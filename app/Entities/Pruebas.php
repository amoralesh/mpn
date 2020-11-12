<?php  

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;
  
/**
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="Pruebas",indexes = {
 * @ORM\Index(name="indices", columns={"id"})})
 * 
*/
class Pruebas
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
     * @var string
     *
     * @ORM\Column(name="contenido", type="string", length=255, nullable=true, options={"default":""})
     */
    private $contenido;

    /**   
     * 
     * @ORM\ManytoOne(targetEntity="Dispositivo",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Dispositivo", referencedColumnName="id", nullable=false)   
     */  
    private $dispositivo;  
   
    /**  
     * 
     * @ORM\ManytoOne(targetEntity="Negocio",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Negocio", referencedColumnName="id", nullable=false)
     */ 
    private $negocio;
      
    /**
     *  
     * @ORM\ManytoOne(targetEntity="App\Entities\DivisionTerritorial\Sector",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Sector", referencedColumnName="id", nullable=true)
     */
    private $sector;     

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAlta", type="datetime" , nullable=false)
     */
    private $fechaAlta;

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

	public function getContenido(){
		return $this->contenido;
	}

	public function setContenido($contenido){
		$this->contenido = $contenido;
	}

	public function getDispositivo(){
		return $this->dispositivo;
	}

	public function setDispositivo($dispositivo){
		$this->dispositivo = $dispositivo;
	}

	public function getNegocio(){
		return $this->negocio;
	}

	public function setNegocio($negocio){
		$this->negocio = $negocio;
	}

	public function getSector(){
		return $this->sector;
	}

	public function setSector($sector){
		$this->sector = $sector;
	}

	public function getFechaAlta(){
		return $this->fechaAlta;
	}

	public function setFechaAlta($fechaAlta){
		$this->fechaAlta = $fechaAlta;
	}


}
