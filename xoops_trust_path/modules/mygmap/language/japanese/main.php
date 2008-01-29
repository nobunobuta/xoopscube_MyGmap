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
$constpref = NBFrame::langConstPrefix('', $mydirname);

if (defined( 'FOR_XOOPS_LANG_CHECKER' ) || !defined($constpref.'LANGUAGE_MAIN_READ')) {

define($constpref.'LANGUAGE_MAIN_READ','1');

define($constpref.'LANG_SET_DEFAULT','�����Ϥ�ǥե���Ȥ��ѹ�');
define($constpref.'LANG_NEW_CATEGORY','�����Ϥ򥫥ƥ��꡼�ɲ�');
define($constpref.'LANG_NEW_POINT','�����Ϥ�ޡ����ɲ�');
define($constpref.'LANG_NEW_AREA','�����Ϥ򥨥ꥢ�ɲ�');

define($constpref.'LANG_AREA','ɽ�����ꥢ');
define($constpref.'LANG_CATEGORY','���ƥ��꡼');
define($constpref.'LANG_MARKER','�ޡ�����');

define($constpref.'LANG_ALL_CATEGORIES','����');

define($constpref.'LANG_TITLE','�����ȥ�');
define($constpref.'LANG_DESCRIPTION','����');
define($constpref.'LANG_ORDER','ɽ����');
define($constpref.'LANG_LAT','����');
define($constpref.'LANG_LNG','����');
define($constpref.'LANG_ZOOM','�̼�');
define($constpref.'LANG_ICON','��������');
define($constpref.'LANG_OVERLAY','�����С��쥤');
define($constpref.'LANG_ADDRESS','����');
define($constpref.'LANG_STATION','��');
define($constpref.'LANG_MAPTYPE','�⡼��');
define($constpref.'LANG_MAPTYPE_MAP','�Ͽ�');
define($constpref.'LANG_MAPTYPE_SATELITE','���ƥ饤��');
define($constpref.'LANG_MAPTYPE_HYBRID','�ǥ奢��');
define($constpref.'LANG_MYGMAP_CATEGORY_ID', '#');
define($constpref.'LANG_MYGMAP_CATEGORY_NAME', '���ƥ��꡼̾');
define($constpref.'LANG_MYGMAP_CATEGORY_DESC', '����');
define($constpref.'LANG_MYGMAP_CATEGORY_LAT', '����');
define($constpref.'LANG_MYGMAP_CATEGORY_LNG', '����');
define($constpref.'LANG_MYGMAP_CATEGORY_ZOOM', '�̼�');
define($constpref.'LANG_MYGMAP_CATEGORY_MAPTYPE', '�⡼��');
define($constpref.'LANG_MYGMAP_CATEGORY_OVERLAY', '�����С��쥤');
define($constpref.'LANG_MYGMAP_AREA_ID', '#');
define($constpref.'LANG_MYGMAP_AREA_NAME', '�����ȥ�');
define($constpref.'LANG_MYGMAP_AREA_DESC', '����');
define($constpref.'LANG_MYGMAP_AREA_LAT', '����');
define($constpref.'LANG_MYGMAP_AREA_LNG', '����');
define($constpref.'LANG_MYGMAP_AREA_ZOOM', '�̼�');
define($constpref.'LANG_MYGMAP_AREA_ORDER', 'ɽ����');
define($constpref.'LANG_MYGMAP_AREA_MAPTYPE', '�⡼��');
define($constpref.'LANG_MYGMAP_MARKER_ID', '#');
define($constpref.'LANG_MYGMAP_MARKER_CATEGORY_ID', '���ƥ��꡼');
define($constpref.'LANG_MYGMAP_MARKER_TITLE', '�����ȥ�');
define($constpref.'LANG_MYGMAP_MARKER_DESC', '����');
define($constpref.'LANG_MYGMAP_MARKER_ICONTEXT', '��������');
define($constpref.'LANG_MYGMAP_MARKER_LAT', '����');
define($constpref.'LANG_MYGMAP_MARKER_LNG', '����');
define($constpref.'LANG_MYGMAP_MARKER_ZOOM', '�̼�');
define($constpref.'LANG_MYGMAP_MARKER_MAPTYPE', '�⡼��');
define($constpref.'LANG_PERM_CAN_READ', '��������');
define($constpref.'LANG_PERM_CAN_EDIT', '�Խ�����');

define($constpref.'LANG_GROUP_PERM_MARKER_EDIT', '�ޡ���������Ͽ�Խ�����');
define($constpref.'LANG_GROUP_PERM_CATEGORY_EDIT', '���ƥ��꡼����Ͽ�Խ�����');
define($constpref.'LANG_GROUP_PERM_AREA_EDIT', '���ꥢ����Ͽ�Խ�����');
}
?>
