<?php  

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;
  
/**
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="Participacion",indexes = {
 * @ORM\Index(name="indices", columns={"etiqueta"})})
 * 
*/
class Participacion
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
     * @ORM\Column(name="etiqueta", type="string", length=100, nullable = false) 
     */
    private $etiqueta;

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



}
