<?php
if (!class_exists('MyGmapLoadKLMAction')) {
    NBFrame::using('Action');
    class MyGmapLoadKLMAction extends NBFrameAction {
        var $mLoadCommon = false;
        
        function executeDefaultOp() {
            error_reporting(0);
            $fileName = basename($_GET['file']);
            $fileName = XOOPS_TRUST_PATH.'/data/kml/'.$fileName;
            if (!empty($fileName) && file_exists($fileName)) {
                NBFrame::using('HTTPOutput');
                NBFrameHTTPOutput::putFile($fileName, 'application/vnd.google-earth.kml+xml;charset="UTF-8"',false);
            }
        }
    }
}
?>
