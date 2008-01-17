<?php
if (!class_exists('MyGmapMarkerAdminList')) {
    NBFrame::using('ObjectList');

    class MyGmapMarkerAdminList extends NBFrameObjectList
    {
        var $categoryHandler;

        function prepare() {
            $this->categoryHandler =& NBFrame::getHandler('MyGmapCategory', $this->mEnvironment);
            $this->addElement('mygmap_marker_id', '#', 20, array('sort'=>true));
            $this->addElement('mygmap_marker_category_id', $this->__l('mygmap_marker_category_id'), 150, array('sort'=>true));
            $this->addElement('mygmap_marker_title', $this->__l('mygmap_marker_title'), 300);
            $this->addElement('mygmap_marker_icontext', $this->__l('mygmap_marker_icontext'), 50, array('sort'=>true));
            $this->addElement('mygmap_marker_maptype', $this->__l('mygmap_marker_maptype'), 80, array('sort'=>true));
            $this->addElement('__SimpleEditLink__','',50, array('caption'=>$this->__l('Edit')));
            $this->addElement('__SimpleDeleteLink__','',50, array('caption'=>$this->__l('Delete')));
        }
        
        function formatItem_mygmap_marker_category_id($value) {
            return $this->categoryHandler->getName($value);
        }
        function formatItem_mygmap_marker_maptype($value) {
            $optionArray = array('', $this->__l('Maptype Map'),$this->__l('Maptype Satelite'),$this->__l('Maptype Hybrid'));
            return $optionArray[$value];
        }
    }
}
?>
