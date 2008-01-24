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
if (!class_exists('MyGmapCategoryAdminList')) {
    NBFrame::using('ObjectList');

    class MyGmapCategoryAdminList extends NBFrameObjectList
    {
        function prepare() {
            parent::prepare();

            $this->addElement('mygmap_category_id', '#', 20, array('sort'=>true));
            $this->addElement('mygmap_category_name', $this->__l('mygmap_category_name'), 300);
            $this->addElement('mygmap_category_maptype', $this->__l('mygmap_category_maptype'), 80, array('sort'=>true));
            $this->addElement('__SimpleEditLink__','',50, array('caption'=>$this->__l('Edit')));
            $this->addElement('__SimpleDeleteLink__','',50, array('caption'=>$this->__l('Delete')));
        }
        
        function formatItem_mygmap_category_maptype($value) {
            $optionArray = array('', $this->__l('MapType Map'),$this->__l('MapType Satelite'),$this->__l('Maptype_Hybrid'));
            return $optionArray[$value];
        }
    }
}
?>
