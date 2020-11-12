<?php  

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;
  
/**
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="Informe",indexes = {
 * @ORM\Index(name="indices", columns={"id"})})
 * 
*/ 
class Informe
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
     * @ORM\ManytoOne(targetEntity="Alarma",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Alarma", referencedColumnName="id", nullable=false)
     */
    private $alarma;
  
 
    /**    
     * @var text
     *
     * @ORM\Column(name="contenido", type="text",  nullable=true, options={"default":""})
     */
    private $contenido;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroDetenidos", type="string", length=3, nullable=true, options={"default":""})
     */
    private $numeroDetenidos;
   
    /**
     * 
     * @ORM\OnetoMany(targetEntity="Entrevistado",mappedBy="informe",cascade={"persist"})
     * @ORM\JoinColumn(name="id_Entrevistado", referencedColumnName="id", nullable=false)
     */
    private $entrevistados;
  
    /**
     * 
     * @ORM\OnetoMany(targetEntity="Entrevistador",mappedBy="informe",cascade={"persist"})
     * @ORM\JoinColumn(name="id_Entrevistador", referencedColumnName="id", nullable=false)
     */
    private $entrevistadores;

    /**
     * 
     * @ORM\ManytoOne(targetEntity="Razon",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Razon", referencedColumnName="id", nullable=false)
     */
    private $razon;

     /**
     * 
     * @ORM\ManytoOne(targetEntity="Reporta",cascade={"merge"})
     * @ORM\JoinColumn(name="id_reporta", referencedColumnName="id", nullable=false)
     */
    private $reporta;

    /**
     * 
     * @ORM\ManytoOne(targetEntity="Participacion",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Partcipacion", referencedColumnName="id", nullable=true)
     */  
    private $participacion;

    /**    
     * @var time 
     *
     * @ORM\Column(name="tiempoRespuesta", type="string", nullable=false)
     */
    private $tiempoRespuesta;

    /**    
     * @var string
     *
     * @ORM\Column(name="folioPap", type="string", length=255, nullable=true)
     */
    private $folioPap;

      /**    
     * @var string
     *
     * @ORM\Column(name="folioSip", type="string", length=255, nullable=true)
     */
    private $folioSip;

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
      //$this->status = 1;
      $this->fechaAlta = new \DateTime();
    }


    public function getId(){
        return $this->id;
    }

    public function getContenido(){
        return $this->contenido;
    }

    public function setContenido($contenido){
        $this->contenido = $contenido;
    }

    public function getNumeroDetenidos(){
        return $this->numeroDetenidos;
    }

    public function setNumeroDetenidos($numeroDetenidos){
        $this->numeroDetenidos = $numeroDetenidos;
    }

    public function getAlarma(){
        return $this->alarma;
    }

    public function setAlarma($alarma){
        $this->alarma = $alarma;
    }

    public function getEntrevistados(){
        return $this->entrevistados;
    }

    public function setEntrevistados($entrevistados){
        $this->entrevistados = $entrevistados;
    }

    public function getEntrevistadores(){
        return $this->entrevistadores;
    }

    public function setEntrevistadores($entrevistadores){
        $this->entrevistadores = $entrevistadores;
    }

    public function getRazon(){
        return $this->razon;
    }

    public function setRazon($razon){
        $this->razon = $razon;
    }

    public function getReporta(){
        return $this->reporta;
    }

    public function setReporta($reporta){
        $this->reporta = $reporta;
    }

    public function getParticipacion(){
        return $this->participacion;
    }

    public function setParticipacion($participacion){
        $this->participacion = $participacion;
    } 

    public function getTiempoRespuesta(){
        return $this->tiempoRespuesta;
    }

    public function setTiempoRespuesta( $tiempoRespuesta ){
        $this->tiempoRespuesta = $tiempoRespuesta; 
    }

    public function getFolioPap(){
        return $this->folioPap;
    }

    public function setFolioPap($folioPap){
        $this->folioPap = $folioPap;
    }

    public function getFolioSip(){
        return $this->folioSip;
    }

    public function setFolioSip($folioSip){
        $this->folioSip = $folioSip;
    }

    
}
