<?php
include dirname(dirname(__FILE__)).'/include/NBFrameLoader.inc.php';
$envtemp =& NBFrame::getEnvironments(NBFRAME_TARGET_TEMP);
include NBFrame::findFile('admin_menu.inc.php', $envtemp, 'include');
$adminmenu = array_merge($adminmenu, NBFrame::getAdminMenu($envtemp));
?>
