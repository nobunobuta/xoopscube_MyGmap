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
$constpref = NBFrame::langConstPrefix('MI', $mydirname);

if (defined( 'FOR_XOOPS_LANG_CHECKER' ) || !defined($constpref.'LANGUAGE_MODINFO_READ')) {
define ($constpref.'LANGUAGE_MODINFO_READ','1');
// Module Info

// Config titles
define($constpref."API_MSG","Google Maps APIからもらえるキー");
define($constpref."API_DESC","<a href=\"http://www.google.com/apis/maps/signup.html\" target=\"_blank\">Google Maps API - Sign up</a>からもらえるソースの<br />key =xxxxxxx\"のxxxxxxx部分のみを記述して下さい。<br />Sign up時のURLは、".XOOPS_URL." 又は".XOOPS_URL."/modules/mygmap/ を指定して<br />キーを取得して下さい。");
define($constpref."CAT_MSG","初期表示するカテゴリーID");
define($constpref."CAT_DESC","初期表示地図のカテゴリーIDを指定して下さい。<br />0に指定した場合には、以下の緯度・経度・拡大率が有効になります。<br />
                              -1に指定した場合には、すべてのカテゴリーのマーカーが表示されます。");
define($constpref."LAT_MSG","初期表示地図の緯度");
define($constpref."LAT_DESC","初期表示地図の緯度を北緯で指定して下さい。");
define($constpref."LNG_MSG","初期表示地図の経度");
define($constpref."LNG_DESC","初期表示地図の経度を東経で指定して下さい。<br />米国などの地図表示時の西経はマイナス数字になります。");
define($constpref."ZOOM_MSG","初期表示地図の拡大率");
define($constpref."ZOOM_DESC","拡大率を 0(最大倍率)〜19で指定して下さい。");
define($constpref."MAPTYPE_MSG","初期表示の地図タイプ");
define($constpref."MAPTYPE_DESC","地図・サテライト・ハイブリッドから選択出来ます");
define($constpref."MAPTYPE_OPT1","地図");
define($constpref."MAPTYPE_OPT2","サテライト");
define($constpref."MAPTYPE_OPT3","ハイブリッド");
define($constpref."INFOPOP_MSG","一覧からマーカーを選択したときに情報ウィンドウをポップアップする");
define($constpref."INFOPOP_DESC","");
define($constpref."SEARCH_MSG","住所・駅検索機能を使用");
define($constpref."SEARCH_DESC","<a href=\"http://pc035.tkl.iis.u-tokyo.ac.jp/~sagara/geocode/index.php\" target=\"_blank\">CSISシンプルジオコーディング実験</a>を使用した、住所検索機能を使用します。<br />当機能を使用する場合には、<a href=\"http://www.tkl.iis.u-tokyo.ac.jp/~sagara/geocode/simple_condition.html\" target=\"_blank\">「CSISシンプルジオコーディング実験 参加規約」</a>を参照して条件を承諾する必要があります。<br /><br />なお、当実験で本実験で位置参照情報として利用している元データは一部にかなり古いものが含まれており、最近開通した鉄道の駅名は検索できません。");
define($constpref."INVGEO_MSG","地図表示位置の住所表示機能を使用");
define($constpref."INVGEO_DESC","<a href=\"http://wiki.knya.net/wiki.cgi?page=invgeocoder\" target=\"_blank\">InvGeoCoder</a>を使用して、表示されている地図の中心位置の住所を表示します。<br /><br />地図の拡大率によって表示の詳細度が変化します。");
define($constpref."LINK_MSG","現在地図表示用のURLを表示");
define($constpref."LINK_DESC","");
define($constpref."WIKI_MSG","現在地図表示用のWIKIタグを生成");
define($constpref."WIKI_DESC","別途<a href=\"http://apap.co4.jp/modules/mydownloads/singlefile.php?cid=7&lid=51\" target=\"_blank\">サイトパック</a>が必要です<br/>
                               pluginsフォルダーからmyGmapPluginFgmap.jsと<br/>
                               myGmapPluginFgmap.htmlを削除するとこのオプションに関係なく表示されなくなります。");
define($constpref."BLOG_MSG","現在地図表示用のBlogタグを生成");
define($constpref."BLOG_DESC","別途<a href=\"http://apap.co4.jp/modules/mydownloads/singlefile.php?cid=7&lid=51\" target=\"_blank\">サイトパック</a>が必要です<br/>
                               pluginsフォルダーからmyGmapPluginFgmap.jsと<br/>
                               myGmapPluginFgmap.htmlを削除するとこのオプションに関係なく表示されなくなります。");
define($constpref."WIDTH_MSG","地図の表示幅");
define($constpref."WIDTH_DESC","単位：px(ピクセル)にて指定して下さい。");
define($constpref."HEIGHT_MSG","地図の表示高さ");
define($constpref."HEIGHT_DESC","単位：px(ピクセル)にて指定して下さい。");
define($constpref."TEXT1_MSG","初期表示地図の吹き出しに表示する文字");
define($constpref."TEXT1_DESC","XOOPSのBBcodeにて記述して下さい。");
define($constpref."TEXT1_DEFAULT","[b]尾道は、ココ！[/b]");
define($constpref."TEXT2_MSG","任意表示地図の吹き出しに表示する文字");
define($constpref."TEXT2_DESC","URLのパラメータで位置していた時の<br/>吹き出しに表示する文字を、<br/>XOOPSのBBcodeにて記述して下さい。");
define($constpref."TEXT2_DEFAULT","[b]ココですよ！[/b]");
define($constpref."SETDEF_SHOW_MSG","「ここをデフォルトに変更」ボタンを表示");
define($constpref."SETDEF_SHOW_DESC","管理者が初期表示用の地図を簡単に指定できる様に<br />管理者権限ユーザに対して「ここをデフォルトに変更」ボタンを表示します。<br />（初期設定完了後は、「いいえ」にすることをお奨めします）");
define($constpref."DEBUG_MSG","デバッグメッセージを出力する");
define($constpref."DEBUG_DESC","基本的には、作者(NobuNobu)専用のオプションです。<br />Ajax呼出などを一部トレース出力します。");

define($constpref."Z_OPT0","0");
define($constpref."Z_OPT1","1");
define($constpref."Z_OPT2","2");
define($constpref."Z_OPT3","3");
define($constpref."Z_OPT4","4");
define($constpref."Z_OPT5","5");
define($constpref."Z_OPT6","6");
define($constpref."Z_OPT7","7");
define($constpref."Z_OPT8","8");
define($constpref."Z_OPT9","9");
define($constpref."Z_OPT10","10");
define($constpref."Z_OPT11","11");
define($constpref."Z_OPT12","12");
define($constpref."Z_OPT13","13");
define($constpref."Z_OPT14","14");
define($constpref."Z_OPT15","15");
define($constpref."Z_OPT16","16");
define($constpref."Z_OPT17","17");
define($constpref."Z_OPT18","18");
define($constpref."Z_OPT19","19");
define($constpref."Z_OPT20","20");
define($constpref."Z_OPT21","21");
define($constpref."Z_OPT22","22");
define($constpref."Z_OPT23","23");

define($constpref.'AD_MENU0','カテゴリー管理');
define($constpref.'AD_MENU1','マーカー管理');
define($constpref.'AD_MENU2','表示エリア管理');
}
?>
