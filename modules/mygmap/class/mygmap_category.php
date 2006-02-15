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
		$this->setNameField('mygmap_category_name');

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
	var $tableName = 'mygmap_category';
}
}
?>