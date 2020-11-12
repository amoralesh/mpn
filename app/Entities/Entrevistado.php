<?php  

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;
  
/**
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="Entrevistado",indexes = {
 * @ORM\Index(name="indices", columns={"id"})})
 * 
*/
class Entrevistado
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
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true, options={"default":""})
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidoPaterno", type="string", length=255, nullable=true, options={"default":""})
     */
    private $apellidoPaterno;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidoMaterno", type="string", length=255, nullable=true, options={"default":""})
     */
    private $apellidoMaterno;

    /**
     * @var string
     *
     * @ORM\Column(name="edad", type="string", length=3, nullable=true, options={"default":""})
     */
    private $edad;   

    /**
     * 
     * @ORM\ManytoOne(targetEntity="Informe",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Informe", referencedColumnName="id", nullable=false)
     */
    private $informe;


    /**
    * @ORM\PrePersist
    * @ORM\PreUpdate
    */
    public function prePersist()
    {

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

    public function getAPaterno(){
        return $this->apellidoPaterno;
    }

    public function setAPaterno($apellidoPaterno){
        $this->apellidoPaterno = $apellidoPaterno;
    }

    public function getAMaterno(){
        return $this->apellidoMaterno;
    }

    public function setAMaterno($apellidoMaterno){
        $this->apellidoMaterno = $apellidoMaterno;
    }

    public function getEdad(){
        return $this->edad;
    }

    public function setEdad($edad){ 
        $this->edad = $edad;
    }

    public function getInforme(){
        return $this->informe;
    }

    public function setInforme($informe){
        $this->informe = $informe;
    }

    
}
