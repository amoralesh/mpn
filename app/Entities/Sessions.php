<?php  
  
namespace App\Entities;
   
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;
 
/**
 * @ORM\Entity 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="Sessions",uniqueConstraints={
 * @ORM\UniqueConstraint(name="id", columns={"id"})})
 * 
*/
class Sessions
{
	/**
     * @var string
     *
     * @ORM\Column(name="id", type="string", unique=true ,nullable=false)
     * @ORM\Id
     */
    private $id;

	/**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", options={"unsigned"=true},nullable=true)
     */
    private $user_id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="ip_address", type="string", length=255, nullable=true) 
     */
    private $ip_address;

    /**
     * @var string
     *
     * @ORM\Column(name="user_agent", type="text",  nullable=true) 
     */
    private $user_agent;

    /**
     * @var string
     *
     * @ORM\Column(name="payload", type="text",  nullable=true) 
     */
    private $payload;

	/**
     * @var integer
     *
     * @ORM\Column(name="last_activity", type="integer",nullable=false)
     */
    private $last_activity;
	
	
	
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getUser_id(){
		return $this->user_id;
	}

	public function setUser_id($user_id){
		$this->user_id = $user_id;
	}

	public function getIp_address(){
		return $this->ip_address;
	}

	public function setIp_address($ip_address){
		$this->ip_address = $ip_address;
	}

	public function getUser_agent(){
		return $this->user_agent;
	}

	public function setUser_agent($user_agent){
		$this->user_agent = $user_agent;
	}

	public function getPayload(){
		return $this->payload;
	}

	public function setPayload($payload){
		$this->payload = $payload;
	}

	public function getLast_activity(){
		return $this->last_activity;
	}

	public function setLast_activity($last_activity){
		$this->last_activity = $last_activity;
	}
     

}
