<?php
include_once dirname(__FILE__).'/include/version.inc.php';
$modEnv =& NBFrame::getEnvironments(NBFRAME_TARGET_INSTALLER);

$modversion['name'] = 'MyGmap ['.$modEnv->mDirName.']';
$modversion['version'] = $GLOBALS['mygmap_version_xoops'];
$modversion['description'] = 'googleAPIによる地図表示モジュールです。';
$modversion['credits'] = $GLOBALS['mygmap_credit'];
$modversion['author'] = 'NobuNobu';
$modversion['help'] = '';
$modversion['license'] = 'GPL see LICENSE';
$modversion['official'] = 0;
$modversion['image'] = '?action=NBFrame.GetImage&file=logo.png';
$modversion['dirname'] = $modEnv->mDirName;

//$modversion['NBFrameOnInstall']['file'] =  '/include/oninstall.inc.php';
//$modversion['NBFrameOnInstall']['func'][] = 'install_mygmap';
$modversion['NBFrameOnUpdate']['file'] = '/include/onupdate.inc.php';
$modversion['NBFrameOnUpdate']['func'][] = 'update_mygmap';
//$modversion['NBFrameOnUninstall']['file'] =  '/include/onuninstall.inc.php';
//$modversion['NBFrameOnUninstall']['func'][] = 'uninstall_mygmap';
NBFrame::prepareInstaller($modversion);

// Menu
$modversion['hasMain'] = 1;

// DB Table
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';

// Tables created by sql file (without prefix!)
$modversion['tables'][0] = $modEnv->prefix('marker');
$modversion['tables'][1] = $modEnv->prefix('category');
$modversion['tables'][2] = $modEnv->prefix('area');

// Templates

$modversion['templates'][1] = NBFrame::setModuleTemplate('index.html');
$modversion['templates'][1]['description'] = '';
$modversion['templates'][2] = NBFrame::setModuleTemplate('category.html');
$modversion['templates'][2]['description'] = '';
$modversion['templates'][3] = NBFrame::setModuleTemplate('marker.html');
$modversion['templates'][3]['description'] = '';
$modversion['templates'][4] = NBFrame::setModuleTemplate('area.html');
$modversion['templates'][4]['description'] = '';

$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'index.php?action='.$modEnv->getAttribute('AdminMainAction');
$modversion['adminmenu'] = 'include/NBFrameAdminMenu.inc.php';
$modversion['hasconfig'] = 1;
$modversion['config'][1] = array(
    'name'          => 'mygmap_api' ,
    'title'         => '_MI_MYGMAP_API_MSG' ,
    'description'   => '_MI_MYGMAP_API_DESC' ,
    'formtype'      => 'textbox' ,
    'valuetype'     => 'text' ,
    'default'       => '' ,
);

$modversion['config'][2] = array(
    'name'          => 'mygmap_cat' ,
    'title'         => '_MI_MYGMAP_CAT_MSG' ,
    'description'   => '_MI_MYGMAP_CAT_DESC' ,
    'formtype'      => 'textbox' ,
    'valuetype'     => 'text' ,
    'default'       => '0' ,
);

$modversion['config'][3] = array(
    'name'          => 'mygmap_lat' ,
    'title'         => '_MI_MYGMAP_LAT_MSG' ,
    'description'   => '_MI_MYGMAP_LAT_DESC' ,
    'formtype'      => 'textbox' ,
    'valuetype'     => 'text' ,
    'default'       => '34.4048914272' ,
);

$modversion['config'][4] = array(
    'name'          => 'mygmap_lng' ,
    'title'         => '_MI_MYGMAP_LNG_MSG' ,
    'description'   => '_MI_MYGMAP_LNG_DESC' ,
    'formtype'      => 'textbox' ,
    'valuetype'     => 'text' ,
    'default'       => '133.193650246' ,
);

