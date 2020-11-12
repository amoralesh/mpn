<?php  

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;
  
/**
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="Alarma",indexes = {
 * @ORM\Index(name="indices", columns={"id"})})   
 * 
*/
class Alarma
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
     * 
     * @ORM\ManytoOne(targetEntity="Tipoalarma",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Tipoalarma", referencedColumnName="id", nullable=false)
     */
    private $tipoAlarma;
        
    /** 
     *     
     * @ORM\ManytoOne(targetEntity="MotivoAlarma",cascade={"merge"})
     * @ORM\JoinColumn(name="id_MotivoAlarma", referencedColumnName="id", nullable=true)
     */
    private $motivoAlarma;

    /**
     *   
     * @ORM\ManytoOne(targetEntity="Tipostatus",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Tipostatus", referencedColumnName="id", nullable=false)
     */
    private $tipoStatus;
  
    /**
     * 
     * @ORM\OnetoMany(targetEntity="Informe",mappedBy="alarma",cascade={"All"})
     * @ORM\JoinColumn(name="id_Informe", referencedColumnName="id", nullable=true)
     */
    private $informe;   

    /**
     * 
     * @ORM\ManytoOne(targetEntity="Negocio",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Negocio", referencedColumnName="id", nullable=false)
     */ 
    private $negocio;

    /**
     * 
     * @ORM\ManytoOne(targetEntity="Dispositivo",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Dispositivo", referencedColumnName="id", nullable=false)
     */
    private $dispositivo;

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
     *  
     * @ORM\ManytoOne(targetEntity="App\Entities\DivisionTerritorial\Sector",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Sector", referencedColumnName="id", nullable=true)
     */
    private $sector;     
     
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

    public function getTipoAlarma(){
        return $this->tipoAlarma;
    }

    public function setTipoAlarma($tipoAlarma){
        $this->tipoAlarma = $tipoAlarma;
    }

    public function getMotivoAlarma(){
        return $this->motivoAlarma;
    }

    public function setMotivoAlarma($motivoAlarma){
        $this->motivoAlarma = $motivoAlarma;
    }
  
    public function getTipoStatus(){
        return $this->tipoStatus;
    }

    public function setTipoStatus($tipoStatus){
        $this->tipoStatus = $tipoStatus;
    }
 
    public function getInforme(){
        return $this->informe;
    }
    
    public function setInforme($informe){
        $this->informe = $informe;
    }

    public function getNegocio(){
        return $this->negocio;
    }

    public function setNegocio($negocio){
        $this->negocio = $negocio;
    }
    public function getDispositivo(){
        return $this->dispositivo;
    }

    public function setDispositivo($dispositivo){
        $this->dispositivo = $dispositivo;
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
    

    public function getSector(){
        return $this->sector;
    }

    public function setSector($sector){
        $this->sector = $sector;
    }

}
