<?php

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="Encargado",indexes = {
 * @ORM\Index(name="indices", columns={"id"})})
 *
*/
class Encargado
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
     * @ORM\Column(name="nombre", type="string", length=100, nullable = false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidoPaterno", type="string", length=100, nullable = false)
     */
    private $apellidoPaterno;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidoMaterno", type="string", length=100, nullable = false)
     */
    private $apellidoMaterno;

    /**
     * @var varchar
     *
     * @ORM\Column(name="telefono", type="string", length=20, nullable = false)
     */
    private $telefono;

    /**
     * @var varchar
     *
     * @ORM\Column(name="extension", type="string", length=10, nullable = true)
     */
    private $extension;
    /**
     * @var varchar
     *
     * @ORM\Column(name="celular", type="string", length=20, nullable = true)
     */
    private $celular;
    /**
     * @var varchar
     *
     * @ORM\Column(name="correo", type="string", unique=false, length=150, nullable = false)
     */
    private $correo;
    /**
     * @var
     *
     * @ORM\ManyToMany(targetEntity="Asociacion", mappedBy="encargados")
     */
    protected $asociaciones;
    /**
     * @var
     *
     * @ORM\ManyToMany(targetEntity="Cadena", mappedBy="encargados")
     */
    protected $cadenas;
    /**
     * @var
     *
     * @ORM\ManyToMany(targetEntity="Negocio", mappedBy="encargados")
     */
    protected $negocios;
    /**
     * @var
     *
     * @ORM\ManyToMany(targetEntity="Plaza", mappedBy="encargados")
     */
    protected $plazas;

     /**
     * @var tipoEncargado ( contacto,representante,dueño)
     *
     * @ORM\ManytoOne(targetEntity="TipoEncargado",cascade={"merge"})
     * @ORM\JoinColumn(name="id_TipoEncargado", referencedColumnName="id", nullable=true)
     */
     private $tipoEncargado;  

    /**
     * @var binary
     *
     * @ORM\Column(name="status", type="boolean", nullable=false, options={"default":"1"})
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAlta", type="datetime" , nullable=false)
     */
    private $fechaAlta;
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="MotivoAltaBaja", inversedBy="encargados",cascade={"All"})
     * @ORM\JoinTable(
     *  name="Encargado_MotivoAltaBaja",
     *  joinColumns={
     *      @ORM\JoinColumn(name="id_Encargado", referencedColumnName="id")
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

    public function getId(){
        return $this->id;
    }
 
    public function setId($id){
        $this->id = $id;
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

    public function getTelefono(){
        return $this->telefono;
    }

    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }

    public function getExtension(){
        return $this->extension;
    }

    public function setExtension($extension){
        $this->extension = $extension;
    }

    public function getCelular(){
        return $this->celular;
    }

    public function setCelular($celular){
        $this->celular = $celular;
    }

    public function getCorreo(){
        return $this->correo;
    }

    public function setCorreo($correo){
        $this->correo = $correo;
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

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function getFechaAlta(){
        return $this->fechaAlta;
    }

    public function setFechaAlta($fechaAlta){
        $this->fechaAlta = $fechaAlta;
    }

    public function getMotivosAltaBaja(){
        return $this->motivosAltaBaja;
    }

    public function addMotivoAltaBaja(MotivoAltaBaja $motivoAltaBaja)
    {
        if (!$this->motivosAltaBaja->contains($motivoAltaBaja)) {
             $this->motivosAltaBaja->add($motivoAltaBaja);
        }
        return $this;
    }

    public function setMotivosAltaBaja($motivoAltaBaja){
        $this->motivosAltaBaja = $motivoAltaBaja;
    }

    public function getTipoEncargado(){
		return $this->tipoEncargado;
	}

	public function setTipoEncargado($tipoEncargado){
		$this->tipoEncargado = $tipoEncargado;
	}




}
