<?php
if (!class_exists('MyGmapMarkerAdminAction')) {
    NBFrame::using('AdminMaintAction');

    class MyGmapMarkerAdminAction extends NBFrameAdminMaintAction {
        function prepare() {
            parent::prepare('MyGmapMarker', $this->__l('Marker Title'));
        }
    }
}
?>
