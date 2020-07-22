<?php

namespace bot\Services;
use RedBeanPHP\R;
use bot\Interfaces\IRedbeanFactory;

class RedbeanFactory implements IRedbeanFactory {

	private $dsn;
	private $username;
	private $password;

	/**
	 *
	 * @var \RedBeanPHP\ToolBox
	 */
	private $toolbox;

	public function __construct($dsn, $username, $password) {
		$this->password = $password;
		$this->dsn = $dsn;
		$this->username = $username;
		$this->toolbox = null;
	}

	public function getRedbeanToolbox() {
		if( $this->toolbox !== null ) return $this->toolbox;
		$this->initializeToolbox();
		return $this->toolbox;
	}

	private function initializeToolbox() {
		R::setup($this->dsn, $this->username, $this->password);
		$this->toolbox = R::getToolBox();
	}


}
