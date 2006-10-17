<?php
$adminmenu[0]['title'] = _MI_MYGMAP_AD_MENU0;
$adminmenu[0]['link'] = "?action=admin.MyGmapCategoryAdmin";
$adminmenu[1]['title'] = _MI_MYGMAP_AD_MENU1;
$adminmenu[1]['link'] = "?action=admin.MyGmapMarkerAdmin";
$adminmenu[2]['title'] = _MI_MYGMAP_AD_MENU2;
$adminmenu[2]['link'] = "?action=admin.MyGmapAreaAdmin";
if (!NBFrame::checkAltSys(false)) {
  $adminmenu[3]['title'] = _MI_MYGMAP_AD_MENU3;
  $adminmenu[3]['link'] = "?action=NBFrame.admin.BlocksAdmin";
} else {
  $adminmenu[3]['title'] = _MI_MYGMAP_AD_MENU3;
  $adminmenu[3]['link'] = "?action=NBFrame.admin.AltSys&page=myblocksadmin";
  $adminmenu[4]['title'] = _MI_MYGMAP_AD_MENU4;
  $adminmenu[4]['link'] = "?action=NBFrame.admin.AltSys&page=mytplsadmin";
}
?>