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
if (!class_exists('MyGmapAreaForm')) {
    NBFrame::using('ObjectForm');

    class MyGmapAreaForm extends NBFrameObjectForm {
        function prepare() {
            $this->addElement('mygmap_area_id',new XoopsFormHidden('mygmap_area_id', 0));
            $this->addElement('mygmap_area_name',new XoopsFormText($this->__l('mygmap_area_name'), 'mygmap_area_name', 35, 255));
            $this->addElement('mygmap_area_desc',new XoopsFormDhtmlTextArea($this->__l('mygmap_area_desc'), 'mygmap_area_desc', '', 8, 25));
            $this->addElement('mygmap_area_lat',new XoopsFormHidden('mygmap_area_lat', 0));
            $this->addElement('mygmap_area_lng',new XoopsFormHidden('mygmap_area_lng', 0));
            $this->addElement('mygmap_area_zoom',new XoopsFormHidden('mygmap_area_zoom', 0));
            $this->addElement('mygmap_area_order',new XoopsFormText($this->__l('mygmap_area_order'), 'mygmap_area_order', 0, 5));
            $this->addElement('mygmap_area_maptype',new XoopsFormSelect($this->__l('mygmap_area_maptype'),'mygmap_area_maptype'));

            $this->addOptionArray('mygmap_area_maptype',array(
                '0' =>'----' ,
                '1' =>$this->__l('Maptype Map') ,
                '2' =>$this->__l('Maptype Satelite') ,
                '3' =>$this->__l('Maptype Hybrid'),
            ));
        }
    }
}
?>
