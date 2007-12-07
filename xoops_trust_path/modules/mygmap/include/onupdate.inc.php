<?php
if (!function_exists('update_mygmap')){
    function update_mygmap(&$installHelper, &$module, $prevVer) {
        global $xoopsDB;
        $dirname = $installHelper->mDirName;
        $installHelper->addMsg('Start Updateing for Mygmap New Version Data Tables');
        if (!$xoopsDB->getRowsNum($xoopsDB->query("SHOW COLUMNS FROM ".$xoopsDB->prefix($dirname.'_marker')." LIKE 'mygmap_marker_maptype'"))) {
            $sql1 = "ALTER TABLE ".$xoopsDB->prefix($dirname.'_marker')." ADD (
                        mygmap_marker_maptype int(5) NOT NULL default 0,
                        mygmap_marker_tmp double(20,15) NOT NULL default 0.000000000000000
                    )";
            $xoopsDB->query($sql1);

            $xoopsDB->query("UPDATE ".$xoopsDB->prefix($dirname.'_marker')." SET mygmap_marker_tmp=mygmap_marker_lng, mygmap_marker_lng=mygmap_marker_lat, mygmap_marker_lat=mygmap_marker_tmp, mygmap_marker_zoom=17-mygmap_marker_zoom");

            $sql1 = "ALTER TABLE ".$xoopsDB->prefix($dirname.'_marker')." DROP mygmap_marker_tmp";
            $xoopsDB->query($sql1);

            $sql1 = "ALTER TABLE ".$xoopsDB->prefix($dirname.'_marker')."
                     MODIFY COLUMN `mygmap_marker_lat` DOUBLE(14,9) NOT NULL DEFAULT 0.000000000,
                     MODIFY COLUMN `mygmap_marker_lng` DOUBLE(14,9) NOT NULL DEFAULT 0.000000000
                    ";
            $xoopsDB->query($sql1);

            $GLOBALS['msgs'][] = "TABLE ".$xoopsDB->prefix($dirname.'_marker')." is modified.";

            $config_lat = NBFrameGetModuleConfig($dirname, 'mygmap_lat');
            $config_lng = NBFrameGetModuleConfig($dirname, 'mygmap_lng');
            NBFrameSetModuleConfig($dirname, 'mygmap_lat', $config_lng);
            NBFrameSetModuleConfig($dirname, 'mygmap_lng', $config_lat);
        }
        if (!$xoopsDB->getRowsNum($xoopsDB->query("SHOW COLUMNS FROM ".$xoopsDB->prefix($dirname.'_marker')." LIKE 'mygmap_marker_updatetime'"))) {
            $sql1 = "ALTER TABLE ".$xoopsDB->prefix($dirname.'_marker')." ADD (
                        mygmap_marker_updatetime int(10) NOT NULL default 0,
                        KEY mygmap_marker_updatetime_key (mygmap_marker_updatetime)
                    )";
            $xoopsDB->query($sql1);
        }
        if (!$xoopsDB->getRowsNum($xoopsDB->query("SHOW COLUMNS FROM ".$xoopsDB->prefix($dirname.'_area')." LIKE 'mygmap_area_maptype'"))) {

            $sql1 = "ALTER TABLE ".$xoopsDB->prefix($dirname.'_area')." ADD (
                        mygmap_area_maptype int(5) NOT NULL default 0,
                        mygmap_area_tmp double(20,15) NOT NULL default 0.000000000000000
                    )";
            $xoopsDB->query($sql1);

            $xoopsDB->query("UPDATE ".$xoopsDB->prefix($dirname.'_area')." SET mygmap_area_tmp=mygmap_area_lng, mygmap_area_lng=mygmap_area_lat, mygmap_area_lat=mygmap_area_tmp, mygmap_area_zoom=17-mygmap_area_zoom");

            $sql1 = "ALTER TABLE ".$xoopsDB->prefix($dirname.'_area')." DROP mygmap_area_tmp";
            $xoopsDB->query($sql1);

            $sql1 = "ALTER TABLE ".$xoopsDB->prefix($dirname.'_area')."
                     MODIFY COLUMN `mygmap_area_lat` DOUBLE(14,9) NOT NULL DEFAULT 0.000000000,
                     MODIFY COLUMN `mygmap_area_lng` DOUBLE(14,9) NOT NULL DEFAULT 0.000000000
                    ";
            $xoopsDB->query($sql1);

            $GLOBALS['msgs'][] = "TABLE ".$xoopsDB->prefix($dirname.'_area')." is modified.";
        }
        if (!$xoopsDB->getRowsNum($xoopsDB->query("SHOW COLUMNS FROM ".$xoopsDB->prefix($dirname.'_area')." LIKE 'mygmap_area_updatetime'"))) {
            $sql1 = "ALTER TABLE ".$xoopsDB->prefix($dirname.'_area')." ADD (
                        mygmap_area_updatetime int(10) NOT NULL default 0,
                        KEY mygmap_area_updatetime_key (mygmap_area_updatetime)
                    )";
            $xoopsDB->query($sql1);
        }
        if (!$xoopsDB->getRowsNum($xoopsDB->query("SHOW COLUMNS FROM ".$xoopsDB->prefix($dirname.'_category')." LIKE 'mygmap_category_maptype'"))) {
            $sql1 = "ALTER TABLE ".$xoopsDB->prefix($dirname.'_category')." ADD (
                        mygmap_category_maptype int(5) NOT NULL default 0,
                        mygmap_category_tmp double(20,15) NOT NULL default 0.000000000000000
                    )";
            $xoopsDB->query($sql1);

            $xoopsDB->query("UPDATE ".$xoopsDB->prefix($dirname.'_category')." SET mygmap_category_tmp=mygmap_category_lng, mygmap_category_lng=mygmap_category_lat, mygmap_category_lat=mygmap_category_tmp, mygmap_category_zoom=17-mygmap_category_zoom");

            $sql1 = "ALTER TABLE ".$xoopsDB->prefix($dirname.'_category')." DROP mygmap_category_tmp";
            $xoopsDB->query($sql1);

            $sql1 = "ALTER TABLE ".$xoopsDB->prefix($dirname.'_category')."
                     MODIFY COLUMN `mygmap_category_lat` DOUBLE(14,9) NOT NULL DEFAULT 0.000000000,
                     MODIFY COLUMN `mygmap_category_lng` DOUBLE(14,9) NOT NULL DEFAULT 0.000000000
                    ";
            $xoopsDB->query($sql1);

            $GLOBALS['msgs'][] = "TABLE ".$xoopsDB->prefix($dirname.'_category')." is modified.";
        }
        if (!$xoopsDB->getRowsNum($xoopsDB->query("SHOW COLUMNS FROM ".$xoopsDB->prefix($dirname.'_category')." LIKE 'mygmap_category_updatetime'"))) {
            $sql1 = "ALTER TABLE ".$xoopsDB->prefix($dirname.'_category')." ADD (
                        mygmap_category_updatetime int(10) NOT NULL default 0,
                        KEY mygmap_category_updatetime_key (mygmap_category_updatetime)
                    )";
            $xoopsDB->query($sql1);
        }
        return true;
    }
}
?>