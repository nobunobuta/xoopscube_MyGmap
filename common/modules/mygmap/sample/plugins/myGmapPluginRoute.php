<?php
class myGmapPluginRoute {
    function executeDefaultOp(&$controller) {
        if (isset($_GET['route'])) {
            $route = $_GET['route'];
            if(preg_match('/^[_-\d\.a-f]+$/',$route)) {
                $controller->mAttributes['mygmap_route'] = $route;
            }
        }
        if (isset($_GET['title'])) {
            $work_in = $_GET['title'];
            $work_out= "";
            for($i=0;$i<strlen($work_in);){
                if(substr($work_in,$i,1)=="%"){
                    if(substr($work_in,$i,2)=="%u"){
                        $work_out .= mb_convert_encoding(pack("H4",substr($work_in,$i+2,4)),"EUC-JP","UCS2");
                        $i+=6;
                    } else {
                        // ページがEUC-JPなので、ここでのmb_convert_encodingは不要
                        $work_out .= pack("H2",substr($work_in,$i+1,2));
                        $i+=3;
                    }
                } else {
                    $work_out .= substr($work_in,$i,1);
                    $i++;
                }
            }
            $controller->mAttributes['mygmap_pagetitle'] = $work_out;
        }   
    }

    function viewDefaultOp(&$controller) {
        $controller->mXoopsTpl->assign('mygmap_route', $controller->mAttributes['mygmap_route']);
        $controller->mXoopsTpl->assign('mygmap_pagetitle', $controller->mAttributes['mygmap_pagetitle']);
        $controller->mXoopsTpl->assign('xoops_pagetitle', "MyGmap/".$controller->mAttributes['mygmap_pagetitle']);
    }
}
?>