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
if(! class_exists('MyGmapSearch')) {
    class MyGmapSearch {
        function search(&$environment, $queryarray, $andor, $limit, $offset, $userid)
        {
            $ret = array();
            $markerHandler =& NBFrame::getHandler('MyGmapMarker', $environment);
            if ( is_array($queryarray) && $count = count($queryarray) ) {
                $criteria0 = new CriteriaCompo(new Criteria('mygmap_marker_title', '%'.$queryarray[0].'%', 'LIKE'));
                $criteria0->add(new Criteria('mygmap_marker_desc', '%'.$queryarray[0].'%', 'LIKE'),'OR');
                $criteria =& new CriteriaCompo($criteria0);
                for($i=1;$i<$count;$i++){
                    $criteria0 = new CriteriaCompo(new Criteria('mygmap_marker_title', '%'.$queryarray[$i].'%', 'LIKE'));
                    $criteria0->add(new Criteria('mygmap_marker_desc', '%'.$queryarray[$i].'%', 'LIKE'),'OR');
                    $criteria->add($criteria0, $andor);
                }
            } else {
                $criteria =& new CriteriaCompo(new CriteriaElement());
            }
            if ($userid) {
                $criteria->add(new Criteria('_NBsys_create_user', $userid));
            }
            $criteria->setLimit($limit);
            $criteria->setStart($offset);
            $markerObjects = $markerHandler->getObjects($criteria);
            foreach($markerObjects as $markerObject) {
                $desc = $markerObject->getVar('mygmap_marker_desc');
                if (!empty($desc) && function_exists('xoops_make_context')) {
                    $context = xoops_make_context(strip_tags($desc),$queryarray);
                } else if (!empty($desc) && function_exists('search_make_context')) {
                    if (!empty($_GET['showcontext']) && ($_GET['showcontext']==1)) {
                        $context = search_make_context(strip_tags($desc),$queryarray);
                    }
                } else {
                    $context = '';
                }
                $ret[] = array(
                    'title' => $markerObject->getVar('mygmap_marker_title'),
                    'uid' => $markerObject->getVar('_NBsys_create_user'), 
                    'time' => $markerObject->getVar('_NBsys_update_time'), 
                    'page' => $markerObject->getVar('mygmap_marker_title'),
                    'link' => $environment->getActionUrl('MyGmapMain', array('cat'=>$markerObject->getVar('mygmap_marker_category_id'),'id'=>$markerObject->getVar('mygmap_marker_id')),'html',true),
                    'context' => $context,
                );
            }
            return $ret;
        }
    }
}
?>
