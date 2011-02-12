<?php
/**
 * User auth component
 * 
 * All authentication function available here
 */

class UserAuthComponent extends Object{
	var $components = array('Auth', 'Session');
	function initialize(&$controller, $settings = array()) {
        $this->controller =& $controller;
    }
    
    /**
     * Authenticate user data
     * @parameter null
	 * @return array userdata
	 * @author CakePHP
	 */
	function __authUser() {
		return $this->Auth->user();
	}
	
	/**
     * get user id
     * @parameter null
	 * @return array userdata
	 * @author CakePHP
	 */
	function getUserId() {
		return $this->Session->read('Auth.User.id');
	}

	/**
     * get user login name
     * @parameter null
	 * @return array userdata
	 * @author CakePHP
	 */
	function getLogin() {
		return $this->Session->read('Auth.User.username');
	}
    
    /**
     * get user real name
     * @parameter null
	 * @return array userdata
	 * @author CakePHP
	 */
    function getRealname() {
        return $this->Session->read('Auth.User.realname');
    }
    
    /**
     * get user group id
     * @parameter null
	 * @return array userdata
	 * @author CakePHP
	 */
    function getGroupId() {
        return $this->Session->read('Auth.User.system_group_id');
    }
}
?>
