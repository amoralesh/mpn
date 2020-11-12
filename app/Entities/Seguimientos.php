<?php  

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;
  
/**
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="Seguimientos",indexes = {
 * @ORM\Index(name="indices", columns={"id"})})
 * 
*/  
class Seguimientos
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
     * @ORM\ManytoOne(targetEntity="Negocio",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Negocio", referencedColumnName="id", nullable=false)
     */
    private $negocio;
    
    /**
     * @var string
     *
     * @ORM\Column(name="comentario", type="text", nullable = true) 
     */
     private $comentario;

    /**  
     * 
     * @ORM\ManytoOne(targetEntity="App\Entities\Usuarios\Usuario",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Usuario", referencedColumnName="id", nullable=false)
     */
     private $usuario;

    /**
     * @var binary
     *
     * @ORM\Column(name="esAdmin", type="boolean", nullable=true, options={"default":"1"})
     */
    private $esAdmin;

    /**
     * @var tipoStatus
     *
     * @ORM\ManytoOne(targetEntity="Encargado",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Encargado", referencedColumnName="id", nullable=true)
     */
     private $encargado; 

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

    public function setId($id){
      $this->id = $id;
    }

    public function getNegocio(){
      return $this->negocio;
    }

    public function setNegocio($negocio){
      $this->negocio = $negocio;
    }

    public function getComentario(){
      return $this->comentario;
    }

    public function setComentario($comentario){
      $this->comentario = $comentario;
    }

    public function getUsuario(){
      return $this->usuario;
    }

    public function setUsuario($usuario){
      $this->usuario = $usuario;
    }

    public function getFechaAlta(){
      return $this->fechaAlta;
    }

    public function setFechaAlta($fechaAlta){
      $this->fechaAlta = $fechaAlta;
    }
    
    public function getEsAdmin(){
      return $this->esAdmin;
    } 

    public function setEsAdmin($esAdmin){
      $this->esAdmin = $esAdmin;
    }

    public function getEncargado(){
      return $this->encargado;
    }

    public function setEncargado($encargado){
      $this->encargado = $encargado;
    }
  

}

