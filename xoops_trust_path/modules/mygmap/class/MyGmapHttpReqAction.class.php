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
if (!class_exists('MyGmapHttpReqAction')) {
    NBFrame::using('Action');
    class MyGmapHttpReqAction extends NBFrameAction {
        var $mLoadCommon = false;
        function executeDefaultOp() {
            error_reporting(E_ERROR);
            $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $_ENV['HTTP_REFERER'];
            if (!$referer) exit();
            if (strpos($referer, $this->getUrlBase())===false) exit();
            if (empty($_REQUEST['geoop'])) exit();
            include "../../class/snoopy.php";
            $snoopy=new Snoopy();
            //$snoopy->proxy_host='proxy.host.com';
            //$snoopy->proxy_port='8080';
            $snoopy->agent = 'XOOPS MyGmap Module';
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
        }
    }
}
?>
