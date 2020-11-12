<?php  

namespace App\Entities;


 
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;


/**
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="PreAfiliacion",indexes = {
 * @ORM\Index(name="indices", columns={"id"})})  
 * 
*/ 
class PreAfiliacion 
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
     * @ORM\Column(name="nombre", type="string", length=250, nullable = false) 
     */
    private $nombre;

     /**
     * @var string
     *
     * @ORM\Column(name="apellidoP", type="string", length=250, nullable = false) 
     */
     private $apellidoP;

      /**
     * @var string
     *
     * @ORM\Column(name="apellidoM", type="string", length=250, nullable = true) 
     */
    private $apellidoM;

     /**
     * @var string
     *
     * @ORM\Column(name="nombreNegocio", type="string", length=250, nullable = false) 
     */
     private $nombreNegocio;
     
    /** 
     * @var \varchar
     *
     * @ORM\Column(name="telefono", type="string" , length=255 , nullable=true)
     */
    private $telefono;


    /** 
     * @var \varchar
     *
     * @ORM\Column(name="ext", type="string" , length=255 , nullable=true)
     */
     private $ext;

      /** 
     * @var \varchar
     *
     * @ORM\Column(name="celular", type="string" , length=255 , nullable=true)
     */
     private $celular;

     /**
     * @var varchar
     *
     * @ORM\Column(name="correo", type="string", unique=false, length=150, nullable = false)
     */
    private $correo;

     /**
     * 
     * @ORM\ManytoOne(targetEntity="Delegacion",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Delegacion", referencedColumnName="id", nullable=false)
     */
     private $delegacion; 


      /**
     * @var statusPreAfiliacion (Revisado,Incorporado,No contesta)
     *
     * @ORM\ManytoOne(targetEntity="StatusPreAfiliacion",cascade={"merge"})
     * @ORM\JoinColumn(name="id_StatusPreAfiliacion", referencedColumnName="id", nullable=true)
     */
     private $statusPreAfiliacion; 

     /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAlta", type="datetime" , nullable=false)
     */
    private $fechaAlta;

    /**
     * @var string
     *
     * @ORM\Column(name="reviso", type="string", length=255, nullable=true)
     */
     private $reviso;
    

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

	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

	public function getApellidoP(){
		return $this->apellidoP;
	}

	public function setApellidoP($apellidoP){
		$this->apellidoP = $apellidoP;
	}

	public function getApellidoM(){
		return $this->apellidoM;
	}

	public function setApellidoM($apellidoM){
		$this->apellidoM = $apellidoM;
	}

	public function getNombreNegocio(){
		return $this->nombreNegocio;
	}

	public function setNombreNegocio($nombreNegocio){
		$this->nombreNegocio = $nombreNegocio;
	}

	public function getTelefono(){
		return $this->telefono;
	}

	public function setTelefono($telefono){
		$this->telefono = $telefono;
	}

	public function getExt(){
		return $this->ext;
	}

	public function setExt($ext){
		$this->ext = $ext;
	}

	public function getCelular(){
		return $this->celular;
	}

	public function setCelular($celular){
		$this->celular = $celular;
	}

	public function getCorreo(){
		return $this->correo;
	}

	public function setCorreo($correo){
		$this->correo = $correo;
	}

	public function getDelegacion(){
		return $this->delegacion;
	}

	public function setDelegacion($delegacion){
		$this->delegacion = $delegacion;
	}

	public function getStatusPreAfiliacion(){
		return $this->statusPreAfiliacion;
	}

	public function setStatusPreAfiliacion($statusPreAfiliacion){
		$this->statusPreAfiliacion = $statusPreAfiliacion;
    }
    
    public function getFechaAlta(){
		return $this->fechaAlta;
	}

	public function setFechaAlta($fechaAlta){
		$this->fechaAlta = $fechaAlta;
    }
    
    public function getReviso(){
		return $this->reviso;
	}

	public function setReviso($reviso){
		$this->reviso = $reviso;
	}
 

    
}
