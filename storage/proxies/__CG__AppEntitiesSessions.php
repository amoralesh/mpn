<?php

namespace DoctrineProxies\__CG__\App\Entities;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Sessions extends \App\Entities\Sessions implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = [];



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'App\\Entities\\Sessions' . "\0" . 'id', '' . "\0" . 'App\\Entities\\Sessions' . "\0" . 'user_id', '' . "\0" . 'App\\Entities\\Sessions' . "\0" . 'ip_address', '' . "\0" . 'App\\Entities\\Sessions' . "\0" . 'user_agent', '' . "\0" . 'App\\Entities\\Sessions' . "\0" . 'payload', '' . "\0" . 'App\\Entities\\Sessions' . "\0" . 'last_activity'];
        }

        return ['__isInitialized__', '' . "\0" . 'App\\Entities\\Sessions' . "\0" . 'id', '' . "\0" . 'App\\Entities\\Sessions' . "\0" . 'user_id', '' . "\0" . 'App\\Entities\\Sessions' . "\0" . 'ip_address', '' . "\0" . 'App\\Entities\\Sessions' . "\0" . 'user_agent', '' . "\0" . 'App\\Entities\\Sessions' . "\0" . 'payload', '' . "\0" . 'App\\Entities\\Sessions' . "\0" . 'last_activity'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Sessions $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setId($id)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setId', [$id]);

        return parent::setId($id);
    }

    /**
     * {@inheritDoc}
     */
    public function getUser_id()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUser_id', []);

        return parent::getUser_id();
    }

    /**
     * {@inheritDoc}
     */
    public function setUser_id($user_id)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUser_id', [$user_id]);

        return parent::setUser_id($user_id);
    }

    /**
     * {@inheritDoc}
     */
    public function getIp_address()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIp_address', []);

        return parent::getIp_address();
    }

    /**
     * {@inheritDoc}
     */
    public function setIp_address($ip_address)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIp_address', [$ip_address]);

        return parent::setIp_address($ip_address);
    }

    /**
     * {@inheritDoc}
     */
    public function getUser_agent()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUser_agent', []);

        return parent::getUser_agent();
    }

    /**
     * {@inheritDoc}
     */
    public function setUser_agent($user_agent)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUser_agent', [$user_agent]);

        return parent::setUser_agent($user_agent);
    }

    /**
     * {@inheritDoc}
     */
    public function getPayload()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPayload', []);

        return parent::getPayload();
    }

    /**
     * {@inheritDoc}
     */
    public function setPayload($payload)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPayload', [$payload]);

        return parent::setPayload($payload);
    }

    /**
     * {@inheritDoc}
     */
    public function getLast_activity()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLast_activity', []);

        return parent::getLast_activity();
    }

    /**
     * {@inheritDoc}
     */
    public function setLast_activity($last_activity)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLast_activity', [$last_activity]);

        return parent::setLast_activity($last_activity);
    }

}
