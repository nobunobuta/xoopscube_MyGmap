<?php
include '../../../include/cp_header.php';
include('../class/mygmap_classes.php');

class MyGmapMarkerAdminList extends XoopsTableObjectList
{
	var $categoryHandler;

	function MyGmapMarkerAdminList() {
		$this->categoryHandler =& new MyGmapCategoryHandler($GLOBALS['xoopsDB']);

		$this->addElement('mygmap_marker_id', '#', 20, array('sort'=>true));
		$this->addElement('mygmap_marker_category_id', _AD_MYGMAP_LANG_CATEGORY, 150, array('sort'=>true));
		$this->addElement('mygmap_marker_title', _AD_MYGMAP_LANG_TITLE, 300);
		$this->addElement('mygmap_marker_icontext', _AD_MYGMAP_LANG_ICON, 50, array('sort'=>true));
		$this->addElement('__SimpleEditLink__','',50, array('caption'=>_AD_MYGMAP_LANG_EDIT));
		$this->addElement('__SimpleDeleteLink__','',50, array('caption'=>_AD_MYGMAP_LANG_DELETE));
	}
	
	function formatItem_mygmap_marker_category_id($value) {
		return $this->categoryHandler->getName($value);
	}
}

class MyGmapMarkerAdminForm extends XoopsTableObjectForm
{
	function MyGmapMarkerAdminForm($caption='', $name='', $action='', $token=0) {
		parent::XoopsTableObjectForm($caption, $name, $action, $token);

		$this->addElement('mygmap_marker_id',new XoopsFormHidden('mygmap_marker_id',0));
		$this->addElement('mygmap_marker_category_id',new XoopsFormSelect(_AD_MYGMAP_LANG_CATEGORY,'mygmap_marker_category_id'));
		$this->addElement('mygmap_marker_title',new XoopsFormText(_AD_MYGMAP_LANG_TITLE,'mygmap_marker_title',50,255));
	    $this->addElement('mygmap_marker_desc', new XoopsFormDhtmlTextArea(_AD_MYGMAP_LANG_DESCRIPTION,'mygmap_marker_desc',''));
		$this->addElement('mygmap_marker_icontext',new XoopsFormSelect(_AD_MYGMAP_LANG_ICON,'mygmap_marker_icontext'));
		$this->addElement('mygmap_marker_lat',new XoopsFormText(_AD_MYGMAP_LANG_LAT,'mygmap_marker_lat',25,22));
		$this->addElement('mygmap_marker_lng',new XoopsFormText(_AD_MYGMAP_LANG_LNG,'mygmap_marker_lng',25,22));
		$this->addElement('mygmap_marker_zoom',new XoopsFormSelect(_AD_MYGMAP_LANG_ZOOM,'mygmap_marker_zoom'));
		
		$categoryHandler =& new MyGmapCategoryHandler($GLOBALS['xoopsDB']);
		$this->addOptionArray('mygmap_marker_category_id',$categoryHandler->getSelectOptionArray());

		$markerHandler =& new MyGmapMarkerHandler($GLOBALS['xoopsDB']);
		$this->addOptionArray('mygmap_marker_icontext', $markerHandler->getIconListArray());

		$this->addOptionArray('mygmap_marker_zoom',array(
			'0' =>'0' , '1' =>'1' , '2' =>'2' , '3' =>'3' , '4' =>'4' , '5' =>'5' ,
			'6' =>'6' , '7' =>'7' , '8' =>'8' , '9' =>'9' , '10' =>'10' , '11' =>'11' ,
			'12' =>'12' , '13' =>'13' , '14' =>'14' , '15' =>'15' , '16' =>'16' , '17' =>'17' ,
		));
	}
}


$simpleAdmin =& new XoopsSimpleAdminController('MyGmapMarker', _AD_MYGMAP_LANG_MARKER_TITLE);
$simpleAdmin->execute();
?>
