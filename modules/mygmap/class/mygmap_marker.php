<?php
if( ! class_exists( 'MyGmapMarker' ) ) {
class MyGmapMarker extends XoopsTableObject
{
	var $prefix;
	/**
	 * ���󥹥ȥ饯��
	 */
	function MyGmapMarker() {
	////////////////////////////////////////
	// �ƥ��饹������ʬ(������)
	////////////////////////////////////////

		//�ƥ��饹�Υ��󥹥ȥ饯���ƽ�
		$this->XoopsTableObject();

	////////////////////////////////////////
	// �������饹��ͭ�������ʬ
	////////////////////////////////////////

		//�ƥ��֥����������Ǥ����
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
		//�ץ饤�ޥ꡼���������
		$this->setKeyFields(array('mygmap_marker_id'));

		//AUTO_INCREMENT°���Υե���������
		// - ��ĤΥơ��֥���ˤϡ�AUTO_INCREMENT°������ĥե�����ɤ�
		//   ��Ĥ����ʤ�����Ǥ���
		$this->setAutoIncrementField('mygmap_marker_id');
	}

	function defineFormElements() {
		$this->assignEditFormElement('mygmap_marker_id','Hidden', array('mygmap_marker_id',0));
		$this->assignEditFormElement('mygmap_marker_category_id','Select',array(_MYGMAP_LANG_CATEGORY,'mygmap_marker_category_id'));
		$this->assignEditFormElement('mygmap_marker_title','Text',array(_MYGMAP_LANG_TITLE,'mygmap_marker_title',50,255));
	    $this->assignEditFormElement('mygmap_marker_desc', 'DhtmlTextArea', array(_MYGMAP_LANG_DESCRIPTION,'mygmap_marker_desc',''));
		$this->assignEditFormElement('mygmap_marker_icontext','Select',array(_MYGMAP_LANG_ICON,'mygmap_marker_icontext'));
		$this->assignEditFormElement('mygmap_marker_lat','Text',array(_MYGMAP_LANG_LAT,'mygmap_marker_lat',25,22));
		$this->assignEditFormElement('mygmap_marker_lng','Text',array(_MYGMAP_LANG_LNG,'mygmap_marker_lng',25,22));
		$this->assignEditFormElement('mygmap_marker_zoom','Select',array(_MYGMAP_LANG_ZOOM,'mygmap_marker_zoom'));
		
		$categoryHandler =& new MyGmapCategoryHandler($GLOBALS['xoopsDB']);
		$this->assignEditFormOptionArray('mygmap_marker_category_id',$categoryHandler->getSelectOptionArray());
		$this->assignEditFormOptionArray('mygmap_marker_icontext', $this->getIconListArray());
		$this->assignEditFormOptionArray('mygmap_marker_zoom',array(
			'0' =>'0' , '1' =>'1' , '2' =>'2' , '3' =>'3' , '4' =>'4' , '5' =>'5' ,
			'6' =>'6' , '7' =>'7' , '8' =>'8' , '9' =>'9' , '10' =>'10' , '11' =>'11' ,
			'12' =>'12' , '13' =>'13' , '14' =>'14' , '15' =>'15' , '16' =>'16' , '17' =>'17' ,
		));
	}

	function defineFormElementsForGMap() {
		$this->assignEditFormElement('mygmap_marker_id','Hidden', array('mygmap_marker_id',0));
		$this->assignEditFormElement('mygmap_marker_category_id','Select',array(_MYGMAP_LANG_CATEGORY,'mygmap_marker_category_id'));
		$this->assignEditFormElement('mygmap_marker_title','Text',array(_MYGMAP_LANG_TITLE,'mygmap_marker_title',35,255));
	    $this->assignEditFormElement('mygmap_marker_desc', 'DhtmlTextArea', array(_MYGMAP_LANG_DESCRIPTION,'mygmap_marker_desc','',8,25));
		$this->assignEditFormElement('mygmap_marker_icontext','Select',array(_MYGMAP_LANG_ICON,'mygmap_marker_icontext'));
		$this->assignEditFormElement('mygmap_marker_lat','Hidden',array('mygmap_marker_lat',0));
		$this->assignEditFormElement('mygmap_marker_lng','Hidden',array('mygmap_marker_lng',0));
		$this->assignEditFormElement('mygmap_marker_zoom','Hidden',array('mygmap_marker_zoom',0));
		
		$categoryHandler =& new MyGmapCategoryHandler($GLOBALS['xoopsDB']);
		$this->assignEditFormOptionArray('mygmap_marker_category_id',$categoryHandler->getSelectOptionArray());
		$this->assignEditFormOptionArray('mygmap_marker_icontext', $this->getIconListArray());
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
		if (array_key_exists(substr($value.' ',0,1), $this->getIconListArray())){
			return true;
		}
		$this->setErrors('Range Error at ICON Text "'.$value.'" (Blank or A to J)');
		return false;
	}
}

class MyGmapMarkerHandler  extends XoopsTableObjectHandler
{
	/**
	 * ���󥹥ȥ饯��
	 */
	function MyGmapMarkerHandler($db)
	{
	////////////////////////////////////////
	// �ƥ��饹������ʬ(������)
	////////////////////////////////////////

		//�ƥ��饹�Υ��󥹥ȥ饯���ƽ�
		$this->XoopsTableObjectHandler($db);
		
	////////////////////////////////////////
	// �������饹��ͭ�������ʬ
	////////////////////////////////////////
		//�ϥ�ɥ���оݥơ��֥�̾���
		$this->tableName = $this->db->prefix('mygmap_marker');
	}
	
	/**
     * �쥳���ɤμ���(�ץ饤�ޥ꡼�����ˤ���ո�����
     * 
     * @param	string $key ��������
	 *
     * @return	object  {@link WordPressPost2Cat}, FALSE on fail
     */
/*�ơ��֥�˸�ͭ�Υǡ���������ɬ�פʻ��ʳ�������
	function &get($key)
	{
		return parent::get($key);
	}
*/

    /**
     * �쥳���ɤ���¸
     * 
     * @param	object	&$record	{@link WordPressPost2Cat} object
     * @param	bool	$force		POST�᥽�åɰʳ��Ƕ��������������ture
     * 
     * @return	bool    �����λ��� TRUE
     */
/*�ơ��֥�˸�ͭ�Υǡ���������ɬ�פʻ��ʳ�������
	function insert(&$record,$force=false,$updateOnlyChanged=false)
	{
		return parent::insert($record, $force, $updateOnlyChanged);
	}
*/
	/**
	 * �쥳���ɤκ��
	 * 
     * @param	object  &$record  {@link WordPressPost2Cat} object
     * @param	bool	$force		POST�᥽�åɰʳ��Ƕ��������������ture
     * 
     * @return	bool    �����λ��� TRUE
	 */
/*�ơ��֥�˸�ͭ�Υǡ���������ɬ�פʻ��ʳ�������
	function delete(&$record,$force=false)
	{
		return parent::delete($record,$force);
	}
*/
	/**
	 * �ơ��֥�ξ�︡���ˤ��ʣ���쥳���ɼ���
	 * 
	 * @param	object	$criteria 	{@link CriteriaElement} �������
	 * @param	bool $id_as_key		�ץ饤�ޥ꡼�������������Υ����ˤ������true
	 * @return	mixed Array			������̥쥳���ɤ�����
	 */
/*�ơ��֥�˸�ͭ�Υǡ���������ɬ�פʻ��ʳ�������
	function &getObjects($criteria = null, $id_as_key = false, $fieldlist="")
	{
		return parent::getObjects($criteria, $id_as_key, $fieldlist);
	}
*/
}
}
?>