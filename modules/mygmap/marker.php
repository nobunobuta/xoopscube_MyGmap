<?php
include('../../mainfile.php');include('class/mygmap_classes.php');
class MyGmapMarkerForm extends XoopsTableObjectForm {
	function MyGmapMarkerForm($caption='', $name='', $action='', $token=0) {
		parent::XoopsTableObjectForm($caption, $name, $action, $token);
		$this->addElement('mygmap_marker_id',new XoopsFormHidden('mygmap_marker_id',0));
		$this->addElement('mygmap_marker_category_id',new XoopsFormSelect(_MYGMAP_LANG_CATEGORY,'mygmap_marker_category_id'));
		$this->addElement('mygmap_marker_title',new XoopsFormText(_MYGMAP_LANG_TITLE,'mygmap_marker_title',35,255));
	    $this->addElement('mygmap_marker_desc', new XoopsFormDhtmlTextArea(_MYGMAP_LANG_DESCRIPTION,'mygmap_marker_desc','',8,25));
		$this->addElement('mygmap_marker_icontext',new XoopsFormSelect(_MYGMAP_LANG_ICON,'mygmap_marker_icontext'));
		$this->addElement('mygmap_marker_lat',new XoopsFormHidden('mygmap_marker_lat',0));
		$this->addElement('mygmap_marker_lng',new XoopsFormHidden('mygmap_marker_lng',0));
		$this->addElement('mygmap_marker_zoom',new XoopsFormHidden('mygmap_marker_zoom',0));
		
		$categoryHandler =& new MyGmapCategoryHandler($GLOBALS['xoopsDB']);
		$this->addOptionArray('mygmap_marker_category_id',$categoryHandler->getSelectOptionArray());
		$markerHandler =& new MyGmapMarkerHandler($GLOBALS['xoopsDB']);
		$this->addOptionArray('mygmap_marker_icontext', $markerHandler->getIconListArray());
	}
}

if ($GLOBALS['xoopsUserIsAdmin']) {
	$xoopsOption['template_main'] = 'mygmap_marker.html';
	include(XOOPS_ROOT_PATH.'/header.php');	$controller = new MyGmapSimpleController('MyGmapMarker', 'mygmap_markedit',_MYGMAP_LANG_MARKER);
    $result = $controller->action();
	switch ($result) {
		case SIMPLE_CONTROLLER_VIEW_FORM:
			$GLOBALS['xoopsTpl']->assign('mygmap_API', $GLOBALS['xoopsModuleConfig']['mygmap_api']);			$GLOBALS['xoopsTpl']->assign('mygmap_center_lat', $controller->object->getVar('mygmap_marker_lat'));			$GLOBALS['xoopsTpl']->assign('mygmap_center_lng', $controller->object->getVar('mygmap_marker_lng'));			$GLOBALS['xoopsTpl']->assign('mygmap_zoom', $controller->object->getVar('mygmap_marker_zoom'));			$GLOBALS['xoopsTpl']->assign('mygmap_width', $GLOBALS['xoopsModuleConfig']['mygmap_width']);
			$GLOBALS['xoopsTpl']->assign('mygmap_height', $GLOBALS['xoopsModuleConfig']['mygmap_height']);
			$GLOBALS['xoopsTpl']->assign('mygmap_credit', $GLOBALS['mygmap_credit']);			$GLOBALS['xoopsTpl']->assign('mygmap_use_undocAPI', $GLOBALS['xoopsModuleConfig']['mygmap_use_undocAPI']);			include(XOOPS_ROOT_PATH.'/footer.php');
			break;
		case SIMPLE_CONTROLLER_ACTION_ERROR:
			redirect_header(XOOPS_URL.'/modules/mygmap/', 2, $controller->errorMsg);
			break;
		case SIMPLE_CONTROLLER_ACTION_SUCCESS:
			redirect_header(XOOPS_URL.'/modules/mygmap/?cat='.$controller->object->getVar('mygmap_marker_category_id'),2,$controller->__e('Action Success'));
			break;
		default:
			break;
	}
}
?>