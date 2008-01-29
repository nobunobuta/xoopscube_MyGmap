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
if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'mygmap' ;
$constpref = NBFrame::langConstPrefix('AD', $mydirname);

if (defined( 'FOR_XOOPS_LANG_CHECKER' ) || !defined($constpref.'LANGUAGE_ADMIN_READ')) {

define($constpref.'LANGUAGE_ADMIN_READ','1');

define($constpref.'LANG_MARKER_TITLE','マーカー管理');
define($constpref.'LANG_CATEGORY_TITLE','カテゴリー管理');
define($constpref.'LANG_AREA_TITLE','表示エリア管理');
}
?>
