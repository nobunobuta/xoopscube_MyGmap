<?php
if (!defined('MYGMAP_LANGUAGE_MODINFO_READ')) {
define ('MYGMAP_LANGUAGE_MODINFO_READ','1');
// Module Info

// Config titles
define("_MI_MYGMAP_API_MSG","Google Maps APIからもらえるキー");
define("_MI_MYGMAP_API_DESC","<a href=\"http://www.google.com/apis/maps/signup.html\" target=\"_blank\">Google Maps API - Sign up</a>からもらえるソースの<br />key =xxxxxxx\"のxxxxxxx部分のみを記述して下さい。<br />Sign up時のURLは、".XOOPS_URL." 又は".XOOPS_URL."/modules/mygmap/ を指定して<br />キーを取得して下さい。");
define("_MI_MYGMAP_CAT_MSG","初期表示するカテゴリーID");
define("_MI_MYGMAP_CAT_DESC","初期表示地図のカテゴリーIDを指定して下さい。<br />0に指定した場合には、以下の緯度・経度・拡大率が有効になります。<br />
                              -1に指定した場合には、すべてのカテゴリーのマーカーが表示されます。");
define("_MI_MYGMAP_LAT_MSG","初期表示地図の緯度");
define("_MI_MYGMAP_LAT_DESC","初期表示地図の緯度を北緯で指定して下さい。");
define("_MI_MYGMAP_LNG_MSG","初期表示地図の経度");
define("_MI_MYGMAP_LNG_DESC","初期表示地図の経度を東経で指定して下さい。<br />米国などの地図表示時の西経はマイナス数字になります。");
define("_MI_MYGMAP_ZOOM_MSG","初期表示地図の拡大率");
define("_MI_MYGMAP_ZOOM_DESC","拡大率を 0(最大倍率)〜19で指定して下さい。");
define("_MI_MYGMAP_MAPTYPE_MSG","初期表示の地図タイプ");
define("_MI_MYGMAP_MAPTYPE_DESC","地図・サテライト・ハイブリッドから選択出来ます");
define("_MI_MYGMAP_MAPTYPE_OPT1","地図");
define("_MI_MYGMAP_MAPTYPE_OPT2","サテライト");
define("_MI_MYGMAP_MAPTYPE_OPT3","ハイブリッド");
define("_MI_MYGMAP_INFOPOP_MSG","一覧からマーカーを選択したときに情報ウィンドウをポップアップする");
define("_MI_MYGMAP_INFOPOP_DESC","");
define("_MI_MYGMAP_SEARCH_MSG","住所・駅検索機能を使用");
define("_MI_MYGMAP_SEARCH_DESC","<a href=\"http://pc035.tkl.iis.u-tokyo.ac.jp/~sagara/geocode/index.php\" target=\"_blank\">CSISシンプルジオコーディング実験</a>を使用した、住所検索機能を使用します。<br />当機能を使用する場合には、<a href=\"http://www.tkl.iis.u-tokyo.ac.jp/~sagara/geocode/simple_condition.html\" target=\"_blank\">「CSISシンプルジオコーディング実験 参加規約」</a>を参照して条件を承諾する必要があります。<br /><br />なお、当実験で本実験で位置参照情報として利用している元データは一部にかなり古いものが含まれており、最近開通した鉄道の駅名は検索できません。");
define("_MI_MYGMAP_INVGEO_MSG","地図表示位置の住所表示機能を使用");
define("_MI_MYGMAP_INVGEO_DESC","<a href=\"http://wiki.knya.net/wiki.cgi?page=invgeocoder\" target=\"_blank\">InvGeoCoder</a>を使用して、表示されている地図の中心位置の住所を表示します。<br /><br />地図の拡大率によって表示の詳細度が変化します。");
define("_MI_MYGMAP_LINK_MSG","現在地図表示用のURLを表示");
define("_MI_MYGMAP_LINK_DESC","");
define("_MI_MYGMAP_WIKI_MSG","現在地図表示用のWIKIタグを生成");
define("_MI_MYGMAP_WIKI_DESC","別途<a href=\"http://apap.co4.jp/modules/mydownloads/singlefile.php?cid=7&lid=51\" target=\"_blank\">サイトパック</a>が必要です<br/>
                               pluginsフォルダーからmyGmapPluginFgmap.jsと<br/>
                               myGmapPluginFgmap.htmlを削除するとこのオプションに関係なく表示されなくなります。");
define("_MI_MYGMAP_BLOG_MSG","現在地図表示用のBlogタグを生成");
define("_MI_MYGMAP_BLOG_DESC","別途<a href=\"http://apap.co4.jp/modules/mydownloads/singlefile.php?cid=7&lid=51\" target=\"_blank\">サイトパック</a>が必要です<br/>
                               pluginsフォルダーからmyGmapPluginFgmap.jsと<br/>
                               myGmapPluginFgmap.htmlを削除するとこのオプションに関係なく表示されなくなります。");
define("_MI_MYGMAP_WIDTH_MSG","地図の表示幅");
define("_MI_MYGMAP_WIDTH_DESC","単位：px(ピクセル)にて指定して下さい。");
define("_MI_MYGMAP_HEIGHT_MSG","地図の表示高さ");
define("_MI_MYGMAP_HEIGHT_DESC","単位：px(ピクセル)にて指定して下さい。");
define("_MI_MYGMAP_TEXT1_MSG","初期表示地図の吹き出しに表示する文字");
define("_MI_MYGMAP_TEXT1_DESC","XOOPSのBBcodeにて記述して下さい。");
define("_MI_MYGMAP_TEXT1_DEFAULT","[b]尾道は、ココ！[/b]");
define("_MI_MYGMAP_TEXT2_MSG","任意表示地図の吹き出しに表示する文字");
define("_MI_MYGMAP_TEXT2_DESC","URLのパラメータで位置していた時の<br/>吹き出しに表示する文字を、<br/>XOOPSのBBcodeにて記述して下さい。");
define("_MI_MYGMAP_TEXT2_DEFAULT","[b]ココですよ！[/b]");
define("_MI_MYGMAP_SETDEF_SHOW_MSG","「ここをデフォルトに変更」ボタンを表示");
define("_MI_MYGMAP_SETDEF_SHOW_DESC","管理者が初期表示用の地図を簡単に指定できる様に<br />管理者権限ユーザに対して「ここをデフォルトに変更」ボタンを表示します。<br />（初期設定完了後は、「いいえ」にすることをお奨めします）");
define("_MI_MYGMAP_DEBUG_MSG","デバッグメッセージを出力する");
define("_MI_MYGMAP_DEBUG_DESC","基本的には、作者(NobuNobu)専用のオプションです。<br />Ajax呼出などを一部トレース出力します。");

define("_MI_MYGMAP_Z_OPT0","0");
define("_MI_MYGMAP_Z_OPT1","1");
define("_MI_MYGMAP_Z_OPT2","2");
define("_MI_MYGMAP_Z_OPT3","3");
define("_MI_MYGMAP_Z_OPT4","4");
define("_MI_MYGMAP_Z_OPT5","5");
define("_MI_MYGMAP_Z_OPT6","6");
define("_MI_MYGMAP_Z_OPT7","7");
define("_MI_MYGMAP_Z_OPT8","8");
define("_MI_MYGMAP_Z_OPT9","9");
define("_MI_MYGMAP_Z_OPT10","10");
define("_MI_MYGMAP_Z_OPT11","11");
define("_MI_MYGMAP_Z_OPT12","12");
define("_MI_MYGMAP_Z_OPT13","13");
define("_MI_MYGMAP_Z_OPT14","14");
define("_MI_MYGMAP_Z_OPT15","15");
define("_MI_MYGMAP_Z_OPT16","16");
define("_MI_MYGMAP_Z_OPT17","17");
define("_MI_MYGMAP_Z_OPT18","18");
define("_MI_MYGMAP_Z_OPT19","19");

define('_MI_MYGMAP_AD_MENU0','カテゴリー管理');
define('_MI_MYGMAP_AD_MENU1','マーカー管理');
define('_MI_MYGMAP_AD_MENU2','表示エリア管理');
}
?>
