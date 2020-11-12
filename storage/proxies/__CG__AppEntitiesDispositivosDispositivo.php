<?php

namespace DoctrineProxies\__CG__\App\Entities\Dispositivos;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Dispositivo extends \App\Entities\DispositivosMobile\DispositivoMobile implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'App\\Entities\\Dispositivos\\Dispositivo' . "\0" . 'id', '' . "\0" . 'App\\Entities\\Dispositivos\\Dispositivo' . "\0" . 'idUnico', '' . "\0" . 'App\\Entities\\Dispositivos\\Dispositivo' . "\0" . 'alias', '' . "\0" . 'App\\Entities\\Dispositivos\\Dispositivo' . "\0" . 'numero', '' . "\0" . 'App\\Entities\\Dispositivos\\Dispositivo' . "\0" . 'modelo', '' . "\0" . 'App\\Entities\\Dispositivos\\Dispositivo' . "\0" . 'version', '' . "\0" . 'App\\Entities\\Dispositivos\\Dispositivo' . "\0" . 'tipoDispositivo', '' . "\0" . 'App\\Entities\\Dispositivos\\Dispositivo' . "\0" . 'token', 'usuariosPublicos', '' . "\0" . 'App\\Entities\\Dispositivos\\Dispositivo' . "\0" . 'permisos', '' . "\0" . 'App\\Entities\\Dispositivos\\Dispositivo' . "\0" . 'fechaAlta', '' . "\0" . 'App\\Entities\\Dispositivos\\Dispositivo' . "\0" . 'status', '' . "\0" . 'App\\Entities\\Dispositivos\\Dispositivo' . "\0" . 'motivoAltaBaja'];
        }

        return ['__isInitialized__', '' . "\0" . 'App\\Entities\\Dispositivos\\Dispositivo' . "\0" . 'id', '' . "\0" . 'App\\Entities\\Dispositivos\\Dispositivo' . "\0" . 'idUnico', '' . "\0" . 'App\\Entities\\Dispositivos\\Dispositivo' . "\0" . 'alias', '' . "\0" . 'App\\Entities\\Dispositivos\\Dispositivo' . "\0" . 'numero', '' . "\0" . 'App\\Entities\\Dispositivos\\Dispositivo' . "\0" . 'modelo', '' . "\0" . 'App\\Entities\\Dispositivos\\Dispositivo' . "\0" . 'version', '' . "\0" . 'App\\Entities\\Dispositivos\\Dispositivo' . "\0" . 'tipoDispositivo', '' . "\0" . 'App\\Entities\\Dispositivos\\Dispositivo' . "\0" . 'token', 'usuariosPublicos', '' . "\0" . 'App\\Entities\\Dispositivos\\Dispositivo' . "\0" . 'permisos', '' . "\0" . 'App\\Entities\\Dispositivos\\Dispositivo' . "\0" . 'fechaAlta', '' . "\0" . 'App\\Entities\\Dispositivos\\Dispositivo' . "\0" . 'status', '' . "\0" . 'App\\Entities\\Dispositivos\\Dispositivo' . "\0" . 'motivoAltaBaja'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Dispositivo $proxy) {
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
    public function setId($id)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setId', [$id]);

        return parent::setId($id);
    }

    /**
     * {@inheritDoc}
     */
    public function getIdUnico()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdUnico', []);

        return parent::getIdUnico();
    }

    /**
     * {@inheritDoc}
     */
    public function setIdUnico($idUnico)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIdUnico', [$idUnico]);

        return parent::setIdUnico($idUnico);
    }

    /**
     * {@inheritDoc}
     */
    public function getAlias()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAlias', []);

        return parent::getAlias();
    }

    /**
     * {@inheritDoc}
     */
    public function setAlias($alias)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAlias', [$alias]);

        return parent::setAlias($alias);
    }

    /**
     * {@inheritDoc}
     */
    public function getNumero()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNumero', []);

        return parent::getNumero();
    }

    /**
     * {@inheritDoc}
     */
    public function setNumero($numero)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNumero', [$numero]);

        return parent::setNumero($numero);
    }

    /**
     * {@inheritDoc}
     */
    public function getModelo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getModelo', []);

        return parent::getModelo();
    }

    /**
     * {@inheritDoc}
     */
    public function setModelo($modelo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setModelo', [$modelo]);

        return parent::setModelo($modelo);
    }

    /**
     * {@inheritDoc}
     */
    public function getVersion()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getVersion', []);

        return parent::getVersion();
    }

    /**
     * {@inheritDoc}
     */
    public function setVersion($version)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setVersion', [$version]);

        return parent::setVersion($version);
    }

    /**
     * {@inheritDoc}
     */
    public function getTipoDispositivo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTipoDispositivo', []);

        return parent::getTipoDispositivo();
    }

    /**
     * {@inheritDoc}
     */
    public function setTipoDispositivo($tipoDispositivo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTipoDispositivo', [$tipoDispositivo]);

        return parent::setTipoDispositivo($tipoDispositivo);
    }

    /**
     * {@inheritDoc}
     */
    public function getToken()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getToken', []);

        return parent::getToken();
    }

    /**
     * {@inheritDoc}
     */
    public function setToken($token)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setToken', [$token]);

        return parent::setToken($token);
    }

    /**
     * {@inheritDoc}
     */
    public function getUsuariosPublicos()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUsuariosPublicos', []);

        return parent::getUsuariosPublicos();
    }

    /**
     * {@inheritDoc}
     */
    public function setUsuariosPublicos($usuariosPublicos)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUsuariosPublicos', [$usuariosPublicos]);

        return parent::setUsuariosPublicos($usuariosPublicos);
    }

    /**
     * {@inheritDoc}
     */
    public function removeUsuarioPublico(\App\Entities\UsuariosPublico\UsuarioPublico $usuarioPublico)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeUsuarioPublico', [$usuarioPublico]);

        return parent::removeUsuarioPublico($usuarioPublico);
    }

    /**
     * {@inheritDoc}
     */
    public function getPermisos()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPermisos', []);

        return parent::getPermisos();
    }

    /**
     * {@inheritDoc}
     */
    public function setPermisos($permisos)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPermisos', [$permisos]);

        return parent::setPermisos($permisos);
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
    public function getMotivoAltaBaja()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMotivoAltaBaja', []);

        return parent::getMotivoAltaBaja();
    }

    /**
     * {@inheritDoc}
     */
    public function setMotivoAltaBaja($motivoAltaBaja)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMotivoAltaBaja', [$motivoAltaBaja]);

        return parent::setMotivoAltaBaja($motivoAltaBaja);
    }

}