<?php
include '../../../include/cp_header.php';
include('../class/mygmap_classes.php');
class MyGmapCategoryAdminList extends XoopsTableObjectList
{
	function MyGmapCategoryAdminList() {
		$this->addElement('mygmap_category_id', '#', 20, array('sort'=>true));
		$this->addElement('mygmap_category_name', _AD_MYGMAP_LANG_TITLE, 300);
		$this->addElement('__SimpleEditLink__','',50, array('caption'=>_AD_MYGMAP_LANG_EDIT));
		$this->addElement('__SimpleDeleteLink__','',50, array('caption'=>_AD_MYGMAP_LANG_DELETE));
	}
}

class MyGmapCategoryAdminForm extends XoopsTableObjectForm 
{
	function MyGmapCategoryAdminForm($caption='', $name='', $action='', $token=0) {
		parent::XoopsTableObjectForm($caption, $name, $action, $token);
		$this->addElement('mygmap_category_id',new XoopsFormHidden('mygmap_category_id',0));
		$this->addElement('mygmap_category_name',new XoopsFormText(_AD_MYGMAP_LANG_TITLE,'mygmap_category_name',50,255));
	    $this->addElement('mygmap_category_desc',new XoopsFormDhtmlTextArea(_AD_MYGMAP_LANG_DESCRIPTION,'mygmap_category_desc','',5,25));
		$this->addElement('mygmap_category_lat',new XoopsFormText(_AD_MYGMAP_LANG_LAT,'mygmap_category_lat',25,22));
		$this->addElement('mygmap_category_lng',new XoopsFormText(_AD_MYGMAP_LANG_LNG,'mygmap_category_lng',25,22));
		$this->addElement('mygmap_category_zoom',new XoopsFormSelect(_AD_MYGMAP_LANG_ZOOM,'mygmap_category_zoom'));
		
		$this->addOptionArray('mygmap_category_zoom',array(
			'0' =>'0' , '1' =>'1' , '2' =>'2' , '3' =>'3' , '4' =>'4' , '5' =>'5' ,
			'6' =>'6' , '7' =>'7' , '8' =>'8' , '9' =>'9' , '10' =>'10' , '11' =>'11' ,
			'12' =>'12' , '13' =>'13' , '14' =>'14' , '15' =>'15' , '16' =>'16' , '17' =>'17' ,
		));
	}
}

$simpleAdmin =& new XoopsSimpleAdminController('MyGmapCategory', _AD_MYGMAP_LANG_CATEGORY_TITLE);
$simpleAdmin->execute();
?>
