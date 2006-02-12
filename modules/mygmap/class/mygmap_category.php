<?php
if( ! class_exists( 'MyGmapCategory' ) ) {
class MyGmapCategory extends XoopsTableObject
{
	function MyGmapCategory() {
		$this->XoopsTableObject();

		$this->initVar('mygmap_category_id', XOBJ_DTYPE_INT, 0, true);
		$this->initVar('mygmap_category_name', XOBJ_DTYPE_TXTBOX, '', true, 255);
		$this->initVar('mygmap_category_desc', XOBJ_DTYPE_TXTAREA, null, false);
		$this->initVar('mygmap_category_lat', XOBJ_DTYPE_FLOAT, 0, true);
		$this->initVar('mygmap_category_lng', XOBJ_DTYPE_FLOAT, 0, true);
		$this->initVar('mygmap_category_zoom', XOBJ_DTYPE_INT, 0, true);

		$this->setAttribute('dohtml', 0);
		$this->setAttribute('doxcode', 1);
		$this->setAttribute('dosmiley', 1);
		$this->setAttribute('doimage', 1);
		$this->setAttribute('dobr', 1);

		$this->setKeyFields(array('mygmap_category_id'));

		$this->setAutoIncrementField('mygmap_category_id');
	}

	function checkVar_mygmap_category_lat($value) {
		if (($value <= 180) && ($value >= -180)) {
			return true;
		}
		$this->setErrors('Range Error at Lat (-180 <= Lat <= 180)');
		return false;
	}
	
	function checkVar_mygmap_category_lng($value) {
		if (($value <= 90) && ($value >= -90)) {
			return true;
		}
		$this->setErrors('Range Error at Lng (-90 <= Lng <= 90)');
		return false;
	}

	function checkVar_mygmap_category_zoom($value) {
		if (($value >= 0) && ($value <= 17)) {
			return true;
		}
		$this->setErrors('Range Error at Zoom (0 <= Zoom <= 17)');
		return false;
	}
}

class MyGmapCategoryHandler  extends XoopsTableObjectHandler
{
	function MyGmapCategoryHandler($db)
	{
		$this->XoopsTableObjectHandler($db);
		$this->tableName = $this->db->prefix('mygmap_category');
	}

	function &getSelectOptionArray() {
		$objects =& $this->getObjects();
		$optionArray = array();
		foreach($objects as $object) {
			$optionArray[$object->getVar('mygmap_category_id')] = $object->getVar('mygmap_category_name');
		}
		return $optionArray;
	}
}

class MyGmapCategoryAdminList extends XoopsTableObjectList
{
	function MyGmapCategoryAdminList() {
		$this->addElement('mygmap_category_id',   'right', '', 20);
		$this->addElement('mygmap_category_name','left',_MYGMAP_LANG_TITLE, 300);
	}
}

class MyGmapCategoryAdminForm extends XoopsTableObjectForm 
{
	function MyGmapCategoryAdminForm($caption='', $name='', $action='', $token=0) {
		parent::XoopsTableObjectForm($caption, $name, $action, $token);
		$this->addElement('mygmap_category_id',new XoopsFormHidden('mygmap_category_id',0));
		$this->addElement('mygmap_category_name',new XoopsFormText(_MYGMAP_LANG_TITLE,'mygmap_category_name',50,255));
	    $this->addElement('mygmap_category_desc',new XoopsFormDhtmlTextArea(_MYGMAP_LANG_DESCRIPTION,'mygmap_category_desc','',5,25));
		$this->addElement('mygmap_category_lat',new XoopsFormText(_MYGMAP_LANG_LAT,'mygmap_category_lat',25,22));
		$this->addElement('mygmap_category_lng',new XoopsFormText(_MYGMAP_LANG_LNG,'mygmap_category_lng',25,22));
		$this->addElement('mygmap_category_zoom',new XoopsFormSelect(_MYGMAP_LANG_ZOOM,'mygmap_category_zoom'));
		
		$this->addOptionArray('mygmap_category_zoom',array(
			'0' =>'0' , '1' =>'1' , '2' =>'2' , '3' =>'3' , '4' =>'4' , '5' =>'5' ,
			'6' =>'6' , '7' =>'7' , '8' =>'8' , '9' =>'9' , '10' =>'10' , '11' =>'11' ,
			'12' =>'12' , '13' =>'13' , '14' =>'14' , '15' =>'15' , '16' =>'16' , '17' =>'17' ,
		));
	}
}

class MyGmapCategoryFormForGmap extends XoopsTableObjectForm
{
	function MyGmapCategoryFormForGmap($caption='', $name='', $action='', $token=0) {
		parent::XoopsTableObjectForm($caption, $name, $action, $token);
		$this->addElement('mygmap_category_id',new XoopsFormHidden('mygmap_category_id',0));
		$this->addElement('mygmap_category_name',new XoopsFormText(_MYGMAP_LANG_TITLE,'mygmap_category_name',35,255));
	    $this->addElement('mygmap_category_desc',new XoopsFormDhtmlTextArea(_MYGMAP_LANG_DESCRIPTION,'mygmap_category_desc','',8,25));
		$this->addElement('mygmap_category_lat',new XoopsFormHidden('mygmap_category_lat',0));
		$this->addElement('mygmap_category_lng',new XoopsFormHidden('mygmap_category_lng',0));
		$this->addElement('mygmap_category_zoom',new XoopsFormHidden('mygmap_category_zoom',0));
	}
}
}
?>