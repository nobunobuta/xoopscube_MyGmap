<?php
if (!class_exists('MyGmapAreaAdminAction')) {
    NBFrame::using('AdminMaintAction');

    class MyGmapAreaAdminAction extends NBFrameAdminMaintAction {
        function prepare() {
            parent::prepare('MyGmapArea', $this->__l('Area Title'));
        }
    }
}
?>
