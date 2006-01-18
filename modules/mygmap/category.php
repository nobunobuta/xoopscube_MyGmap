<?php
include("../../mainfile.php");$xoopsOption['template_main'] = 'mygmap_category.html';
$category_form = '';
if ($GLOBALS['xoopsUserIsAdmin']) {
	include('class/mygmap_classes.php');    if (!isset($_REQUEST['op'])) $_REQUEST['op'] = '';
	$categoryHandler =& new MyGmapCategoryHandler($GLOBALS['xoopsDB']);	switch ($_REQUEST['op']) {
	  case 'insert':
	    if (class_exists('XoopsMultiTokenHandler')) {
		    if(!XoopsMultiTokenHandler::quickValidate('gcatedit_insert')) {
				redirect_header(XOOPS_URL."/modules/mygmap/",1,'Token Error');
			}
		}
		$categoryObject =& $categoryHandler->create();
		$categoryObject->setFormVars($_POST,'');
		if (!$categoryHandler->insert($categoryObject,false,true)) {
			include(XOOPS_ROOT_PATH.'/header.php');
			$categoryObject->setFormVars($_POST,'');
			$categoryObject->defineFormElementsForGMap();			$category_form = $categoryObject->renderEditForm("New","gcatedit",XOOPS_URL."/modules/mygmap/category.php",1);
			showCategoryForm(
				$category_form,
				floatval($_POST['mygmap_category_lat']),
				floatval($_POST['mygmap_category_lng']),
				intval($_POST['mygmap_category_zoom']),
				$categoryHandler->getErrors());
			include(XOOPS_ROOT_PATH.'/footer.php');		}
		redirect_header(XOOPS_URL."/modules/mygmap/",1,'');
		exit();
		break;
	  case 'save':
	    if (class_exists('XoopsMultiTokenHandler')) {
		    if(!XoopsMultiTokenHandler::quickValidate('gcatedit_save')) {
				redirect_header(XOOPS_URL."/modules/mygmap/",1,'Token Error');
			}
		}
		if (isset($_POST['mygmap_category_id'])) {			$category_id = intval($_POST['mygmap_category_id']);			if ($categoryObject =& $categoryHandler->get($category_id)) {				$categoryObject->setFormVars($_POST,'');
				if (!$categoryHandler->insert($categoryObject,false,true)) {
					include(XOOPS_ROOT_PATH.'/header.php');
					$categoryObject->setFormVars($_POST,'');
					$categoryObject->defineFormElementsForGMap();					$category_form = $categoryObject->renderEditForm("Edit","gcatedit",XOOPS_URL."/modules/mygmap/category.php",1);
					showCategoryForm(
						$category_form,
						floatval($_POST['mygmap_category_lat']),
						floatval($_POST['mygmap_category_lng']),
						intval($_POST['mygmap_category_zoom']),
						$categoryHandler->getErrors());
					include(XOOPS_ROOT_PATH.'/footer.php');					exit();
				}
				redirect_header(XOOPS_URL."/modules/mygmap/",1,'');
				exit();
			}
		}
		break;
	  case 'new':
		include(XOOPS_ROOT_PATH.'/header.php');		$categoryObject =& $categoryHandler->create();
		$categoryObject->setFormVars($_POST,'');
		$categoryObject->defineFormElementsForGMap();		$category_form .= $categoryObject->renderEditForm("New","gcatedit",XOOPS_URL."/modules/mygmap/category.php",1);
		showCategoryForm(
			$category_form,
			floatval($_POST['mygmap_category_lat']),
			floatval($_POST['mygmap_category_lng']),
			intval($_POST['mygmap_category_zoom']),
			'');
		include(XOOPS_ROOT_PATH.'/footer.php');		break;
	  default:
		include(XOOPS_ROOT_PATH.'/header.php');		if (isset($_GET['cat'])) {			$cat_id = intval($_GET['cat']);			if ($categoryObject =& $categoryHandler->get($cat_id)) {
				$categoryObject->defineFormElementsForGMap();				$category_form .= $categoryObject->renderEditForm("Edit","gcatedit",XOOPS_URL."/modules/mygmap/category.php",1);
				showCategoryForm(
					$category_form,
					$categoryObject->getVar('mygmap_category_lat'),
					$categoryObject->getVar('mygmap_category_lng'),
					$categoryObject->getVar('mygmap_category_zoom'),
					'');
			}
		}		include(XOOPS_ROOT_PATH.'/footer.php');		break;
	}
}
function showCategoryForm($form, $lat, $lng, $zoom, $errmsg) {
	$GLOBALS['xoopsTpl']->assign('mygmap_API', $GLOBALS['xoopsModuleConfig']['mygmap_api']);	$GLOBALS['xoopsTpl']->assign('mygmap_center_lat', $lat);	$GLOBALS['xoopsTpl']->assign('mygmap_center_lng', $lng);	$GLOBALS['xoopsTpl']->assign('mygmap_zoom', $zoom);	$GLOBALS['xoopsTpl']->assign('mygmap_width', $GLOBALS['xoopsModuleConfig']['mygmap_width']);
	$GLOBALS['xoopsTpl']->assign('mygmap_height', $GLOBALS['xoopsModuleConfig']['mygmap_height']);
	$GLOBALS['xoopsTpl']->assign('category_form', $form);
	$GLOBALS['xoopsTpl']->assign('errmsg', $errmsg);
	$GLOBALS['xoopsTpl']->assign('mygmap_credit', $GLOBALS['mygmap_credit']);	$GLOBALS['xoopsTpl']->assign('mygmap_use_undocAPI', $GLOBALS['xoopsModuleConfig']['mygmap_use_undocAPI']);}
?>