<?php

namespace bot\Interfaces;

use RedBeanPHP\ToolBox;

interface IRedbeanFactory {

	/**
	 * @return ToolBox
	 */
	function getRedbeanToolbox();

}
