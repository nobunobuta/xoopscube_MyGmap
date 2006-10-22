<?php
if( ! class_exists( 'MyGmapMarker' ) ) {
    class MyGmapMarker extends NBFrameObject
    {
        function MyGmapMarker() {

            $this->NBFrameObject();

            $this->initVar('mygmap_marker_id', XOBJ_DTYPE_INT, 0, true);
            $this->initVar('mygmap_marker_category_id', XOBJ_DTYPE_INT, 0, true);
            $this->initVar('mygmap_marker_title', XOBJ_DTYPE_TXTBOX, '', true, 255);
            $this->initVar('mygmap_marker_desc', XOBJ_DTYPE_TXTAREA, null, false);
            $this->initVar('mygmap_marker_icontext', XOBJ_DTYPE_TXTBOX, '', false, 2);
            $this->initVar('mygmap_marker_lat', XOBJ_DTYPE_FLOAT, 0, true);
            $this->initVar('mygmap_marker_lng', XOBJ_DTYPE_FLOAT, 0, true);
            $this->initVar('mygmap_marker_zoom', XOBJ_DTYPE_INT, 0, true);
            $this->initVar('mygmap_marker_uid', XOBJ_DTYPE_INT, 0, true);
            $this->initVar('mygmap_marker_maptype', XOBJ_DTYPE_INT, 0, false);
            $this->initVar('mygmap_marker_updatetime', XOBJ_DTYPE_INT, false);

            $this->setAttribute('dohtml', 0);
            $this->setAttribute('doxcode', 1);
            $this->setAttribute('dosmiley', 1);
            $this->setAttribute('doimage', 1);
            $this->setAttribute('dobr', 1);

            $this->setKeyFields(array('mygmap_marker_id'));
            $this->setNameField('mygmap_marker_title');

            $this->setAutoIncrementField('mygmap_marker_id');
        }
        
        // Special Verifier
        
        function checkVar_mygmap_marker_lat($value) {
            if (($value <= 90) && ($value >= -90)) {
                return true;
            }
            $this->setErrors('Range Error at Lat (-90 <= Lat <= 90)');
            return false;
        }
        
        function checkVar_mygmap_marker_lng($value) {
            if (($value <= 180) && ($value >= -180)) {
                return true;
            }
            $this->setErrors('Range Error at Lng (-180 <= Lng <= 180)');
            return false;
        }

        function checkVar_mygmap_marker_zoom($value) {
            if (($value >= 0) && ($value <= 19)) {
                return true;
            }
            $this->setErrors('Range Error at Zoom (0 <= Zoom <= 19)');
            return false;
        }

        function checkVar_mygmap_marker_icontext($value) {
            if (array_key_exists(substr($value.' ',0,1), $this->mHandler->getIconListArray())){
                return true;
            }
            $this->setErrors('Range Error at ICON Text "'.$value.'" (Blank or A to J)');
            return false;
        }
        
        // Special Permission Verifier

        function checkGroupPerm_mygmap_marker_category_id($value, $mode) {
            if ($mode=='write') {
                if (NBFrameCheckRight('markereditcat', $value)) {
                    return true;
                }
                $this->setErrors('Category Permission Error');
                return false;
            }
            return true;
        }
    }

    class MyGmapMarkerHandler  extends NBFrameObjectHandler
    {
        var $mTableName = 'marker';

        function getIconListArray() {
            static $result = Array();
            if ($result) return $result;
            $alphalist = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $result[" "] = 'Blank';
            for($i=1; $i<=20; $i++) {
                $ch = sprintf("%02d",$i);
                $result["$i"] = "$i";
            }
            for($i=0; $i<26; $i++) {
                $ch = substr($alphalist, $i, 1);
                $result["$ch"] = "$ch";
            }
            return $result;
        }
        
        function insert(&$record,$force=false,$updateOnlyChanged=false) {
            $record->setVar('mygmap_marker_updatetime', time(), true);
            return parent::insert($record,$force,$updateOnlyChanged);
        }
        
        function getLastModified($criteria = null) {
            if (empty($criteria)) {
                $criteria = new Criteria(1, intNBCriteriaVal(1));
            }
            $criteria->setSort('mygmap_marker_updatetime');
            $criteria->setOrder('DESC');
            $_prevLimit = $criteria->getLimit();
            $criteria->setLimit(1);
            $markerObjects =& $this->getObjects($criteria, false, 'mygmap_marker_updatetime');
            $lastModified = $markerObjects[0]->getVar('mygmap_marker_updatetime');
            $criteria->setLimit($_prevLimit);

            return $lastModified;
        }
    }
}
?>