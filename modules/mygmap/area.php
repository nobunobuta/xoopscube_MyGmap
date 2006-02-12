<?php
include("../../mainfile.php");$xoopsOption['template_main'] = 'mygmap_area.html';
if ($GLOBALS['xoopsUserIsAdmin']) {
	include('class/mygmap_classes.php');    if (!isset($_REQUEST['op'])) $_REQUEST['op'] = '';
	$areaHandler =& new MyGmapAreaHandler($GLOBALS['xoopsDB']);	$areaForm =& new MyGmapAreaFormForGmap('', 'mygmap_areaedit', XOOPS_URL."/modules/mygmap/area.php", 1);

	switch ($_REQUEST['op']) {
	  case 'insert':
	    if (class_exists('XoopsMultiTokenHandler')) {
		    if (!XoopsMultiTokenHandler::quickValidate('mygmap_areaedit_insert')) {
				redirect_header(XOOPS_URL."/modules/mygmap/",1,'Token Error');
			}
		}
		$areaObject =& $areaHandler->create();
		$areaObject->setFormVars($_POST,'');
		if (!$areaHandler->insert($areaObject,false,true)) {
			include(XOOPS_ROOT_PATH.'/header.php');
			$areaObject->setFormVars($_POST,'');
			$areaForm->setCaption('New Area');
			showAreaForm($areaForm, $areaObject, $areaHandler->getErrors());
			include(XOOPS_ROOT_PATH.'/footer.php');		}
		redirect_header(XOOPS_URL."/modules/mygmap/",1,'');
		break;
	  case 'save':
	    if (class_exists('XoopsMultiTokenHandler')) {
		    if (!XoopsMultiTokenHandler::quickValidate('mygmap_areaedit_save')) {
				redirect_header(XOOPS_URL."/modules/mygmap/",1,'Token Error');
			}
		}
		if (isset($_POST['mygmap_area_id'])) {			$area_id = intval($_POST['mygmap_area_id']);			if ($areaObject =& $areaHandler->get($area_id)) {				$areaObject->setFormVars($_POST,'');
				if (!$areaHandler->insert($areaObject,false,true)) {
					include(XOOPS_ROOT_PATH.'/header.php');
					$areaObject->setFormVars($_POST,'');
					$areaForm->setCaption('Edit Area');
					showAreaForm($areaForm, $areaObject, $areaHandler->getErrors());
					include(XOOPS_ROOT_PATH.'/footer.php');					exit();
				}
				redirect_header(XOOPS_URL."/modules/mygmap/",1,'');
			}
		}
		break;
	  case 'new':
		include(XOOPS_ROOT_PATH.'/header.php');		$areaObject =& $areaHandler->create();
		$areaObject->setFormVars($_POST,'');
		$areaForm->setCaption('New Area');
		showAreaForm($areaForm, $areaObject);
		include(XOOPS_ROOT_PATH.'/footer.php');		break;
	  default:
		include(XOOPS_ROOT_PATH.'/header.php');		if (isset($_GET['area'])) {			$area_id = intval($_GET['area']);			if ($areaObject =& $areaHandler->get($area_id)) {
				$areaForm->setCaption('Edit Area');
				showAreaForm($areaForm, $areaObject);
			}
		}		include(XOOPS_ROOT_PATH.'/footer.php');		break;
	}
}

function showAreaForm(&$form, &$object, $errmsg='') {
    $form->assign($object, $GLOBALS['xoopsTpl']);
	$GLOBALS['xoopsTpl']->assign('mygmap_API', $GLOBALS['xoopsModuleConfig']['mygmap_api']);	$GLOBALS['xoopsTpl']->assign('mygmap_center_lat', $object->getVar('mygmap_area_lat'));	$GLOBALS['xoopsTpl']->assign('mygmap_center_lng', $object->getVar('mygmap_area_lng'));	$GLOBALS['xoopsTpl']->assign('mygmap_zoom', $object->getVar('mygmap_area_zoom'));	$GLOBALS['xoopsTpl']->assign('mygmap_width', $GLOBALS['xoopsModuleConfig']['mygmap_width']);
	$GLOBALS['xoopsTpl']->assign('mygmap_height', $GLOBALS['xoopsModuleConfig']['mygmap_height']);
	$GLOBALS['xoopsTpl']->assign('errmsg', $errmsg);
	$GLOBALS['xoopsTpl']->assign('mygmap_credit', $GLOBALS['mygmap_credit']);	$GLOBALS['xoopsTpl']->assign('mygmap_use_undocAPI', $GLOBALS['xoopsModuleConfig']['mygmap_use_undocAPI']);}
?>