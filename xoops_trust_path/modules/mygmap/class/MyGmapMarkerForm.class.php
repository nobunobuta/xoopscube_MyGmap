<?php
if (!class_exists('MyGmapMarkerForm')) {
    NBFrame::using('ObjectForm');

    class MyGmapMarkerForm extends NBFrameObjectForm {
        function prepare() {
            $this->addElement('mygmap_marker_id',new XoopsFormHidden('mygmap_marker_id',0));
            $this->addElement('mygmap_marker_category_id',new XoopsFormSelect(_MYGMAP_LANG_CATEGORY,'mygmap_marker_category_id'));
            $this->addElement('mygmap_marker_title',new XoopsFormText(_MYGMAP_LANG_TITLE,'mygmap_marker_title',35,255));
            $this->addElement('mygmap_marker_desc', new XoopsFormDhtmlTextArea(_MYGMAP_LANG_DESCRIPTION,'mygmap_marker_desc','',8,25));
            $this->addElement('mygmap_marker_icontext',new XoopsFormSelect(_MYGMAP_LANG_ICON,'mygmap_marker_icontext'));
            $this->addElement('mygmap_marker_maptype',new XoopsFormSelect(_MYGMAP_LANG_MAPTYPE,'mygmap_marker_maptype'));
            $this->addElement('mygmap_marker_lat',new XoopsFormHidden('mygmap_marker_lat',0));
            $this->addElement('mygmap_marker_lng',new XoopsFormHidden('mygmap_marker_lng',0));
            $this->addElement('mygmap_marker_zoom',new XoopsFormHidden('mygmap_marker_zoom',0));
            
            $categoryHandler =& NBFrame::getHandler('MyGmapCategory', $this->mEnvironment);
            $this->addOptionArray('mygmap_marker_category_id',$categoryHandler->getSelectOptionArray(null, 'markereditlist'));
            $markerHandler =& NBFrame::getHandler('MyGmapmarker', $this->mEnvironment);
            $this->addOptionArray('mygmap_marker_icontext', $markerHandler->getIconListArray());
            $this->addOptionArray('mygmap_marker_maptype',array(
                '0' =>'----' ,
                '1' =>_MYGMAP_LANG_MAPTYPE_MAP ,
                '2' =>_MYGMAP_LANG_MAPTYPE_SATELITE ,
                '3' =>_MYGMAP_LANG_MAPTYPE_HYBRID ,
            ));
        }
    }
}
?>
