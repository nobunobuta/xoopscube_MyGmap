<?php
class MyGmapSimpleController extends XoopsSimpleController{
	function MyGmapSimpleController($classprefix, $name, $caption) {
		$this->name = $name;
		$this->caption = $caption;
		$this->url = xoops_getenv('PHP_SELF');
		$handlerName = $classprefix.'Handler';
		$formName = $classprefix.'Form';
		$this->objectHandler =& new $handlerName($GLOBALS['xoopsDB']);
		$this->objectForm =& new $formName($caption, $name, $this->url, 1);
		$this->xoopsTpl =& $GLOBALS['xoopsTpl'];
		$this->defautlOp = 'edit';
		$this->allowedOp = array('edit','new','insert','save');
	}
	function __l($msg) {
		if (defined('_MYGMAP_LANG_'.str_replace(' ','_',strtoupper($msg)))) {
			return constant('_MYGMAP_LANG_'.str_replace(' ','_',strtoupper($msg)));
		} else {
			return $msg;
		}
	}
	function __e($msg) {
		if (defined('_MYGMAP_ERROR_'.str_replace(' ','_',strtoupper($msg)))) {
			return constant('_MYGMAP_ERROR_'.str_replace(' ','_',strtoupper($msg)));
		} else {
			return $msg;
		}
	}
}
?>
