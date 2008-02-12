<?php
/**
 *
 * @package MyGmap
 * @version $Id$
 * @copyright Copyright 2006-2008 NobuNobuXOOPS Project <http://sourceforge.net/projects/nobunobuxoops/>
 * @author NobuNobu <nobunobu@nobunobu.com>
 * @license http://www.gnu.org/licenses/gpl.txt GNU GENERAL PUBLIC LICENSE Version 2
 *
 */
if (!class_exists('MyGmapCategoryAction')) {
    NBFrame::using('ObjectAction');

    class MyGmapCategoryAction extends NBFrameObjectAction
    {
        function prepare() {
            $this->mHalfAutoForm = true;
            parent::prepare('MyGmapCategory', 'mygmap_catedit',$this->__l('Category'));
            $this->setObjectForm('MyGmapCategory');
            $this->setFormTemplate($this->prefix('category.html'));
            $this->setExecutePermission('category_edit');
        }
        
        function viewFormOp() {
            parent::viewFormOp();
            $this->mXoopsTpl->assign('mygmap_API', $GLOBALS['xoopsModuleConfig']['mygmap_api']);
            $this->mXoopsTpl->assign('mygmap_dirname', $this->mDirName);
            $this->mXoopsTpl->assign('mygmap_center_lat', $this->mObject->getVar('mygmap_category_lat'));
            $this->mXoopsTpl->assign('mygmap_center_lng', $this->mObject->getVar('mygmap_category_lng'));
            $this->mXoopsTpl->assign('mygmap_zoom', $this->mObject->getVar('mygmap_category_zoom'));
            $this->mXoopsTpl->assign('mygmap_maptype', $this->mObject->getVar('mygmap_category_maptype'));
            $this->mXoopsTpl->assign('mygmap_width', $GLOBALS['xoopsModuleConfig']['mygmap_width']);
            $this->mXoopsTpl->assign('mygmap_height', $GLOBALS['xoopsModuleConfig']['mygmap_height']);
            $this->mXoopsTpl->assign('mygmap_credit', $GLOBALS['mygmap_credit']);
        }

        function executeActionSuccess() {
            $this->mEnvironment->redirect('MyGmapMain', 2, $this->__e('Action Success'),array('cat'=>$this->mObject->getVar('mygmap_category_id')));
        }
    }
}
?>
