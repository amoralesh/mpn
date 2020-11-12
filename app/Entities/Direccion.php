<?php  

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;
        
/**
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="Direccion",indexes = {
 * @ORM\Index(name="indices", columns={"id"})})
 * 
*/
class Direccion 
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
     * @ORM\Column(name="callePrincipal", type="string", length=250, nullable = false) 
     */
    private $callePrincipal;

    /**
     * @var string
     *
     * @ORM\Column(name="calle1", type="string", length=250, nullable = false) 
     */
    private $calle1;

    /**
     * @var string
     *
     * @ORM\Column(name="calle2", type="string", length=250, nullable = false) 
     */
    private $calle2;

     /**
     * @var string
     *
     * @ORM\Column(name="numeroInterior", type="string", length=200, nullable = true) 
     */
    private $numeroInterior;

     /**   
     * @var string
     *
     * @ORM\Column(name="numeroExterior", type="string", length=100, nullable = false) 
     */
    private $numeroExterior;

     /**
     * @var string  
     *
     * @ORM\Column(name="Edificio", type="string", length=250, nullable = true) 
     */
    private $edificio;

    /**
     * @var tipoAsentamiento ( fraccionamiento, colonia )
     *
     * @ORM\ManytoOne(targetEntity="TipoAsentamiento",cascade={"merge"})
     * @ORM\JoinColumn(name="id_TipoAsentamiento", referencedColumnName="id", nullable=false)
     */
    private $tipoAsentamiento;
  
     /**
     * @var string
     *
     * @ORM\Column(name="nombreAsentamiento", type="string", length=250, nullable = true) 
     */
    private $nombreAsentamiento;
  
    /**
     * 
     * @ORM\ManytoOne(targetEntity="Colonia",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Colonia", referencedColumnName="id", nullable=false)
     */
    private $colonia;  
   
    /**
     * @var string
     *
     * @ORM\Column(name="codigoPostal", type="string", length=10, nullable = false) 
     */
    private $codigoPostal;
   
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

    public function getCallePrincipal(){
        return $this->callePrincipal;
    }

    public function setCallePrincipal($callePrincipal){
        $this->callePrincipal = $callePrincipal;
    }

    public function getCalle1(){
        return $this->calle1;
    }

    public function setCalle1($calle1){
        $this->calle1 = $calle1;
    }

    public function getCalle2(){
        return $this->calle2;
    }

    public function setCalle2($calle2){
        $this->calle2 = $calle2;
    }

    public function getNumeroInterior(){
        return $this->numeroInterior;
    }

    public function setNumeroInterior($numeroInterior){
        $this->numeroInterior = $numeroInterior;
    }

    public function getNumeroExterior(){
        return $this->numeroExterior;
    }

    public function setNumeroExterior($numeroExterior){
        $this->numeroExterior = $numeroExterior;
    }

    public function getEdificio(){
        return $this->edificio;
    }

    public function setEdificio($edificio){
        $this->edificio = $edificio;
    }

    public function getTipoAsentamiento(){
        return $this->tipoAsentamiento;
    }

    public function setTipoAsentamiento($tipoAsentamiento){
        $this->tipoAsentamiento = $tipoAsentamiento;
    }

    public function getNombreAsentamiento(){
        return $this->nombreAsentamiento;
    }

    public function setNombreAsentamiento($nombreAsentamiento){
        $this->nombreAsentamiento = $nombreAsentamiento;
    }

    public function getColonia(){
        return $this->colonia;
    }

    public function setColonia($colonia){
        $this->colonia = $colonia;
    }

    public function getCodigoPostal(){
        return $this->codigoPostal;
    }

    public function setCodigoPostal($codigoPostal){
        $this->codigoPostal = $codigoPostal;
    }

}
