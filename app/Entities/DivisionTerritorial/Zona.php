<?php  

namespace App\Entities\DivisionTerritorial;


use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**  
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="Zona") 
 */
class Zona  
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
     * @ORM\Column(name="etiqueta", type="string", length=100, nullable=false)
     */
    private $etiqueta;

    /**
     * 
     * @ORM\ManyToMany(targetEntity="Sector", inversedBy="zonas")
     * @ORM\JoinTable(
     *  name="Zona_Sector",
     *  joinColumns={
     *      @ORM\JoinColumn(name="id_Zona", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="id_Sector", referencedColumnName="id")
     *  }
     * )
     */
    private $sectores;
    
    /**
     *
     * @ORM\ManyToMany(targetEntity="App\Entities\Delegacion", mappedBy="zonas",cascade={"merge"})
     */ 
    protected $delegaciones;

    public function getId(){
        return $this->id;
    }

    public function getEtiqueta(){
        return $this->etiqueta;
    }

    public function setEtiqueta($etiqueta){
        $this->etiqueta = $etiqueta;
    }



}