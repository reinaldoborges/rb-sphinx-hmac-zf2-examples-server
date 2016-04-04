<?php
/**
 * Local Configuration Override
 *
 * This configuration override file is for overriding environment-specific and
 * security-sensitive configuration information. Copy this file without the
 * .dist extension at the end and populate values as needed.
 *
 * @NOTE: This file is ignored from Git by default with the .gitignore included
 * in ZendSkeletonApplication. This is a good practice, as it prevents sensitive
 * credentials from accidentally being committed into version control.
 */
return array (
		'rb_sphinx_hmac_server' => array (
				
				// Nomeie o seletor o seu respectivo serviço a ser usado na AbstractFactory
				// Exemplo:
				// 'HMACSimples' => 'MyApp\Factories\SimpleHMACAbstractFactory'
				'selectors' => array (
						'HMAC' => 'Rbhmac\HMAC',
						'HMACSession' => 'Rbhmac\HMACSession' 
				),
				
				// Opcionalmente, defina seletor e/ou adapter padrão a ser utilizado nos Controller's com HMAC ativo
				'default_selector' => 'HMAC',
				'default_adapter' => 'HMACHeaderAdapter',
				
				// Defina quais controller's utilizarão autenticação HMAC
				'controllers' => array (
						'Application\Controller\Index' => array(
								'actions' => array(
									'index' => false,
									'header' => array(
											'selector' => 'HMAC',
											'adapter' => 'HMACHeaderAdapter'
									),
									'session' => array(
											'selector' => 'HMACSession',
											'adapter' => 'HMACSessionHeaderAdapter'
									),
									'uri' => array(
											'selector' => 'HMAC',
											'adapter' => 'HMACUriAdapter'
									)
								)
						)
				)
		)
);
