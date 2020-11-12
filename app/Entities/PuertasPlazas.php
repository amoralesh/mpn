<?php  

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;
  
/**
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="PuertasPlazas",indexes = {
 * @ORM\Index(name="indices", columns={"id"})})
 * 
*/
class PuertasPlazas
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
     * @ORM\Column(name="nombre", type="string", length=250, nullable = true) 
     */
     private $nombre;

     /**  
     * 
     * @ORM\ManytoOne(targetEntity="Negocio",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Negocio", referencedColumnName="id", nullable=true)
     */
    private $negocio;

    /**
     * @var float
     *
     * @ORM\Column(name="latitudPuerta", type="float", length=255, nullable=true)
     */
     private $latitudPuerta; 
     
    /**
    * @var float
    *
    * @ORM\Column(name="longitudPuerta", type="float", length=255, nullable=true)
    */
    private $longitudPuerta;
      
     /**
     *
     * @ORM\OnetoOne(targetEntity="Direccion",cascade={"All"})
     * @ORM\JoinColumn(name="id_Direccion", referencedColumnName="id", nullable=true)
     */
    private $direccion;

    /**
     *
     * @ORM\OnetoOne(targetEntity="Dispositivo",cascade={"All"})
     * @ORM\JoinColumn(name="id_Dispositivo", referencedColumnName="id", nullable=true)
     */
     private $dispositivos; 

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

    public function getNombre(){
      return $this->nombre;
    }
  
    public function setNombre($nombre){
      $this->nombre = $nombre;
    }
  
    public function getNegocio(){
      return $this->negocio;
    }
  
    public function setNegocio($negocio){
      $this->negocio = $negocio;
    }

    public function getLatitudPuerta(){
      return $this->latitudPuerta;
    }
  
    public function setLatitudPuerta($latitudPuerta){
      $this->latitudPuerta = $latitudPuerta;
    }
  
    public function getLongitudPuerta(){
      return $this->longitudPuerta;
    }
  
    public function setLongitudPuerta($longitudPuerta){
      $this->longitudPuerta = $longitudPuerta;
    }
  
    public function getDireccion(){
      return $this->direccion;
    }
  
    public function setDireccion($direccion){
      $this->direccion = $direccion;
    }
  
    public function getDispositivos(){
      return $this->dispositivos;
    }
  
    public function setDispositivos($dispositivos){
      $this->dispositivos = $dispositivos;
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
  
    public function getMotivoAltaBaja(){
      return $this->motivoAltaBaja;
    }
  
    public function setMotivoAltaBaja($motivoAltaBaja){
      $this->motivoAltaBaja = $motivoAltaBaja;
    }

   
}