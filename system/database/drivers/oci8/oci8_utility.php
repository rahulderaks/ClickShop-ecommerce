<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CI_DB_oci8_utility extends CI_DB_utility {

	/**
	 * List databases statement
	 *
	 * @var	string
	 */
	protected $_list_databases	= 'SELECT username FROM dba_users'; // Schemas are actual usernames

	/**
	 * Export
	 *
	 * @param	array	$params	Preferences
	 * @return	mixed
	 */
	protected function _backup($params = array())
	{
		// Currently unsupported
		return $this->db->display_error('db_unsupported_feature');
	}

}
