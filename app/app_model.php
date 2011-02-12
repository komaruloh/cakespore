<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @subpackage    cake.cake.libs.model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application model for Cake.
 *
 * This is a placeholder class.
 * Create the same file in app/app_model.php
 * Add your application-wide methods to the class, your models will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.model
 */
class AppModel extends Model {
	/**
	 * Check Field
	 * 
	 * Function to check if one table has created_by and modified_by field
	 * so it can determine which field filled when editing or adding data
	 * 
	 * @version initial
	 * @created 29Jan2011
	 * @author Desanto W (weird2think@gmail.com)
	 */
	function checkByField() {
        //Get the name of the table
        $db =& ConnectionManager::getDataSource($this->useDbConfig);
        $tableName = $db->fullTableName($this, false);

        // cek if field created_by and modified_by is exists in current table
        $result = $this->query("SELECT column_name FROM information_schema.columns WHERE table_name ='{$tableName}' and column_name LIKE '%ed_by';");
        if( isset( $result[0]['COLUMNS']['column_name']) || isset($result[0][0]['column_name'])) {
            return true;
        } else {
            return false;
        }
    }
}
