<?php
include('../../mainfile.php');include('class/mygmap_classes.php');
class MyGmapCategoryForm extends XoopsTableObjectForm {
	function MyGmapCategoryForm($caption='', $name='', $action='', $token=0) {
		parent::XoopsTableObjectForm($caption, $name, $action, $token);
		$this->addElement('mygmap_category_id',new XoopsFormHidden('mygmap_category_id',0));
		$this->addElement('mygmap_category_name',new XoopsFormText(_MYGMAP_LANG_TITLE,'mygmap_category_name',35,255));
	    $this->addElement('mygmap_category_desc',new XoopsFormDhtmlTextArea(_MYGMAP_LANG_DESCRIPTION,'mygmap_category_desc','',8,25));
		$this->addElement('mygmap_category_lat',new XoopsFormHidden('mygmap_category_lat',0));
		$this->addElement('mygmap_category_lng',new XoopsFormHidden('mygmap_category_lng',0));
		$this->addElement('mygmap_category_zoom',new XoopsFormHidden('mygmap_category_zoom',0));
	}
}

if ($GLOBALS['xoopsUserIsAdmin']) {
	$xoopsOption['template_main'] = 'mygmap_category.html';
	include(XOOPS_ROOT_PATH.'/header.php');	$controller = new MyGmapSimpleController('MyGmapCategory', 'mygmap_catedit',_MYGMAP_LANG_CATEGORY);
    $result = $controller->action();
	switch ($result) {
		case SIMPLE_CONTROLLER_VIEW_FORM:
			$GLOBALS['xoopsTpl']->assign('mygmap_API', $GLOBALS['xoopsModuleConfig']['mygmap_api']);			$GLOBALS['xoopsTpl']->assign('mygmap_center_lat', $controller->object->getVar('mygmap_category_lat'));			$GLOBALS['xoopsTpl']->assign('mygmap_center_lng', $controller->object->getVar('mygmap_category_lng'));			$GLOBALS['xoopsTpl']->assign('mygmap_zoom', $controller->object->getVar('mygmap_category_zoom'));			$GLOBALS['xoopsTpl']->assign('mygmap_width', $GLOBALS['xoopsModuleConfig']['mygmap_width']);
			$GLOBALS['xoopsTpl']->assign('mygmap_height', $GLOBALS['xoopsModuleConfig']['mygmap_height']);
			$GLOBALS['xoopsTpl']->assign('mygmap_credit', $GLOBALS['mygmap_credit']);			include(XOOPS_ROOT_PATH.'/footer.php');
			break;
		case SIMPLE_CONTROLLER_ACTION_ERROR:
			redirect_header(XOOPS_URL.'/modules/mygmap/', 2, $controller->errorMsg);
			break;
		case SIMPLE_CONTROLLER_ACTION_SUCCESS:
			redirect_header(XOOPS_URL.'/modules/mygmap/?cat='.$controller->object->getVar('mygmap_category_id'),2,$controller->__e('Action Success'));
			break;
		default:
			break;
	}
}
?>