<?php  

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Auth;

/**
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="Logger")
 */
class Logger
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime" , nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario", type="string", length=255, nullable=false)
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="accion", type="string", length=255, nullable=false)
     */
    private $accion;


    public function __construct( $accion )
    {
        $this->accion = $accion;
        $this->fecha = new \DateTime();

        if ( Auth::guard('mobile')->check() )
        {
            $this->usuario = Auth::guard('mobile')->user()->getUsuario();
        } 
        elseif ( Auth::guard('webpublico')->check() )
        {
            $this->usuario = Auth::guard('webpublico')->user()->getUsuario();
        }
        else 
        {
            $this->usuario = Auth::user()->getUsuario();
        }
    }

    /**
    * @ORM\PrePersist
    *
    */
    public function prePersist()
    { 
      $this->fecha = new \DateTime();
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function setFecha($fecha){
        $this->fecha = $fecha;
    }

    public function getUsuario(){
        return $this->usuario;
    }

    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }

    public function getAccion(){
        return $this->accion;
    }

    public function setAccion($accion){
        $this->accion = $accion;
    }


}
