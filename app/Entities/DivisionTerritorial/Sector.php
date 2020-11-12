<?php  

namespace App\Entities\DivisionTerritorial;


use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**  
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="Sector") 
 */
class Sector  
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
     * @ORM\Column(name="etiqueta", type="string", length=100, nullable=false)
     */ 
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="geometry", type="text" , nullable=true)
     */
    private $geometry;

    /**
     * @var string 
     *
     * @ORM\Column(name="delegacion", type="string", length=200, nullable=true)
     */
    private $delegacion;

    /**
     * @var string
     *
     * @ORM\Column(name="zona", type="string", length=200, nullable=true)
     */
    private $zona;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Zona", mappedBy="sectores",cascade={"merge"})
     */ 
    protected $zonas;

    /**  
     * 
     * @ORM\ManyToMany(targetEntity="Cuadrante", inversedBy="sectores")
     * @ORM\JoinTable(
     *  name="Sector_Cuadrante",
     *  joinColumns={
     *      @ORM\JoinColumn(name="id_Sector", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="id_Cuadrante", referencedColumnName="id")
     *  }
     * )
     */
    private $cuadrantes;
    
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

	public function getGeometry(){
		return $this->geometry;
	}

	public function setGeometry($geometry){
		$this->geometry = $geometry;
	}

	public function getDelegacion(){
		return $this->delegacion;
	}

	public function setDelegacion($delegacion){
		$this->delegacion = $delegacion;
	}

	public function getZona(){
		return $this->zona;
	}

	public function setZona($zona){
		$this->zona = $zona;
	}

	public function getZonas(){
		return $this->zonas;
	}

	public function setZonas($zonas){
		$this->zonas = $zonas;
	}

	public function getCuadrantes(){
		return $this->cuadrantes;
	}

	public function setCuadrantes($cuadrantes){
		$this->cuadrantes = $cuadrantes;
	}


}