<?php
if( ! class_exists( 'MyGmapCategory' ) ) {
    class MyGmapCategory extends NBFrameObject
    {
        // Special Verifier
        
        function checkVar_mygmap_category_lat($value) {
            if (($value <= 90) && ($value >= -90)) {
                return true;
            }
            $this->setErrors('Range Error at Lat (-90 <= Lat <= 90)');
            return false;
        }
        
        function checkVar_mygmap_category_lng($value) {
            if (($value <= 180) && ($value >= -180)) {
                return true;
            }
            $this->setErrors('Range Error at Lng (-180 <= Lng <= 180)');
            return false;
        }

        function checkVar_mygmap_category_zoom($value) {
            if (($value >= 0) && ($value <= 24)) {
                return true;
            }
            $this->setErrors('Range Error at Zoom (0 <= Zoom <= 24)');
            return false;
        }
        // Special Permission Verifier

        function checkGroupPerm_mygmap_category_id($value, $mode) {
            if ($mode == 'markereditlist') {
                if (NBFrameCheckRight('markereditcat', $value)) {
                    return true;
                }
                $this->setErrors('Category Permission Error');
                return false;
            }
            return true;
        }
    }

    class MyGmapCategoryHandler  extends NBFrameObjectHandler
    {
        var $mTableName = 'category';
    }
}
?>