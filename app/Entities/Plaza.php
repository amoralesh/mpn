<?php  

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;
  
/**
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="Plaza",indexes = {
 * @ORM\Index(name="indices", columns={"etiqueta"})})
 * 
*/
class Plaza   
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
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=true, options={"default":""})
     */
    private $etiqueta;

    /**
     * @var string  
     *  
     * @ORM\Column(name="alias", type="string", length=255, nullable=true)
     */
    private $alias;

    /**
     * @var tipoNegocio ( mayoreo menudeo, de construccion)
     *
     * @ORM\ManytoOne(targetEntity="Direccion",cascade={"All"})
     * @ORM\JoinColumn(name="id_Direccion", referencedColumnName="id", nullable=false)
     */
    private $direccion;

    /**
     * @var \varchar
     *
     * @ORM\Column(name="telefono", type="string" , length=30 , nullable=true)
     */
    private $telefono;
 
    /**
     * @var varchar
     *
     * @ORM\Column(name="ext", type="string", length = 10 , nullable=true, options={"default":"1"})
     */
    private $extension;

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
    * @ORM\OneToMany(targetEntity="Negocio",mappedBy="plaza",cascade={"All"})
    * @ORM\JoinColumn(name="id_Negocio", referencedColumnName="id", nullable=false)
    */   
    private $negocios;

    /**
     * 
     * @ORM\ManyToMany(targetEntity="Encargado", inversedBy="plazas")
     * @ORM\JoinTable(
     *  name="Plaza_Encargado",
     *  joinColumns={
     *      @ORM\JoinColumn(name="id_Plaza", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="id_Encargado", referencedColumnName="id")
     *  }
     * )
     */
    private $encargados;  

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="MotivoAltaBaja", inversedBy="plazas",cascade={"All"})
     * @ORM\JoinTable( 
     *  name="Plaza_MotivoAltaBaja",
     *  joinColumns={
     *      @ORM\JoinColumn(name="id_Plaza", referencedColumnName="id")
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

    public function getDireccion(){
        return $this->direccion;
    }

    public function setDireccion($direccion){
        $this->direccion = $direccion;
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

    public function getNegocios(){
		return $this->negocios;
	}

	public function setNegocios($negocios){
		$this->negocios = $negocios;
	}



    public function getAlias(){
        return $this->alias;
    }

    public function setAlias($alias){
        $this->alias = $alias;
    }   

    public function getEncargados(){
        return $this->encargados;
    }

    public function setEncargados($encargados){
        $this->encargados = $encargados;
    }
}
