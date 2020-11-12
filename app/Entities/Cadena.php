<?php  

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;
  
/**
 * @ORM\Entity  
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="Cadena",indexes = {
 * @ORM\Index(name="indices", columns={"etiqueta"})})
 * 
*/
class Cadena
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
     * @ORM\Column(name="etiqueta", type="string", length=200, nullable = false) 
     */
    private $etiqueta;

    /**  
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=200, nullable = false) 
     */
    private $alias;

    /**   
     * 
     * @ORM\ManyToMany(targetEntity="Encargado", inversedBy="cadenas")
     * @ORM\JoinTable(
     *  name="Cadena_Encargado",
     *  joinColumns={
     *      @ORM\JoinColumn(name="id_Cadena", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="id_Encargado", referencedColumnName="id")
     *  }
     * )
     */
    private $encargados;
     
    /**
     * 
     * @ORM\ManyToMany(targetEntity="App\Entities\Negocio", mappedBy="cadenas",cascade={"merge"})
     */ 
    protected $negocios;   

    /**  
     * @var asociacion
     *
     * @ORM\ManytoOne(targetEntity="Asociacion",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Asociacion", referencedColumnName="id", nullable=true)
     */
    private $asociacion;

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
     * @ORM\ManyToMany(targetEntity="MotivoAltaBaja", inversedBy="cadenas",cascade={"All"})
     * @ORM\JoinTable( 
     *  name="Cadena_MotivoAltaBaja",
     *  joinColumns={
     *      @ORM\JoinColumn(name="id_Cadena", referencedColumnName="id")
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

    public function getAlias(){
        return $this->alias;
    }

    public function setAlias($alias){
        $this->alias = $alias;
    }

    public function getNegocios(){
        return $this->negocios;
    }

    public function setNegocios($negocios){
        $this->negocios = $negocios;
    }

    public function getEncargados(){
        return $this->encargados;
    }

    public function setEncargados($encargados){
        $this->encargados = $encargados;
    }

    public function getAsociacion(){
        return $this->asociacion;
    }

    public function setAsociacion($asociacion){
        $this->asociacion = $asociacion;
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

    public function setMotivosAltaBaja($motivoAltaBaja){
        $this->motivosAltaBaja = $motivoAltaBaja;
    }


}