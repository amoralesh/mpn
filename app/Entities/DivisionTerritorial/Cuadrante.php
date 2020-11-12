<?php  

namespace App\Entities\DivisionTerritorial;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;
 
/**  
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="Cuadrante") 
 */
class Cuadrante  
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
     * @ORM\Column(name="numeroCuadrante", type="integer", length=9, nullable=true)
     */
    private $numeroCuadrante; 
	
    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=100, nullable=false)
     */
    private $etiqueta; 
	
    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=25, nullable=true)
     */
    private $telefono; 
	
    /**
     * @var string
     *
     * @ORM\Column(name="nextel", type="string", length=25, nullable=true)
     */
    private $nextel; 

    /**
     *
     * @ORM\ManyToMany(targetEntity="Sector", mappedBy="cuadrantes",cascade={"merge"})
     */ 
    protected $sectores;
    
       
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getEtiqueta(){
		return $this->etiqueta;
	}
  
	public function setEtiqueta($etiqueta){
		$this->etiqueta = $etiqueta;
	}

	public function getSectores(){
		return $this->sectores;
	}  

	public function setSectores($sectores){
		$this->sectores = $sectores;
	}
	public function getDispositivos(){
		return $this->dispositivos;
	}

	public function setDispositivos($dispositivos){
		$this->dispositivos = $dispositivos;
	}
}