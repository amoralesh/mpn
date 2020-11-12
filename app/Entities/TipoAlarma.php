<?php

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="TipoAlarma",indexes = {
 * @ORM\Index(name="indices", columns={"etiqueta"})})
 *
*/
class TipoAlarma
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

    /**
     *
     * @ORM\OnetoMany(targetEntity="Razon",mappedBy="tipoAlarama",cascade={"merge"})
     */
    private $razones;



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

    public function getRazones(){
        return $this->razones;
    }

    public function setRazones($razones){
        $this->razones = $razones;
    }

}
