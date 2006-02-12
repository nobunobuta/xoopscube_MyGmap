<?php
if( ! class_exists( 'MyGmapArea' ) ) {
class MyGmapArea extends XoopsTableObject
{
	function MyGmapArea() {
		$this->XoopsTableObject();

		$this->initVar('mygmap_area_id', XOBJ_DTYPE_INT, 0, true);
		$this->initVar('mygmap_area_name', XOBJ_DTYPE_TXTBOX, '', true, 255);
		$this->initVar('mygmap_area_desc', XOBJ_DTYPE_TXTAREA, null, false);
		$this->initVar('mygmap_area_lat', XOBJ_DTYPE_FLOAT, 0, true);
		$this->initVar('mygmap_area_lng', XOBJ_DTYPE_FLOAT, 0, true);
		$this->initVar('mygmap_area_zoom', XOBJ_DTYPE_INT, 0, true);
		$this->initVar('mygmap_area_order', XOBJ_DTYPE_INT, 0, false);

		$this->setAttribute('dohtml', 0);
		$this->setAttribute('doxcode', 1);
		$this->setAttribute('dosmiley', 1);
		$this->setAttribute('doimage', 1);
		$this->setAttribute('dobr', 1);

		$this->setKeyFields(array('mygmap_area_id'));

		$this->setAutoIncrementField('mygmap_area_id');
	}

	function checkVar_mygmap_area_lat($value) {
		if (($value <= 180) && ($value >= -180)) {
			return true;
		}
		$this->setErrors('Range Error at Lat (-180 <= Lat <= 180)');
		return false;
	}
	
	function checkVar_mygmap_area_lng($value) {
		if (($value <= 90) && ($value >= -90)) {
			return true;
		}
		$this->setErrors('Range Error at Lng (-90 <= Lng <= 90)');
		return false;
	}

	function checkVar_mygmap_area_zoom($value) {
		if (($value >= 0) && ($value <= 17)) {
			return true;
		}
		$this->setErrors('Range Error at Zoom (0 <= Zoom <= 17)');
		return false;
	}
}

class MyGmapAreaHandler  extends XoopsTableObjectHandler
{
	function MyGmapAreaHandler($db)
	{
		$this->XoopsTableObjectHandler($db);
		$this->tableName = $this->db->prefix('mygmap_area');
	}

	function &getSelectOptionArray() {
		$objects =& $this->getObjects();
		$optionArray = array();
		foreach($objects as $object) {
			$optionArray[$object->getVar('mygmap_area_id')] = $object->getVar('mygmap_area_name');
		}
		return $optionArray;
	}
}

class MyGmapAreaAdminList extends XoopsTableObjectList
{
	function MyGmapAreaAdminList() {
		$this->addElement('mygmap_area_id',   'right', '', 20);
		$this->addElement('mygmap_area_name', 'left', _MYGMAP_LANG_TITLE, 300);
		$this->addElement('mygmap_area_order','right',_MYGMAP_LANG_ORDER, 50);
	}
}

class MyGmapAreaAdminForm extends XoopsTableObjectForm
{
	function MyGmapAreaAdminForm($caption='', $name='', $action='', $token=0) {
		parent::XoopsTableObjectForm($caption, $name, $action, $token);
		$this->addElement('mygmap_area_id', new XoopsFormHidden('mygmap_area_id',0));
		$this->addElement('mygmap_area_name',new XoopsFormText(_MYGMAP_LANG_TITLE,'mygmap_area_name',50,255));
	    $this->addElement('mygmap_area_desc', new XoopsFormDhtmlTextArea(_MYGMAP_LANG_DESCRIPTION,'mygmap_area_desc','',5,25));
		$this->addElement('mygmap_area_lat',new XoopsFormText(_MYGMAP_LANG_LAT,'mygmap_area_lat',25,22));
		$this->addElement('mygmap_area_lng',new XoopsFormText(_MYGMAP_LANG_LNG,'mygmap_area_lng',25,22));
		$this->addElement('mygmap_area_zoom',new XoopsFormSelect(_MYGMAP_LANG_ZOOM,'mygmap_area_zoom'));
		$this->addElement('mygmap_area_order',new XoopsFormText(_MYGMAP_LANG_ORDER, 'mygmap_area_order',0,5));
		
		$this->addOptionArray('mygmap_area_zoom',array(
			'0' =>'0' , '1' =>'1' , '2' =>'2' , '3' =>'3' , '4' =>'4' , '5' =>'5' ,
			'6' =>'6' , '7' =>'7' , '8' =>'8' , '9' =>'9' , '10' =>'10' , '11' =>'11' ,
			'12' =>'12' , '13' =>'13' , '14' =>'14' , '15' =>'15' , '16' =>'16' , '17' =>'17' ,
		));
	}
}

class MyGmapAreaFormForGmap extends XoopsTableObjectForm
{
	function MyGmapAreaFormForGmap($caption='', $name='', $action='', $token=0) {
		parent::XoopsTableObjectForm($caption, $name, $action, $token);
		$this->addElement('mygmap_area_id',new XoopsFormHidden('mygmap_area_id',0));
		$this->addElement('mygmap_area_name',new XoopsFormText(_MYGMAP_LANG_TITLE,'mygmap_area_name',35,255));
	    $this->addElement('mygmap_area_desc',new XoopsFormDhtmlTextArea(_MYGMAP_LANG_DESCRIPTION,'mygmap_area_desc','',8,25));
		$this->addElement('mygmap_area_lat',new XoopsFormHidden('mygmap_area_lat',0));
		$this->addElement('mygmap_area_lng',new XoopsFormHidden('mygmap_area_lng',0));
		$this->addElement('mygmap_area_zoom',new XoopsFormHidden('mygmap_area_zoom',0));
		$this->addElement('mygmap_area_order',new XoopsFormText(_MYGMAP_LANG_ORDER, 'mygmap_area_order',0,5));
	}
}
}
?>