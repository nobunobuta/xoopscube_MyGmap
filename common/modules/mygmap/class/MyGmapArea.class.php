<?php
if( ! class_exists( 'MyGmapArea' ) ) {
    class MyGmapArea extends NBFrameObject
    {
        function MyGmapArea() {
            $this->NBFrameObject();

            $this->initVar('mygmap_area_id', XOBJ_DTYPE_INT, 0, true);
            $this->initVar('mygmap_area_name', XOBJ_DTYPE_TXTBOX, '', true, 255);
            $this->initVar('mygmap_area_desc', XOBJ_DTYPE_TXTAREA, null, false);
            $this->initVar('mygmap_area_lat', XOBJ_DTYPE_FLOAT, 0, true);
            $this->initVar('mygmap_area_lng', XOBJ_DTYPE_FLOAT, 0, true);
            $this->initVar('mygmap_area_zoom', XOBJ_DTYPE_INT, 0, true);
            $this->initVar('mygmap_area_order', XOBJ_DTYPE_INT, 0, false);
            $this->initVar('mygmap_area_maptype', XOBJ_DTYPE_INT, 0, false);

            $this->setAttribute('dohtml', 0);
            $this->setAttribute('doxcode', 1);
            $this->setAttribute('dosmiley', 1);
            $this->setAttribute('doimage', 1);
            $this->setAttribute('dobr', 1);

            $this->setKeyFields(array('mygmap_area_id'));
            $this->setNameField('mygmap_area_name');

            $this->setAutoIncrementField('mygmap_area_id');
        }

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
        var $tableName = 'area';
    }
}
?>