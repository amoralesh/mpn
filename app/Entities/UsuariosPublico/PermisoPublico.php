<?php  

namespace App\Entities\UsuariosPublico;


use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;
 
/**
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="PermisoPublico",uniqueConstraints={
 * @ORM\UniqueConstraint(name="Permiso", columns={"nombre"})},indexes = {
 * @ORM\Index(name="indices", columns={"nombre"})})
 * 
*/
class PermisoPublico
{    
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer",nullable=false)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=80, nullable=true) 
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true) 
     */
    private $descripcion;

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

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
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
