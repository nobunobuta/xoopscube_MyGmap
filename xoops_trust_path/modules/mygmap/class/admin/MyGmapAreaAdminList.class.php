<?php
if (!class_exists('MyGmapAreaAdminList')) {
    NBFrame::using('ObjectList');

    class MyGmapAreaAdminList extends NBFrameObjectList
    {
        function prepare() {
            $this->addElement('mygmap_area_id', '#', 20, array('sort'=>true));
            $this->addElement('mygmap_area_name',  $this->__l('Title'), 300);
            $this->addElement('mygmap_area_order', $this->__l('Order'), 50, array('sort'=>true));
            $this->addElement('mygmap_area_maptype', $this->__l('MapType'), 80, array('sort'=>true));
            $this->addElement('__SimpleEditLink__','',50, array('caption'=>$this->__l('Edit')));
            $this->addElement('__SimpleDeleteLink__','',50, array('caption'=>$this->__l('Delete')));
        }
        function formatItem_mygmap_area_maptype($value) {
            $optionArray = array('', $this->__l('Maptype Map'),$this->__l('Maptype Satelite'),$this->__l('Maptype Hybrid'));
            return $optionArray[$value];
        }
    }
}
?>
