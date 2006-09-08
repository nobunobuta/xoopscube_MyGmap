<?php
$xoopsOption['nocommon'];
include "../../mainfile.php";
foreach (array('GLOBALS', '_SESSION', 'HTTP_SESSION_VARS', '_GET', 'HTTP_GET_VARS', '_POST', 'HTTP_POST_VARS', '_COOKIE', 'HTTP_COOKIE_VARS', '_REQUEST', '_SERVER', 'HTTP_SERVER_VARS', '_ENV', 'HTTP_ENV_VARS', '_FILES', 'HTTP_POST_FILES') as $bad_global) {
    if (isset($_REQUEST[$bad_global])) {
       exit();
    }
}
error_reporting(E_ERROR);
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $_ENV['HTTP_REFERER'];
if (!$referer) exit();
if (strpos($referer, XOOPS_URL.'/modules/mygmap')===false) exit();
if (empty($_REQUEST['geoop'])) exit();
include "../../class/snoopy.php";
$snoopy=new Snoopy();
//$snoopy->proxy_host='proxy.host.com';
//$snoopy->proxy_port='8080';
$snoopy->agent = 'XOOPS MyGmap';
$postArray = array();
if ($_REQUEST['geoop']=='csis') {
    $postArray['addr']= mb_convert_encoding(urldecode($_REQUEST['addr']), 'EUC-JP', 'auto');
    $postArray['series'] = $_REQUEST['series'];
    $postArray['geosys'] = 'world';
	$postArray['charset'] = 'x-euc-jp';
	$snoopy->submit("http://geocode.csis.u-tokyo.ac.jp/cgi-bin/simple_geocode.cgi",$postArray);
} else if ($_REQUEST['geoop']=='invgeo') {
    $postArray['lat'] = floatval($_REQUEST['lat']);
    $postArray['lon'] = floatval($_REQUEST['lon']);
    $postArray['format'] = 'simple';
	$snoopy->submit("http://nishioka.sakura.ne.jp/google/ws.php",$postArray);
}
header('Content-type: application/xml');
echo $snoopy->results;
?>
