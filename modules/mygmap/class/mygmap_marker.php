<?php
if( ! class_exists( 'MyGmapMarker' ) ) {
class MyGmapMarker extends XoopsTableObject
{
	function MyGmapMarker() {

		$this->XoopsTableObject();

		$this->initVar('mygmap_marker_id', XOBJ_DTYPE_INT, 0, true);
		$this->initVar('mygmap_marker_category_id', XOBJ_DTYPE_INT, 0, true);
		$this->initVar('mygmap_marker_title', XOBJ_DTYPE_TXTBOX, '', true, 255);
		$this->initVar('mygmap_marker_desc', XOBJ_DTYPE_TXTAREA, null, false);
		$this->initVar('mygmap_marker_icontext', XOBJ_DTYPE_TXTBOX, '', false, 2);
		$this->initVar('mygmap_marker_lat', XOBJ_DTYPE_FLOAT, 0, true);
		$this->initVar('mygmap_marker_lng', XOBJ_DTYPE_FLOAT, 0, true);
		$this->initVar('mygmap_marker_zoom', XOBJ_DTYPE_INT, 0, true);
		$this->initVar('mygmap_marker_uid', XOBJ_DTYPE_INT, 0, true);

		$this->setAttribute('dohtml', 0);
		$this->setAttribute('doxcode', 1);
		$this->setAttribute('dosmiley', 1);
		$this->setAttribute('doimage', 1);
		$this->setAttribute('dobr', 1);

		$this->setKeyFields(array('mygmap_marker_id'));

		$this->setAutoIncrementField('mygmap_marker_id');
	}

	function checkVar_mygmap_marker_lat($value) {
		if (($value <= 180) && ($value >= -180)) {
			return true;
		}
		$this->setErrors('Range Error at Lat (-180 <= Lat <= 180)');
		return false;
	}
	
	function checkVar_mygmap_marker_lng($value) {
		if (($value <= 90) && ($value >= -90)) {
			return true;
		}
		$this->setErrors('Range Error at Lng (-90 <= Lng <= 90)');
		return false;
	}

	function checkVar_mygmap_marker_zoom($value) {
		if (($value >= 0) && ($value <= 17)) {
			return true;
		}
		$this->setErrors('Range Error at Zoom (0 <= Zoom <= 17)');
		return false;
	}

	function checkVar_mygmap_marker_icontext($value) {
		if (array_key_exists(substr($value.' ',0,1), $this->_handler->getIconListArray())){
			return true;
		}
		$this->setErrors('Range Error at ICON Text "'.$value.'" (Blank or A to J)');
		return false;
	}
}

class MyGmapMarkerHandler  extends XoopsTableObjectHandler
{
	function MyGmapMarkerHandler($db)
	{
		$this->XoopsTableObjectHandler($db);

		$this->tableName = $this->db->prefix('mygmap_marker');
	}

    function getIconListArray() {
    	static $result = Array();
    	if ($result) return $result;
    	$alphalist = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$result[" "] = 'Blank';
    	for($i=1; $i<=20; $i++) {
    		$ch = sprintf("%02d",$i);
    		$result["$i"] = "$i";
    	}
    	for($i=0; $i<26; $i++) {
    		$ch = substr($alphalist, $i, 1);
    		$result["$ch"] = "$ch";
    	}
    	return $result;
    }
}

class MyGmapMarkerAdminList extends XoopsTableObjectList
{
	function MyGmapMarkerAdminList() {
		$this->addElement('mygmap_marker_id',   'right', '', 20);
		$this->addElement('mygmap_marker_category_id', 'right', _MYGMAP_LANG_CATEGORY, 80);
		$this->addElement('mygmap_marker_title','left',_MYGMAP_LANG_TITLE, 300);
		$this->addElement('mygmap_marker_icontext','right',_MYGMAP_LANG_ICON, 50);
	}
}

class MyGmapMarkerAdminForm extends XoopsTableObjectForm
{
	function MyGmapMarkerAdminForm($caption='', $name='', $action='', $token=0) {
		parent::XoopsTableObjectForm($caption, $name, $action, $token);
		$this->addElement('mygmap_marker_id',new XoopsFormHidden('mygmap_marker_id',0));
		$this->addElement('mygmap_marker_category_id',new XoopsFormSelect(_MYGMAP_LANG_CATEGORY,'mygmap_marker_category_id'));
		$this->addElement('mygmap_marker_title',new XoopsFormText(_MYGMAP_LANG_TITLE,'mygmap_marker_title',50,255));
	    $this->addElement('mygmap_marker_desc', new XoopsFormDhtmlTextArea(_MYGMAP_LANG_DESCRIPTION,'mygmap_marker_desc',''));
		$this->addElement('mygmap_marker_icontext',new XoopsFormSelect(_MYGMAP_LANG_ICON,'mygmap_marker_icontext'));
		$this->addElement('mygmap_marker_lat',new XoopsFormText(_MYGMAP_LANG_LAT,'mygmap_marker_lat',25,22));
		$this->addElement('mygmap_marker_lng',new XoopsFormText(_MYGMAP_LANG_LNG,'mygmap_marker_lng',25,22));
		$this->addElement('mygmap_marker_zoom',new XoopsFormSelect(_MYGMAP_LANG_ZOOM,'mygmap_marker_zoom'));
		
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

class MyGmapMarkerFormForGmap extends XoopsTableObjectForm
{
	function MyGmapMarkerFormForGmap($caption='', $name='', $action='', $token=0) {
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
}
?>