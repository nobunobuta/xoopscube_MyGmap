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
if (!class_exists('MyGmapAreaAdminList')) {
    NBFrame::using('ObjectList');

    class MyGmapAreaAdminList extends NBFrameObjectList
    {
        function prepare() {
            $this->addElement('mygmap_area_id', '#', 20, array('sort'=>true));
            $this->addElement('mygmap_area_name',  $this->__l('mygmap_area_name'), 300);
            $this->addElement('mygmap_area_order', $this->__l('mygmap_area_order'), 50, array('sort'=>true));
            $this->addElement('mygmap_area_maptype', $this->__l('mygmap_area_maptype'), 80, array('sort'=>true));
            $this->addElement('__SimpleEditLink__','',50, array('caption'=>$this->__l('Edit')));
            $this->addElement('__SimpleDeleteLink__','',50, array('caption'=>$this->__l('Delete')));
        }
        function formatItem_mygmap_area_maptype($value) {
            $optionArray = array('', $this->__l('Maptype Map'),$this->__l('Maptype Satelite'),$this->__l('Maptype Hybrid'));
            return $optionArray[$value];
        }
    }
}
?>
