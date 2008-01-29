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
$constpref = NBFrame::langConstPrefix('MI', $mydirname);

if (defined( 'FOR_XOOPS_LANG_CHECKER' ) || !defined($constpref.'LANGUAGE_MODINFO_READ')) {
define ($constpref.'LANGUAGE_MODINFO_READ','1');
// Module Info

// Config titles
define($constpref."API_MSG","Google Maps API�����館�륭��");
define($constpref."API_DESC","<a href=\"http://www.google.com/apis/maps/signup.html\" target=\"_blank\">Google Maps API - Sign up</a>�����館�륽������<br />key =xxxxxxx\"��xxxxxxx��ʬ�Τߤ򵭽Ҥ��Ʋ�������<br />Sign up����URL�ϡ�".XOOPS_URL." ����".XOOPS_URL."/modules/mygmap/ ����ꤷ��<br />������������Ʋ�������");
define($constpref."CAT_MSG","���ɽ�����륫�ƥ��꡼ID");
define($constpref."CAT_DESC","���ɽ���ϿޤΥ��ƥ��꡼ID����ꤷ�Ʋ�������<br />0�˻��ꤷ�����ˤϡ��ʲ��ΰ��١����١�����Ψ��ͭ���ˤʤ�ޤ���<br />
                              -1�˻��ꤷ�����ˤϡ����٤ƤΥ��ƥ��꡼�Υޡ�������ɽ������ޤ���");
define($constpref."LAT_MSG","���ɽ���Ͽޤΰ���");
define($constpref."LAT_DESC","���ɽ���Ͽޤΰ��٤��̰ޤǻ��ꤷ�Ʋ�������");
define($constpref."LNG_MSG","���ɽ���Ͽޤη���");
define($constpref."LNG_DESC","���ɽ���Ͽޤη��٤���Фǻ��ꤷ�Ʋ�������<br />�ƹ�ʤɤ��Ͽ�ɽ���������Фϥޥ��ʥ������ˤʤ�ޤ���");
define($constpref."ZOOM_MSG","���ɽ���Ͽޤγ���Ψ");
define($constpref."ZOOM_DESC","����Ψ�� 0(������Ψ)��19�ǻ��ꤷ�Ʋ�������");
define($constpref."MAPTYPE_MSG","���ɽ�����Ͽޥ�����");
define($constpref."MAPTYPE_DESC","�Ͽޡ����ƥ饤�ȡ��ϥ��֥�åɤ����������ޤ�");
define($constpref."MAPTYPE_OPT1","�Ͽ�");
define($constpref."MAPTYPE_OPT2","���ƥ饤��");
define($constpref."MAPTYPE_OPT3","�ϥ��֥�å�");
define($constpref."INFOPOP_MSG","��������ޡ����������򤷤��Ȥ��˾��󥦥���ɥ���ݥåץ��åפ���");
define($constpref."INFOPOP_DESC","");
define($constpref."SEARCH_MSG","���ꡦ�ظ�����ǽ�����");
define($constpref."SEARCH_DESC","<a href=\"http://pc035.tkl.iis.u-tokyo.ac.jp/~sagara/geocode/index.php\" target=\"_blank\">CSIS����ץ른�������ǥ��󥰼¸�</a>����Ѥ��������긡����ǽ����Ѥ��ޤ���<br />����ǽ����Ѥ�����ˤϡ�<a href=\"http://www.tkl.iis.u-tokyo.ac.jp/~sagara/geocode/simple_condition.html\" target=\"_blank\">��CSIS����ץ른�������ǥ��󥰼¸� ���õ����</a>�򻲾Ȥ��ƾ���������ɬ�פ�����ޤ���<br /><br />�ʤ������¸����ܼ¸��ǰ��ֻ��Ⱦ���Ȥ������Ѥ��Ƥ��븵�ǡ����ϰ����ˤ��ʤ�Ť���Τ��ޤޤ�Ƥ��ꡢ�Ƕᳫ�̤���Ŵƻ�α�̾�ϸ����Ǥ��ޤ���");
define($constpref."INVGEO_MSG","�Ͽ�ɽ�����֤ν���ɽ����ǽ�����");
define($constpref."INVGEO_DESC","<a href=\"http://wiki.knya.net/wiki.cgi?page=invgeocoder\" target=\"_blank\">InvGeoCoder</a>����Ѥ��ơ�ɽ������Ƥ����Ͽޤ��濴���֤ν����ɽ�����ޤ���<br /><br />�Ͽޤγ���Ψ�ˤ�ä�ɽ���ξܺ��٤��Ѳ����ޤ���");
define($constpref."LINK_MSG","�����Ͽ�ɽ���Ѥ�URL��ɽ��");
define($constpref."LINK_DESC","");
define($constpref."WIKI_MSG","�����Ͽ�ɽ���Ѥ�WIKI����������");
define($constpref."WIKI_DESC","����<a href=\"http://apap.co4.jp/modules/mydownloads/singlefile.php?cid=7&lid=51\" target=\"_blank\">�����ȥѥå�</a>��ɬ�פǤ�<br/>
                               plugins�ե����������myGmapPluginFgmap.js��<br/>
                               myGmapPluginFgmap.html��������Ȥ��Υ��ץ����˴ط��ʤ�ɽ������ʤ��ʤ�ޤ���");
define($constpref."BLOG_MSG","�����Ͽ�ɽ���Ѥ�Blog����������");
define($constpref."BLOG_DESC","����<a href=\"http://apap.co4.jp/modules/mydownloads/singlefile.php?cid=7&lid=51\" target=\"_blank\">�����ȥѥå�</a>��ɬ�פǤ�<br/>
                               plugins�ե����������myGmapPluginFgmap.js��<br/>
                               myGmapPluginFgmap.html��������Ȥ��Υ��ץ����˴ط��ʤ�ɽ������ʤ��ʤ�ޤ���");
define($constpref."WIDTH_MSG","�Ͽޤ�ɽ����");
define($constpref."WIDTH_DESC","ñ�̡�px(�ԥ�����)�ˤƻ��ꤷ�Ʋ�������");
define($constpref."HEIGHT_MSG","�Ͽޤ�ɽ���⤵");
define($constpref."HEIGHT_DESC","ñ�̡�px(�ԥ�����)�ˤƻ��ꤷ�Ʋ�������");
define($constpref."TEXT1_MSG","���ɽ���Ͽޤο᤭�Ф���ɽ������ʸ��");
define($constpref."TEXT1_DESC","XOOPS��BBcode�ˤƵ��Ҥ��Ʋ�������");
define($constpref."TEXT1_DEFAULT","[b]��ƻ�ϡ�������[/b]");
define($constpref."TEXT2_MSG","Ǥ��ɽ���Ͽޤο᤭�Ф���ɽ������ʸ��");
define($constpref."TEXT2_DESC","URL�Υѥ�᡼���ǰ��֤��Ƥ�������<br/>�᤭�Ф���ɽ������ʸ����<br/>XOOPS��BBcode�ˤƵ��Ҥ��Ʋ�������");
define($constpref."TEXT2_DEFAULT","[b]�����Ǥ��衪[/b]");
define($constpref."SETDEF_SHOW_MSG","�֤�����ǥե���Ȥ��ѹ��ץܥ����ɽ��");
define($constpref."SETDEF_SHOW_DESC","�����Ԥ����ɽ���Ѥ��Ͽޤ��ñ�˻���Ǥ����ͤ�<br />�����Ը��¥桼�����Ф��ơ֤�����ǥե���Ȥ��ѹ��ץܥ����ɽ�����ޤ���<br />�ʽ�����괰λ��ϡ��֤������פˤ��뤳�Ȥ򤪾��ᤷ�ޤ���");
define($constpref."DEBUG_MSG","�ǥХå���å���������Ϥ���");
define($constpref."DEBUG_DESC","����Ū�ˤϡ����(NobuNobu)���ѤΥ��ץ����Ǥ���<br />Ajax�ƽФʤɤ�����ȥ졼�����Ϥ��ޤ���");

define($constpref."Z_OPT0","0");
define($constpref."Z_OPT1","1");
define($constpref."Z_OPT2","2");
define($constpref."Z_OPT3","3");
define($constpref."Z_OPT4","4");
define($constpref."Z_OPT5","5");
define($constpref."Z_OPT6","6");
define($constpref."Z_OPT7","7");
define($constpref."Z_OPT8","8");
define($constpref."Z_OPT9","9");
define($constpref."Z_OPT10","10");
define($constpref."Z_OPT11","11");
define($constpref."Z_OPT12","12");
define($constpref."Z_OPT13","13");
define($constpref."Z_OPT14","14");
define($constpref."Z_OPT15","15");
define($constpref."Z_OPT16","16");
define($constpref."Z_OPT17","17");
define($constpref."Z_OPT18","18");
define($constpref."Z_OPT19","19");
define($constpref."Z_OPT20","20");
define($constpref."Z_OPT21","21");
define($constpref."Z_OPT22","22");
define($constpref."Z_OPT23","23");

define($constpref.'AD_MENU0','���ƥ��꡼����');
define($constpref.'AD_MENU1','�ޡ���������');
define($constpref.'AD_MENU2','ɽ�����ꥢ����');
}
?>
