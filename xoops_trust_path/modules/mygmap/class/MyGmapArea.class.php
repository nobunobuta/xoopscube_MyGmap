<?php
if( ! class_exists( 'MyGmapArea' ) ) {
    class MyGmapArea extends NBFrameObject
    {
        // Special Verifier
        
        function checkVar_mygmap_area_lat($value) {
            if (($value <= 90) && ($value >= -90)) {
                return true;
            }
            $this->setErrors('Range Error at Lat (-90 <= Lat <= 90)');
            return false;
        }
        
        function checkVar_mygmap_area_lng($value) {
            if (($value <= 180) && ($value >= -180)) {
                return true;
            }
            $this->setErrors('Range Error at Lng (-180 <= Lng <= 180)');
            return false;
        }

        function checkVar_mygmap_area_zoom($value) {
            if (($value >= 0) && ($value <= 19)) {
                return true;
            }
            $this->setErrors('Range Error at Zoom (0 <= Zoom <= 19)');
            return false;
        }
    }

    class MyGmapAreaHandler extends NBFrameObjectHandler
    {
        var $mTableName = 'area';
    }
}
?>