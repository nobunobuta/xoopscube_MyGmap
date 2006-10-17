<?php
if (!class_exists('MyGmapMarkerAdminList')) {
    NBFrame::using('ObjectList');

    class MyGmapMarkerAdminList extends NBFrameObjectList
    {
        var $categoryHandler;

        function prepare() {
            $this->categoryHandler =& NBFrame::getHandler('MyGmapCategory', $this->mEnvironment);
            $this->addElement('mygmap_marker_id', '#', 20, array('sort'=>true));
            $this->addElement('mygmap_marker_category_id', _AD_MYGMAP_LANG_CATEGORY, 150, array('sort'=>true));
            $this->addElement('mygmap_marker_title', _AD_MYGMAP_LANG_TITLE, 300);
            $this->addElement('mygmap_marker_icontext', _AD_MYGMAP_LANG_ICON, 50, array('sort'=>true));
            $this->addElement('mygmap_marker_maptype', _AD_MYGMAP_LANG_MAPTYPE, 80, array('sort'=>true));
            $this->addElement('__SimpleEditLink__','',50, array('caption'=>$this->__l('Edit')));
            $this->addElement('__SimpleDeleteLink__','',50, array('caption'=>$this->__l('Delete')));
        }
        
        function formatItem_mygmap_marker_category_id($value) {
            return $this->categoryHandler->getName($value);
        }
        function formatItem_mygmap_marker_maptype($value) {
            $optionArray = array('', _AD_MYGMAP_LANG_MAPTYPE_MAP,_AD_MYGMAP_LANG_MAPTYPE_SATELITE,_AD_MYGMAP_LANG_MAPTYPE_HYBRID);
            return $optionArray[$value];
        }
    }
}
?>
