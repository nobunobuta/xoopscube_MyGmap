<?php
include("../../mainfile.php");
if ($GLOBALS['xoopsUserIsAdmin']) {
	if (isset($_POST['lat']) && isset($_POST['lng']) && isset($_POST['zoom'])) {
		$update_configs = array('mygmap_lat','mygmap_lng','mygmap_zoom');
		$update_vars = array(floatval($_POST['lat']),floatval($_POST['lng']),intval($_POST['zoom']));
	    $config_handler =& xoops_gethandler('configitem');
		foreach($update_configs as $key=>$update_config) {
			$criteria = new CriteriaCompo(new Criteria('conf_modid', $xoopsModule->getVar('mid')));
		   	$criteria->add(new Criteria('conf_name', $update_config));
			$configitems =& $config_handler->getObjects($criteria, false);
			if (count($configitems)==1) {
				$configitems[0]->setVar('conf_value', $update_vars[$key]);
				$config_handler->insert($configitems[0]);
			}
		}
	}
}
header("Location: ".XOOPS_URL."/modules/mygmap");
?>