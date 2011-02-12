<?php
class Basic extends AppModel{
    var $name = 'Basic';
    var $belongsTo = array('Group');
    var $useTable = 'users';
    /**
     * Provides automated functioning from Acl Behavior, which
     * in turn provides functionality from TreeBehavior
     * @access public
     * @var array
     */
    var $actsAs = array('Acl' => 'requester');
     
    function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        $data = $this->data;
        if (empty($this->data)) {
            $data = $this->read();
        }
        if (empty($data['User']['group_id'])) {
            return null;
        } else {
            return array('Group' => array('id' => $data['User']['group_id']));
        }
    }
    
    function afterSave($created) {
        if (!$created) {
            $parent = $this->parentNode();
            $parent = $this->node($parent);
            $node = $this->node();
            $aro = $node[0];
            $aro['Aro']['parent_id'] = $parent[0]['Aro']['id'];
            $this->Aro->save($aro);
        } else {
            $this->id = $this->getLastInsertId();
		    // first create alias for the newly created Aro
		    // ACL Behavior does NOT manage alias values
		    $this->__createAroAlias();
        }
    }
    
    /**
     * Creates an alias value for a newly created user.
     * 
	 * @returns boolean TRUE if alias value successfully changed.
     */
	function __createAroAlias()
	{
	    $aroId = $this->Aro->getLastInsertId();
		$this->Aro->create();
		$this->Aro->id = $aroId;
		if( $this->Aro->saveField('alias', $this->data['User']['username'] ) ){
		    return TRUE;
		} else {
		    return FALSE;
		}
	}
}
?>
