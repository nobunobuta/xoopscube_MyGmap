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
if (!class_exists('MyGmapMarkerAdminForm')) {
    NBFrame::using('ObjectForm');

    class MyGmapMarkerAdminForm extends NBFrameObjectForm {
        function prepare() {
            $this->addElement('mygmap_marker_category_id',new XoopsFormSelect($this->__l('mygmap_marker_category_id'),'mygmap_marker_category_id'));
            $this->addElement('mygmap_marker_icontext',new XoopsFormSelect($this->__l('mygmap_marker_icontext'),'mygmap_marker_icontext'));
            $this->addElement('mygmap_marker_zoom',new XoopsFormSelect($this->__l('mygmap_marker_zoom'),'mygmap_marker_zoom'));
            $this->addElement('mygmap_marker_maptype',new XoopsFormSelect($this->__l('mygmap_marker_maptype'),'mygmap_marker_maptype'));
            
            $this->addObjectOptionArray('mygmap_marker_category_id','MyGmapCategory');

            $markerHandler =& NBFrame::getHandler('MyGmapMarker', $this->mEnvironment);            $this->addOptionArray('mygmap_marker_icontext', $markerHandler->getIconListArray());

            $this->addOptionArray('mygmap_marker_zoom',array(
                '0' =>'0' , '1' =>'1' , '2' =>'2' , '3' =>'3' , '4' =>'4' , '5' =>'5' ,
                '6' =>'6' , '7' =>'7' , '8' =>'8' , '9' =>'9' , '10' =>'10' , '11' =>'11' ,
                '12' =>'12' , '13' =>'13' , '14' =>'14' , '15' =>'15' , '16' =>'16' , '17' =>'17' ,
                '18' =>'18' , '19' =>'19' , '20' =>'20' , '21' =>'21' , '22' =>'22' , '23' =>'23' ,
                '24' =>'24' ,
            ));
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
