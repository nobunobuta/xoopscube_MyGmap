<?php
if (!class_exists('MyGmapCategoryAdminForm')) {
    NBFrame::using('ObjectForm');

    class MyGmapCategoryAdminForm extends NBFrameObjectForm {
        function prepare() {
            $this->addElement('mygmap_category_id',new XoopsFormHidden('mygmap_category_id',0));
            $this->addElement('mygmap_category_name',new XoopsFormText($this->__l('Title'),'mygmap_category_name',50,255));
            $this->addElement('mygmap_category_desc',new XoopsFormDhtmlTextArea($this->__l('Description'),'mygmap_category_desc','',5,25));
            $this->addElement('mygmap_category_lat',new XoopsFormText($this->__l('Lat'),'mygmap_category_lat',25,22));
            $this->addElement('mygmap_category_lng',new XoopsFormText($this->__l('Lng'),'mygmap_category_lng',25,22));
            $this->addElement('mygmap_category_zoom',new XoopsFormSelect($this->__l('Zoom'),'mygmap_category_zoom'));
            $this->addElement('mygmap_category_maptype',new XoopsFormSelect($this->__l('Maptype'),'mygmap_category_maptype'));
            
            $this->addOptionArray('mygmap_category_zoom',array(
                '0' =>'0' , '1' =>'1' , '2' =>'2' , '3' =>'3' , '4' =>'4' , '5' =>'5' ,
                '6' =>'6' , '7' =>'7' , '8' =>'8' , '9' =>'9' , '10' =>'10' , '11' =>'11' ,
                '12' =>'12' , '13' =>'13' , '14' =>'14' , '15' =>'15' , '16' =>'16' , '17' =>'17' ,
                '18' =>'18' , '19' =>'19' ,
            ));
            $this->addOptionArray('mygmap_category_maptype',array(
                '0' =>'----' ,
                '1' =>$this->__l('Maptype Map') ,
                '2' =>$this->__l('Maptype Satelite') ,
                '3' =>$this->__l('Maptype Hybrid'),
            ));
        }
    }
}
?>
