<?php
if (!class_exists('MyGmapMarkerAdminAction')) {
    NBFrame::using('AdminMaintAction');

    class MyGmapMarkerAdminAction extends NBFrameAdminMaintAction {
        function prepare() {
            parent::prepare('MyGmapMarker', _AD_MYGMAP_LANG_MARKER_TITLE);
        }
    }
}
?>
