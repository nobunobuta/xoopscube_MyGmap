<?php
if( ! class_exists( 'MyGmapMarker' ) ) {
    class MyGmapMarker extends NBFrameObject
    {
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
            if (($value >= 0) && ($value <= 24)) {
                return true;
            }
            $this->setErrors('Range Error at Zoom (0 <= Zoom <= 24)');
            return false;
        }

        function checkVar_mygmap_marker_icontext($value) {
            if (array_key_exists(substr($value.' ',0,1), $this->mHandler->getIconListArray())){
                return true;
            }
            $this->setErrors('Range Error at ICON Text "'.$value.'" (Blank or 1 to 20 or A to Z)');
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
    }
}
?>