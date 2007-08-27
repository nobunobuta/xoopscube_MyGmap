<?php
include dirname(__FILE__).'/include/NBFrameLoader.inc.php';
// Include Moudle xoops_version.php
include (NBFrame::getXoopsVersionFileName(null));
// Parse and Modify xoops_version.php info
NBFrame::parseXoopsVerionFile($modversion);
?>
