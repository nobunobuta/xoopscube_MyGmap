<?php
if (!class_exists('MyGmapCategoryAdminForm')) {
    NBFrame::using('ObjectForm');

    class MyGmapCategoryAdminForm extends NBFrameObjectForm {
        function prepare() {
            $this->addElement('mygmap_category_id',new XoopsFormHidden('mygmap_category_id',0));
            $this->addElement('mygmap_category_name',new XoopsFormText(_AD_MYGMAP_LANG_TITLE,'mygmap_category_name',50,255));
            $this->addElement('mygmap_category_desc',new XoopsFormDhtmlTextArea(_AD_MYGMAP_LANG_DESCRIPTION,'mygmap_category_desc','',5,25));
            $this->addElement('mygmap_category_lat',new XoopsFormText(_AD_MYGMAP_LANG_LAT,'mygmap_category_lat',25,22));
            $this->addElement('mygmap_category_lng',new XoopsFormText(_AD_MYGMAP_LANG_LNG,'mygmap_category_lng',25,22));
            $this->addElement('mygmap_category_zoom',new XoopsFormSelect(_AD_MYGMAP_LANG_ZOOM,'mygmap_category_zoom'));
            $this->addElement('mygmap_category_maptype',new XoopsFormSelect(_AD_MYGMAP_LANG_MAPTYPE,'mygmap_category_maptype'));
            
            $this->addOptionArray('mygmap_category_zoom',array(
                '0' =>'0' , '1' =>'1' , '2' =>'2' , '3' =>'3' , '4' =>'4' , '5' =>'5' ,
                '6' =>'6' , '7' =>'7' , '8' =>'8' , '9' =>'9' , '10' =>'10' , '11' =>'11' ,
                '12' =>'12' , '13' =>'13' , '14' =>'14' , '15' =>'15' , '16' =>'16' , '17' =>'17' ,
                '18' =>'18' , '19' =>'19' ,
            ));
            $this->addOptionArray('mygmap_category_maptype',array(
                '0' =>'----' ,
                '1' =>_AD_MYGMAP_LANG_MAPTYPE_MAP ,
                '2' =>_AD_MYGMAP_LANG_MAPTYPE_SATELITE ,
                '3' =>_AD_MYGMAP_LANG_MAPTYPE_HYBRID
            ));
        }
    }
}
?>
