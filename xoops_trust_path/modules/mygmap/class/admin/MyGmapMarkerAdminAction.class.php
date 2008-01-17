<?php
if (!class_exists('MyGmapMarkerAdminAction')) {
    NBFrame::using('AdminMaintAction');

    class MyGmapMarkerAdminAction extends NBFrameAdminMaintAction {
        function prepare() {
            $this->mHalfAutoForm = true;
            parent::prepare('MyGmapMarker', $this->__l('Marker Title'));
        }
    }
}
?>
