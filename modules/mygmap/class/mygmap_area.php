<?php
if( ! class_exists( 'MyGmapArea' ) ) {
class MyGmapArea extends XoopsTableObject
{
	var $prefix;
	/**
	 * コンストラクタ
	 */
	function MyGmapArea() {
	////////////////////////////////////////
	// 各クラス共通部分(書換不要)
	////////////////////////////////////////

		//親クラスのコンストラクタ呼出
		$this->XoopsTableObject();

	////////////////////////////////////////
	// 派生クラス固有の定義部分
	////////////////////////////////////////

		//各オブジェクト要素の定義
		$this->initVar('mygmap_area_id', XOBJ_DTYPE_INT, 0, true);
		$this->initVar('mygmap_area_name', XOBJ_DTYPE_TXTBOX, '', false, 255);
		$this->initVar('mygmap_area_desc', XOBJ_DTYPE_TXTAREA, null, false);
		$this->initVar('mygmap_area_lat', XOBJ_DTYPE_FLOAT, 0, true);
		$this->initVar('mygmap_area_lng', XOBJ_DTYPE_FLOAT, 0, true);
		$this->initVar('mygmap_area_zoom', XOBJ_DTYPE_INT, 0, true);
		$this->initVar('mygmap_area_order', XOBJ_DTYPE_INT, 0, false);

		$this->setAttribute('dohtml', 0);
		$this->setAttribute('doxcode', 1);
		$this->setAttribute('dosmiley', 0);
		$this->setAttribute('doimage', 0);
		$this->setAttribute('dobr', 1);
		//プライマリーキーの定義
		$this->setKeyFields(array('mygmap_area_id'));

		//AUTO_INCREMENT属性のフィールド定義
		// - 一つのテーブル内には、AUTO_INCREMENT属性を持つフィールドは
		//   一つしかない前提です。
		$this->setAutoIncrementField('mygmap_area_id');
	}

	function defineFormElements() {
		$this->assignEditFormElement('mygmap_area_id','Hidden', array('mygmap_area_id',0));
		$this->assignEditFormElement('mygmap_area_name','Text',array(_MYGMAP_LANG_TITLE,'mygmap_area_name',50,255));
	    $this->assignEditFormElement('mygmap_area_desc', 'DhtmlTextArea', array(_MYGMAP_LANG_DESCRIPTION,'mygmap_area_desc','',5,25));
		$this->assignEditFormElement('mygmap_area_lat','Text',array(_MYGMAP_LANG_LAT,'mygmap_area_lat',25,22));
		$this->assignEditFormElement('mygmap_area_lng','Text',array(_MYGMAP_LANG_LNG,'mygmap_area_lng',25,22));
		$this->assignEditFormElement('mygmap_area_zoom','Select',array(_MYGMAP_LANG_ZOOM,'mygmap_area_zoom'));
		$this->assignEditFormElement('mygmap_area_order','Text',array(_MYGMAP_LANG_ORDER, 'mygmap_area_order',0,5));
		
		$this->assignEditFormOptionArray('mygmap_area_zoom',array(
			'0' =>'0' , '1' =>'1' , '2' =>'2' , '3' =>'3' , '4' =>'4' , '5' =>'5' ,
			'6' =>'6' , '7' =>'7' , '8' =>'8' , '9' =>'9' , '10' =>'10' , '11' =>'11' ,
			'12' =>'12' , '13' =>'13' , '14' =>'14' , '15' =>'15' , '16' =>'16' , '17' =>'17' ,
		));
	}

	function defineFormElementsForGMap() {
		$this->assignEditFormElement('mygmap_area_id','Hidden', array('mygmap_area_id',0));
		$this->assignEditFormElement('mygmap_area_name','Text',array(_MYGMAP_LANG_TITLE,'mygmap_area_name',35,255));
	    $this->assignEditFormElement('mygmap_area_desc', 'DhtmlTextArea', array(_MYGMAP_LANG_DESCRIPTION,'mygmap_area_desc','',8,25));
		$this->assignEditFormElement('mygmap_area_lat','Hidden',array('mygmap_area_lat',0));
		$this->assignEditFormElement('mygmap_area_lng','Hidden',array('mygmap_area_lng',0));
		$this->assignEditFormElement('mygmap_area_zoom','Hidden',array('mygmap_area_zoom',0));
		$this->assignEditFormElement('mygmap_area_order','Text',array(_MYGMAP_LANG_ORDER, 'mygmap_area_order',0,5));
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
	/**
	 * コンストラクタ
	 */
	function MyGmapAreaHandler($db)
	{
	////////////////////////////////////////
	// 各クラス共通部分(書換不要)
	////////////////////////////////////////

		//親クラスのコンストラクタ呼出
		$this->XoopsTableObjectHandler($db);
		
	////////////////////////////////////////
	// 派生クラス固有の定義部分
	////////////////////////////////////////
		//ハンドラの対象テーブル名定義
		$this->tableName = $this->db->prefix('mygmap_area');
	}
	
	/**
     * レコードの取得(プライマリーキーによる一意検索）
     * 
     * @param	string $key 検索キー
	 *
     * @return	object  {@link WordPressPost2Cat}, FALSE on fail
     */
/*テーブルに固有のデータ処理が必要な時以外は不要
	function &get($key)
	{
		return parent::get($key);
	}
*/

    /**
     * レコードの保存
     * 
     * @param	object	&$record	{@link WordPressPost2Cat} object
     * @param	bool	$force		POSTメソッド以外で強制更新する場合はture
     * 
     * @return	bool    成功の時は TRUE
     */
/*テーブルに固有のデータ処理が必要な時以外は不要
	function insert(&$record,$force=false,$updateOnlyChanged=false)
	{
		return parent::insert($record, $force, $updateOnlyChanged);
	}
*/
	/**
	 * レコードの削除
	 * 
     * @param	object  &$record  {@link WordPressPost2Cat} object
     * @param	bool	$force		POSTメソッド以外で強制更新する場合はture
     * 
     * @return	bool    成功の時は TRUE
	 */
/*テーブルに固有のデータ処理が必要な時以外は不要
	function delete(&$record,$force=false)
	{
		return parent::delete($record,$force);
	}
*/
	/**
	 * テーブルの条件検索による複数レコード取得
	 * 
	 * @param	object	$criteria 	{@link CriteriaElement} 検索条件
	 * @param	bool $id_as_key		プライマリーキーを、戻り配列のキーにする場合はtrue
	 * @return	mixed Array			検索結果レコードの配列
	 */
/*テーブルに固有のデータ処理が必要な時以外は不要
	function &getObjects($criteria = null, $id_as_key = false, $fieldlist="")
	{
		return parent::getObjects($criteria, $id_as_key, $fieldlist);
	}
*/

	function &getSelectOptionArray() {
		$objects =& $this->getObjects();
		$optionArray = array();
		foreach($objects as $object) {
			$optionArray[$object->getVar('mygmap_area_id')] = $object->getVar('mygmap_area_name');
		}
		return $optionArray;
	}
}
}
?>