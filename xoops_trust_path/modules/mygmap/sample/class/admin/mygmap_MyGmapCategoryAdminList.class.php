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
if (!class_exists('mygmap_MyGmapCategoryAdminList')) {
    NBFrame::using('+admin.MyGmapCategoryAdminList', NBFrame::getEnvironments());

    class mygmap_MyGmapCategoryAdminList extends MyGmapCategoryAdminList
    {
        function prepare() {
            parent::prepare();
            $this->mElements['mygmap_category_id']['caption'] = 'Num';
        }
        
    }
}
?>
