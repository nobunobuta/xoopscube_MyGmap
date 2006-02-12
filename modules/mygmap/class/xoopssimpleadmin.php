<?php
define('SIMPLE_ADMIN_VIEW_LIST', '1');
define('SIMPLE_ADMIN_VIEW_FORM', '2');
define('SIMPLE_ADMIN_VIEW_NONE', '99');

class XoopsSimpleAdmin {
	var $name;
	var $objectHandler;
	var $objectForm;
	var $objectList;
	var $xoopsTpl;

	function XoopsSimpleAdmin($name,$caption) {
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
	}
	
	function execute() {
		$object =& $this->objectHandler->create();
		$objectKey = $object->getKeyFields();
		$objectKey = $objectKey[0];

		if (!isset($_REQUEST['op'])) $_REQUEST['op'] = '';
		switch ($_REQUEST['op']) {
		  case 'insert':
		  case 'save':
		   if (class_exists('XoopsMultiTokenHandler') && !XoopsMultiTokenHandler::quickValidate($this->name.'_'.$_REQUEST['op'])) {
				redirect_header($this->url,1,'Token Error');
			}
			if (($_REQUEST['op']=='save')&& isset($_POST[$objectKey])) {				$object =& $this->objectHandler->get(intval($_POST[$objectKey]));
			} else if ($_REQUEST['op']=='save'){
				$object =& $this->objectHandler->create();
			} else {
				$object = false;
			}
			if (is_object($object)) {				$object->setFormVars($_POST,'');
				if (!$this->objectHandler->insert($object,false,true)) {
					$object->setFormVars($_POST,'');
					$this->objectForm->setCaption($this->caption.' &raquo; '.$this->_getLang('Edit'));
					$this->objectForm->_showForm($object, &$this->xoopsTpl, $this->objectHandler->getErrors());
					return SIMPLE_ADMIN_VIEW_FORM;
				}
			} else {
				redirect_header($this->url,1,'');
				exit();
			}
			redirect_header($this->url,1,'');
			exit();
			break;
		  case 'delete':
			if (isset($_GET[$objectKey])) {
				$key = intval(intval($_GET[$objectKey]));				$object =& $this->objectHandler->get($key);
				if (is_object($object)) {
					ob_start();
					xoops_confirm(array('op'=>'deleteok',$objectKey=>$key), $this->url, "Delete Area ID=".$key." ?");
					$this->xoopsTpl->assign('formhtml',ob_get_contents());
					ob_end_clean();
					$this->xoopsTpl->assign('title',$this->caption.' &raquo; '.$this->_getLang('Delete'));
					return SIMPLE_ADMIN_VIEW_FORM;
				}
			}
			redirect_header($this->url,1,'');
			exit();
		    break;
		  case 'deleteok':
		   if (class_exists('XoopsMultiTokenHandler') && !XoopsMultiTokenHandler::quickValidate(XOOPS_TOKEN_DEFAULT)) {
				redirect_header($this->url,1,'Token Error');
				exit();
			}
			if (isset($_POST[$objectKey])) {				$key = intval(intval($_POST[$objectKey]));				$object =& $this->objectHandler->get($key);
			} else {
				$object = false;
			}
			if (is_object($object)) {				if (!$this->objectHandler->delete($object)) {
					redirect_header($this->url,1,'');
					exit();
				}
			} else {
				redirect_header($this->url,1,'');
				exit();
			}
			redirect_header($this->url,1,'');
			exit();
		    break;
		  case 'new':
			$object =& $this->objectHandler->create();
			$object->setFormVars($_POST,'');
			$this->objectForm->setCaption($this->caption.' &raquo; '.$this->_getLang('New'));
			$this->objectForm->_showForm($object, &$this->xoopsTpl);
			return SIMPLE_ADMIN_VIEW_FORM;
			break;
		  case 'edit':
			if (isset($_GET[$objectKey])) {				if ($object =& $this->objectHandler->get(intval($_GET[$objectKey]))) {
					$this->objectForm->setCaption($this->caption.' &raquo; '.$this->_getLang('Edit'));
					$this->objectForm->_showForm($object, &$this->xoopsTpl);
					return SIMPLE_ADMIN_VIEW_FORM;
				}
			}			redirect_header($this->url,1,'');
			exit();
			break;
		  default:
			$criteria = new CriteriaElement();
			$criteria->setSort($objectKey);
			$objects =& $this->objectHandler->getObjects($criteria);
			$this->objectList->_showList($objects, $this->xoopsTpl, $this->caption.' &raquo; '.$this->_getLang('List'), $this->url);
	    	$lang['edit'] = $this->_getLang('Edit');
	    	$lang['delete'] = $this->_getLang('Delete');
	    	$lang['new'] = $this->_getLang('New');
			$this->xoopsTpl->assign('lang', $lang);
			$this->xoopsTpl->assign('newlink', $url.'?op=new');
			return SIMPLE_ADMIN_VIEW_LIST;
		    break;
		}
		return SIMPLE_ADMIN_VIEW_NONE;
	}
	
	function _getLang($msg) {
		  return constant('_AD_'.strtoupper($GLOBALS['xoopsModule']->getVar('dirname')).'_LANG_'.strtoupper($msg));
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
