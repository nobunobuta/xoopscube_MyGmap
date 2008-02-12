<?php
if( ! class_exists( 'MyGmapAdminMenu' ) ) {
    NBFrame::using('Menu');
    class MyGmapAdminMenu extends NBFrameMenu
    {
        function getAdminMenu() {
            $constpref = NBFrame::langConstPrefix('MI', '', NBFRAME_TARGET_LOADER);
            $adminmenu = array();
            $adminmenu[] = array (
                'title' => constant($constpref.'AD_MENU0'),
                'link'  => $this->mEnvironment->getActionUrl('admin.MyGmapCategoryAdmin', array(), 'html', true),
            );
            $adminmenu[] = array (
                'title' => constant($constpref.'AD_MENU1'),
                'link'  => $this->mEnvironment->getActionUrl('admin.MyGmapMarkerAdmin', array(), 'html', true),
            );
            $adminmenu[] = array (
                'title' => constant($constpref.'AD_MENU2'),
                'link'  => $this->mEnvironment->getActionUrl('admin.MyGmapAreaAdmin', array(), 'html', true),
            );
            return $adminmenu;
        }
    }
}
