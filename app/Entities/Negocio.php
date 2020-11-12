<?php  

namespace App\Entities;

use App\Entities\UsuariosMobile\UsuarioMobile;
use App\Entities\OficioIncorporacion;
 
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;


/**
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="Negocio",indexes = {
 * @ORM\Index(name="indices", columns={"id"})})  
 * 
*/ 
class Negocio 
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
     * @var integer 
     *
     * @ORM\Column(name="idNegocio", type="integer",nullable=true)
     */
    private $idNegocio;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=250, nullable = false) 
     */
    private $nombre;

    /** 
     * @var string
     *
     * @ORM\Column(name="razonSocial", type="string", length=250, nullable = true) 
     */
    private $razonSocial;

    /**
     * @var tipoNegocio ( mayoreo menudeo, de construccion)
     *
     * @ORM\ManytoOne(targetEntity="Direccion",cascade={"All"})
     * @ORM\JoinColumn(name="id_Direccion", referencedColumnName="id", nullable=false)
     */
    private $direccion;

    /**
     * @var tipoNegocio ( mayoreo menudeo, de construccion)
     *    
     * @ORM\ManytoOne(targetEntity="TipoNegocio",cascade={"merge"})
     * @ORM\JoinColumn(name="id_TipoNegocio", referencedColumnName="id", nullable=false)
     */
    private $tipoNegocio;

    /**
     * @var giroNegocio ( gas,mercado,etc.) 
     *
     * @ORM\ManytoOne(targetEntity="GiroNegocio",cascade={"merge"})
     * @ORM\JoinColumn(name="id_GironeGegocio", referencedColumnName="id", nullable=true)
     */
    private $giroNegocio;   
    
    /**
     * @var giroNegocioGeneral ( mercado,escuela,etc.)
     *
     * @ORM\ManytoOne(targetEntity="GiroNegocioGeneral",cascade={"merge"})
     * @ORM\JoinColumn(name="id_GiroNegocioGeneral", referencedColumnName="id", nullable=true)
     */
     private $giroNegocioGeneral;  

     /**
    * @var \varchar  
    *
    * @ORM\Column(name="comentarios", type="text" , nullable=true)
    */
    private $comentarios;

    /**
    * @var plaza
    *
    * @ORM\ManytoOne(targetEntity="Plaza",cascade={"All"})
    * @ORM\JoinColumn(name="id_Plaza", referencedColumnName="id", nullable=true)
    */
    private $plaza;
  
    /**
    * @var \varchar
    *
    * @ORM\Column(name="piso", type="string", length=3 , nullable=true)
    */
    private $piso;
    
    /**
     * @var \varchar
     *
     * @ORM\Column(name="referencia", type="text" , nullable=false)
     */
    private $referencia;

    /**
     * @var float
     * 
     * @ORM\Column(name="latitud", type="float", length=255, nullable=false)
     */
    private $latitud;

    /**
     * @var float
     *
     * @ORM\Column(name="longitud", type="float", length=255, nullable=false)
     */
    private $longitud;

    /** 
     * @var \varchar
     *
     * @ORM\Column(name="telefono", type="string" , length=255 , nullable=true)
     */
    private $telefono;

    /**
     * @var varchar
     *
     * @ORM\Column(name="ext", type="string", length = 10 , nullable=true, options={"default":"1"})
     */
    private $extension;

    /**
    * 
    * @ORM\ManyToMany(targetEntity="Encargado", inversedBy="negocios", cascade={"persist"})
    * @ORM\JoinTable(
    *  name="Negocio_Encargado",
    *  joinColumns={
    *      @ORM\JoinColumn(name="id_Negocio", referencedColumnName="id")
    *  },
    *  inverseJoinColumns={
    *      @ORM\JoinColumn(name="id_Encargado", referencedColumnName="id")
    *  }
    * )
    */
    private $encargados;

    /** 
    * 
    * @ORM\ManyToMany(targetEntity="App\Entities\UsuariosMobile\UsuarioMobile", inversedBy="negocios", cascade={"persist"})
    * @ORM\JoinTable(
    *  name="Negocio_UsuarioMobile",
    *  joinColumns={
    *      @ORM\JoinColumn(name="id_Negocio", referencedColumnName="id")
    *  },
    *  inverseJoinColumns={
    *      @ORM\JoinColumn(name="id_UsuarioMobile", referencedColumnName="id")
    *  }
    * )
    */
    protected $usuariosMobile;

    /**
    *
    * @ORM\ManyToMany(targetEntity="App\Entities\UsuariosPublico\UsuarioPublico", mappedBy="negocio",cascade={"merge"})
    */ 
    protected $usuarioPublico; 

    /**     
    *  
    * @ORM\OneToMany(targetEntity="Dispositivo",mappedBy="negocio",cascade={"All"})
    * @ORM\JoinColumn(name="id_Dispositivo", referencedColumnName="id", nullable=false)
    */   
    private $dispositivos;

    /**
     * @var tipoStatus
     *
     * @ORM\ManytoOne(targetEntity="TipoStatus",cascade={"merge"})
     * @ORM\JoinColumn(name="id_TipoStatus", referencedColumnName="id", nullable=false)
     */
    private $tipoStatus;   

    /**
     *  
     * @ORM\OneToMany(targetEntity="Alarma",mappedBy="negocio",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Alarma", referencedColumnName="id", nullable=false)
     */
    private $alarmas;

    /**
     *  
     * @ORM\OneToMany(targetEntity="Pruebas",mappedBy="negocio",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Pruebas", referencedColumnName="id", nullable=false)
     */  
    private $pruebas;  

    /**
     * 
     * @ORM\ManyToMany(targetEntity="Cadena", inversedBy="negocios", cascade={"persist"})
     * @ORM\JoinTable(
     *  name="Negocio_Cadena",
     *  joinColumns={
     *      @ORM\JoinColumn(name="id_Negocio", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="id_Cadena", referencedColumnName="id")
     *  } 
     * )
     */
    private $cadenas; 

    /**
     * 
     * @ORM\ManyToMany(targetEntity="Asociacion", inversedBy="negocios", cascade={"persist"})
     * @ORM\JoinTable(
     *  name="Negocio_Asociacion",
     *  joinColumns={
     *      @ORM\JoinColumn(name="id_Negocio", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="id_Asociacion", referencedColumnName="id")
     *  }
     * )
     */
    private $asociaciones; 
 
    /**    
    *  
    * @ORM\OneToMany(targetEntity="Seguimientos",mappedBy="negocio",cascade={"All"})
    * @ORM\JoinColumn(name="id_Seguimientos", referencedColumnName="id", nullable=false)
    */   
    private $seguimientos;

     /**
     *  
     * @ORM\OneToMany(targetEntity="PuertasMercado",mappedBy="negocio",cascade={"All"})
     * @ORM\JoinColumn(name="id_PuertaMercado", referencedColumnName="id", nullable=true)
     */
    private $puertaMercado;   

      /**
     *  
     * @ORM\OneToMany(targetEntity="PuertasPlazas",mappedBy="negocio",cascade={"All"})
     * @ORM\JoinColumn(name="id_PuertasPlazas", referencedColumnName="id", nullable=true)
     */
    private $puertaPlazas;

     /**       
     * 
     * @ORM\ManyToOne(targetEntity="StatusRevisionNegocio",cascade={"merge"})
     * @ORM\JoinColumn(name="id_StatusRevisionNegocio", referencedColumnName="id", nullable=true)
     */
    private $statusRevisionNegocio;
  
    /**
     * @var binary
     *  
     * @ORM\Column(name="codigoAguila", type="boolean", nullable=false, options={"default":"0"})
     */
    private $codigoAguila;

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
    * @ORM\ManyToMany(targetEntity="MotivoAltaBaja", inversedBy="negocios",cascade={"All"})
    * @ORM\JoinTable( 
    *  name="Negocio_MotivoAltaBaja",
    *  joinColumns={
    *      @ORM\JoinColumn(name="id_Negocio", referencedColumnName="id")
    *  },
    *  inverseJoinColumns={
    *      @ORM\JoinColumn(name="id_MotivoAltaBaja", referencedColumnName="id")
    *  }
    * )
    */
    private $motivosAltaBaja;
   
    /**
    * @var \varchar
    *
    * @ORM\Column(name="delegacionDePaso", type="string" , length=255 , nullable=true)
    */
    private $delegacionDePaso;
     
    /**
    * @var \varchar
    *
    * @ORM\Column(name="coloniaDePaso", type="string" , length=255 , nullable=true)  
    */
    private $coloniaDePaso;

    /**
     *  
     * @ORM\ManytoOne(targetEntity="App\Entities\DivisionTerritorial\Sector",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Sector", referencedColumnName="id", nullable=true)
     */
    private $sector;

    /** 
    * @var string  
    *
    * @ORM\Column(name="numeroDeEstablecimientos", type="string", length=250, nullable = true) 
    */ 
    private $numeroDeEstablecimientos;

    /**
    * @var string
    *
    * @ORM\Column(name="placaMPN", type="string", length=100, nullable=true)
    */
    private $placaMPN;

      /**
    * @var string
    *
    * @ORM\Column(name="cuentaConOficio", type="string", length=100, nullable=true)
    */
    private $cuentaConOficio;

    /**
    * @ORM\OneToMany(targetEntity="OficioIncorporacion", mappedBy="negocio",cascade={"All"})
    */
    private $oficioIncorporacion;
    
     /**
     * @ORM\OneToMany(targetEntity="ComprobanteDomicilio", mappedBy="negocio",cascade={"All"})
     */
    private $comprobanteDomicilio;
 
    /**
    * @ORM\OneToMany(targetEntity="ComprobanteFiscal", mappedBy="negocio",cascade={"All"})
    */
    private $comprobanteFiscal;


    /**
    * @ORM\PrePersist 
    */
    public function prePersist()
    {   
        $this->status = 1;
        $this->fechaAlta = new \DateTime();
        $this->codigoAguila = 0;
    }


    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getIdNegocio(){
		return $this->idNegocio;
	}

	public function setIdNegocio($idNegocio){
		$this->idNegocio = $idNegocio;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

	public function getRazonSocial(){
		return $this->razonSocial;
	}

	public function setRazonSocial($razonSocial){
		$this->razonSocial = $razonSocial;
	}

	public function getDireccion(){
		return $this->direccion;
	}

	public function setDireccion($direccion){
		$this->direccion = $direccion;
	}

	public function getTipoNegocio(){
		return $this->tipoNegocio;
	}

	public function setTipoNegocio($tipoNegocio){
		$this->tipoNegocio = $tipoNegocio;
	}

	public function getGiroNegocio(){
		return $this->giroNegocio;
	}

	public function setGiroNegocio($giroNegocio){
		$this->giroNegocio = $giroNegocio;
	}

	public function getGiroNegocioGeneral(){
		return $this->giroNegocioGeneral;
	}

	public function setGiroNegocioGeneral($giroNegocioGeneral){
		$this->giroNegocioGeneral = $giroNegocioGeneral;
	}

	public function getComentarios(){
		return $this->comentarios;
	}

	public function setComentarios($comentarios){
		$this->comentarios = $comentarios;
	}
   
	public function getPlaza(){
		return $this->plaza;
	}

	public function setPlaza($plaza){
		$this->plaza = $plaza;
	}

	public function getPiso(){
		return $this->piso;
	}

	public function setPiso($piso){
		$this->piso = $piso;
	}

	public function getReferencia(){
		return $this->referencia;
	}

	public function setReferencia($referencia){
		$this->referencia = $referencia;
	}

	public function getLatitud(){
		return $this->latitud;
	}

	public function setLatitud($latitud){
		$this->latitud = $latitud;
	}

	public function getLongitud(){
		return $this->longitud;
	}

	public function setLongitud($longitud){
		$this->longitud = $longitud;
	}

	public function getTelefono(){
		return $this->telefono;
	}

	public function setTelefono($telefono){
		$this->telefono = $telefono;
	}

	public function getExtension(){
		return $this->extension;
	}

	public function setExtension($extension){
		$this->extension = $extension;
	}

	public function getEncargados(){
		return $this->encargados;
	}

	public function setEncargados($encargados){
		$this->encargados = $encargados;
	}

	public function getUsuariosMobile(){
		return $this->usuariosMobile;
	}
  
	public function setUsuariosMobile($usuariosMobile){
		$this->usuariosMobile = $usuariosMobile;
    }
    

    public function addUsuariosMobile(UsuarioMobile $usuarioMobile)
    {
        if (!$this->usuariosMobile->contains($usuarioMobile)) {
             $this->usuariosMobile->add($usuarioMobile);
        }
        return $this;
    }

    public function removeUsuarioApp(UsuarioMobile $usuarioMobile)
    {
        if (!$this->usuariosMobile->contains($usuarioMobile)) {
            return;
        }
        $this->usuariosMobile->removeElement($usuarioMobile);
        $usuarioMobile->removeNegocio($this);
    }

    

	public function getUsuarioPublico(){
		return $this->usuarioPublico;
	}

	public function setUsuarioPublico($usuarioPublico){
		$this->usuarioPublico = $usuarioPublico;
	}  

	public function getDispositivos(){
		return $this->dispositivos;
	}

	public function setDispositivos($dispositivos){
		$this->dispositivos = $dispositivos;
	}

	public function getTipoStatus(){
		return $this->tipoStatus;
	}

	public function setTipoStatus($tipoStatus){
		$this->tipoStatus = $tipoStatus;
	}

	public function getAlarmas(){
		return $this->alarmas;
	}

	public function setAlarmas($alarmas){
		$this->alarmas = $alarmas;
	}

	public function getPruebas(){
		return $this->pruebas;
	}

	public function setPruebas($pruebas){
		$this->pruebas = $pruebas;
	}

	public function getCadenas(){
		return $this->cadenas;
	}

	public function setCadenas($cadenas){
		$this->cadenas = $cadenas;
	}

	public function getAsociaciones(){
		return $this->asociaciones;
	}

	public function setAsociaciones($asociaciones){
		$this->asociaciones = $asociaciones;
    } 
    
	public function getSeguimientos(){
		return $this->seguimientos;
	}

    public function addSeguimiento(Seguimiento $seguimiento)
    {
        if (!$this->seguimientos->contains($seguimiento)) {
             $this->seguimientos->add($seguimiento);
        }
        return $this;
    }

	public function setSeguimientos($seguimientos){
		$this->seguimientos = $seguimientos;
	}

	public function getPuertaMercado(){
		return $this->puertaMercado;
	}

	public function setPuertaMercado($puertaMercado){
		$this->puertaMercado = $puertaMercado;
	}

	public function getStatusRevisionNegocio(){
		return $this->statusRevisionNegocio;
	}

	public function setStatusRevisionNegocio($statusRevisionNegocio){
		$this->statusRevisionNegocio = $statusRevisionNegocio;
	}

	public function getCodigoAguila(){
		return $this->codigoAguila;
	}   

	public function setCodigoAguila($codigoAguila){
		$this->codigoAguila = $codigoAguila;
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
    
    public function addMotivoAltaBaja(MotivoAltaBaja $motivoAltaBaja)
    {
        if (!$this->motivosAltaBaja->contains($motivoAltaBaja)) {
             $this->motivosAltaBaja->add($motivoAltaBaja);
        }
        return $this;
    }


	public function setMotivosAltaBaja($motivosAltaBaja){
		$this->motivosAltaBaja = $motivosAltaBaja;
	}

	public function getDelegacionDePaso(){
		return $this->delegacionDePaso;
	}

	public function setDelegacionDePaso($delegacionDePaso){
		$this->delegacionDePaso = $delegacionDePaso;
	}

	public function getColoniaDePaso(){
		return $this->coloniaDePaso;
	}

	public function setColoniaDePaso($coloniaDePaso){
		$this->coloniaDePaso = $coloniaDePaso;
	}

	public function getSector(){
		return $this->sector;
	}

	public function setSector($sector){
		$this->sector = $sector;
	}

	public function getNumeroDeEstablecimientos(){
		return $this->numeroDeEstablecimientos;
	}

	public function setNumeroDeEstablecimientos($numeroDeEstablecimientos){
		$this->numeroDeEstablecimientos = $numeroDeEstablecimientos;
	}

	public function getPlacaMPN(){
		return $this->placaMPN; 
	}

	public function setPlacaMPN($placaMPN){
		$this->placaMPN = $placaMPN;
	}

	public function getOficioIncorporacion(){
		return $this->oficioIncorporacion;
	}

	public function setOficioIncorporacion($oficioIncorporacion){
		$this->oficioIncorporacion = $oficioIncorporacion;
	}

    public function addOficioIncorporacion(OficioIncorporacion $oficio)
    {
        if (!$this->oficioIncorporacion->contains($oficio)) {
             $this->oficioIncorporacion->add($oficio);
        }
        return $this;
    }


    public function getComprobanteDomicilio(){
		return $this->comprobanteDomicilio;
	}

	public function setComprobanteDomicilio($comprobanteDomicilio){
		$this->comprobanteDomicilio = $comprobanteDomicilio;
    } 
    
    public function addComprobanteDomicilio(ComprobanteDomicilio $comprobante)
    {
        if (!$this->comprobanteDomicilio->contains($comprobante)) {
             $this->comprobanteDomicilio->add($comprobante);
        }
        return $this;
    }

	public function getComprobanteFiscal(){
		return $this->comprobanteFiscal;
	}

	public function setComprobanteFiscal($comprobanteFiscal){
		$this->comprobanteFiscal = $comprobanteFiscal;
    }
    
    public function addComprobanteFiscal(ComprobanteFiscal $comprobante)
    {
        if (!$this->comprobanteFiscal->contains($comprobante)) {
             $this->comprobanteFiscal->add($comprobante); 
        }
        return $this;
    }

    public function getPuertaPlazas(){
		return $this->puertaPlazas;
	}

	public function setPuertaPlazas($puertaPlazas){
		$this->puertaPlazas = $puertaPlazas;
    }
    
    public function getCuentaConOficio(){
		return $this->cuentaConOficio;
	}

	public function setCuentaConOficio($cuentaConOficio){
		$this->cuentaConOficio = $cuentaConOficio;
	}


    
}
