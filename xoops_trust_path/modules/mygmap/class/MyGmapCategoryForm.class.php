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
if (!class_exists('MyGmapCategoryForm')) {
    NBFrame::using('ObjectForm');

    class MyGmapCategoryForm extends NBFrameObjectForm {
        function prepare() {
            $this->addElement('mygmap_category_id',new XoopsFormHidden('mygmap_category_id',0));
            $this->addElement('mygmap_category_name',new XoopsFormText($this->__l('mygmap_category_name'),'mygmap_category_name',35,255));
            $this->addElement('mygmap_category_desc',new XoopsFormDhtmlTextArea($this->__l('mygmap_category_desc'),'mygmap_category_desc','',8,25));
            $this->addElement('mygmap_category_lat',new XoopsFormHidden('mygmap_category_lat',0));
            $this->addElement('mygmap_category_lng',new XoopsFormHidden('mygmap_category_lng',0));
            $this->addElement('mygmap_category_zoom',new XoopsFormHidden('mygmap_category_zoom',0));
            $this->addElement('mygmap_category_overlay',new XoopsFormText($this->__l('mygmap_category_overlay'),'mygmap_category_overlay',35,255));
            $this->addElement('mygmap_category_maptype',new XoopsFormSelect($this->__l('mygmap_category_maptype'),'mygmap_category_maptype'));

            if (is_object($GLOBALS['xoopsUser']) && (in_array(XOOPS_GROUP_ADMIN, $GLOBALS['xoopsUser']->getGroups()))) {
                $this->addElement('perm_can_read',new XoopsFormSelectGroup($this->__l('perm_can_read'),'perm_can_read',true,null,3,true));
                $this->addElement('perm_can_edit',new XoopsFormSelectGroup($this->__l('perm_can_edit'),'perm_can_edit',true,null,3,true));
            }

            $this->addOptionArray('mygmap_category_maptype',array(
                '0' =>'----' ,
                '1' =>$this->__l('Maptype Map') ,
                '2' =>$this->__l('Maptype Satelite') ,
                '3' =>$this->__l('Maptype Hybrid'),
            ));
        }
    }
}
?>
