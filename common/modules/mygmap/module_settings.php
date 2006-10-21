<?php
if (class_exists('NBFrame')) {
    $environment->setAttribute('ModueleMainAction','MyGmapMain');
    $environment->setAttribute('AdminMainAction',  'admin.MyGmapMainAdmin');

    $environment->setAttribute('AllowedAction', array('MyGmapCategory',
                                                          'MyGmapMarker',
                                                          'MyGmapArea',
                                                          'MyGmapHttpReq',
                                                          'MyGmapSetDefault',
                                                          'MyGmapLoadJscipt',
                                                          'admin.MyGmapMainAdmin',
                                                          'admin.MyGmapAreaAdmin',
                                                          'admin.MyGmapMarkerAdmin',
                                                          'admin.MyGmapCategoryAdmin',
                                                          'NBFrame.GetImage',
                                                          'NBFrame.admin.BlocksAdmin',
                                                          'NBFrame.admin.AltSys',
                                                       ));

    $environment->setAttribute('BlockHandler', array('MyGmapMiniMapBlock'));

    $environment->setAttribute('UseAltSys', true);
    $environment->setAttribute('UseBlockAdmin', true);
    $environment->setAttribute('UseTemplateAdmin', true);
}
?>