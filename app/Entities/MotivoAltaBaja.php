<?php  

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\Collection;
  
/**
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="MotivoAltaBaja",indexes = {
 * @ORM\Index(name="indices", columns={"id"})})
 * 
*/
class MotivoAltaBaja
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
     * @ORM\Column(name="contenido", type="string", length=255, nullable = false) 
     */
    private $contenido;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable = false) 
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario", type="string", length=255, nullable = false) 
     */
    private $usuario;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAlta", type="datetime" , nullable=false)
     */
    private $fechaAlta;


    /**
     *
     * @ORM\ManyToMany(targetEntity="App\Entities\Usuarios\Usuario", mappedBy="motivosAltaBaja",cascade={"merge"})
     */ 
    protected $usuarios;   
    
    /**
     *
     * @ORM\ManyToMany(targetEntity="App\Entities\UsuariosPublico\UsuarioPublico", mappedBy="motivosAltaBaja",cascade={"merge"})
     */ 
    protected $usuariosPublico;   
    
    /**
     *
     * @ORM\ManyToMany(targetEntity="App\Entities\UsuariosMobile\UsuarioMobile", mappedBy="motivosAltaBaja",cascade={"merge"})
     */ 
    protected $usuariosMobile;   

    //setEncargados
    /**
     *
     * @ORM\ManyToMany(targetEntity="Encargado", mappedBy="motivoAltaBaja",cascade={"merge"})
     */
    protected $encargados; 

    /**
     *
     * @ORM\ManyToMany(targetEntity="Asociacion", mappedBy="motivoAltaBaja",cascade={"merge"})
     */ 
    protected $asociaciones;   

    /**
     *
     * @ORM\ManyToMany(targetEntity="Cadena", mappedBy="motivoAltaBaja",cascade={"merge"})
     */ 
    protected $cadenas;   

    /**
     *
     * @ORM\ManyToMany(targetEntity="Dispositivo", mappedBy="motivoAltaBaja",cascade={"merge"})
     */ 
    protected $dispositivos;    

    /** 
     *
     * @ORM\ManyToMany(targetEntity="Negocio", mappedBy="motivoAltaBaja",cascade={"merge"})
     */ 
    protected $negocios;    
  
    /**
     *
     * @ORM\ManyToMany(targetEntity="Plaza", mappedBy="motivoAltaBaja",cascade={"merge"})
     */ 
    protected $plazas;    

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

	public function getContenido(){
		return $this->contenido;
	}

	public function setContenido($contenido){
		$this->contenido = $contenido;
	}

	public function getTipo(){
		return $this->tipo;
	}

	public function setTipo($tipo){
		$this->tipo = $tipo;
    }
    
	public function getFechaAlta(){
		return $this->fechaAlta;
	}

	public function setFechaAlta($fechaAlta){
		$this->fechaAlta = $fechaAlta;
	}
 
	public function getUsuario(){
		return $this->usuario;
	}

	public function setUsuario($usuario){
		$this->usuario = $usuario;
    }
    



	public function getUsuarios(){
		return $this->usuarios;
	}

	public function setUsuarios($usuarios){
		$this->usuarios = $usuarios;
	}

	public function getUsuariosPublico(){
		return $this->usuariosPublico;
	}

	public function setUsuariosPublico($usuariosPublico){
		$this->usuariosPublico = $usuariosPublico;
	}

	public function getUsuariosMobile(){
		return $this->usuariosMobile;
	}

	public function setUsuariosMobile($usuariosMobile){
		$this->usuariosMobile = $usuariosMobile;
	} 

    public function getAlarmas(){
        return $this->alarmas;
    }

    public function setAlarmas($alarmas){
        $this->alarmas = $alarmas;
    }

    public function getAsociaciones(){
        return $this->asociaciones;
    }

    public function setAsociaciones($asociaciones){
        $this->asociaciones = $asociaciones;
    }

    public function getCadenas(){
        return $this->cadenas;
    }

    public function setCadenas($cadenas){
        $this->cadenas = $cadenas;
    }

    public function getDispositivos(){
        return $this->dispositivos;
    }

    public function setDispositivos($dispositivos){
        $this->dispositivos = $dispositivos;
    }

    public function getEncargados(){
        return $this->encargados;
    }

    public function setEncargados($encargados){
        $this->encargados = $encargados;
    }

    public function getNegocios(){
        return $this->negocios;
    }

    public function setNegocios($negocios){
        $this->negocios = $negocios;
    }

    public function getPlazas(){
        return $this->plazas;
    }

    public function setPlazas($plazas){
        $this->plazas = $plazas;
    }


}
