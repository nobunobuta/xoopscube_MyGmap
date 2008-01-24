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
        }
    }
}
?>
