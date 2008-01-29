<?php
/**
 *
 * @package MyGmap
 * @version $Id$
 * @copyright Copyright 2006-2008 NobuNobuXOOPS Project <http://sourceforge.net/projects/nobunobuxoops/>
 * @author NobuNobu <nobunobu@nobunobu.com>
 * @license http://www.gnu.org/licenses/gpl.txt GNU GENERAL PUBLIC LICENSE Version 2
 *
 */
if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'mygmap' ;
$constpref = NBFrame::langConstPrefix('', $mydirname);

if (defined( 'FOR_XOOPS_LANG_CHECKER' ) || !defined($constpref.'LANGUAGE_MAIN_READ')) {

define($constpref.'LANGUAGE_MAIN_READ','1');

define($constpref.'LANG_SET_DEFAULT','現在地をデフォルトに変更');
define($constpref.'LANG_NEW_CATEGORY','現在地をカテゴリー追加');
define($constpref.'LANG_NEW_POINT','現在地をマーカ追加');
define($constpref.'LANG_NEW_AREA','現在地をエリア追加');

define($constpref.'LANG_AREA','表示エリア');
define($constpref.'LANG_CATEGORY','カテゴリー');
define($constpref.'LANG_MARKER','マーカー');

define($constpref.'LANG_ALL_CATEGORIES','全て');

define($constpref.'LANG_TITLE','タイトル');
define($constpref.'LANG_DESCRIPTION','説明');
define($constpref.'LANG_ORDER','表示順');
define($constpref.'LANG_LAT','緯度');
define($constpref.'LANG_LNG','経度');
define($constpref.'LANG_ZOOM','縮尺');
define($constpref.'LANG_ICON','アイコン');
define($constpref.'LANG_OVERLAY','オーバーレイ');
define($constpref.'LANG_ADDRESS','住所');
define($constpref.'LANG_STATION','駅');
define($constpref.'LANG_MAPTYPE','モード');
define($constpref.'LANG_MAPTYPE_MAP','地図');
define($constpref.'LANG_MAPTYPE_SATELITE','サテライト');
define($constpref.'LANG_MAPTYPE_HYBRID','デュアル');
define($constpref.'LANG_MYGMAP_CATEGORY_ID', '#');
define($constpref.'LANG_MYGMAP_CATEGORY_NAME', 'カテゴリー名');
define($constpref.'LANG_MYGMAP_CATEGORY_DESC', '説明');
define($constpref.'LANG_MYGMAP_CATEGORY_LAT', '緯度');
define($constpref.'LANG_MYGMAP_CATEGORY_LNG', '経度');
define($constpref.'LANG_MYGMAP_CATEGORY_ZOOM', '縮尺');
define($constpref.'LANG_MYGMAP_CATEGORY_MAPTYPE', 'モード');
define($constpref.'LANG_MYGMAP_CATEGORY_OVERLAY', 'オーバーレイ');
define($constpref.'LANG_MYGMAP_AREA_ID', '#');
define($constpref.'LANG_MYGMAP_AREA_NAME', 'タイトル');
define($constpref.'LANG_MYGMAP_AREA_DESC', '説明');
define($constpref.'LANG_MYGMAP_AREA_LAT', '緯度');
define($constpref.'LANG_MYGMAP_AREA_LNG', '経度');
define($constpref.'LANG_MYGMAP_AREA_ZOOM', '縮尺');
define($constpref.'LANG_MYGMAP_AREA_ORDER', '表示順');
define($constpref.'LANG_MYGMAP_AREA_MAPTYPE', 'モード');
define($constpref.'LANG_MYGMAP_MARKER_ID', '#');
define($constpref.'LANG_MYGMAP_MARKER_CATEGORY_ID', 'カテゴリー');
define($constpref.'LANG_MYGMAP_MARKER_TITLE', 'タイトル');
define($constpref.'LANG_MYGMAP_MARKER_DESC', '説明');
define($constpref.'LANG_MYGMAP_MARKER_ICONTEXT', 'アイコン');
define($constpref.'LANG_MYGMAP_MARKER_LAT', '緯度');
define($constpref.'LANG_MYGMAP_MARKER_LNG', '経度');
define($constpref.'LANG_MYGMAP_MARKER_ZOOM', '縮尺');
define($constpref.'LANG_MYGMAP_MARKER_MAPTYPE', 'モード');
define($constpref.'LANG_PERM_CAN_READ', '閲覧権限');
define($constpref.'LANG_PERM_CAN_EDIT', '編集権限');

define($constpref.'LANG_GROUP_PERM_MARKER_EDIT', 'マーカーの登録編集権限');
define($constpref.'LANG_GROUP_PERM_CATEGORY_EDIT', 'カテゴリーの登録編集権限');
define($constpref.'LANG_GROUP_PERM_AREA_EDIT', 'エリアの登録編集権限');
}
?>
