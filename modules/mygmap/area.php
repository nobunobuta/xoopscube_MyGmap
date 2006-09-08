<?php
include('../../mainfile.php');
include('class/mygmap_classes.php');
class MyGmapAreaForm extends XoopsTableObjectForm {
	function MyGmapAreaForm($caption='', $name='', $action='', $token=0) {
		parent::XoopsTableObjectForm($caption, $name, $action, $token);
		$this->addElement('mygmap_area_id',new XoopsFormHidden('mygmap_area_id', 0));
		$this->addElement('mygmap_area_name',new XoopsFormText(_MYGMAP_LANG_TITLE, 'mygmap_area_name', 35, 255));
	    $this->addElement('mygmap_area_desc',new XoopsFormDhtmlTextArea(_MYGMAP_LANG_DESCRIPTION, 'mygmap_area_desc', '', 8, 25));
		$this->addElement('mygmap_area_lat',new XoopsFormHidden('mygmap_area_lat', 0));
		$this->addElement('mygmap_area_lng',new XoopsFormHidden('mygmap_area_lng', 0));
		$this->addElement('mygmap_area_zoom',new XoopsFormHidden('mygmap_area_zoom', 0));
		$this->addElement('mygmap_area_order',new XoopsFormText(_MYGMAP_LANG_ORDER, 'mygmap_area_order', 0, 5));
	}
}

if ($GLOBALS['xoopsUserIsAdmin']) {
	$xoopsOption['template_main'] = 'mygmap_area.html';
	include(XOOPS_ROOT_PATH.'/header.php');
	$controller = new MyGmapSimpleController('MyGmapArea','mygmap_areaedit',_MYGMAP_LANG_AREA);
    $result = $controller->action();

	switch ($result) {
		case SIMPLE_CONTROLLER_VIEW_FORM:
			$GLOBALS['xoopsTpl']->assign('mygmap_API', $GLOBALS['xoopsModuleConfig']['mygmap_api']);
			$GLOBALS['xoopsTpl']->assign('mygmap_center_lat', $controller->object->getVar('mygmap_area_lat'));
			$GLOBALS['xoopsTpl']->assign('mygmap_center_lng', $controller->object->getVar('mygmap_area_lng'));
			$GLOBALS['xoopsTpl']->assign('mygmap_zoom', $controller->object->getVar('mygmap_area_zoom'));
			$GLOBALS['xoopsTpl']->assign('mygmap_width', $GLOBALS['xoopsModuleConfig']['mygmap_width']);
			$GLOBALS['xoopsTpl']->assign('mygmap_height', $GLOBALS['xoopsModuleConfig']['mygmap_height']);
			$GLOBALS['xoopsTpl']->assign('mygmap_credit', $GLOBALS['mygmap_credit']);
			include(XOOPS_ROOT_PATH.'/footer.php');
			break;
		case SIMPLE_CONTROLLER_ACTION_ERROR:
			redirect_header(XOOPS_URL.'/modules/mygmap/', 2, $controller->errorMsg);
			break;
		case SIMPLE_CONTROLLER_ACTION_SUCCESS:
			redirect_header(XOOPS_URL.'/modules/mygmap/', 2, $controller->__e('Action Success'));
			break;
		default:
			break;
	}
}
?>