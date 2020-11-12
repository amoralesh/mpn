<?php  

namespace App\Entities;

//use App\Entities\PuertasMercado;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;
  
/**
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="Dispositivo",uniqueConstraints={
 * @ORM\UniqueConstraint(name="token", columns={"token"})},indexes = {
 * @ORM\Index(name="indices_etiqueta_token", columns={"etiqueta", "token"})})
 * 
*/  
class Dispositivo
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
     * @ORM\Column(name="etiqueta", type="string", length=100, nullable = false) 
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="cantidad", type="integer" ,  nullable = true) 
     */
    private $cantidad;

    /**
     * 
     * @ORM\ManytoOne(targetEntity="TipoDispositivo",cascade={"merge"})
     * @ORM\JoinColumn(name="id_TipoDispositivo", referencedColumnName="id", nullable=true)
     */
    private $tipoDispositivo;
   
    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=250 , nullable = false, unique=true ) 
     */
    private $token;

     /**
     * @var string
     * 
     * @ORM\Column(name="numeroActualizacion", type="string", length=250 , nullable = true) 
     */
    private $numeroActualizacion;

    /**
     *
     * @ORM\OneToOne(targetEntity="PuertasMercado", mappedBy="dispositivos")
     */
    private $puertaMercado;

    /**
     *
     * @ORM\OneToOne(targetEntity="PuertasPlazas", mappedBy="dispositivos")
     */
    private $puertasPlazas;
     
    /**
     *     
     * @ORM\ManytoOne(targetEntity="Tipostatus",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Tipostatus", referencedColumnName="id", nullable=true)
     */
    private $tipoStatus;
     
    /**
     * 
     * @ORM\OnetoMany(targetEntity="Pruebas",mappedBy="dispositivo",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Pruebas", referencedColumnName="id", nullable=false)
     */   
    private $pruebas;

    /**   
     * 
     * @ORM\OnetoMany(targetEntity="Alarma",mappedBy="dispositivo",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Alarma", referencedColumnName="id", nullable=false)
     */    
    private $alertas;

    /**
     * 
     * @ORM\ManytoOne(targetEntity="Negocio",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Negocio", referencedColumnName="id", nullable=true)
     */
    private $negocio;    

    /** 
     * @var binary
     *
     * @ORM\Column(name="status", type="boolean", nullable=false, options={"default":"1"})
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAlta", type="datetime" , nullable=false)
     */
    private $fechaAlta;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="MotivoAltaBaja", inversedBy="dispositivos",cascade={"All"})
     * @ORM\JoinTable( 
     *  name="Dispositivo_MotivoAltaBaja",
     *  joinColumns={
     *      @ORM\JoinColumn(name="id_Dispositivo", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="id_MotivoAltaBaja", referencedColumnName="id")
     *  }
     * )
     */
    private $motivosAltaBaja;

    
    /**
    * @ORM\PrePersist
    */
    public function prePersist()
    {
      $this->status = 1;
      $this->fechaAlta = new \DateTime();
    }

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

	public function getCantidad(){
		return $this->cantidad;
	}

	public function setCantidad($cantidad){
		$this->cantidad = $cantidad;
	}

	public function getTipoDispositivo(){
		return $this->tipoDispositivo;
	}

	public function setTipoDispositivo($tipoDispositivo){
		$this->tipoDispositivo = $tipoDispositivo;
	}

	public function getToken(){
		return $this->token;
	}

	public function setToken($token){  
		$this->token = $token;
	}

	public function getNumeroActualizacion(){
		return $this->numeroActualizacion;
	}

	public function setNumeroActualizacion($numeroActualizacion){
		$this->numeroActualizacion = $numeroActualizacion;
  }
  
	public function getPuertaMercado(){
		return $this->puertaMercado;
	}

	public function setPuertaMercado($puertaMercado){
		$this->puertaMercado = $puertaMercado;
  }
  
  public function getPuertasPlazas(){
		return $this->puertasPlazas;
	}

	public function setPuertasPlazas($puertasPlazas){
		$this->puertasPlazas = $puertasPlazas;
	}

	public function getTipoStatus(){
		return $this->tipoStatus;
	}

	public function setTipoStatus($tipoStatus){
		$this->tipoStatus = $tipoStatus;
	}

	public function getPruebas(){
		return $this->pruebas;
	}

	public function setPruebas($pruebas){
		$this->pruebas = $pruebas;
	}

	public function getAlertas(){
		return $this->alertas;
	}

	public function setAlertas($alertas){
		$this->alertas = $alertas;
	}

	public function getNegocio(){
		return $this->negocio;
	}

	public function setNegocio($negocio){
		$this->negocio = $negocio;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function getFechaAlta(){
		return $this->fechaAlta;
	}

	public function setFechaAlta($fechaAlta){
		$this->fechaAlta = $fechaAlta;
	}

	public function getMotivosAltaBaja(){
		return $this->motivosAltaBaja;
	}

	public function setMotivosAltaBaja($motivosAltaBaja){
		$this->motivosAltaBaja = $motivosAltaBaja;
	}

}
