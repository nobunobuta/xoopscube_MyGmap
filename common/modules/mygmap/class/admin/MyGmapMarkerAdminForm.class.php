<?php
if (!class_exists('MyGmapMarkerAdminForm')) {
    NBFrame::using('ObjectForm');

    class MyGmapMarkerAdminForm extends NBFrameObjectForm {
        function prepare() {
            $this->addElement('mygmap_marker_id',new XoopsFormHidden('mygmap_marker_id',0));
            $this->addElement('mygmap_marker_category_id',new XoopsFormSelect(_AD_MYGMAP_LANG_CATEGORY,'mygmap_marker_category_id'));
            $this->addElement('mygmap_marker_title',new XoopsFormText(_AD_MYGMAP_LANG_TITLE,'mygmap_marker_title',50,255));
            $this->addElement('mygmap_marker_desc', new XoopsFormDhtmlTextArea(_AD_MYGMAP_LANG_DESCRIPTION,'mygmap_marker_desc',''));
            $this->addElement('mygmap_marker_icontext',new XoopsFormSelect(_AD_MYGMAP_LANG_ICON,'mygmap_marker_icontext'));
            $this->addElement('mygmap_marker_lat',new XoopsFormText(_AD_MYGMAP_LANG_LAT,'mygmap_marker_lat',25,22));
            $this->addElement('mygmap_marker_lng',new XoopsFormText(_AD_MYGMAP_LANG_LNG,'mygmap_marker_lng',25,22));
            $this->addElement('mygmap_marker_zoom',new XoopsFormSelect(_AD_MYGMAP_LANG_ZOOM,'mygmap_marker_zoom'));
            $this->addElement('mygmap_marker_maptype',new XoopsFormSelect(_AD_MYGMAP_LANG_MAPTYPE,'mygmap_marker_maptype'));
            
            $categoryHandler =& NBFrame::getHandler('MyGmapCategory', $this->mEnvironment);            $this->addOptionArray('mygmap_marker_category_id',$categoryHandler->getSelectOptionArray());

            $markerHandler =& NBFrame::getHandler('MyGmapMarker', $this->mEnvironment);            $this->addOptionArray('mygmap_marker_icontext', $markerHandler->getIconListArray());

            $this->addOptionArray('mygmap_marker_zoom',array(
                '0' =>'0' , '1' =>'1' , '2' =>'2' , '3' =>'3' , '4' =>'4' , '5' =>'5' ,
                '6' =>'6' , '7' =>'7' , '8' =>'8' , '9' =>'9' , '10' =>'10' , '11' =>'11' ,
                '12' =>'12' , '13' =>'13' , '14' =>'14' , '15' =>'15' , '16' =>'16' , '17' =>'17' ,
                    '18' =>'18' , '19' =>'19' ,
            ));
            $this->addOptionArray('mygmap_marker_maptype',array(
                '0' =>'----' ,
                '1' =>_AD_MYGMAP_LANG_MAPTYPE_MAP ,
                '2' =>_AD_MYGMAP_LANG_MAPTYPE_SATELITE ,
                '3' =>_AD_MYGMAP_LANG_MAPTYPE_HYBRID
            ));
        }
    }
}
?>
