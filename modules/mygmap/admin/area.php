<?php
include '../../../include/cp_header.php';
include('../class/mygmap_classes.php');

class MyGmapAreaAdminList extends XoopsTableObjectList
{
	function MyGmapAreaAdminList() {
		$this->addElement('mygmap_area_id', '#', 20, array('sort'=>true));
		$this->addElement('mygmap_area_name',  _AD_MYGMAP_LANG_TITLE, 300);
		$this->addElement('mygmap_area_order', _AD_MYGMAP_LANG_ORDER, 50, array('sort'=>true));
		$this->addElement('__SimpleEditLink__','',50, array('caption'=>_AD_MYGMAP_LANG_EDIT));
		$this->addElement('__SimpleDeleteLink__','',50, array('caption'=>_AD_MYGMAP_LANG_DELETE));
	}
}

class MyGmapAreaAdminForm extends XoopsTableObjectForm
{
	function MyGmapAreaAdminForm($caption='', $name='', $action='', $token=0) {
		parent::XoopsTableObjectForm($caption, $name, $action, $token);
		$this->addElement('mygmap_area_id', new XoopsFormHidden('mygmap_area_id',0));
		$this->addElement('mygmap_area_name',new XoopsFormText(_AD_MYGMAP_LANG_TITLE,'mygmap_area_name',50,255));
	    $this->addElement('mygmap_area_desc', new XoopsFormDhtmlTextArea(_AD_MYGMAP_LANG_DESCRIPTION,'mygmap_area_desc','',5,25));
		$this->addElement('mygmap_area_lat',new XoopsFormText(_AD_MYGMAP_LANG_LAT,'mygmap_area_lat',25,22));
		$this->addElement('mygmap_area_lng',new XoopsFormText(_AD_MYGMAP_LANG_LNG,'mygmap_area_lng',25,22));
		$this->addElement('mygmap_area_zoom',new XoopsFormSelect(_AD_MYGMAP_LANG_ZOOM,'mygmap_area_zoom'));
		$this->addElement('mygmap_area_order',new XoopsFormText(_AD_MYGMAP_LANG_ORDER, 'mygmap_area_order',0,5));
		
		$this->addOptionArray('mygmap_area_zoom',array(
			'0' =>'0' , '1' =>'1' , '2' =>'2' , '3' =>'3' , '4' =>'4' , '5' =>'5' ,
			'6' =>'6' , '7' =>'7' , '8' =>'8' , '9' =>'9' , '10' =>'10' , '11' =>'11' ,
			'12' =>'12' , '13' =>'13' , '14' =>'14' , '15' =>'15' , '16' =>'16' , '17' =>'17' ,
		));
	}
}

$simpleAdmin =& new XoopsSimpleAdminController('MyGmapArea', _AD_MYGMAP_LANG_AREA_TITLE);
$simpleAdmin->execute();

?>
