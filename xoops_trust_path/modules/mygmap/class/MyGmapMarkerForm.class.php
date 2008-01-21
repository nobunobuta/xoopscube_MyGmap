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
if (!class_exists('MyGmapMarkerForm')) {
    NBFrame::using('ObjectForm');

    class MyGmapMarkerForm extends NBFrameObjectForm {
        function prepare() {
            $this->addElement('mygmap_marker_id',new XoopsFormHidden('mygmap_marker_id',0));
            $this->addElement('mygmap_marker_category_id',new XoopsFormSelect($this->__l('mygmap_marker_category_id'),'mygmap_marker_category_id'));
            $this->addElement('mygmap_marker_title',new XoopsFormText($this->__l('mygmap_marker_title'),'mygmap_marker_title',35,255));
            $this->addElement('mygmap_marker_desc', new XoopsFormDhtmlTextArea($this->__l('mygmap_marker_desc'),'mygmap_marker_desc','',8,25));
            $this->addElement('mygmap_marker_icontext',new XoopsFormSelect($this->__l('mygmap_marker_icontext'),'mygmap_marker_icontext'));
            $this->addElement('mygmap_marker_maptype',new XoopsFormSelect($this->__l('mygmap_marker_maptype'),'mygmap_marker_maptype'));
            $this->addElement('mygmap_marker_lat',new XoopsFormHidden('mygmap_marker_lat',0));
            $this->addElement('mygmap_marker_lng',new XoopsFormHidden('mygmap_marker_lng',0));
            $this->addElement('mygmap_marker_zoom',new XoopsFormHidden('mygmap_marker_zoom',0));
            
            $categoryHandler =& NBFrame::getHandler('MyGmapCategory', $this->mEnvironment);
            $this->addOptionArray('mygmap_marker_category_id',$categoryHandler->getSelectOptionArray(null, 'markereditlist'));
            $markerHandler =& NBFrame::getHandler('MyGmapmarker', $this->mEnvironment);
            $this->addOptionArray('mygmap_marker_icontext', $markerHandler->getIconListArray());
            $this->addOptionArray('mygmap_marker_maptype',array(
                '0' =>'----' ,
                '1' =>$this->__l('Maptype Map') ,
                '2' =>$this->__l('Maptype Satelite') ,
                '3' =>$this->__l('Maptype Hybrid'),
            ));
        }
    }
}
?>
