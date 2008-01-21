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
if (!class_exists('MyGmapCategoryAdminAction')) {
    NBFrame::using('AdminMaintAction');

    class MyGmapCategoryAdminAction extends NBFrameAdminMaintAction {
        function prepare() {
            $this->mHalfAutoForm = true;
            parent::prepare('MyGmapCategory', $this->__l('Category Title'));
            $this->mAllowedOp = array_merge($this->mAllowedOp, array('perm'));
        }

        function permAction() {
            if (isset($_GET[$this->mObjectKeyField])) {                if ($object =& $this->mObjectHandler->get(intval($_GET[$this->mObjectKeyField]))) {
                    $this->mObject =& $object;
                    include_once XOOPS_ROOT_PATH.'/class/xoopsform/grouppermform.php';
                    $this->mObjectForm =& new XoopsGroupPermForm($object->getVar('mygmap_category_name'),$GLOBALS['xoopsModule']->getVar('mid'),'markereditcat','');
                    $this->mObjectForm->addItem($object->getVar('mygmap_category_id'), 'Can Write');
                    $this->mExtraShowMethod = 'Perm';
                    $this->mExtraTemplate = $this->mFormTemplate;
                    return NBFRAME_ACTION_VIEW_EXTRA;
                }
            }
            $this->mErrorMsg = $this->__e('No Record is found');
            return NBFRAME_ACTION_ERROR;
        }

        function executeViewPerm() {
            $this->mXoopsTpl->assign('modulename', $GLOBALS['xoopsModule']->getVar('name'));
            $this->mXoopsTpl->assign('formhtml', $this->mObjectForm->render());
            $this->mXoopsTpl->assign('title', $this->mCaption.' &raquo; '.$this->__l('Group Permission'));
            $this->mXoopsTpl->assign('errmsg','');
        }
    }
}
?>
