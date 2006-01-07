<?php
include("../../mainfile.php");$xoopsOption['template_main'] = 'mygmap_area.html';
$area_form = '';
if ($GLOBALS['xoopsUserIsAdmin']) {
	include('class/mygmap_classes.php');    if (!isset($_REQUEST['op'])) $_REQUEST['op'] = '';
	$areaHandler =& new MyGmapAreaHandler($GLOBALS['xoopsDB']);	switch ($_REQUEST['op']) {
	  case 'insert':
	    if(!XoopsMultiTokenHandler::quickValidate('gareaedit_insert'))
			redirect_header(XOOPS_URL."/modules/mygmap/",1,'Token Error');
		$areaObject =& $areaHandler->create();
		$areaObject->setFormVars($_POST,'');
		if (!$areaHandler->insert($areaObject,false,true)) {
			include(XOOPS_ROOT_PATH.'/header.php');
			$areaObject->setFormVars($_POST,'');
			$areaObject->defineFormElementsForGMap();			$area_form = $areaObject->renderEditForm("New","gareaedit",XOOPS_URL."/modules/mygmap/area.php",1);
			showAreaForm(
				$area_form,
				floatval($_POST['mygmap_area_lat']),
				floatval($_POST['mygmap_area_lng']),
				intval($_POST['mygmap_area_zoom']),
				$areaHandler->getErrors());
			include(XOOPS_ROOT_PATH.'/footer.php');		}
		redirect_header(XOOPS_URL."/modules/mygmap/",1,'');
		exit();
		break;
	  case 'save':
	    if(!XoopsMultiTokenHandler::quickValidate('gareaedit_save'))
			redirect_header(XOOPS_URL."/modules/mygmap/",1,'Token Error');
		if (isset($_POST['mygmap_area_id'])) {			$area_id = intval($_POST['mygmap_area_id']);			if ($areaObject =& $areaHandler->get($area_id)) {				$areaObject->setFormVars($_POST,'');
				if (!$areaHandler->insert($areaObject,false,true)) {
					include(XOOPS_ROOT_PATH.'/header.php');
					$areaObject->setFormVars($_POST,'');
					$areaObject->defineFormElementsForGMap();					$area_form = $areaObject->renderEditForm("Edit","gareaedit",XOOPS_URL."/modules/mygmap/area.php",1);
					showAreaForm(
						$area_form,
						floatval($_POST['mygmap_area_lat']),
						floatval($_POST['mygmap_area_lng']),
						intval($_POST['mygmap_area_zoom']),
						$areaHandler->getErrors());
					include(XOOPS_ROOT_PATH.'/footer.php');					exit();
				}
				redirect_header(XOOPS_URL."/modules/mygmap/",1,'');
				exit();
			}
		}
		break;
	  case 'new':
		include(XOOPS_ROOT_PATH.'/header.php');		$areaObject =& $areaHandler->create();
		$areaObject->setFormVars($_POST,'');
		$areaObject->defineFormElementsForGMap();		$area_form .= $areaObject->renderEditForm("New","gareaedit",XOOPS_URL."/modules/mygmap/area.php",1);
		showAreaForm(
			$area_form,
			floatval($_POST['mygmap_area_lat']),
			floatval($_POST['mygmap_area_lng']),
			intval($_POST['mygmap_area_zoom']),
			'');
		include(XOOPS_ROOT_PATH.'/footer.php');		break;
	  default:
		include(XOOPS_ROOT_PATH.'/header.php');		if (isset($_GET['area'])) {			$area_id = intval($_GET['area']);			if ($areaObject =& $areaHandler->get($area_id)) {
				$areaObject->defineFormElementsForGMap();				$area_form .= $areaObject->renderEditForm("Edit","gareaedit",XOOPS_URL."/modules/mygmap/area.php",1);
				showAreaForm(
					$area_form,
					$areaObject->getVar('mygmap_area_lat'),
					$areaObject->getVar('mygmap_area_lng'),
					$areaObject->getVar('mygmap_area_zoom'),
					'');
			}
		}		include(XOOPS_ROOT_PATH.'/footer.php');		break;
	}
}
function showAreaForm($form, $lat, $lng, $zoom, $errmsg) {
	$GLOBALS['xoopsTpl']->assign('mygmap_API', $GLOBALS['xoopsModuleConfig']['mygmap_api']);	$GLOBALS['xoopsTpl']->assign('mygmap_center_lat', $lat);	$GLOBALS['xoopsTpl']->assign('mygmap_center_lng', $lng);	$GLOBALS['xoopsTpl']->assign('mygmap_zoom', $zoom);	$GLOBALS['xoopsTpl']->assign('mygmap_width', $GLOBALS['xoopsModuleConfig']['mygmap_width']);	$GLOBALS['xoopsTpl']->assign('mygmap_height', $GLOBALS['xoopsModuleConfig']['mygmap_height']);	$GLOBALS['xoopsTpl']->assign('area_form', $form);
	$GLOBALS['xoopsTpl']->assign('errmsg', $errmsg);
	$GLOBALS['xoopsTpl']->assign('mygmap_credit', $GLOBALS['mygmap_credit']);}
?>