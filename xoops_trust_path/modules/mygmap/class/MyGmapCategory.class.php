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
if( ! class_exists( 'MyGmapCategory' ) ) {
    class MyGmapCategory extends NBFrameObject
    {
        function prepare()
        {
            $this->setGroupPermAttrib('can_read');
            $this->setGroupPermAttrib('can_edit');
        }

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
        
        function checkGroupPerm($mode, $bypassAdminCheck=false) {
            $permArray= array('read'=>'can_read', 'write'=>'can_edit');
            if (in_array($mode, array_keys($permArray))) {
                if ($this->checkRight($permArray[$mode], $bypassAdminCheck)) {
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