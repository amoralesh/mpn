<?php  

namespace App\Entities\DispositivosMobile;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;
  
/**
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="TipoDispositivoMobile",indexes = {
 * @ORM\Index(name="indices", columns={"etiqueta"})})
 * 
*/
class TipoDispositivoMobile
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
     * 
     * @ORM\OnetoMany(targetEntity="App\Entities\DispositivosMobile\DispositivoMobile",mappedBy="tipoDispositivo",cascade={"merge"})
     * @ORM\JoinColumn(name="id_DispositivoMobile", referencedColumnName="id", nullable=false)
     */    
    private $dispositivos;

    

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
    public function getDispositivos(){
        return $this->dispositivos;
    }

    public function setDispositivos($dispositivos){
        $this->dispositivos = $dispositivos;
    }
}
