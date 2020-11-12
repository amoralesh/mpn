<?php  

namespace App\Entities\Usuarios;

use App\Entities\MotivoAltaBaja;
  
use Doctrine\ORM\Mapping as ORM;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use LaravelDoctrine\ORM\Auth\Authenticatable;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;
use LaravelDoctrine\ORM\Notifications\Notifiable;

/**
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="Usuario",uniqueConstraints={
 * @ORM\UniqueConstraint(name="cxtn_email_usuario", columns={"email", "usuario"})},indexes = {
 * @ORM\Index(name="index_usuario_email", columns={"usuario", "email"})})
 *  
*/
class Usuario implements AuthenticatableContract, CanResetPasswordContract
{

    use Timestamps, Notifiable;
    
	/**
     * @var integer
     *
     * @ORM\Id  
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer",nullable=false)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="remember_token", type="string", length=200, nullable=true) 
     */
    private $remember_token;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario", type="string", length=200, nullable=false) 
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=200 , nullable=false) 
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=200, nullable=false) 
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=200, nullable=true) 
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidoPaterno", type="string", length=200, nullable=true) 
     */
    private $apellidoPaterno;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidoMaterno", type="string", length=200, nullable=true) 
     */
    private $apellidoMaterno;

    /**
     * @var integer
     *
     * @ORM\Column(name="placa", type="integer" , nullable=true) 
     */
    private $placa;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Institucion",cascade={"merge"})
     * @ORM\JoinColumn(name="id_Institucion", referencedColumnName="id", nullable=false)
     */
    private $institucion;
    
    /**
     * 
     * @ORM\ManyToMany(targetEntity="Permiso", inversedBy="Usuario")
     * @ORM\JoinTable(
     *  name="Usuario_Permisos",
     *  joinColumns={
     *      @ORM\JoinColumn(name="id_Usuario", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="id_Permiso", referencedColumnName="id")
     *  }
     * )
     */
    private $permisos;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAlta", type="datetime" , nullable=false)
     */
    private $fechaAlta;

    /**
     * @var binary
     *
     * @ORM\Column(name="status", type="boolean", nullable=false, options={"default":"1"})
     */
    private $status;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="App\Entities\MotivoAltaBaja", inversedBy="usuarios",cascade={"All"})
     * @ORM\JoinTable( 
     *  name="Usuario_MotivoAltaBaja",
     *  joinColumns={
     *      @ORM\JoinColumn(name="id_Usuario", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="id_MotivoAltaBaja", referencedColumnName="id")
     *  }
     * )
     */
    private $motivosAltaBaja;

    /**
    * @ORM\PrePersist
    */
    public function prePersist()
    {
      $this->status = 1;
      $this->fechaAlta = new \DateTime();
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->id;
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getRemember_token(){
		return $this->remember_token;
	}

	public function setRemember_token($remember_token){
		$this->remember_token = $remember_token;
	}

	public function getUsuario(){
		return $this->usuario;
	}

	public function setUsuario($usuario){
		$this->usuario = $usuario;
	}

	public function getPassword(){
		return $this->password;
	}

	public function setPassword($password){
		$this->password = $password;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

	public function getApellidoPaterno(){
		return $this->apellidoPaterno;
	}

	public function setApellidoPaterno($apellidoPaterno){
		$this->apellidoPaterno = $apellidoPaterno;
	}

	public function getApellidoMaterno(){
		return $this->apellidoMaterno;
	}

	public function setApellidoMaterno($apellidoMaterno){
		$this->apellidoMaterno = $apellidoMaterno;
	}

	public function getPlaca(){
		return $this->placa;
	}

	public function setPlaca($placa){
		$this->placa = $placa;
	}

	public function getInstitucion(){ 
		return $this->institucion;
	}

	public function setInstitucion($institucion){
		$this->institucion = $institucion;
	}

	public function getPermisos(){
		return $this->permisos;
	}

	public function setPermisos($permisos){
		$this->permisos = $permisos;
	}

	public function getFechaAlta(){
		return $this->fechaAlta;
	}

	public function setFechaAlta($fechaAlta){
		$this->fechaAlta = $fechaAlta;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function getMotivosAltaBaja(){
		return $this->motivosAltaBaja; 
	}

	public function setMotivosAltaBaja($motivosAltaBaja){
		$this->motivosAltaBaja = $motivosAltaBaja;
    }
    
    public function addMotivoAltaBaja(MotivoAltaBaja $motivoAltaBaja)
    {
        if (!$this->motivosAltaBaja->contains($motivoAltaBaja)) {
             $this->motivosAltaBaja->add($motivoAltaBaja);
        }
        return $this;
    }



    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset(){
		return $this->email;
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token){
        return void;
    }

}
