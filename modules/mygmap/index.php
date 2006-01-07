<?phpinclude('../../mainfile.php');$xoopsOption['template_main'] = 'mygmap_index.html';
include('class/mygmap_classes.php');include(XOOPS_ROOT_PATH.'/header.php');//----------------------------------------------$myts =& MyTextSanitizer::getInstance();$mygmap_markers = array();$mygmap_category = array();$categoryHandler =& new MyGmapCategoryHandler($GLOBALS['xoopsDB']);$criteria = new Criteria(1,1);$categoryObjects =& $categoryHandler->getObjects($criteria);$mygmap_catlist = array();foreach($categoryObjects as $categoryObject) {	$mygmap_cat = array();	$mygmap_cat['id'] = $categoryObject->getVar('mygmap_category_id');	$mygmap_cat['name'] = $categoryObject->getVar('mygmap_category_name');	$mygmap_catlist[] = $mygmap_cat;}if (isset($_GET['lat'])&&isset($_GET['lng'])) {	$mygmap_marker = array();	$mygmap_marker['id'] = 0;	$mygmap_center_lat = $mygmap_marker['lat'] = floatval($_GET['lat']);	$mygmap_center_lng = $mygmap_marker['lng'] = floatval($_GET['lng']);	$mygmap_zoom = $mygmap_marker['zoom'] = (isset($_GET['z'])) ? intval($_GET['z']) : $GLOBALS['xoopsModuleConfig']['mygmap_z'];	$mygmap_marker['mark'] = (isset($_GET['mark'])) ? htmlspecialchars(strtoupper($_GET['mark']),ENT_QUOTES) : $GLOBALS['xoopsModuleConfig']['mygmap_m'];	$mygmap_text =(!empty($_GET['text'])) ? mb_convert_encoding($_GET['text'],'EUC-JP','auto') : $GLOBALS['xoopsModuleConfig']['mygmap_text2'];	$mygmap_marker['text'] = str_replace("'","\'",$myts->makeTareaData4Show($mygmap_text));	$mygmap_markers[] = $mygmap_marker;} elseif (!empty($_GET['cat']) || !empty($GLOBALS['xoopsModuleConfig']['mygmap_cat'])) {	$category_id = (!empty($_GET['cat'])) ? intval($_GET['cat']) : $GLOBALS['xoopsModuleConfig']['mygmap_cat'];	$markerHandler =& new MyGmapMarkerHandler($GLOBALS['xoopsDB']);	$categoryObject =& $categoryHandler->get($category_id);	$mygmap_center_lat = $mygmap_category['lat'] = $categoryObject->getVar('mygmap_category_lat');	$mygmap_center_lng = $mygmap_category['lng'] = $categoryObject->getVar('mygmap_category_lng');	$mygmap_zoom = $mygmap_category['zoom'] = $categoryObject->getVar('mygmap_category_zoom');	$mygmap_category['id'] = $categoryObject->getVar('mygmap_category_id');	$mygmap_category['name'] = $categoryObject->getVar('mygmap_category_name');		if (!empty($_GET['id'])) {		$map_id = intval($_GET['id']);		$markerHandler =& new MyGmapMarkerHandler($GLOBALS['xoopsDB']);		if ($markerObject =& $markerHandler->get($map_id)) {			$mygmap_center_lat = $markerObject->getVar('mygmap_marker_lat');			$mygmap_center_lng = $markerObject->getVar('mygmap_marker_lng');			$mygmap_zoom = $markerObject->getVar('mygmap_marker_zoom');		}	}	$criteria =& new Criteria('mygmap_marker_category_id', $category_id);	$criteria->setSort('mygmap_marker_icontext');	$markerObjects =& $markerHandler->getObjects($criteria);	foreach($markerObjects as $markerObject) {		$mygmap_marker = array();		$mygmap_marker['id'] = $markerObject->getVar('mygmap_marker_id');		$mygmap_marker['lat'] = $markerObject->getVar('mygmap_marker_lat');		$mygmap_marker['lng'] = $markerObject->getVar('mygmap_marker_lng');		$mygmap_marker['zoom'] = $markerObject->getVar('mygmap_marker_zoom');		$mygmap_marker['mark'] = $markerObject->getVar('mygmap_marker_icontext');		$mygmap_title = htmlspecialchars($markerObject->getVar('mygmap_marker_title'),ENT_QUOTES);		$mygmap_desc = $markerObject->getVar('mygmap_marker_desc');		$mygmap_marker['title'] = $mygmap_title;		$mygmap_marker['text'] = '<b>'.$mygmap_title .'</b>' . '<hr />' . $mygmap_desc;		$mygmap_markers[] = $mygmap_marker;	}} else {	$mygmap_marker = array();	$mygmap_marker['id'] = 0;	$mygmap_center_lat = $mygmap_marker['lat'] = $GLOBALS['xoopsModuleConfig']['mygmap_lat'];	$mygmap_center_lng = $mygmap_marker['lng'] = $GLOBALS['xoopsModuleConfig']['mygmap_lng'];	$mygmap_zoom = $GLOBALS['xoopsModuleConfig']['mygmap_zoom'];	$mygmap_marker['mark'] = '';	$mygmap_text = $GLOBALS['xoopsModuleConfig']['mygmap_text1'];	$mygmap_marker['text'] = str_replace("'","\'",$myts->makeTareaData4Show($mygmap_text));	$mygmap_markers[] = $mygmap_marker;}$areaHandler =& new MyGmapAreaHandler($GLOBALS['xoopsDB']);$criteria = new Criteria(1,1);$criteria->setSort('mygmap_area_order');$areaObjects =& $areaHandler->getObjects($criteria);$mygmap_areas = array();foreach($areaObjects as $areaObject) {	$mygmap_area = array();	$mygmap_area['id'] = $areaObject->getVar('mygmap_area_id');	$mygmap_area['name'] = $areaObject->getVar('mygmap_area_name');	$mygmap_area['lat'] = $areaObject->getVar('mygmap_area_lat');	$mygmap_area['lng'] = $areaObject->getVar('mygmap_area_lng');	$mygmap_area['zoom'] = $areaObject->getVar('mygmap_area_zoom');	$mygmap_areas[] = $mygmap_area;}//----------------------------------------------$xoopsTpl->assign('mygmap_API', $GLOBALS['xoopsModuleConfig']['mygmap_api']);$xoopsTpl->assign('mygmap_center_lat', $mygmap_center_lat);$xoopsTpl->assign('mygmap_center_lng', $mygmap_center_lng);$xoopsTpl->assign('mygmap_zoom', $mygmap_zoom);$xoopsTpl->assign('mygmap_category', $mygmap_category);$xoopsTpl->assign('mygmap_catlist', $mygmap_catlist);$xoopsTpl->assign('mygmap_markers', $mygmap_markers);$xoopsTpl->assign('mygmap_areas', $mygmap_areas);$xoopsTpl->assign('mygmap_fuki', $GLOBALS['xoopsModuleConfig']['mygmap_fuki']);$xoopsTpl->assign('mygmap_search', $GLOBALS['xoopsModuleConfig']['mygmap_search']);$xoopsTpl->assign('mygmap_invgeo', $GLOBALS['xoopsModuleConfig']['mygmap_invgeo']);$xoopsTpl->assign('mygmap_link', $GLOBALS['xoopsModuleConfig']['mygmap_link']);$xoopsTpl->assign('mygmap_wiki', $GLOBALS['xoopsModuleConfig']['mygmap_wiki']);$xoopsTpl->assign('mygmap_blog', $GLOBALS['xoopsModuleConfig']['mygmap_blog']);$xoopsTpl->assign('mygmap_width', $GLOBALS['xoopsModuleConfig']['mygmap_width']);$xoopsTpl->assign('mygmap_height', $GLOBALS['xoopsModuleConfig']['mygmap_height']);$xoopsTpl->assign('mygmap_setdef_show', $GLOBALS['xoopsModuleConfig']['mygmap_setdef_show']);$xoopsTpl->assign('mygmap_debug', $GLOBALS['xoopsModuleConfig']['mygmap_debug']);$credit = $GLOBALS['mygmap_credit'];if ($GLOBALS['xoopsModuleConfig']['mygmap_search']) {	$credit .= '<br />'.$GLOBALS['mygmap_csis_credit'];}if ($GLOBALS['xoopsModuleConfig']['mygmap_invgeo']) {	$credit .= '<br />'.$GLOBALS['mygmap_invgeo_credit'];}$xoopsTpl->assign('mygmap_credit', $credit);$xoopsTpl->assign('xoopsUserIsAdmin', $GLOBALS['xoopsUserIsAdmin']);include(XOOPS_ROOT_PATH."/footer.php");?>