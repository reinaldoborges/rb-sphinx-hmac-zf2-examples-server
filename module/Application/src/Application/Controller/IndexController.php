<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

use RB\Sphinx\Hmac\Zend\Server\HMACServerHelper;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
    
    /**
     * A configuração requer autenticação HMAC por Header (sem sessão) para este Action
     * @return \Zend\View\Model\JsonModel
     */
    public function headerAction() {
    	return new JsonModel(array(
    			'datetime' => date('r'),
    			'plugin' => array(
    				'id' => $this->HMACKeyId (),
    				'hmac' => $this->HMACAdapter()->getHmacDescription(),
    			),
    			'helper' => array(
	    			'id' => HMACServerHelper::getHmacKeyId( $this->getEvent() ),
    				'hmac' => HMACServerHelper::getHmacAdapter( $this->getEvent() )->getHmacDescription()
    			)
    	));
	}
	
	/**
	 * A configuração requer autenticação HMAC por Header (COM sessão) para este Action
	 * @return \Zend\View\Model\JsonModel
	 */
	public function sessionAction() {
		return new JsonModel(array(
				'datetime' => date('r'),
				'plugin' => array(
						'id' => $this->HMACKeyId (),
						'hmac' => $this->HMACAdapter()->getHmacDescription(),
				),
				'helper' => array(
						'id' => HMACServerHelper::getHmacKeyId( $this->getEvent() ),
						'hmac' => HMACServerHelper::getHmacAdapter( $this->getEvent() )->getHmacDescription()
				)
		));
	}
	
	/**
	 * A configuração requer autenticação HMAC na URI (sem sessão) para este Action
	 * @return \Zend\View\Model\JsonModel
	 */
	public function uriAction() {
		return new JsonModel(array(
				'datetime' => date('r'),
				'plugin' => array(
						'id' => $this->HMACKeyId (),
						'hmac' => $this->HMACAdapter()->getHmacDescription(),
				),
				'helper' => array(
						'id' => HMACServerHelper::getHmacKeyId( $this->getEvent() ),
						'hmac' => HMACServerHelper::getHmacAdapter( $this->getEvent() )->getHmacDescription()
				)
		));
	}
	
}
