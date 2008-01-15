<?php
if( ! class_exists( 'MyGmapCategory' ) ) {
    class MyGmapCategory extends NBFrameObject
    {

        function prepare() {
            $this->initVar('mygmap_category_id', XOBJ_DTYPE_INT, 0, true);
            $this->initVar('mygmap_category_name', XOBJ_DTYPE_TXTBOX, '', true, 255);
            $this->initVar('mygmap_category_desc', XOBJ_DTYPE_TXTAREA, null, false);
            $this->initVar('mygmap_category_lat', XOBJ_DTYPE_FLOAT, 0, true);
            $this->initVar('mygmap_category_lng', XOBJ_DTYPE_FLOAT, 0, true);
            $this->initVar('mygmap_category_zoom', XOBJ_DTYPE_INT, 0, true);
            $this->initVar('mygmap_category_maptype', XOBJ_DTYPE_INT, 0, false);
            $this->initVar('mygmap_category_updatetime', XOBJ_DTYPE_INT, 0, false);

            $this->setAttribute('dohtml', 0);
            $this->setAttribute('doxcode', 1);
            $this->setAttribute('dosmiley', 1);
            $this->setAttribute('doimage', 1);
            $this->setAttribute('dobr', 1);

            $this->setKeyFields(array('mygmap_category_id'));
            $this->setNameField('mygmap_category_name');

            $this->setAutoIncrementField('mygmap_category_id');
        }

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
            if (($value >= 0) && ($value <= 19)) {
                return true;
            }
            $this->setErrors('Range Error at Zoom (0 <= Zoom <= 19)');
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
        
        function insert(&$record,$force=false,$updateOnlyChanged=false) {
            $record->set('mygmap_category_updatetime', time());
            return parent::insert($record,$force,$updateOnlyChanged);
        }
        
        function getLastModified($criteria = null) {
            if (empty($criteria)) {
                $criteria = new Criteria(1, intNBCriteriaVal(1));
            }
            $criteria->setSort('mygmap_category_updatetime');
            $criteria->setOrder('DESC');
            $_prevLimit = $criteria->getLimit();
            $criteria->setLimit(1);
            $categoryObjects =& $this->getObjects($criteria, false, 'mygmap_category_updatetime');
            $lastModified = $categoryObjects[0]->getVar('mygmap_category_updatetime');
            $criteria->setLimit($_prevLimit);

            return $lastModified;
        }
    }
}
?>