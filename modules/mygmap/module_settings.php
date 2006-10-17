<?php
    $environment =& NBFrame::getEnvironments(NBFRAME_TARGET_TEMP);
    $environment->setOrigDirName('mygmap');
    $environment->setAttribute('defaultActionOp','MyGmapMain');
    $environment->setAttribute('allowedActionOp', array('MyGmapCategory',
                                                          'MyGmapMarker',
                                                          'MyGmapArea',
                                                          'MyGmapHttpReq',
                                                          'MyGmapSetDefault',
                                                          'MyGmapLoadJscipt',
                                                          'MyGmapGetImage',
                                                          'admin.MyGmapMainAdmin',
                                                          'admin.MyGmapAreaAdmin',
                                                          'admin.MyGmapMarkerAdmin',
                                                          'admin.MyGmapCategoryAdmin',
                                                          'NBFrame.admin.BlocksAdmin',
                                                          'NBFrame.admin.AltSys',
                                                       ));
    $environment->setAttribute('blockHandler', array('MyGmapMiniMapBlock'));
?>
