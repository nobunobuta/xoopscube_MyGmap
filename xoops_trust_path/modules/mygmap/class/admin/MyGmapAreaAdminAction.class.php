<?php
if (!class_exists('MyGmapAreaAdminAction')) {
    NBFrame::using('AdminMaintAction');

    class MyGmapAreaAdminAction extends NBFrameAdminMaintAction {
        function prepare() {
            $this->mHalfAutoForm = true;
            parent::prepare('MyGmapArea', $this->__l('Area Title'));
        }
    }
}
?>
