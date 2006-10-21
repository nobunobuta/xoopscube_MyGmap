<?php
    include dirname(__FILE__).'/NBFrameLoader.inc.php';
    NBFrame::prepare(null, NBFRAME_TARGET_INSTALLER);
    NBFrame::prepareOnInstallFunction();
    NBFrame::prepareOnUpdateFunction();
    NBFrame::prepareOnUninstallFunction();
?>
