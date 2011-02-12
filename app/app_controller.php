<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @link http://book.cakephp.org/view/957/The-App-Controller
 */
class AppController extends Controller {
	var $components = array('Acl', 'Auth', 'Session', 'AclFilter', 'UserAuth');
    var $helpers = array('Html', 'Form', 'Javascript', 'Session', 'Time');
	
	/** 
	 * authenticate user and get javascript for view, also adding
	 * default filled field
	 * 
	 * @parameter null
	 * @return true
	 * @author CakePHP
	 */
    function beforeFilter() {
        $this->AclFilter->auth();
        $this->set('modelName', Inflector::singularize($this->name));
		
        if($this->UserAuth->getUserId()) {
            $this->layout = 'default'; //set layout with menu
            $this->set('authRealname', $this->UserAuth->getRealname());
            
            $action = $this->params['action'];
			// form client side scripting automated via jQuery
			$this->set('form_js', FORM_JS);
			
			// load javascript per model if exists 
			$root = dirname(__FILE__);
			if(file_exists($root.'/webroot/js/jsOnPage/'.Inflector::singularize($this->name).'_'.$action.'.js'))
				$this->set('displayJs',true);
			else
				$this->set('displayJs',false);

			// make sure created_by & modified by fields are filled, if table has that fields
			if( !empty($this->data)) {
				if($this->{Inflector::singularize($this->name)}->checkByField()) {
					if($action == 'add') {
						$this->data[Inflector::singularize($this->name)]['created_by'] = $this->UserAuth->getUserId();
					} else if ($action == 'edit') {
						$this->data[Inflector::singularize($this->name)]['modified_by'] = $this->UserAuth->getUserId();
					}
					$this->data[Inflector::singularize($this->name)]['branch_id'] = $this->UserAuth->getBranchId();
				}
			}
        } else {
            $this->layout = 'anonymous'; //set layout without menu
        }
    }
}
