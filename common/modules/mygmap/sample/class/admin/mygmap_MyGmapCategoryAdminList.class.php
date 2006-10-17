<?php
if (!class_exists('mygmap_MyGmapCategoryAdminList')) {
    NBFrame::using('+admin.MyGmapCategoryAdminList', NBFrame::getEnvironments());

    class mygmap_MyGmapCategoryAdminList extends MyGmapCategoryAdminList
    {
        function prepare() {
            parent::prepare();
            $this->mElements['mygmap_category_id']['caption'] = 'Num';
        }
        
    }
}
?>
