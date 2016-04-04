<?php

namespace Rbhmac;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use RB\Sphinx\Hmac\HMAC;
use RB\Sphinx\Hmac\Algorithm\HMACv1;
use RB\Sphinx\Hmac\Hash\Sha256;
use RB\Sphinx\Hmac\Key\StaticKey;
use RB\Sphinx\Hmac\Nonce\DummyNonce;
use RB\Sphinx\Hmac\Exception\HMACException;
use RB\Sphinx\Hmac\HMACSession;
use RB\Sphinx\Hmac\Hash\DummyHash;
use RB\Sphinx\Hmac\Hash\PHPHash;
use RB\Sphinx\Hmac\Algorithm\HMACv0;



class HMACAbstractFactory implements AbstractFactoryInterface {
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see \Zend\ServiceManager\AbstractFactoryInterface::canCreateServiceWithName()
	 */
	public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) {
		switch ($requestedName) {
			case 'Rbhmac\HMAC' :
			case 'Rbhmac\HMACSession' :
				return true;
		}
		
		return false;
	}
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see \Zend\ServiceManager\AbstractFactoryInterface::createServiceWithName()
	 */
	public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) {
		$algo = new HMACv0 ();
		
		$hash = new PHPHash ( 'sha256' );
		//$hash = new DummyHash();
		
		$key = new StaticKey ( '[PRE-SHARED KEY]' );
		
		$nonce = new DummyNonce ();
		$nonce2 = clone $nonce;
		
		switch ($requestedName) {
			
			case 'Rbhmac\HMAC' :
				return new HMAC ( $algo, $hash, $key, $nonce );
				break;
			
			case 'Rbhmac\HMACSession' :
				return new HMACSession ( $algo, $hash, $key, $nonce, $nonce2 );
				break;
		}
		return null;
	}
}