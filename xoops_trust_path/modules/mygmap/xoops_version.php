<?php
include_once dirname(__FILE__).'/include/version.inc.php';

$langPrefix = NBFrame::langConstPrefix('MI', NBFRAME_TARGET_INSTALLER);

$modversion['name'] = 'MyGmap'; // It'll be rewritten
$modversion['version'] = $GLOBALS['mygmap_version_xoops'];
$modversion['description'] = 'googleAPIによる地図表示モジュールです。';
$modversion['credits'] = $GLOBALS['mygmap_credit'];
$modversion['author'] = 'NobuNobu';
$modversion['help'] = '';
$modversion['license'] = 'GPL see LICENSE';
$modversion['official'] = 0;
$modversion['image'] = 'images/logo.png'; // It'll be rewritten
$modversion['dirname'] = 'mygmap'; // It'll be rewritten

//If you want specify your custom install sequence, uncomment following 2 lines.
//$modversion['NBFrameOnInstall']['file'] =  '/include/oninstall.inc.php';
//$modversion['NBFrameOnInstall']['func'][] = 'install_mygmap';

//If you want specify your custom update sequence, uncomment following 2 lines.
//$modversion['NBFrameOnUpdate']['file'] = '/include/onupdate.inc.php';
//$modversion['NBFrameOnUpdate']['func'][] = 'update_mygmap';

//If you want specify your custom uninstall sequence, uncomment following 2 lines.
//$modversion['NBFrameOnUninstall']['file'] =  '/include/onuninstall.inc.php';
//$modversion['NBFrameOnUninstall']['func'][] = 'uninstall_mygmap';

// Menu
$modversion['hasMain'] = 1;

$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/index.php'; // It'll be rewritten
$modversion['adminmenu'] = 'include/admin_menu.inc.php'; // It'll be rewritten
$modversion['hasconfig'] = 1;
$modversion['config'][1] = array(
    'name'          => 'mygmap_api' ,
    'title'         => $langPrefix.'API_MSG' ,
    'description'   => $langPrefix.'API_DESC' ,
    'formtype'      => 'textbox' ,
    'valuetype'     => 'text' ,
    'default'       => '' ,
);

$modversion['config'][2] = array(
    'name'          => 'mygmap_cat' ,
    'title'         => $langPrefix.'CAT_MSG' ,
    'description'   => $langPrefix.'CAT_DESC' ,
    'formtype'      => 'textbox' ,
    'valuetype'     => 'text' ,
    'default'       => '0' ,
);

$modversion['config'][3] = array(
    'name'          => 'mygmap_lat' ,
    'title'         => $langPrefix.'LAT_MSG' ,
    'description'   => $langPrefix.'LAT_DESC' ,
    'formtype'      => 'textbox' ,
    'valuetype'     => 'text' ,
    'default'       => '34.4048914272' ,
);

$modversion['config'][4] = array(
    'name'          => 'mygmap_lng' ,
    'title'         => $langPrefix.'LNG_MSG' ,
    'description'   => $langPrefix.'LNG_DESC' ,
    'formtype'      => 'textbox' ,
    'valuetype'     => 'text' ,
    'default'       => '133.193650246' ,
);

