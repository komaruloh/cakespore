<?php 
/**
 * ACL Filtering Component
 *
 * This file is application-wide ACL file. You can put all
 * ACL function-related methods here.
 */
 
class AclFilterComponent extends Object {
    function initialize(&$controller, $settings = array()) {
        $this->controller =& $controller;
    }

	/** 
	 * authenticate user data when login, and also determine
	 * when user at first login or not
	 * 
	 * @parameter null
	 * @return true
	 * @author Desanto W (weird2think@gmail.com)
	 */
    function auth() {
        //Configure AuthComponent
        $this->controller->Auth->authorize = 'actions';
        $this->controller->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->controller->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
        $this->controller->Auth->loginRedirect = array('controller' => 'homes', 'action' => 'index');        
        $this->controller->Auth->actionPath = 'Controllers/';
        $this->controller->Auth->userScope = array('User.active' => '1');
        $this->controller->Auth->autoRedirect = false;
        
        if($this->controller->Auth->user() && $this->controller->Auth->user('group_id') == 3) {
            // Group: Admin still dont know how to not hardcode this
            $this->controller->Auth->allow('*'); 
            
        } else {
			
            if($this->controller->Auth->user()) {
				
                if(($this->controller->name=='Menus' && $this->controller->action=='show_menus') || 
                   ($this->controller->name=='Home' && $this->controller->action=='index')) {
					
                    // untuk menus->show_menus dan home diperbolehkan
                    $this->controller->Auth->allow();

                } else {
                    $groupId = $this->controller->Auth->user('group_id');
                    $thisControllerNode = $this->controller->Acl->Aco->node($this->controller->Auth->actionPath.$this->controller->name);

                    if($thisControllerNode) {
                        $thisControllerNode = $thisControllerNode['0'];

                        $aroCurrent = $this->controller->Acl->Aro->find('first', array('conditions' => array('model'=>'Group', 
																										     'foreign_key'=>$groupId)));

                        $allowedActions = $this->controller->Acl->Aco->Permission->find('list', array(
																		'conditions' => array('Permission.aro_id' => $aroCurrent['Aro']['id'],
																							  'Permission.aco_id' => $thisControllerNode['Aco']['id'],
																							  'Permission._create' => 1,
																							  'Permission._read' => 1,
																							  'Permission._update' => 1,
																							  'Permission._delete' => 1,),
																		'fields' => array('id','aco_id'),
																		'recursive' => '-1',));
                        
                        if(isset($allowedActions) && !empty($allowedActions)) {
                            $this->controller->Auth->allow();
                        }
                    }
                }
            } else { 
				//initial login page
                $this->controller->Auth->allow('anon');
            }
        }
    }
}
?>
