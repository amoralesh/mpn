<?php

namespace DoctrineProxies\__CG__\App\Entities\UsuariosApp;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class InstitucionApp extends \App\Entities\UsuariosApp\InstitucionApp implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'App\\Entities\\UsuariosApp\\InstitucionApp' . "\0" . 'id', '' . "\0" . 'App\\Entities\\UsuariosApp\\InstitucionApp' . "\0" . 'nombre', '' . "\0" . 'App\\Entities\\UsuariosApp\\InstitucionApp' . "\0" . 'nombreCorto', '' . "\0" . 'App\\Entities\\UsuariosApp\\InstitucionApp' . "\0" . 'fechaAlta', '' . "\0" . 'App\\Entities\\UsuariosApp\\InstitucionApp' . "\0" . 'status', '' . "\0" . 'App\\Entities\\UsuariosApp\\InstitucionApp' . "\0" . 'motivoBaja'];
        }

        return ['__isInitialized__', '' . "\0" . 'App\\Entities\\UsuariosApp\\InstitucionApp' . "\0" . 'id', '' . "\0" . 'App\\Entities\\UsuariosApp\\InstitucionApp' . "\0" . 'nombre', '' . "\0" . 'App\\Entities\\UsuariosApp\\InstitucionApp' . "\0" . 'nombreCorto', '' . "\0" . 'App\\Entities\\UsuariosApp\\InstitucionApp' . "\0" . 'fechaAlta', '' . "\0" . 'App\\Entities\\UsuariosApp\\InstitucionApp' . "\0" . 'status', '' . "\0" . 'App\\Entities\\UsuariosApp\\InstitucionApp' . "\0" . 'motivoBaja'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (InstitucionApp $proxy) {
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
    public function prePersist()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'prePersist', []);

        return parent::prePersist();
    }

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getNombre()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNombre', []);

        return parent::getNombre();
    }

    /**
     * {@inheritDoc}
     */
    public function setNombre($nombre)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNombre', [$nombre]);

        return parent::setNombre($nombre);
    }

    /**
     * {@inheritDoc}
     */
    public function getNombreCorto()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNombreCorto', []);

        return parent::getNombreCorto();
    }

    /**
     * {@inheritDoc}
     */
    public function setNombreCorto($nombreCorto)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNombreCorto', [$nombreCorto]);

        return parent::setNombreCorto($nombreCorto);
    }

    /**
     * {@inheritDoc}
     */
    public function getFechaAlta()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFechaAlta', []);

        return parent::getFechaAlta();
    }

    /**
     * {@inheritDoc}
     */
    public function setFechaAlta($fechaAlta)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFechaAlta', [$fechaAlta]);

        return parent::setFechaAlta($fechaAlta);
    }

    /**
     * {@inheritDoc}
     */
    public function getStatus()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStatus', []);

        return parent::getStatus();
    }

    /**
     * {@inheritDoc}
     */
    public function setStatus($status)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setStatus', [$status]);

        return parent::setStatus($status);
    }

    /**
     * {@inheritDoc}
     */
    public function getMotivoBaja()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMotivoBaja', []);

        return parent::getMotivoBaja();
    }

    /**
     * {@inheritDoc}
     */
    public function setMotivoBaja($motivoBaja)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMotivoBaja', [$motivoBaja]);

        return parent::setMotivoBaja($motivoBaja);
    }

    /**
     * {@inheritDoc}
     */
    public function getMotivoAlta()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMotivoAlta', []);

        return parent::getMotivoAlta();
    }

    /**
     * {@inheritDoc}
     */
    public function setMotivoAlta($motivoAlta)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMotivoAlta', [$motivoAlta]);

        return parent::setMotivoAlta($motivoAlta);
    }

}
