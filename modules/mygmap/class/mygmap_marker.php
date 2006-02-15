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
		$this->setNameField('mygmap_marker_title');

		$this->setAutoIncrementField('mygmap_marker_id');
	}
	
	// Special Verifier
	
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
	var $tableName = 'mygmap_marker';

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
}
?>