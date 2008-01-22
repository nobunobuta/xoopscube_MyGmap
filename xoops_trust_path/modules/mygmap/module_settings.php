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
if (class_exists('NBFrame')) {
    $environment->setAttribute('ModueleMainAction','MyGmapMain');
    $environment->setAttribute('AdminMainAction',  'admin.MyGmapMainAdmin');

    $environment->setAttribute('AllowedAction', array('MyGmapCategory',
                                                      'MyGmapMarker',
                                                      'MyGmapArea',
                                                      'MyGmapHttpReq',
                                                      'MyGmapSetDefault',
                                                      'MyGmapLoadJscipt',
                                                      'MyGmapLoadKLM',
                                                      'admin.MyGmapMainAdmin',
                                                      'admin.MyGmapAreaAdmin',
                                                      'admin.MyGmapMarkerAdmin',
                                                      'admin.MyGmapCategoryAdmin',
                                                  ));

    $environment->setAttribute('NoCommonAction', array('MyGmapHttpReq',
                                                       'MyGmapLoadJscipt',
                                                       ));
    $environment->setAttribute('ModuleGroupPermKeys', array('marker_edit','category_edit','area_edit'));

    $environment->setAttribute('UseAltSys', true);
    $environment->setAttribute('UseBlockAdmin', true);
    $environment->setAttribute('UseTemplateAdmin', true);
    $environment->setAttribute('UseLanguageAdmin', true);
}
?>
