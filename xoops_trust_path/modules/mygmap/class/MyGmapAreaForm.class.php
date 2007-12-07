<?php
if (!class_exists('MyGmapAreaForm')) {
    NBFrame::using('ObjectForm');

    class MyGmapAreaForm extends NBFrameObjectForm {
        function prepare() {
            $this->addElement('mygmap_area_id',new XoopsFormHidden('mygmap_area_id', 0));
            $this->addElement('mygmap_area_name',new XoopsFormText(_MYGMAP_LANG_TITLE, 'mygmap_area_name', 35, 255));
            $this->addElement('mygmap_area_desc',new XoopsFormDhtmlTextArea(_MYGMAP_LANG_DESCRIPTION, 'mygmap_area_desc', '', 8, 25));
            $this->addElement('mygmap_area_lat',new XoopsFormHidden('mygmap_area_lat', 0));
            $this->addElement('mygmap_area_lng',new XoopsFormHidden('mygmap_area_lng', 0));
            $this->addElement('mygmap_area_zoom',new XoopsFormHidden('mygmap_area_zoom', 0));
            $this->addElement('mygmap_area_order',new XoopsFormText(_MYGMAP_LANG_ORDER, 'mygmap_area_order', 0, 5));
            $this->addElement('mygmap_area_maptype',new XoopsFormSelect(_MYGMAP_LANG_MAPTYPE,'mygmap_area_maptype'));
            $this->addOptionArray('mygmap_area_maptype',array(
                '0' =>'----' ,
                '1' =>_MYGMAP_LANG_MAPTYPE_MAP ,
                '2' =>_MYGMAP_LANG_MAPTYPE_SATELITE ,
                '3' =>_MYGMAP_LANG_MAPTYPE_HYBRID ,
            ));
        }
    }
}
?>
