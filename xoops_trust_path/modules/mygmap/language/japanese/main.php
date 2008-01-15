<?php
$constpref = NBFrame::langConstPrefix('', NBFRAME_TARGET_TEMP);
if (!defined($constpref.'LANGUAGE_MAIN_READ')) {
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
define($constpref.'LANG_LAT','経度');
define($constpref.'LANG_LNG','緯度');
define($constpref.'LANG_ZOOM','縮尺');
define($constpref.'LANG_ICON','アイコン');
define($constpref.'LANG_OVERLAY','オーバーレイ');
define($constpref.'LANG_ADDRESS','住所');
define($constpref.'LANG_STATION','駅');
define($constpref.'LANG_MAPTYPE','モード');
define($constpref.'LANG_MAPTYPE_MAP','地図');
define($constpref.'LANG_MAPTYPE_SATELITE','サテライト');
define($constpref.'LANG_MAPTYPE_HYBRID','デュアル');
}
?>