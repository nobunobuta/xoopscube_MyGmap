<?php
if (!class_exists('MyGmapMarkerAction')) {
    NBFrame::using('ObjectAction');

    class MyGmapMarkerAction extends NBFrameObjectAction
    {
        function prepare() {
            parent::prepare('MyGmapMarker', 'mygmap_markedit',$this->__l('Marker'));
            $this->setObjectForm('MyGmapMarker');
            $this->setFormTemplate($this->prefix('marker.html'));
            $this->setExecutePermission('markeredit');
        }

        function viewFormOp() {
            parent::viewFormOp();
            $this->mXoopsTpl->assign('mygmap_API', $GLOBALS['xoopsModuleConfig']['mygmap_api']);
            $this->mXoopsTpl->assign('mygmap_dirname', $this->mDirName);
            $this->mXoopsTpl->assign('mygmap_center_lat', $this->mObject->getVar('mygmap_marker_lat'));
            $this->mXoopsTpl->assign('mygmap_center_lng', $this->mObject->getVar('mygmap_marker_lng'));
            $this->mXoopsTpl->assign('mygmap_zoom', $this->mObject->getVar('mygmap_marker_zoom'));
            $this->mXoopsTpl->assign('mygmap_maptype', $this->mObject->getVar('mygmap_marker_maptype'));
            $this->mXoopsTpl->assign('mygmap_width', $GLOBALS['xoopsModuleConfig']['mygmap_width']);
            $this->mXoopsTpl->assign('mygmap_height', $GLOBALS['xoopsModuleConfig']['mygmap_height']);
            $this->mXoopsTpl->assign('mygmap_credit', $GLOBALS['mygmap_credit']);
        }

        function executeActionSuccess() {
            redirect_header($this->getUrlBase()."/?cat=".$this->mObject->getVar('mygmap_marker_category_id'), 2, $this->__e('Action Success'));
        }
    }
}
?>
