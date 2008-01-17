<?php
if (!class_exists('MyGmapAreaAdminForm')) {
    NBFrame::using('ObjectForm');

    class MyGmapAreaAdminForm extends NBFrameObjectForm {
        function prepare() {
            $this->addElement('mygmap_area_zoom',new XoopsFormSelect($this->__l('mygmap_area_zoom'),'mygmap_area_zoom'));
            $this->addElement('mygmap_area_maptype',new XoopsFormSelect($this->__l('mygmap_area_maptype'),'mygmap_area_maptype'));
            
            $this->addOptionArray('mygmap_area_zoom',array(
                '0' =>'0' , '1' =>'1' , '2' =>'2' , '3' =>'3' , '4' =>'4' , '5' =>'5' ,
                '6' =>'6' , '7' =>'7' , '8' =>'8' , '9' =>'9' , '10' =>'10' , '11' =>'11' ,
                '12' =>'12' , '13' =>'13' , '14' =>'14' , '15' =>'15' , '16' =>'16' , '17' =>'17' ,
                '18' =>'18' , '19' =>'19' , '20' =>'20' , '21' =>'21' , '22' =>'22' , '23' =>'23' ,
                '24' =>'24' ,
            ));
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
