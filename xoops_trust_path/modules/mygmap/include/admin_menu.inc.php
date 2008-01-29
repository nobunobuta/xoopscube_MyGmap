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
$constpref = NBFrame::langConstPrefix('MI', '', NBFRAME_TARGET_TEMP);
$adminmenu[0]['title'] = constant($constpref.'AD_MENU0');;
$adminmenu[0]['link'] = "?action=admin.MyGmapCategoryAdmin";
$adminmenu[1]['title'] =constant($constpref.'AD_MENU1');;
$adminmenu[1]['link'] = "?action=admin.MyGmapMarkerAdmin";
$adminmenu[2]['title'] = constant($constpref.'AD_MENU2');;
$adminmenu[2]['link'] = "?action=admin.MyGmapAreaAdmin";
?>