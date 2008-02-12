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
if (!class_exists('MyGmapLoadJsciptAction')) {
    NBFrame::using('Action');
    class MyGmapLoadJsciptAction extends NBFrameAction {
        var $mLoadCommon = false;
        function prepare() {
            $this->mAllowedOp =array('default','load','plugin');
        }
        function executeDefaultOp() {
            error_reporting(E_ERROR);
            NBFrame::using('MyGmapUtils', $this->mEnvironment);
            header('Content-type: application/x-javascript;charset="EUC-JP"');
            echo "if (mygmap_js_src == undefined) {\n";
            echo "  var mygmap_map;\n";
            echo "  var mygmap_js_src = \"http://maps.google.co.jp/maps?file=api&amp;v=2.x&amp;key=\" + mygmap_API;\n";
            echo "  document.write('<'+'script src=\"'+mygmap_js_src+'\"'+' type=\"text/javascript\" charset=\"utf-8\"><'+'/script>');\n";
            echo "\n";
            echo "  mygmap_js_src = mygmappath + \"?action=MyGmapLoadJscipt&op=load\";\n";
            echo "  document.write('<'+'script src=\"'+mygmap_js_src+'\"'+' type=\"text/javascript\"><'+'/script>');\n";
            echo "\n";
            foreach(MyGmapUtils::getPluginFiles($this->mEnvironment->mDirName, 'js', true) as $file) {
                echo "  mygmap_plugin_js_src = mygmappath + \"?action=MyGmapLoadJscipt&op=plugin&file=". $file['name']."&place=".$file['place']."\";\n";
                echo "  document.write('<'+'script src=\"'+mygmap_plugin_js_src+'\"'+' type=\"text/javascript\"><'+'/script>');\n";
            }
            echo "  var iconpath = mygmappath + '?action=NBFrame.GetImage&file=';\n";            echo "\n";
            echo "  var myGmapMiniMaps = new Array();\n";
            echo "  var myGmapMiniMap_idx = 0;\n";
            echo "}\n";
        }
        
        function executeLoadOp() {
            $fileName = $this->mEnvironment->findFile('mygmap.js', 'js', false, '=');
            if (!empty($fileName)) {
                NBFrame::using('HTTPOutput');
                NBFrameHTTPOutput::putFile($fileName, 'application/x-javascript;charset="EUC-JP"');
            }
        }

        function executePluginOp() {
            $fileName = basename($_GET['file']);
            $place =  basename($_GET['place']);
            switch ($place) {
                case 'module' :
                    $fileName = XOOPS_ROOT_PATH.'/modules/'.$this->mEnvironment->mDirName.'/plugins/'. $fileName;
                    break;
                case 'trust' :
                    $fileName = XOOPS_TRUST_PATH.'/modules/mygmap/plugins/'. $fileName;
                    break;
                default :
                    $fileName = '';
            }
            if (!empty($fileName)) {
                NBFrame::using('HTTPOutput');
                NBFrameHTTPOutput::putFile($fileName, 'application/x-javascript;charset="EUC-JP"');
            }
        }
    }
}
?>
