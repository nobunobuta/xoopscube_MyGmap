<?php
    include dirname(__FILE__).'/NBFrameLoader.inc.php';
    NBFrame::prepare('mygmap', NBFRAME_TARGET_INSTALLER);
    NBFrame::prepareOnInstallFunction();
    NBFrame::prepareOnUpdateFunction();
    NBFrame::prepareOnUninstallFunction();
?>
