<?php
if (!class_exists('MyGmapAreaAdminAction')) {
    NBFrame::using('AdminMaintAction');

    class MyGmapAreaAdminAction extends NBFrameAdminMaintAction {
        function prepare() {
            parent::prepare('MyGmapArea', _AD_MYGMAP_LANG_AREA_TITLE);
        }
    }
}
?>
