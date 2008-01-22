<?php
/**
 *
 * @package MyGmap
 * @version $Id$
 * @copyright Copyright 2006-2008 NobuNobuXOOPS Project <http://sourceforge.net/projects/nobunobuxoops/>
 * @author NobuNobu <nobunobu@nobunobu.com>
 * @license http://www.gnu.org/licenses/gpl.txt GNU GENERAL PUBLIC LICENSE Version 2
 *
 */
if (!class_exists('MyGmapMainAction')) {
    NBFrame::using('Action');
    class MyGmapMainAction extends NBFrameAction
    {
        var $elements;

        function prepare() {
            parent::prepare();
            $this->setDefaultTemplate($this->prefix('main.html'));
        }

        function executeDefaultOp() {
            $myts =& MyTextSanitizer::getInstance();
            $this->elements['markers'] = array();
            $this->elements['category'] = array();
            $this->elements['overlay'] = array();
            
            $categoryHandler =& NBFrame::getHandler('MyGmapCategory', $this->mEnvironment);
            $criteria = new Criteria(1, intNBCriteriaVal(1));
            $categoryObjects =& $categoryHandler->getObjects($criteria);
            $this->elements['catlist'] = array();
            $this->elements['catlist'][] = array('id'=>-1, 'name'=>$this->__l('All Categories'));
            foreach($categoryObjects as $categoryObject) {
                $mygmap_cat = array();
                $mygmap_cat['id'] = $categoryObject->getVar('mygmap_category_id');
                $mygmap_cat['name'] = $categoryObject->getVar('mygmap_category_name');
                $this->elements['catlist'][] = $mygmap_cat;
            }
            
            $this->elements['maptype'] = $GLOBALS['xoopsModuleConfig']['mygmap_maptype'];
            if (isset($_GET['lat'])&&isset($_GET['lng'])) {
                $mygmap_marker = array();
                $mygmap_marker['id'] = 0;
                $this->elements['center_lat'] = $mygmap_marker['lat'] = floatval($_GET['lat']);
                $this->elements['center_lng'] = $mygmap_marker['lng'] = floatval($_GET['lng']);
                $this->elements['zoom'] = $mygmap_marker['zoom'] = (isset($_GET['z'])) ? intval($_GET['z']) : $GLOBALS['xoopsModuleConfig']['mygmap_z'];
                $this->elements['maptype'] = (isset($_GET['t'])) ? intval($_GET['t']) : $GLOBALS['xoopsModuleConfig']['mygmap_maptype'];
                $mygmap_marker['mark'] = (isset($_GET['mark'])) ? htmlspecialchars(strtoupper($_GET['mark']),ENT_QUOTES) : '';
                $mygmap_text =(!empty($_GET['text'])) ? mb_convert_encoding($_GET['text'],'EUC-JP','auto') : $GLOBALS['xoopsModuleConfig']['mygmap_text2'];
                $mygmap_marker['text'] = str_replace("'","\'",$myts->makeTareaData4Show($mygmap_text));
                $this->elements['markers'][] = $mygmap_marker;
            } elseif (!empty($_GET['cat']) || !empty($GLOBALS['xoopsModuleConfig']['mygmap_cat'])) {
                $category_id = (!empty($_GET['cat'])) ? intval($_GET['cat']) : $GLOBALS['xoopsModuleConfig']['mygmap_cat'];

                $markerHandler =& NBFrame::getHandler('MyGmapMarker', $this->mEnvironment);
                if ($category_id != -1) {
                    $categoryObject =& $categoryHandler->get($category_id);
                    $this->elements['center_lat'] = $this->elements['category']['lat'] = $categoryObject->getVar('mygmap_category_lat');
                    $this->elements['center_lng'] = $this->elements['category']['lng'] = $categoryObject->getVar('mygmap_category_lng');
                    $this->elements['zoom'] = $this->elements['category']['zoom'] = $categoryObject->getVar('mygmap_category_zoom');
                    $this->elements['category']['maptype'] = $categoryObject->getVar('mygmap_category_maptype');
                    $this->elements['maptype'] = $this->elements['category']['maptype'] ? $this->elements['category']['maptype'] : $this->elements['maptype'];
                    $this->elements['category']['id'] = $categoryObject->getVar('mygmap_category_id');
                    $this->elements['category']['name'] = $categoryObject->getVar('mygmap_category_name');
                    $this->elements['category']['desc'] = $categoryObject->getVar('mygmap_category_desc');
                    $this->elements['category']['can_edit'] = $categoryObject->checkGroupPerm('write', true);
                    
                    if ($categoryObject->getVar('mygmap_category_overlay')) {
                        $this->elements['overlay'][] = $this->overlayURL($categoryObject->getVar('mygmap_category_overlay'));
                    }
                } else {
                    $this->elements['center_lat'] = $mygmap_marker['lat'] = $GLOBALS['xoopsModuleConfig']['mygmap_lat'];
                    $this->elements['center_lng'] = $mygmap_marker['lng'] = $GLOBALS['xoopsModuleConfig']['mygmap_lng'];
                    $this->elements['zoom'] = $GLOBALS['xoopsModuleConfig']['mygmap_zoom'];
                    $this->elements['category']['id'] = -1;
                    foreach($categoryObjects as $categoryObject) {
                        if ($categoryObject->getVar('mygmap_category_overlay')) {
                            $this->elements['overlay'][] = $this->overlayURL($categoryObject->getVar('mygmap_category_overlay'));
                        }
                    }
                }
                
                if (!empty($_GET['id'])) {
                    $map_id = intval($_GET['id']);
                    if ($markerObject =& $markerHandler->get($map_id)) {
                        $this->elements['center_lat'] = $markerObject->getVar('mygmap_marker_lat');
                        $this->elements['center_lng'] = $markerObject->getVar('mygmap_marker_lng');
                        $this->elements['zoom'] = $markerObject->getVar('mygmap_marker_zoom');
                        $this->elements['maptype'] = $markerObject->getVar('mygmap_marker_maptype') ? $markerObject->getVar('mygmap_marker_maptype') : $this->elements['maptype'];
                    }
                }
                if ($category_id != -1) {
                    $criteria =& new Criteria('mygmap_marker_category_id', $category_id);
                } else {
                    $criteria = null;
                }
                $markerObjects =& $markerHandler->getObjects($criteria);
                foreach($markerObjects as $markerObject) {
                    $mygmap_marker = array();
                    $mygmap_marker['id'] = $markerObject->getVar('mygmap_marker_id');
                    $mygmap_marker['lat'] = $markerObject->getVar('mygmap_marker_lat');
                    $mygmap_marker['lng'] = $markerObject->getVar('mygmap_marker_lng');
                    $mygmap_marker['zoom'] = $markerObject->getVar('mygmap_marker_zoom');
                    $mygmap_marker['maptype'] = $markerObject->getVar('mygmap_marker_maptype');
                    $mygmap_marker['mark'] = $markerObject->getVar('mygmap_marker_icontext');
                    $mygmap_title = htmlspecialchars($markerObject->getVar('mygmap_marker_title'),ENT_QUOTES);
                    $mygmap_desc = $markerObject->getVar('mygmap_marker_desc');
                    $mygmap_marker['title'] = $mygmap_title;
                    $mygmap_marker['text'] = '<b>'.$mygmap_title .'</b>' . '<hr />' . $mygmap_desc;
                    $mygmap_marker['canedit'] = (NBFrame::checkRight('marker_edit') && $this->elements['category']['can_edit']);
                    $this->elements['markers'][] = $mygmap_marker;
                }
                usort($this->elements['markers'], array(&$this, 'usort_cmp'));
            } else {
                $mygmap_marker = array();
                $mygmap_marker['id'] = 0;
                $this->elements['center_lat'] = $mygmap_marker['lat'] = $GLOBALS['xoopsModuleConfig']['mygmap_lat'];
                $this->elements['center_lng'] = $mygmap_marker['lng'] = $GLOBALS['xoopsModuleConfig']['mygmap_lng'];
                $this->elements['zoom'] = $GLOBALS['xoopsModuleConfig']['mygmap_zoom'];
                $mygmap_marker['mark'] = '';
                $mygmap_text = $GLOBALS['xoopsModuleConfig']['mygmap_text1'];
                $mygmap_marker['text'] = str_replace("'","\'",$myts->makeTareaData4Show($mygmap_text));
                $mygmap_marker['canedit'] = false;
                $this->elements['markers'][] = $mygmap_marker;
            }
            $areaHandler =& NBFrame::getHandler('MyGmapArea', $this->mEnvironment);
            $criteria = new Criteria(1, intNBCriteriaVal(1));
            $criteria->setSort('mygmap_area_order');
            $areaObjects =& $areaHandler->getObjects($criteria);
            $this->elements['areas'] = array();
            foreach($areaObjects as $areaObject) {
                $mygmap_area = array();
                $mygmap_area['id'] = $areaObject->getVar('mygmap_area_id');
                $mygmap_area['name'] = $areaObject->getVar('mygmap_area_name');
                $mygmap_area['lat'] = $areaObject->getVar('mygmap_area_lat');
                $mygmap_area['lng'] = $areaObject->getVar('mygmap_area_lng');
                $mygmap_area['zoom'] = $areaObject->getVar('mygmap_area_zoom');
                $mygmap_area['maptype'] = $areaObject->getVar('mygmap_area_maptype');
                $mygmap_area['desc'] = $areaObject->getVar('mygmap_area_desc');
                $this->elements['areas'][] = $mygmap_area;
            }
            $this->elements['addr'] = (!empty($_GET['q'])) ? mb_convert_encoding(htmlspecialchars($_GET['q'], ENT_QUOTES),'EUC-JP','UTF-8,EUC-JP,SJIS') : '';
            $this->elements['station'] = (!empty($_GET['s'])) ? mb_convert_encoding(htmlspecialchars($_GET['s'], ENT_QUOTES),'EUC-JP','UTF-8,EUC-JP,SJIS') : '';
            NBFrame::using('MyGmapUtils',$this->mEnvironment);
            
            foreach(MyGmapUtils::getPluginFiles($this->mDirName, 'php') as $file) {
                require_once $file;
                $class = basename($file);
                $class = substr($class,0, strlen($class)-4);
                if (class_exists($class)) {
                    call_user_func_array(array($class, 'executeDefaultOp'), array(&$this));
                }
            }
            return NBFRAME_ACTION_VIEW_DEFAULT;
        }

        function viewDefaultOp() {
            //----------------------------------------------
            $this->mXoopsTpl->assign('mygmap_API', $GLOBALS['xoopsModuleConfig']['mygmap_api']);
            $this->mXoopsTpl->assign('mygmap_dirname', $this->mDirName);
            $this->mXoopsTpl->assign('mygmap_center_lat', $this->elements['center_lat']);
            $this->mXoopsTpl->assign('mygmap_center_lng', $this->elements['center_lng']);
            $this->mXoopsTpl->assign('mygmap_zoom', $this->elements['zoom']);
            $this->mXoopsTpl->assign('mygmap_maptype', $this->elements['maptype']);
            $this->mXoopsTpl->assign('mygmap_category', $this->elements['category']);
            $this->mXoopsTpl->assign('mygmap_catlist', $this->elements['catlist']);
            $this->mXoopsTpl->assign('mygmap_markers', $this->elements['markers']);
            $this->mXoopsTpl->assign('mygmap_areas', $this->elements['areas']);
            $this->mXoopsTpl->assign('mygmap_overlays', $this->elements['overlay']);
            $this->mXoopsTpl->assign('mygmap_search', $GLOBALS['xoopsModuleConfig']['mygmap_search']);
            $this->mXoopsTpl->assign('mygmap_addr', $this->elements['addr']);
            $this->mXoopsTpl->assign('mygmap_station', $this->elements['station']);
            $this->mXoopsTpl->assign('mygmap_invgeo', $GLOBALS['xoopsModuleConfig']['mygmap_invgeo']);
            $this->mXoopsTpl->assign('mygmap_link', $GLOBALS['xoopsModuleConfig']['mygmap_link']);
            $this->mXoopsTpl->assign('mygmap_wiki', $GLOBALS['xoopsModuleConfig']['mygmap_wiki']);
            $this->mXoopsTpl->assign('mygmap_blog', $GLOBALS['xoopsModuleConfig']['mygmap_blog']);
            $this->mXoopsTpl->assign('mygmap_width', $GLOBALS['xoopsModuleConfig']['mygmap_width']);
            $this->mXoopsTpl->assign('mygmap_height', $GLOBALS['xoopsModuleConfig']['mygmap_height']);
            $this->mXoopsTpl->assign('mygmap_setdef_show', $GLOBALS['xoopsModuleConfig']['mygmap_setdef_show']);
            $this->mXoopsTpl->assign('mygmap_debug', $GLOBALS['xoopsModuleConfig']['mygmap_debug']);
            $credit = $GLOBALS['mygmap_credit'];
            if ($GLOBALS['xoopsModuleConfig']['mygmap_search']) {
                $credit .= '<br />'.$GLOBALS['mygmap_csis_credit'];
            }
            if ($GLOBALS['xoopsModuleConfig']['mygmap_invgeo']) {
                $credit .= '<br />'.$GLOBALS['mygmap_invgeo_credit'];
            }
            $this->mXoopsTpl->assign('xoopsUserIsAdmin', $GLOBALS['xoopsUserIsAdmin']);
            $this->mXoopsTpl->assign('mygmap_can_edit_area', NBFrame::checkRight('area_edit'));
            $this->mXoopsTpl->assign('mygmap_can_edit_category', NBFrame::checkRight('category_edit'));
            if (!empty($this->elements['category'])&&$this->elements['category']['id'] > 0) {
                $this->mXoopsTpl->assign('mygmap_can_add_marker', (NBFrame::checkRight('marker_edit') && $this->elements['category']['can_edit']));
            } else {
                $this->mXoopsTpl->assign('mygmap_can_add_marker', $GLOBALS['xoopsUserIsAdmin']);
            }
            $this->mXoopsTpl->assign('mygmap_setdef_show', $GLOBALS['xoopsModuleConfig']['mygmap_setdef_show']);
            
            NBFrame::using('MyGmapUtils',$this->mEnvironment);
            
            foreach(MyGmapUtils::getPluginFiles($this->mDirName, 'php') as $file) {
                require_once $file;
                $class = basename($file);
                $class = substr($class,0, strlen($class)-4);
                if (class_exists($class)) {
                    call_user_func_array(array($class, 'viewDefaultOp'), array(&$this));
                }
            }

            $extra = '';
            foreach(MyGmapUtils::getPluginFiles($this->mDirName, 'html') as $file) {
                $extra .= $this->mXoopsTpl->fetch($file);
            }
            $this->mXoopsTpl->assign('mygmap_extra_info', $extra);
            if (!empty($GLOBALS['mygmap_plugin_credit'])) {
                $credit .= $GLOBALS['mygmap_plugin_credit'];
            }
            $this->mXoopsTpl->assign('mygmap_credit', $credit);
        }

        function overlayURL($str)
        {
            $urlArray = explode(',', $str);
            $url = $urlArray[0];
            if (isset($urlArray[1])) {
                $zoomLimit = intval($urlArray[1]);
            } else {
                $zoomLimit = 0;
            }
            if (preg_match('/^mymap\:([0-9a-z\.]+)(,([0-9]+))?$/',$url,$matches)) {
                $url = 'http://maps.google.co.jp/maps/ms?ie=UTF8&hl=ja&msa=0&output=kml&msid='.$matches[1];
            } else {
                $url = XOOPS_URL.'/modules/'.$this->mDirName.'/?action=MyGmapLoadKLM&file='.basename($url);
            }
            return array('url'=>$url, 'limit'=>$zoomLimit);
        }
        function usort_cmp($a, $b) {
            if ($a['mark'] === $b['mark']) return (($a['title'] < $b['title']) ? -1: 1);
            if (trim($a['mark']) === '') return 1;
            if (trim($b['mark']) === '') return -1;
            return strnatcmp($a['mark'],$b['mark']);
        }
    }
}
?>
