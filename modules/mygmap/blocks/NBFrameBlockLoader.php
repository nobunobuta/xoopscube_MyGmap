<?php
include dirname(dirname(__FILE__)).'/include/NBFrameLoader.inc.php';
$environment =& NBFrame::prepare('mygmap', NBFRAME_TARGET_BLOCK);
NBFrame::prepareBlockFunction($environment);
?>