$modversion['config'][5] = array(
    'name'          => 'mygmap_zoom' ,
    'title'         => $langPrefix.'ZOOM_MSG' ,
    'description'   => $langPrefix.'ZOOM_DESC' ,
    'formtype'      => 'select' ,
    'valuetype'     => 'int' ,
    'default'       => 17 ,
    'options' => array(
                    $langPrefix.'Z_OPT0'=>0 ,
                    $langPrefix.'Z_OPT1'=>1 ,
                    $langPrefix.'Z_OPT2'=>2 ,
                    $langPrefix.'Z_OPT3'=>3 ,
                    $langPrefix.'Z_OPT4'=>4 ,
                    $langPrefix.'Z_OPT5'=>5 ,
                    $langPrefix.'Z_OPT6'=>6 ,
                    $langPrefix.'Z_OPT7'=>7 ,
                    $langPrefix.'Z_OPT8'=>8 ,
                    $langPrefix.'Z_OPT9'=>9 ,
                    $langPrefix.'Z_OPT10'=>10 ,
                    $langPrefix.'Z_OPT11'=>11 ,
                    $langPrefix.'Z_OPT12'=>12 ,
                    $langPrefix.'Z_OPT13'=>13 ,
                    $langPrefix.'Z_OPT14'=>14 ,
                    $langPrefix.'Z_OPT15'=>15 ,
                    $langPrefix.'Z_OPT16'=>16 ,
                    $langPrefix.'Z_OPT17'=>17 ,
                    $langPrefix.'Z_OPT18'=>18 ,
                    $langPrefix.'Z_OPT19'=>19 ,
     ),
);
$modversion['config'][6] = array(
    'name'          => 'mygmap_maptype' ,
    'title'         => $langPrefix.'MAPTYPE_MSG' ,
    'description'   => $langPrefix.'MAPTYPE_DESC' ,
    'formtype'      => 'select' ,
    'valuetype'     => 'int' ,
    'default'       => 1 ,
    'options' => array(
                    $langPrefix.'MAPTYPE_OPT1'=>1 ,
                    $langPrefix.'MAPTYPE_OPT2'=>2 ,
                    $langPrefix.'MAPTYPE_OPT3'=>3 ,
     ),
);
$modversion['config'][7] = array(
    'name'          => 'mygmap_search' ,
    'title'         => $langPrefix.'SEARCH_MSG' ,
    'description'   => $langPrefix.'SEARCH_DESC' ,
    'formtype'      => 'yesno' ,
    'valuetype'     => 'int' ,
    'default'       => 0 ,
);
$modversion['config'][8] = array(
    'name'          => 'mygmap_invgeo' ,
    'title'         => $langPrefix.'INVGEO_MSG' ,
    'description'   => $langPrefix.'INVGEO_DESC' ,
    'formtype'      => 'yesno' ,
    'valuetype'     => 'int' ,
    'default'       => 0 ,
);
$modversion['config'][9] = array(
    'name'          => 'mygmap_link' ,
    'title'         => $langPrefix.'LINK_MSG' ,
    'description'   => $langPrefix.'LINK_DESC' ,
    'formtype'      => 'yesno' ,
    'valuetype'     => 'int' ,
    'default'       => 1 ,
);
$modversion['config'][10] = array(
    'name'          => 'mygmap_wiki' ,
    'title'         => $langPrefix.'WIKI_MSG' ,
    'description'   => $langPrefix.'WIKI_DESC' ,
    'formtype'      => 'yesno' ,
    'valuetype'     => 'int' ,
    'default'       => 0 ,
);
$modversion['config'][11] = array(
    'name'          => 'mygmap_blog' ,
    'title'         => $langPrefix.'BLOG_MSG' ,
    'description'   => $langPrefix.'BLOG_DESC' ,
    'formtype'      => 'yesno' ,
    'valuetype'     => 'int' ,
    'default'       => 0 ,
);
$modversion['config'][12] = array(
    'name'          => 'mygmap_width' ,
    'title'         => $langPrefix.'WIDTH_MSG' ,
    'description'   => $langPrefix.'WIDTH_DESC' ,
    'formtype'      => 'textbox' ,
    'valuetype'     => 'int' ,
    'default'       => 540 ,
);
$modversion['config'][13] = array(
    'name'          => 'mygmap_height' ,
    'title'         => $langPrefix.'HEIGHT_MSG' ,
    'description'   => $langPrefix.'HEIGHT_DESC' ,
    'formtype'      => 'textbox' ,
    'valuetype'     => 'int' ,
    'default'       => 460 ,
);
$modversion['config'][14] = array(
    'name'          => 'mygmap_text1' ,
    'title'         => $langPrefix.'TEXT1_MSG' ,
    'description'   => $langPrefix.'TEXT1_DESC' ,
    'formtype'      => 'textarea' ,
    'valuetype'     => 'text' ,
    'default'       => constant($langPrefix.'TEXT1_DEFAULT') ,
);
$modversion['config'][15] = array(
    'name'          => 'mygmap_text2' ,
    'title'         => $langPrefix.'TEXT2_MSG' ,
    'description'   => $langPrefix.'TEXT2_DESC' ,
    'formtype'      => 'textarea' ,
    'valuetype'     => 'text' ,
    'default'       => constant($langPrefix.'TEXT2_DEFAULT') ,
);
$modversion['config'][16] = array(
    'name'          => 'mygmap_setdef_show' ,
    'title'         => $langPrefix.'SETDEF_SHOW_MSG' ,
    'description'   => $langPrefix.'SETDEF_SHOW_DESC' ,
    'formtype'      => 'yesno' ,
    'valuetype'     => 'int' ,
    'default'       => 1 ,
);
$modversion['config'][17] = array(
    'name'          => 'mygmap_debug' ,
    'title'         => $langPrefix.'DEBUG_MSG' ,
    'description'   => $langPrefix.'DEBUG_DESC' ,
    'formtype'      => 'yesno' ,
    'valuetype'     => 'int' ,
    'default'       => 0 ,
);

//$modversion['blocks'][1]['file'] = 'NBFrameBlockLoader.php'; //You should specify this filename;
$modversion['blocks'][1]['name'] = 'Mini Map';
$modversion['blocks'][1]['description'] = '';
$modversion['blocks'][1]['class'] = 'MyGmapMiniMapBlock';
$modversion['blocks'][1]['show_func'] = 'show';  // It'll be rewritten
$modversion['blocks'][1]['edit_func'] = 'edit';  // It'll be rewritten
$modversion['blocks'][1]['options'] = '1';
$modversion['blocks'][1]['template'] = 'block_minimap.html';  // It'll be rewritten
$modversion['blocks'][1]['can_clone'] = true ;
?>
