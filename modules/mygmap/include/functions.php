<?php
function mygmap_option($conf_name) {
	$module_handler =& xoops_gethandler('module');
	$module=$module_handler->getByDirname('mygmap');
	$mid=$module->getVar('mid');
	if (empty($GLOBALS['wp_xoops_config'])) {
		$GLOBALS['wp_xoops_config'] =& xoops_gethandler('config');
	}
    
    $records =& $GLOBALS['wp_xoops_config']->getConfigList($mid);
    $value = $records[$conf_name];
    return ($value);
}

?>