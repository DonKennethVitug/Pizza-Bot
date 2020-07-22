<?php

namespace bot\Controllers;

class BaseController {

	/**
	* @static $container - Holder of dependency container
	*/
	private static $container;

	/**
	*	Setup and Initialize the data
	*	@param object $container - The dependency container
	*/
	public function __construct($container){
		$this->container = $container;
	}

	/** 
	* Get the property
	* @access Protected
	* @return $item
	*/
	protected function getItem(){
		return $this->container["item"];
	}

	/**
	* Get the view config from the DI Container
	
	* @access Public
	* @return \Slim\Views\Twig
	*/

	public function view(){
		return $this->container["view"];
	}

	/**
	* Get the monolog logger
	* @access Public
	* @return \Monolog\Logger
	*/

	public function logger(){
		return $this->container["logger"];
	}

	public function redbeanFactory(){
		return $this->container["RedbeanFactory"];
	}
}