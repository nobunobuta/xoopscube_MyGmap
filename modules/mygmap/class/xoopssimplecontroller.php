<?php
define('SIMPLE_CONTROLLER_VIEW_LIST', '1');
define('SIMPLE_CONTROLLER_VIEW_FORM', '2');
define('SIMPLE_CONTROLLER_VIEW_SINGLE', '2');
define('SIMPLE_CONTROLLER_ACTION_ERROR', '10');
define('SIMPLE_CONTROLLER_ACTION_SUCCESS', '0');
define('SIMPLE_CONTROLLER_VIEW_NONE', '99');

class XoopsSimpleController {
	var $name;
	var $objectHandler;
	var $objectForm;
	var $objectList;
	var $listFilterCriteria = null;
	var $url;
	var $xoopsTpl;
	var $defautlOp = '';
	var $allowedOp = array();
	var $object = null;
	var $errorMsg = '';
	var $_objectKey;
	
	function action() {
		$object =& $this->objectHandler->create();
		$objectKey = $object->getKeyFields();
		$this->_objectKey = $objectKey[0];

		$op = (!isset($_REQUEST['op'])) ? $this->defautlOp : $_REQUEST['op'];
		if (in_array($op, $this->allowedOp) && method_exists($this, $op.'Action')) {
			$method = $op.'Action';
			return $this->$method();
		} else {
			$this->errorMsg = $this->__e('Invalid Operation');
			return SIMPLE_CONTROLLER_ACTION_ERROR;
		}
	}

	function newAction() {
		$object =& $this->objectHandler->create();
		$object->setFormVars($_POST,'');
		return $this->_showForm($object, $this->__l('New'));
	}

	function editAction() {
		if (isset($_GET[$this->_objectKey])) {			$object =& $this->objectHandler->get(intval($_GET[$this->_objectKey]));
			return $this->_showForm($object, $this->__l('Edit'));
		} else {
			$this->errorMsg = $this->__e('Invalid Request');
			return SIMPLE_CONTROLLER_ACTION_ERROR;
		}
	}

	function _showFrom(&$object, $caption) {
		if (is_object($object)) {
			$this->objectForm->setCaption($this->caption.' &raquo; '.$caption);
			$this->objectForm->showForm($object, &$this->xoopsTpl);
			$this->object =& $object;
			return SIMPLE_CONTROLLER_VIEW_FORM;
		} else {
			$this->errorMsg = $this->__e('No Record is found');
			return SIMPLE_CONTROLLER_ACTION_ERROR;
		}
	}

	function insertAction() {
		$object =& $this->objectHandler->create();
		return $this->_insert($object, $this->name.'_'.$op, $this->__l('New'));
	}

	function saveAction() {
		$object =& $this->objectHandler->get(intval($_POST[$this->_objectKey]));
		return $this->_insert($object, $this->name.'_'.$op, $this->__l('Edit'));
	}
	
	function _insert(&$object, $token, $caption) {
		if (class_exists('XoopsMultiTokenHandler') && !XoopsMultiTokenHandler::quickValidate($token)) {
			$this->errorMsg = $this->__e('Token Error');
			return SIMPLE_CONTROLLER_ACTION_ERROR;
		}
		if (is_object($object)) {			$object->setFormVars($_POST,'');
			if ($this->objectHandler->insert($object,false,true)) {
				$this->object =& $object;
				return SIMPLE_CONTROLLER_ACTION_SUCCESS;
			} else {
				$object->setFormVars($_POST,'');
				$this->objectForm->setCaption($this->caption.' &raquo; '.$caption);
				$this->objectForm->showForm($object, &$this->xoopsTpl, $this->objectHandler->getErrors());
				return SIMPLE_CONTROLLER_VIEW_FORM;
			}
		} else {
			$this->errorMsg = $this->__e('No Record is found');
			return SIMPLE_CONTROLLER_ACTION_ERROR;
		}
	}
	
	function deleteAction() {
		if (isset($_GET[$this->_objectKey])) {
			$key = intval(intval($_GET[$this->_objectKey]));			$object =& $this->objectHandler->get($key);
			if (is_object($object)) {
				ob_start();
				xoops_confirm(array('op'=>'deleteok',$this->_objectKey=>$key), $this->url, $this->__l("Delete this Record")."? [ID=".$key."]");
				$this->xoopsTpl->assign('formhtml',ob_get_contents());
				ob_end_clean();
				$this->xoopsTpl->assign('title',$this->caption.' &raquo; '.$this->__l('Delete'));
				return SIMPLE_CONTROLLER_VIEW_FORM;
			}
		}
		$this->errorMsg = $this->__e('No Record is found');
		return SIMPLE_CONTROLLER_ACTION_ERROR;
	}

	function deleteokAction() {
	   if (class_exists('XoopsMultiTokenHandler') && !XoopsMultiTokenHandler::quickValidate(XOOPS_TOKEN_DEFAULT)) {
			$this->errorMsg = $this->__e('Token Error');
			return SIMPLE_CONTROLLER_ACTION_ERROR;
		}
		if (isset($_POST[$this->_objectKey])) {			$key = intval(intval($_POST[$this->_objectKey]));			$object =& $this->objectHandler->get($key);
		} else {
			$object = false;
		}
		if (is_object($object)) {			if ($this->objectHandler->delete($object)) {
				return SIMPLE_CONTROLLER_ACTION_SUCESS;
			} else {
				$this->errorMsg = $this->__e('Record Delete Error');
				return SIMPLE_CONTROLLER_ACTION_ERROR;
			}
		}
		$this->errorMsg = $this->__e('No Record is found');
		return SIMPLE_CONTROLLER_ACTION_ERROR;
	}