$modversion['config'][5] = array(
    'name'          => 'mygmap_zoom' ,
    'title'         => '_MI_MYGMAP_ZOOM_MSG' ,
    'description'   => '_MI_MYGMAP_ZOOM_DESC' ,
    'formtype'      => 'select' ,
    'valuetype'     => 'int' ,
    'default'       => 17 ,
    'options' => array(
                    '_MI_MYGMAP_Z_OPT0'=>0 ,
                    '_MI_MYGMAP_Z_OPT1'=>1 ,
                    '_MI_MYGMAP_Z_OPT2'=>2 ,
                    '_MI_MYGMAP_Z_OPT3'=>3 ,
                    '_MI_MYGMAP_Z_OPT4'=>4 ,
                    '_MI_MYGMAP_Z_OPT5'=>5 ,
                    '_MI_MYGMAP_Z_OPT6'=>6 ,
                    '_MI_MYGMAP_Z_OPT7'=>7 ,
                    '_MI_MYGMAP_Z_OPT8'=>8 ,
                    '_MI_MYGMAP_Z_OPT9'=>9 ,
                    '_MI_MYGMAP_Z_OPT10'=>10 ,
                    '_MI_MYGMAP_Z_OPT11'=>11 ,
                    '_MI_MYGMAP_Z_OPT12'=>12 ,
                    '_MI_MYGMAP_Z_OPT13'=>13 ,
                    '_MI_MYGMAP_Z_OPT14'=>14 ,
                    '_MI_MYGMAP_Z_OPT15'=>15 ,
                    '_MI_MYGMAP_Z_OPT16'=>16 ,
                    '_MI_MYGMAP_Z_OPT17'=>17 ,
                    '_MI_MYGMAP_Z_OPT18'=>18 ,
                    '_MI_MYGMAP_Z_OPT19'=>19 ,
     ),
);
$modversion['config'][6] = array(
    'name'          => 'mygmap_maptype' ,
    'title'         => '_MI_MYGMAP_MAPTYPE_MSG' ,
    'description'   => '_MI_MYGMAP_MAPTYPE_DESC' ,
    'formtype'      => 'select' ,
    'valuetype'     => 'int' ,
    'default'       => 1 ,
    'options' => array(
                    '_MI_MYGMAP_MAPTYPE_OPT1'=>1 ,
                    '_MI_MYGMAP_MAPTYPE_OPT2'=>2 ,
                    '_MI_MYGMAP_MAPTYPE_OPT3'=>3 ,
     ),
);
$modversion['config'][7] = array(
    'name'          => 'mygmap_search' ,
    'title'         => '_MI_MYGMAP_SEARCH_MSG' ,
    'description'   => '_MI_MYGMAP_SEARCH_DESC' ,
    'formtype'      => 'yesno' ,
    'valuetype'     => 'int' ,
    'default'       => 0 ,
);
$modversion['config'][8] = array(
    'name'          => 'mygmap_invgeo' ,
    'title'         => '_MI_MYGMAP_INVGEO_MSG' ,
    'description'   => '_MI_MYGMAP_INVGEO_DESC' ,
    'formtype'      => 'yesno' ,
    'valuetype'     => 'int' ,
    'default'       => 0 ,
);
$modversion['config'][9] = array(
    'name'          => 'mygmap_link' ,
    'title'         => '_MI_MYGMAP_LINK_MSG' ,
    'description'   => '_MI_MYGMAP_LINK_DESC' ,
    'formtype'      => 'yesno' ,
    'valuetype'     => 'int' ,
    'default'       => 1 ,
);
$modversion['config'][10] = array(
    'name'          => 'mygmap_wiki' ,
    'title'         => '_MI_MYGMAP_WIKI_MSG' ,
    'description'   => '_MI_MYGMAP_WIKI_DESC' ,
    'formtype'      => 'yesno' ,
    'valuetype'     => 'int' ,
    'default'       => 0 ,
);
$modversion['config'][11] = array(
    'name'          => 'mygmap_blog' ,
    'title'         => '_MI_MYGMAP_BLOG_MSG' ,
    'description'   => '_MI_MYGMAP_BLOG_DESC' ,
    'formtype'      => 'yesno' ,
    'valuetype'     => 'int' ,
    'default'       => 0 ,
);
$modversion['config'][12] = array(
    'name'          => 'mygmap_width' ,
    'title'         => '_MI_MYGMAP_WIDTH_MSG' ,
    'description'   => '_MI_MYGMAP_WIDTH_DESC' ,
    'formtype'      => 'textbox' ,
    'valuetype'     => 'int' ,
    'default'       => 540 ,
);
$modversion['config'][13] = array(
    'name'          => 'mygmap_height' ,
    'title'         => '_MI_MYGMAP_HEIGHT_MSG' ,
    'description'   => '_MI_MYGMAP_HEIGHT_DESC' ,
    'formtype'      => 'textbox' ,
    'valuetype'     => 'int' ,
    'default'       => 460 ,
);
$modversion['config'][14] = array(
    'name'          => 'mygmap_text1' ,
    'title'         => '_MI_MYGMAP_TEXT1_MSG' ,
    'description'   => '_MI_MYGMAP_TEXT1_DESC' ,
    'formtype'      => 'textarea' ,
    'valuetype'     => 'text' ,
    'default'       => _MI_MYGMAP_TEXT1_DEFAULT ,
);
$modversion['config'][15] = array(
    'name'          => 'mygmap_text2' ,
    'title'         => '_MI_MYGMAP_TEXT2_MSG' ,
    'description'   => '_MI_MYGMAP_TEXT2_DESC' ,
    'formtype'      => 'textarea' ,
    'valuetype'     => 'text' ,
    'default'       => _MI_MYGMAP_TEXT2_DEFAULT ,
);
$modversion['config'][16] = array(
    'name'          => 'mygmap_setdef_show' ,
    'title'         => '_MI_MYGMAP_SETDEF_SHOW_MSG' ,
    'description'   => '_MI_MYGMAP_SETDEF_SHOW_DESC' ,
    'formtype'      => 'yesno' ,
    'valuetype'     => 'int' ,
    'default'       => 1 ,
);
$modversion['config'][17] = array(
    'name'          => 'mygmap_debug' ,
    'title'         => '_MI_MYGMAP_DEBUG_MSG' ,
    'description'   => '_MI_MYGMAP_DEBUG_DESC' ,
    'formtype'      => 'yesno' ,
    'valuetype'     => 'int' ,
    'default'       => 0 ,
);

$modversion['blocks'][1]['file'] = 'NBFrameBlockLoader.php';
$modversion['blocks'][1]['name'] = 'Mini Map';
$modversion['blocks'][1]['description'] = '';
$modversion['blocks'][1]['show_func'] = NBFrame::getBlockShowFunction('MyGmapMiniMapBlock');
$modversion['blocks'][1]['edit_func'] = NBFrame::getBlockEditFunction('MyGmapMiniMapBlock');
$modversion['blocks'][1]['options'] = '1';
$modversion['blocks'][1] += NBFrame::setBlockTemplate('block_minimap.html');
$modversion['blocks'][1]['can_clone'] = true ;

// On Update Pre Process
NBFrame::executePreUpdateProcess($modversion);
?>
