<?php
if (!class_exists('MyGmapCategoryForm')) {
    NBFrame::using('ObjectForm');

    class MyGmapCategoryForm extends NBFrameObjectForm {
        function prepare() {
            $this->addElement('mygmap_category_id',new XoopsFormHidden('mygmap_category_id',0));
            $this->addElement('mygmap_category_name',new XoopsFormText(_MYGMAP_LANG_TITLE,'mygmap_category_name',35,255));
            $this->addElement('mygmap_category_desc',new XoopsFormDhtmlTextArea(_MYGMAP_LANG_DESCRIPTION,'mygmap_category_desc','',8,25));
            $this->addElement('mygmap_category_lat',new XoopsFormHidden('mygmap_category_lat',0));
            $this->addElement('mygmap_category_lng',new XoopsFormHidden('mygmap_category_lng',0));
            $this->addElement('mygmap_category_zoom',new XoopsFormHidden('mygmap_category_zoom',0));
            $this->addElement('mygmap_category_maptype',new XoopsFormSelect(_MYGMAP_LANG_MAPTYPE,'mygmap_category_maptype'));
            $this->addOptionArray('mygmap_category_maptype',array(
                '0' =>'----' ,
                '1' =>_MYGMAP_LANG_MAPTYPE_MAP ,
                '2' =>_MYGMAP_LANG_MAPTYPE_SATELITE ,
                '3' =>_MYGMAP_LANG_MAPTYPE_HYBRID ,
            ));
        }
    }
}
?>
