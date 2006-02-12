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

function mygmap_adminForm($name, $caption) {
	global $xoopsConfig, $xoopsModule;
	$simpleAdmin =& new xoopsSimpleAdmin($name, $caption);
	$result = $simpleAdmin->execute();
	switch ($result) {
		case SIMPLE_ADMIN_VIEW_FORM:
		case SIMPLE_ADMIN_VIEW_LIST:
			xoops_cp_header();
			if( file_exists( dirname(__FILE__).'/../admin/mymenu.php' ) ) {
				include( dirname(__FILE__).'/../admin/mymenu.php' );
			}
			$simpleAdmin->xoopsTpl->assign('modulename', $GLOBALS['xoopsModule']->getVar('name'));
			if ($result == SIMPLE_ADMIN_VIEW_FORM) {
		    	$simpleAdmin->xoopsTpl->display('mygmap_admin_form.html');
		    } else {
				$simpleAdmin->xoopsTpl->assign('modulename', $GLOBALS['xoopsModule']->getVar('name'));
		    	$simpleAdmin->xoopsTpl->display('mygmap_admin_list.html');
		    }
			xoops_cp_footer();
			break;
		case SIMPLE_ADMIN_VIEW_NONE:
			break;
		default:
			break;
	}
}
?>