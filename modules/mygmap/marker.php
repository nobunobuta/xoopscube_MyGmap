<?php
include("../../mainfile.php");$xoopsOption['template_main'] = 'mygmap_marker.html';
$marker_form = '';
if ($GLOBALS['xoopsUserIsAdmin']) {
	include('class/mygmap_classes.php');    if (!isset($_REQUEST['op'])) $_REQUEST['op'] = '';
	$markerHandler =& new MyGmapMarkerHandler($GLOBALS['xoopsDB']);	switch ($_REQUEST['op']) {
	  case 'insert':
	    if (class_exists('XoopsMultiTokenHandler')) {
		    if(!XoopsMultiTokenHandler::quickValidate('gmapedit_insert')) {
				redirect_header(XOOPS_URL."/modules/mygmap/",1,'Token Error');
			}
		}
		$markerObject =& $markerHandler->create();
		$markerObject->setFormVars($_POST,'');
		if (!$markerHandler->insert($markerObject,false,true)) {
			include(XOOPS_ROOT_PATH.'/header.php');
			$markerObject->setFormVars($_POST,'');
			$markerObject->defineFormElementsForGMap();			$marker_form = $markerObject->renderEditForm("Edit","gmapedit",XOOPS_URL."/modules/mygmap/marker.php",1);
			showMarkerForm($marker_form,
						   floatval($_POST['mygmap_marker_lat']),
						   floatval($_POST['mygmap_marker_lng']),
						   intval($_POST['mygmap_marker_zoom']),
						   $markerHandler->getErrors());
			include(XOOPS_ROOT_PATH.'/footer.php');			exit();
		}
		redirect_header(XOOPS_URL."/modules/mygmap/?cat=".$markerObject->getVar('mygmap_marker_category_id'),1,'');
		exit();
		break;
	  case 'save':
	    if (class_exists('XoopsMultiTokenHandler')) {
		    if(!XoopsMultiTokenHandler::quickValidate('gmapedit_save')) {
				redirect_header(XOOPS_URL."/modules/mygmap/",1,'Token Error');
			}
		}
		if (isset($_POST['mygmap_marker_id'])) {			$map_id = intval($_POST['mygmap_marker_id']);			if ($markerObject =& $markerHandler->get($map_id)) {				$markerObject->setFormVars($_POST,'');
				if (!$markerHandler->insert($markerObject,false,true)) {
					include(XOOPS_ROOT_PATH.'/header.php');
					$markerObject->setFormVars($_POST,'');
					$markerObject->defineFormElementsForGMap();					$marker_form = $markerObject->renderEditForm("Edit","gmapedit",XOOPS_URL."/modules/mygmap/marker.php",1);
					showMarkerForm($marker_form,
								   floatval($_POST['mygmap_marker_lat']),
								   floatval($_POST['mygmap_marker_lng']),
								   intval($_POST['mygmap_marker_zoom']),
								   $markerHandler->getErrors());
					include(XOOPS_ROOT_PATH.'/footer.php');					exit();
				}
				redirect_header(XOOPS_URL."/modules/mygmap/?cat=".$markerObject->getVar('mygmap_marker_category_id'),1,'');
				exit();
			}
		}
		break;
	  case 'new':
		include(XOOPS_ROOT_PATH.'/header.php');		$markerObject =& $markerHandler->create();
		$markerObject->setFormVars($_POST,'');
		$markerObject->defineFormElementsForGMap();		$marker_form .= $markerObject->renderEditForm("New","gmapedit",XOOPS_URL."/modules/mygmap/marker.php",1);
		showMarkerForm($marker_form,
					   floatval($_POST['mygmap_lat']),
					   floatval($_POST['mygmap_lng']),
					   intval($_POST['mygmap_zoom']),
					   '');
		include(XOOPS_ROOT_PATH.'/footer.php');		break;
	  default:
		include(XOOPS_ROOT_PATH.'/header.php');		if (isset($_GET['id'])) {			$map_id = intval($_GET['id']);			if ($markerObject =& $markerHandler->get($map_id)) {
				$markerObject->defineFormElementsForGMap();				$marker_form = $markerObject->renderEditForm("Edit","gmapedit",XOOPS_URL."/modules/mygmap/marker.php",1);
				showMarkerForm($marker_form,
							   $markerObject->getVar('mygmap_marker_lat'),
							   $markerObject->getVar('mygmap_marker_lng'),
							   $markerObject->getVar('mygmap_marker_zoom'),
							   '');
			}
		}		include(XOOPS_ROOT_PATH.'/footer.php');		break;
	}
}
function showMarkerForm($form, $lat, $lng, $zoom, $errmsg) {
	$GLOBALS['xoopsTpl']->assign('mygmap_API', $GLOBALS['xoopsModuleConfig']['mygmap_api']);	$GLOBALS['xoopsTpl']->assign('mygmap_center_lat', $lat);	$GLOBALS['xoopsTpl']->assign('mygmap_center_lng', $lng);	$GLOBALS['xoopsTpl']->assign('mygmap_zoom', $zoom);	$GLOBALS['xoopsTpl']->assign('mygmap_width', $GLOBALS['xoopsModuleConfig']['mygmap_width']);
	$GLOBALS['xoopsTpl']->assign('mygmap_height', $GLOBALS['xoopsModuleConfig']['mygmap_height']);
	$GLOBALS['xoopsTpl']->assign('marker_form', $form);
	$GLOBALS['xoopsTpl']->assign('errmsg', $errmsg);
	$GLOBALS['xoopsTpl']->assign('mygmap_credit', $GLOBALS['mygmap_credit']);	$GLOBALS['xoopsTpl']->assign('mygmap_use_undocAPI', $GLOBALS['xoopsModuleConfig']['mygmap_use_undocAPI']);}
?>