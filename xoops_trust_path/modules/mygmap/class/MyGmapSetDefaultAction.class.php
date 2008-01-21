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
                    $update_vars = array($params['lat'], $params['lng'], $params['zoom']);
                    $config_handler =& xoops_gethandler('configitem');
                    foreach($update_configs as $key=>$update_config) {
                        $criteria = new CriteriaCompo(new Criteria('conf_modid', $GLOBALS['xoopsModule']->getVar('mid')));
                        $criteria->add(new Criteria('conf_name', $update_config));
                        $configitems =& $config_handler->getObjects($criteria, false);
                        if (count($configitems)==1) {
                            $configitems[0]->setVar('conf_value', $update_vars[$key]);
                            $config_handler->insert($configitems[0]);
                        }
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
