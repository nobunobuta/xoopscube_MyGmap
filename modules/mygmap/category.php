<?php
include("../../mainfile.php");$xoopsOption['template_main'] = 'mygmap_category.html';
if ($GLOBALS['xoopsUserIsAdmin']) {
	include('class/mygmap_classes.php');    if (!isset($_REQUEST['op'])) $_REQUEST['op'] = '';
	$categoryHandler =& new MyGmapCategoryHandler($GLOBALS['xoopsDB']);	$categoryForm =& new MyGmapCategoryFormForGmap('', 'mygmap_catedit', XOOPS_URL."/modules/mygmap/category.php", 1);

	switch ($_REQUEST['op']) {
	  case 'insert':
	    if (class_exists('XoopsMultiTokenHandler')) {
		    if (!XoopsMultiTokenHandler::quickValidate('mygmap_catedit_insert')) {
				redirect_header(XOOPS_URL."/modules/mygmap/",1,'Token Error');
			}
		}
		$categoryObject =& $categoryHandler->create();
		$categoryObject->setFormVars($_POST,'');
		if (!$categoryHandler->insert($categoryObject,false,true)) {
			include(XOOPS_ROOT_PATH.'/header.php');
			$categoryObject->setFormVars($_POST,'');
			$categoryForm->setCaption('New Category');
			showCategoryForm($categoryForm, $categoryObject, $categoryHandler->getErrors());
			include(XOOPS_ROOT_PATH.'/footer.php');		}
		redirect_header(XOOPS_URL."/modules/mygmap/?cat=".$categoryObject->getVar('mygmap_category_id'),1,'');
		break;
	  case 'save':
	    if (class_exists('XoopsMultiTokenHandler')) {
		    if (!XoopsMultiTokenHandler::quickValidate('mygmap_catedit_save')) {
				redirect_header(XOOPS_URL."/modules/mygmap/",1,'Token Error');
			}
		}
		if (isset($_POST['mygmap_category_id'])) {			$category_id = intval($_POST['mygmap_category_id']);			if ($categoryObject =& $categoryHandler->get($category_id)) {				$categoryObject->setFormVars($_POST,'');
				if (!$categoryHandler->insert($categoryObject,false,true)) {
					include(XOOPS_ROOT_PATH.'/header.php');
					$categoryObject->setFormVars($_POST,'');
					$categoryForm->setCaption('Edit Category');
					showCategoryForm($categoryForm, $categoryObject, $categoryHandler->getErrors());
					include(XOOPS_ROOT_PATH.'/footer.php');					exit();
				}
				redirect_header(XOOPS_URL."/modules/mygmap/?cat=".$categoryObject->getVar('mygmap_category_id'),1,'');
			}
		}
		break;
	  case 'new':
		include(XOOPS_ROOT_PATH.'/header.php');		$categoryObject =& $categoryHandler->create();
		$categoryObject->setFormVars($_POST,'');
		$categoryForm->setCaption('New Category');
		showCategoryForm($categoryForm, $categoryObject);
		include(XOOPS_ROOT_PATH.'/footer.php');		break;
	  default:
		include(XOOPS_ROOT_PATH.'/header.php');		if (isset($_GET['cat'])) {			$cat_id = intval($_GET['cat']);			if ($categoryObject =& $categoryHandler->get($cat_id)) {
				$categoryForm->setCaption('Edit Category');
				showCategoryForm($categoryForm, $categoryObject);
			}
		}		include(XOOPS_ROOT_PATH.'/footer.php');		break;
	}
}
function showCategoryForm(&$form, &$object, $errmsg='') {
    $form->assign($object, $GLOBALS['xoopsTpl']);
	$GLOBALS['xoopsTpl']->assign('mygmap_API', $GLOBALS['xoopsModuleConfig']['mygmap_api']);	$GLOBALS['xoopsTpl']->assign('mygmap_center_lat', $object->getVar('mygmap_category_lat'));	$GLOBALS['xoopsTpl']->assign('mygmap_center_lng', $object->getVar('mygmap_category_lng'));	$GLOBALS['xoopsTpl']->assign('mygmap_zoom', $object->getVar('mygmap_category_zoom'));	$GLOBALS['xoopsTpl']->assign('mygmap_width', $GLOBALS['xoopsModuleConfig']['mygmap_width']);
	$GLOBALS['xoopsTpl']->assign('mygmap_height', $GLOBALS['xoopsModuleConfig']['mygmap_height']);
	$GLOBALS['xoopsTpl']->assign('errmsg', $errmsg);
	$GLOBALS['xoopsTpl']->assign('mygmap_credit', $GLOBALS['mygmap_credit']);	$GLOBALS['xoopsTpl']->assign('mygmap_use_undocAPI', $GLOBALS['xoopsModuleConfig']['mygmap_use_undocAPI']);}
?>