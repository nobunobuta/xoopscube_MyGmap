<?php
include("../../mainfile.php");$xoopsOption['template_main'] = 'mygmap_marker.html';
$marker_form = '';
if ($GLOBALS['xoopsUserIsAdmin']) {
	include('class/mygmap_classes.php');    if (!isset($_REQUEST['op'])) $_REQUEST['op'] = '';
	$markerHandler =& new MyGmapMarkerHandler($GLOBALS['xoopsDB']);	$markerForm =& new MyGmapMarkerFormForGmap('', 'mygmap_markedit', XOOPS_URL."/modules/mygmap/marker.php", 1);

	switch ($_REQUEST['op']) {
	  case 'insert':
	    if (class_exists('XoopsMultiTokenHandler')) {
		    if (!XoopsMultiTokenHandler::quickValidate('mygmap_markedit_insert')) {
				redirect_header(XOOPS_URL."/modules/mygmap/",1,'Token Error');
			}
		}
		$markerObject =& $markerHandler->create();
		$markerObject->setFormVars($_POST,'');
		if (!$markerHandler->insert($markerObject,false,true)) {
			include(XOOPS_ROOT_PATH.'/header.php');
			$markerObject->setFormVars($_POST,'');
			$markerForm->setCaption('New Marker');
			showMarkerForm($markerForm, $markerObject, $markerHandler->getErrors());
			include(XOOPS_ROOT_PATH.'/footer.php');			exit();
		}
		redirect_header(XOOPS_URL."/modules/mygmap/?cat=".$markerObject->getVar('mygmap_marker_category_id'),1,'');
		break;
	  case 'save':
	    if (class_exists('XoopsMultiTokenHandler')) {
		    if (!XoopsMultiTokenHandler::quickValidate('mygmap_markedit_save')) {
				redirect_header(XOOPS_URL."/modules/mygmap/",1,'Token Error');
			}
		}
		if (isset($_POST['mygmap_marker_id'])) {			$map_id = intval($_POST['mygmap_marker_id']);			if ($markerObject =& $markerHandler->get($map_id)) {				$markerObject->setFormVars($_POST,'');
				if (!$markerHandler->insert($markerObject,false,true)) {
					include(XOOPS_ROOT_PATH.'/header.php');
					$markerObject->setFormVars($_POST,'');
					$markerForm->setCaption('Edit Marker');
					showMarkerForm($markerForm, $markerObject, $markerHandler->getErrors());
					include(XOOPS_ROOT_PATH.'/footer.php');					exit();
				}
				redirect_header(XOOPS_URL."/modules/mygmap/?cat=".$markerObject->getVar('mygmap_marker_category_id'),1,'');
			}
		}
		break;
	  case 'new':
		include(XOOPS_ROOT_PATH.'/header.php');		$markerObject =& $markerHandler->create();
		$markerObject->setFormVars($_POST,'');
		$markerForm->setCaption('New Marker');
		showMarkerForm($markerForm, $markerObject, $markerHandler->getErrors());
		include(XOOPS_ROOT_PATH.'/footer.php');		break;
	  default:
		include(XOOPS_ROOT_PATH.'/header.php');		if (isset($_GET['id'])) {			$map_id = intval($_GET['id']);			if ($markerObject =& $markerHandler->get($map_id)) {
				$markerForm->setCaption('Edit Marker');
				showMarkerForm($markerForm, $markerObject, $markerHandler->getErrors());
			}
		}		include(XOOPS_ROOT_PATH.'/footer.php');		break;
	}
}
function showMarkerForm(&$form, &$object, $errmsg='') {
    $form->assign($object, $GLOBALS['xoopsTpl']);
	$GLOBALS['xoopsTpl']->assign('mygmap_API', $GLOBALS['xoopsModuleConfig']['mygmap_api']);	$GLOBALS['xoopsTpl']->assign('mygmap_center_lat', $object->getVar('mygmap_marker_lat'));	$GLOBALS['xoopsTpl']->assign('mygmap_center_lng', $object->getVar('mygmap_marker_lng'));	$GLOBALS['xoopsTpl']->assign('mygmap_zoom', $object->getVar('mygmap_marker_zoom'));	$GLOBALS['xoopsTpl']->assign('mygmap_width', $GLOBALS['xoopsModuleConfig']['mygmap_width']);
	$GLOBALS['xoopsTpl']->assign('mygmap_height', $GLOBALS['xoopsModuleConfig']['mygmap_height']);
	$GLOBALS['xoopsTpl']->assign('errmsg', $errmsg);
	$GLOBALS['xoopsTpl']->assign('mygmap_credit', $GLOBALS['mygmap_credit']);	$GLOBALS['xoopsTpl']->assign('mygmap_use_undocAPI', $GLOBALS['xoopsModuleConfig']['mygmap_use_undocAPI']);}
?>