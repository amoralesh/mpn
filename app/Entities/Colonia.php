<?php  

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;
  
/**
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="Colonia",indexes = {
 * @ORM\Index(name="indices", columns={"etiqueta"})})
 * 
*/
class Colonia
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
     * @ORM\Column(name="etiqueta", type="string", length=250, nullable = false) 
     */
    private $etiqueta;

    /**
     * 
     * @ORM\ManytoOne(targetEntity="Delegacion",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Delegacion", referencedColumnName="id", nullable=false)
     */
    private $delegacion;  

    /**
    * @ORM\PrePersist
    * @ORM\PreUpdate
    */
    public function prePersist()
    {
      //$this->status = 1;
      //$this->fechaAlta = new \DateTime();
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

    public function getDelegacion(){
        return $this->delegacion;
    }

    public function setDelegacion($delegacion){
        $this->delegacion = $delegacion;
    }

}
