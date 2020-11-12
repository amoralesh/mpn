<?php  

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;
  
/**
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="TipoStatus",indexes = {
 * @ORM\Index(name="indices", columns={"etiqueta"})})
 * 
*/
class TipoStatus
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
     * @ORM\Column(name="etiqueta", type="string", length=30, nullable = false) 
     */
    private $etiqueta;

    /**    
     *  
     * @ORM\OneToMany(targetEntity="Alarma",mappedBy="tipoStatus",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Alarma", referencedColumnName="id", nullable=false)
     */
    private $alarma;  

    /**    
     *  
     * @ORM\OneToMany(targetEntity="Negocio",mappedBy="tipoStatus",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Negocio", referencedColumnName="id", nullable=false)
     */
    private $negocio;

    /**    
     *  
     * @ORM\OneToMany(targetEntity="Dispositivo",mappedBy="tipoStatus",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Dispositivo", referencedColumnName="id", nullable=false)
     */
    private $dispositivo;
    

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

    public function getAlarma(){
        return $this->alarma;
    }

    public function setAlarma($alarma){
        $this->alarma = $alarma;
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
    

}