	function listAction() {
	  	$perpage = 30;
	  	$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
	  	$order = (isset($_GET['order'])&& $_GET['order']=='desc') ? 'desc' : 'asc';
	  	$sort = isset($_GET['sort']) ? htmlspecialchars($_GET['sort'],ENT_QUOTES) : $this->_objectKey;
		if (!$this->objectList->inKey($sort)) $sort = $this->_objectKey;
		if ($this->listFilterCriteria) {
			$criteria =& $this->listFilterCriteria;
		} else {
			$criteria =& new Criteria(1,1);
		}
		$criteria->setStart($start);
		$criteria->setLimit($perpage);
		$criteria->setSort($sort);
		$criteria->setOrder($order);
		$count = $this->objectHandler->getCount($criteria);
		require_once XOOPS_ROOT_PATH.'/class/pagenav.php';
		$extra = 'sort='.$sort.'&amp;order='.$order;
		$pageNav =& new XoopsPageNav($count,$perpage,$start,'start',$extra);
		$objects =& $this->objectHandler->getObjects($criteria);
		$this->objectList->showList($objects, $this->xoopsTpl, $this->caption.' &raquo; '.$this->__l('List'),$sort, $order);
    	$lang['new'] = $this->__l('New');
		$this->xoopsTpl->assign('lang', $lang);
		$this->xoopsTpl->assign('newlink', $this->url.'?op=new');
		$this->xoopsTpl->assign('pagenav', $pageNav->renderNav());
		return SIMPLE_CONTROLLER_VIEW_LIST;
	    break;
	}

	function viewAction() {
		if (isset($_GET[$this->_objectKey])) {			if ($object =& $this->objectHandler->get(intval($_GET[$this->_objectKey]))) {
				return SIMPLE_CONTROLLER_VIEW_SINGLE;
			}
		}
		$this->errorMsg = $this->__e('No Record is found');
		return SIMPLE_CONTROLLER_ACTION_ERROR;
	}

	function __l($msg) {
		  return $msg;
	}

	function __e($msg) {
		  return $msg;
	}
}

class XoopsSimpleAdminController extends XoopsSimpleController{
	var $dirname;
	var $formTemplate;
	var $listTemplate;

	function XoopsSimpleAdminController($name,$caption) {
		$this->name = $name;
		$this->caption = $caption;
		$this->url = xoops_getenv('PHP_SELF');
		$handlerName = $name.'Handler';
		$listName = $name.'AdminList';
		$formName = $name.'AdminForm';
		$this->objectHandler =& new $handlerName($GLOBALS['xoopsDB']);
		$this->objectForm =& new $formName($caption, $name, $this->url, 1);
		$this->objectList =& new $listName();
		$this->xoopsTpl =& new XoopsAdminTpl();
		$this->dirname = $GLOBALS['xoopsModule']->getVar('dirname');
		$this->formTemplate = $this->dirname.'_admin_simpleform.html';
		$this->listTemplate = $this->dirname.'_admin_simplelist.html';
		$this->defautlOp = 'list';
		$this->allowedOp = array('list','new','edit','insert','save','delete','deleteok');
	}
	
	function execute() {
		$result = $this->action();
		switch ($result) {
			case SIMPLE_CONTROLLER_VIEW_FORM:
			case SIMPLE_CONTROLLER_VIEW_LIST:
				global $xoopsConfig, $xoopsModule;
				xoops_cp_header();
				$admin_dir = XOOPS_ROOT_PATH.'/modules/'.$this->dirname.'/admin';
				if (file_exists($admin_dir.'/mymenu.php')) {
					include( $admin_dir.'/mymenu.php' );
				}
				$this->xoopsTpl->assign('modulename', $GLOBALS['xoopsModule']->getVar('name'));
				if ($result == SIMPLE_CONTROLLER_VIEW_FORM) {
			    	$this->xoopsTpl->display($this->formTemplate);
			    } else {
			    	$this->xoopsTpl->display($this->listTemplate);
			    }
				xoops_cp_footer();
				break;
			case SIMPLE_CONTROLLER_VIEW_NONE:
				break;
			case SIMPLE_CONTROLLER_ACTION_ERROR:
				redirect_header($this->url, 2, $this->errorMsg,2);
				break;
			case SIMPLE_CONTROLLER_ACTION_SUCCESS:
				redirect_header($this->url, 2, $this->__l('Action Success'));
				break;
			default:
				break;
		}
	}

	function __l($msg) {
		if (defined('_AD_'.strtoupper($this->dirname).'_LANG_'.str_replace(' ','_',strtoupper($msg)))) {
			return constant('_AD_'.strtoupper($this->dirname).'_LANG_'.str_replace(' ','_',strtoupper($msg)));
		} else {
			return $msg;
		}
	}
	function __e($msg) {
		if (defined('_AD_'.strtoupper($this->dirname).'_ERROR_'.str_replace(' ','_',strtoupper($msg)))) {
			return constant('_AD_'.strtoupper($this->dirname).'_ERROR_'.str_replace(' ','_',strtoupper($msg)));
		} else {
			return $msg;
		}
	}
}

require_once(XOOPS_ROOT_PATH.'/class/template.php');
class XoopsAdminTpl extends XoopsTpl
{
	function XoopsAdminTpl()
	{
		parent::XoopsTpl();
		$this->template_dir = XOOPS_ROOT_PATH . '/modules/' .$GLOBALS['xoopsModule']->getVar('dirname').'/admin/templates';
		$this->error_reporting = error_reporting();
	}

	function fetch($tplfile, $cache_id = null, $compile_id = null, $display = false)
	{
		if (!$compile_id) {
			$compile_id = 'admin_';
		}
		return parent::fetch($tplfile, $cache_id, $compile_id, $display);
	}
}
?>
