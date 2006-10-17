<?php
if (!class_exists('MyGmapMiniMapBlock')) {
    class MyGmapMiniMapBlock {
        function edit(&$environment, $option) {
            $dirName = $environment->mCurrentDirName;
            $markerHandler =& NBFrame::getHandler('MyGmapMarker',$environment);            $form = '<table width="100%">';
            $form .= '<tr><td>Marker ID:</td>';
            $form .= '<td><select name="options[0]">';
            $markerObjects =& $markerHandler->getObjects();
            foreach($markerObjects as $markerObject) {
                $id = $markerObject->getVar('mygmap_marker_id');
                $name = $markerObject->getVar('mygmap_marker_title');
                if ($id == $option[0]) {
                    $select = 'selected="selected"';
                } else {
                    $select = '';
                }
                $form .= '<option value="'.$id.'"'.$select.' >'.$id.' : '.$name.'</option>';
            }
            $form .= '</table>';
            return $form;
        }
        
        function show(&$environment, $option){
            $dirName = $environment->mCurrentDirName;
            static $id = 0;
            
            if (defined('MYGMAP_GMAPI_INCLUDED')) {
                $block['gmapi_include'] = 0;
            } else {
                $block['gmapi_include'] = 1;
                define('MYGMAP_GMAPI_INCLUDED', 1);
            }
            $markerHandler =& NBFrame::getHandler('MyGmapMarker',$environment);            $markerObject =& $markerHandler->get($option[0]);
            if ($markerObject) {
                $block['mygmap_API'] = NBFrameGetModuleConfig($dirName, 'mygmap_api');
                $block['dirname'] = $dirName;
                $block['divid'] = 'mygmap_mini_'.$id; $id++;
                $block['id'] = $markerObject->getVar('mygmap_marker_id');
                $block['category_id'] = $markerObject->getVar('mygmap_marker_category_id');
                $block['title'] = $markerObject->getVar('mygmap_marker_title');
                $block['lat'] = $markerObject->getVar('mygmap_marker_lat');
                $block['lng'] = $markerObject->getVar('mygmap_marker_lng');
                $block['zoom'] = $markerObject->getVar('mygmap_marker_zoom');
                $block['maptype'] = $markerObject->getVar('mygmap_marker_maptype');
                return $block;
            } else {
                return null;
            }
        }
    }
}
