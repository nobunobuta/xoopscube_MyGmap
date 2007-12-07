<?php
if (!class_exists('MyGmapCategoryAdminList')) {
    NBFrame::using('ObjectList');

    class MyGmapCategoryAdminList extends NBFrameObjectList
    {
        function prepare() {
            parent::prepare();

            $this->addElement('mygmap_category_id', '#', 20, array('sort'=>true));
            $this->addElement('mygmap_category_name', _AD_MYGMAP_LANG_TITLE, 300);
            $this->addElement('mygmap_category_maptype', _AD_MYGMAP_LANG_MAPTYPE, 80, array('sort'=>true));
            $this->addElement('__SimpleEditLink__','',50, array('caption'=>$this->__l('Edit')));
            $this->addElement('__SimpleDeleteLink__','',50, array('caption'=>$this->__l('Delete')));
            $this->addElement('__SimplePermLink__','',50, array('caption'=>$this->__l('Perm')));
        }
        
        function formatItem_mygmap_category_maptype($value) {
            $optionArray = array('', _AD_MYGMAP_LANG_MAPTYPE_MAP,_AD_MYGMAP_LANG_MAPTYPE_SATELITE,_AD_MYGMAP_LANG_MAPTYPE_HYBRID);
            return $optionArray[$value];
        }

        // Special List Item '__SimplePermLink__'
        function extraItem___SimplePermLink__(&$object,$element) {
            $objectKey = $object->getKeyFields();
            $objectKey = $objectKey[0];
            $key = $object->getVar($objectKey);
            if (!empty($this->mAction)) {
                $item['link'] = $this->mAction->addUrlParam('op=perm&amp;'.$objectKey.'='.$key);
            } else {
                $item['link'] = xoops_getenv('PHP_SELF').'?op=perm&amp;'.$objectKey.'='.$key;
            }
            $item['linktitle'] = 'Set Group Permission';
            $item['value'] = $element['ext']['caption'];
            $item['align'] = 'center';
            return $item;
        }
    }
}
?>
