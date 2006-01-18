<?php
if( ! defined( 'MYGMAP_MINIMAP_INCLUDED' ) ) {
	define( 'MYGMAP_MINIMAP_INCLUDED' , 1 ) ;

	require_once (XOOPS_ROOT_PATH.'/modules/mygmap/class/mygmap_classes.php');
	function b_mygmap_minimap_edit($options)
	{
		$markerHandler =& new MyGmapMarkerHandler($GLOBALS['xoopsDB']);		$form = '<table width="100%">';
		$form .= '<tr><td>Marker ID:</td>';
		$form .= '<td><select name="options[0]">';
		$markerObjects =& $markerHandler->getObjects();
		foreach($markerObjects as $markerObject) {
			$id = $markerObject->getVar('mygmap_marker_id');
			$name = $markerObject->getVar('mygmap_marker_title');
			$form .= '<option value="'.$id.'" >'.$id.' : '.$name.'</option>';
		}
		$form .= "</table>";
		return $form;
	}
	
	function b_mygmap_minimap_show($option)
	{
	    static $id = 0;
	    
		if (defined('MYGMAP_GMAPI_INCLUDED')) {
			$block['gmapi_include'] = 0;
		} else {
			$block['gmapi_include'] = 1;
			define('MYGMAP_GMAPI_INCLUDED', 1);
		}
		$markerHandler =& new MyGmapMarkerHandler($GLOBALS['xoopsDB']);		$markerObject =& $markerHandler->get($option[0]);
		$block['mygmap_API'] = mygmap_option('mygmap_api');;
		$block['mygmap_use_undocAPI'] = mygmap_option('mygmap_use_undocAPI');
		$block['divid'] = 'mygmap_mini_'.$id; $id++;
		$block['id'] = $markerObject->getVar('mygmap_marker_id');
		$block['category_id'] = $markerObject->getVar('mygmap_marker_category_id');
		$block['title'] = $markerObject->getVar('mygmap_marker_title');
		$block['lat'] = $markerObject->getVar('mygmap_marker_lat');
		$block['lng'] = $markerObject->getVar('mygmap_marker_lng');
		$block['zoom'] = $markerObject->getVar('mygmap_marker_zoom');
		return $block;
	}
}
?>
