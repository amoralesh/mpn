<?php  

namespace App\Entities\DispositivosMobile;
  
use App\Entities\UsuariosPublico\UsuarioPublico;
use App\Entities\UsuariosMobile\UsuarioMobile;

use App\Entities\DispositivosMobile\TipoDispositivoMobile;
use App\Entities\MotivoAltaBaja;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="DispositivoMobile")
 * 
*/
class DispositivoMobile 
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
     * @ORM\Column(name="idUnico", type="string", length=255, nullable=false) 
     */
    private $idUnico;

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=200, nullable=false) 
     */
    private $alias;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=200 , nullable=false) 
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="modelo", type="string", length=200, nullable=false) 
     */
    private $modelo;

    /**
     * @var string
     *
     * @ORM\Column(name="version", type="string", length=200, nullable=true) 
     */
    private $version;

    /**
     * 
     * @ORM\ManytoOne(targetEntity="TipoDispositivoMobile",cascade={"merge"})
     * @ORM\JoinColumn(name="id_TipoDispositivoMobile", referencedColumnName="id", nullable=true)
     */
    private $tipoDispositivo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=250 , nullable = true ) 
     */
    private $token;
   
    /**
     *
     * @ORM\ManyToMany(targetEntity="App\Entities\UsuariosPublico\UsuarioPublico", mappedBy="dispositivos",cascade={"All"})
     */ 
    protected $usuariosPublicos;     
     
    /**
     * 
     * @ORM\ManyToMany(targetEntity="App\Entities\UsuariosMobile\UsuarioMobile", mappedBy="dispositivos",cascade={"All"})
     */ 
    protected $usuariosMobile;     
    
    /**
     * 
     * @ORM\ManyToMany(targetEntity="PermisoDispositivo", inversedBy="dispositivos")
     * @ORM\JoinTable(
     *  name="Dispositivo_PermisoDispositivo",
     *  joinColumns={
     *      @ORM\JoinColumn(name="id_Dispositivo", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="id_PermisoDispositivo", referencedColumnName="id")
     *  }  
     * ) 
     */
    private $permisos;

    /**
     * @var \DateTime
     * 
     * @ORM\Column(name="fechaAlta", type="datetime" , nullable=false)
     */
    private $fechaAlta;

    /**
     * @var binary
     *
     * @ORM\Column(name="status", type="boolean", nullable=false, options={"default":"1"})
     */
    private $status;
 
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="App\Entities\MotivoAltaBaja", inversedBy="dispositivos",cascade={"All"})
     * @ORM\JoinTable( 
     *  name="DispositivoMobile_MotivoAltaBaja",
     *  joinColumns={
     *      @ORM\JoinColumn(name="id_DispositivoMobile", referencedColumnName="id")
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
  
    public function getIdUnico(){
      return $this->idUnico;
    }
  
    public function setIdUnico($idUnico){
      $this->idUnico = $idUnico;
    }
  
    public function getAlias(){
      return $this->alias;
    }
  
    public function setAlias($alias){
      $this->alias = $alias;
    }
  
    public function getNumero(){
      return $this->numero;
    }
  
    public function setNumero($numero){
      $this->numero = $numero;
    }
  
    public function getModelo(){
      return $this->modelo;
    }
  
    public function setModelo($modelo){
      $this->modelo = $modelo;
    }
  
    public function getVersion(){
      return $this->version;
    }
  
    public function setVersion($version){
      $this->version = $version;
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
  
    public function getUsuariosPublicos(){
      return $this->usuariosPublicos;
    }
  
    public function setUsuariosPublicos($usuariosPublicos){
      $this->usuariosPublicos = $usuariosPublicos;
    }

    public function removeUsuarioPublico(UsuarioPublico $usuarioPublico)
    {
        if (!$this->usuariosPublicos->contains($usuarioPublico)) {
            return;
        }
        $this->usuariosPublicos->removeElement($usuarioPublico);
        $usuarioPublico->removeDispositivo($this);      
    }


    public function removeUsuarioApp(UsuarioMobile $usuarioMobile)
    {
        if (!$this->usuariosMobile->contains($usuarioMobile)) {
            return;
        }
        $this->usuariosMobile->removeElement($usuarioMobile);
        $usuarioMobile->removeDispositivo($this);      
    }
  
    public function getPermisos(){
      return $this->permisos;
    }
  
    public function setPermisos($permisos){
      $this->permisos = $permisos;
    }
  
    public function getFechaAlta(){
      return $this->fechaAlta;
    }
  
    public function setFechaAlta($fechaAlta){
      $this->fechaAlta = $fechaAlta;
    }
  
    public function getStatus(){
      return $this->status;
    }
  
    public function setStatus($status){
      $this->status = $status;
    }
  
    public function getMotivosAltaBaja(){
      return $this->motivosAltaBaja;
    }
  
    public function setMotivosAltaBaja($motivoAltaBaja){
      $this->motivosAltaBaja = $motivoAltaBaja;
    }

    public function addMotivoAltaBaja(MotivoAltaBaja $motivoAltaBaja)
    {
        if (!$this->motivosAltaBaja->contains($motivoAltaBaja)) {
             $this->motivosAltaBaja->add($motivoAltaBaja);
        }
        return $this;
    }


    
}
