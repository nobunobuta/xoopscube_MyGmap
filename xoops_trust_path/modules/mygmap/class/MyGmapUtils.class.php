<?php
if (!class_exists('MyGmapUtils')) {
    class MyGmapUtils {
        function getPluginFiles($dirname, $ext, $asArray=false) {
            $files = array();
            $dir = XOOPS_ROOT_PATH.'/modules/'.$dirname.'/plugins/';
            if(is_dir($dir)) {
                $files1 = glob($dir.'myGmapPlugin*.'.$ext);
                if (is_array($files1)) {
                    if ($asArray) {
                        $files1 = MyGmapUtils::_divideFile($files1, 'module');
                    }
                    $files = array_merge($files, $files1);
                }
            }
            if (defined('XOOPS_TRUST_PATH')) {
                $dir = XOOPS_TRUST_PATH.'/modules/mygmap/plugins/';
                if(is_dir($dir)) {
                    $files1 = glob($dir.'myGmapPlugin*.'.$ext);
                    if (is_array($files1)) {
                        if ($asArray) {
                            $files1 = MyGmapUtils::_divideFile($files1, 'trust');
                        }
                        $files = array_merge($files, $files1);
                    }
                }
            }
            $dir = XOOPS_ROOT_PATH.'/common/modules/mygmap/plugins/';
            if(is_dir($dir)) {
                $files1 = glob($dir.'myGmapPlugin*.'.$ext);
                if (is_array($files1)) {
                    if ($asArray) {
                        $files1 = MyGmapUtils::_divideFile($files1, 'common');
                    }
                    $files = array_merge($files, $files1);
                }
            }
            
            return $files;
        }
        
        function _divideFile($files, $place) {
            $files1 = array();
            foreach($files as $file) {
                $files1[] = array('name'=>basename($file), 'place'=>$place);
            }
            return $files1;
        }
    }
}
?>
