<?php  

namespace App\Entities\UsuariosMobile;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;
  
/**
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="InstitucionMobile",uniqueConstraints={
 * @ORM\UniqueConstraint(name="institucion", columns={"nombre"})},indexes = {
 * @ORM\Index(name="indices", columns={"id"})})
 * 
*/
class InstitucionMobile
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
     * @ORM\Column(name="nombre", type="string", length=100, nullable = false) 
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreCorto", type="string", length=20, nullable=true) 
     */
    private $nombreCorto;

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
     * @var string
     *
     * @ORM\Column(name="motivoBaja", type="string", length=255, nullable=true, options={"default":""})
     */
    private $motivoBaja;

    /**
    * @ORM\PrePersist
    * @ORM\PreUpdate
    */
    public function prePersist()
    {
      $this->status = 1;
      $this->fechaAlta = new \DateTime();
    }


    public function getId(){
        return $this->id;
    }
    
    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getNombreCorto(){
        return $this->nombreCorto;
    }

    public function setNombreCorto($nombreCorto){
        $this->nombreCorto = $nombreCorto;
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

    public function getMotivoBaja(){
        return $this->motivoBaja;
    }

    public function setMotivoBaja($motivoBaja){
        $this->motivoBaja = $motivoBaja;
    }

    public function getMotivoAlta(){
        return $this->motivoAlta;
    }

    public function setMotivoAlta($motivoAlta){
        $this->motivoAlta = $motivoAlta;
    }

}
