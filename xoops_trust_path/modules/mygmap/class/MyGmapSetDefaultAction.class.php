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
if (!class_exists('MyGmapSetDefaultAction')) {
    NBFrame::using('Action');
    class MyGmapSetDefaultAction extends NBFrameAction {
        function executeDefaultOp() {
            if ($GLOBALS['xoopsUserIsAdmin']) {
                $this->mRequest->defParam('lat',  'POST', 'float', NBFRAME_NO_DEFAULT_PARAM, true);
                $this->mRequest->defParam('lng',  'POST', 'float', NBFRAME_NO_DEFAULT_PARAM, true);
                $this->mRequest->defParam('zoom', 'POST', 'int',   NBFRAME_NO_DEFAULT_PARAM, true);
                if (!$this->mRequest->hasError()) {
                    $params = $this->mRequest->getParam();
                    $update_configs = array('mygmap_lat','mygmap_lng','mygmap_zoom');
                    $update_vars = array(
                        'mygmap_lat'=>$params['lat'],
                        'mygmap_lng'=> $params['lng'],
                        'mygmap_zoom'=>$params['zoom']
                    );
                    $configHandler =& NBFrame::getHandler('NBFrame.xoops.Config',NBFrame::null());
                    foreach($update_vars as $conf_name=>$conf_value) {
                        $configHandler->setModuleConfig($this->mDirName, $conf_name, $conf_value);
                    }
                    return NBFRAME_ACTION_SUCCESS;
                } else {
                    $this->mErrorMsg = $this->__e('Invalid Operation');
                    return NBFRAME_ACTION_ERROR;
                }
            } else {
                $this->mErrorMsg = $this->__e('Permission Error');
                return NBFRAME_ACTION_ERROR;
            }
        }
        function executeActionSuccess() {
            redirect_header($this->getUrlBase().'/', 2, $this->__e('Action Success'));
        }
        function executeActionError() {
            redirect_header($this->getUrlBase().'/', 2, $this->mErrorMsg);
        }
    }
}
?>
