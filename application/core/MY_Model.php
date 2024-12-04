<?php
class MY_Model extends CI_Model {
	protected $_table;
	public function getAutoIncrementValue() {
		$sql = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = '" . $this->_table . "'";
		$query = $this->db->query ( $sql )->result ();
		// print_r($query[0]->AUTO_INCREMENT);exit();
		if ($query [0]->AUTO_INCREMENT) {
			return $query [0]->AUTO_INCREMENT;
		} else {
			return false;
		}
	}
	function __construct($args = null) {
		parent::__construct ();
		// loading cache
		// $this->load->library('../cache/cachedata');
	}
	private function _getMethodName($key) {
		// Replace _ with space, capitalizes words, then remove spaces
		return str_replace ( ' ', '', ucwords ( str_replace ( '_', ' ', $key ) ) );
	}
	public function get($key) {
		$methodName = 'get' . $this->_getMethodName ( $key );
		if (method_exists ( $this, $methodName )) {
			return $this->$methodName ();
		}
		if (property_exists ( $this, $key )) {
			return $this->$key;
		}
		return FALSE;
	}
	public function set($key, $value) {
		if (property_exists ( $this, $key )) {
			$methodName = 'set' . $this->_getMethodName ( $key );
			if (method_exists ( $this, $methodName )) {
				return $this->$methodName ( $key, $value );
			} else {
				$this->$key = (is_array ( $value )) ? serialize ( $value ) : $value;
				return $this->$key;
			}
		}
	}
	public function getValueByColumnName($key, $value, $column, $count = false) {
		$this->db->select ( $column );
		$this->db->where ( $key, $value );
		$query = $this->db->get ( $this->_table );
		if ($count == false) {
			return $query->row_array ();
		}
		return $query->result_array ();
	}
	public function getBlankModel() {
		$db_columns = $this->db->list_fields ( $this->_table );
		$class = new ReflectionClass ( get_called_class () );
		$data = array_fill_keys ( $db_columns, '' );
		return $class->newInstance ( $data );
	}
	public function _cleanseDate($string) {
		if (strtotime ( $string ) === FALSE) {
			return '0000-00-00';
		}
		return date ( 'Y-m-d', strtotime ( $string ) );
	}
	
	/**
	 * Fetches all rows from table as an array of objects
	 * 
	 * @return array
	 */
	public function getAll($orderby = NULL) {
		if ($orderby) {
			$this->db->order_by ( $orderby );
		}
		$query = $this->db->get ( $this->_table );
		return $this->fetchAll ( $query );
	}
	
	/**
	 * Given a CI query, it returns an array of objects
	 * 
	 * @param $query CI
	 *        	query
	 * @return array
	 */
	public function fetchAll($query) {
		$result = array ();
		foreach ( $query->result () as $row ) {
			$class = new ReflectionClass ( get_called_class () );
			$result [] = $class->newInstance ( $row );
		}
		return $result;
	}
	
	/**
	 * Retrieves by a single where clause
	 * 
	 * @param $key database
	 *        	key
	 * @param $value Value
	 *        	of where clause
	 * @return array
	 */
	public function getByKeyValue($key, $value, $orderby = '') {
		if (gettype ( $value ) == 'array') {
			$this->db->where_in ( $key, $value );
		} else {
			$this->db->where ( $key, $value );
		}
		if ($orderby != '') {
			$this->db->order_by ( $orderby );
		}
		$query = $this->db->get ( $this->_table );
		return $this->fetchAll ( $query );
	}
	
	/**
	 * Retrieves by an array of where clauses
	 * 
	 * @param $key database
	 *        	key
	 * @param $value Value
	 *        	of where clause
	 * @return array
	 */
	public function getByKeyValueArray($where_clauses, $orderby = '') {
		foreach ( $where_clauses as $key => $value ) {
			
			if (gettype ( $value ) == 'array') {
				$this->db->where_in ( $key, $value );
			} else {
				$this->db->where ( $key, $value );
			}
		}
		if ($orderby != '') {
			$this->db->order_by ( $orderby );
		}
		$query = $this->db->get ( $this->_table );
		//echo $query;
		//echo $this>db->last_query();exit;
		
		return $this->fetchAll ( $query );
	}



	public function getByKeyValueArray11($where_clauses, $orcondition='', $orderby = '') {
		foreach ( $where_clauses as $key => $value ) {
			
			if (gettype ( $value ) == 'array') {
				$this->db->where_in ( $key, $value );
			} else {
				$this->db->where ( $key, $value );
			}
		}
		if($orcondition != ''){
			$this->db->or_where( $orcondition );
		}
		if ($orderby != '') {
			$this->db->order_by ( $orderby );
		}
		$query = $this->db->get ( $this->_table );
		
		return $this->fetchAll ( $query );
	}
	
	/**
	 * Retrieves by a single where clause
	 * 
	 * @param $key database
	 *        	key
	 * @param $value Value
	 *        	of where clause
	 * @return array
	 */
	public function getColumnByKeyValue($column, $key, $value, $orderby = '') {
		if ($column) {
			$this->db->select ( $column );
		}
		if (gettype ( $value ) == 'array') {
			$this->db->where_in ( $key, $value );
		} else {
			$this->db->where ( $key, $value );
		}
		if ($orderby != '') {
			$this->db->order_by ( $orderby );
		}
		$query = $this->db->get ( $this->_table );
		return $this->fetchAll ( $query );
	}
	
	/**
	 * Retrieves by an array of where clauses
	 * 
	 * @param $key database
	 *        	key
	 * @param $value Value
	 *        	of where clause
	 * @return array
	 */
	public function getColumnByKeyValueArray($column, $where_clauses, $orderby = '') {
		if ($column) {
			$this->db->select ( $column );
		}
		foreach ( $where_clauses as $key => $value ) {
			
			if (gettype ( $value ) == 'array') {
				$this->db->where_in ( $key, $value );
			} else {
				$this->db->where ( $key, $value );
			}
		}
		if ($orderby != '') {
			$this->db->order_by ( $orderby );
		}
		$query = $this->db->get ( $this->_table );
		
		return $this->fetchAll ( $query );
	}
	public function getOneByKeyValueArray($where_clauses, $orderby = '') {
		foreach ( $where_clauses as $key => $value ) {
			
			if (gettype ( $value ) == 'array') {
				$this->db->where_in ( $key, $value );
			} else {
				$this->db->where ( $key, $value );
			}
		}
		if ($orderby != '') {
			$this->db->order_by ( $orderby );
		}
		$query = $this->db->get ( $this->_table );
		$result = $this->fetchAll ( $query );
		
		if (count ( $result ) > 0) {
			return $result [0];
		}
		return FALSE;
	}
	
	/**
	 * If the result set is expected to have one row in the result set, then it returns the object and not an array
	 * 
	 * @param $key Database
	 *        	key
	 * @param $value Value
	 *        	of where clause
	 * @return bool
	 */
	public function getOneByKeyValue($key, $value, $orderby = '') {
		$this->db->where ( $key, $value );
		if ($orderby != '') {
			$this->db->order_by ( $orderby );
		}
		$query = $this->db->get ( $this->_table );
		$result = $this->fetchAll ( $query );
		if (count ( $result ) > 0) {
			return $result [0];
		}
		return FALSE;
	}
	
	/**
	 * Returns the single row as object by common primary key
	 * 
	 * @param $id Value
	 *        	of id field
	 * @return mixed
	 */
	public function getById($id) {
		$row = $this->getOneByKeyValue ( 'id', $id );
		if ($row) {
			$class = new ReflectionClass ( get_called_class () );
			return $class->newInstance ( $row );
		}
		return NULL;
	}
	
	/**
	 * Wrapper around CI insert function without providing table name, and it returns the insert_id()
	 * This also filters out array elements that do not exist in the database table
	 * 
	 * @param $data Array
	 *        	of data where array key is the db field and the array value is the db value
	 * @return mixed
	 */
	public function insert($data) {
		if (array_key_exists ( 'id', $data )) {
			unset ( $data ['id'] );
		}
		$db_columns = $this->db->list_fields ( $this->_table );
		
		if (in_array ( 'updatedDate', $db_columns )) {
			$data ['updatedDate'] = getCurrentDateTime (); // date("Y-m-d H:i:s", time());
		}
		if (in_array ( 'createdDate', $db_columns )) {
			$data ['createdDate'] = getCurrentDateTime (); // date("Y-m-d H:i:s", time());
		}
		if (in_array ( 'createdBy', $db_columns )) {
			$data ['createdBy'] = 0;
			if ($this->session->userdata ( 'user_id' )) {
				$data ['createdBy'] = $this->session->userdata ( 'user_id' );
			}
		}
		if (in_array ( 'updatedBy', $db_columns )) {
			
			$data ['updatedBy'] = 0;
			if ($this->session->userdata ( 'user_id' )) {
				$data ['updatedBy'] = $this->session->userdata ( 'user_id' );
			}
		}
		
		$insert = array_intersect_key ( $data, array_flip ( $db_columns ) );
	
		
		log_message ( 'debug', print_r ( $insert, TRUE ) );
		if (count ( $insert ) > 0) {
			
			$this->db->insert ( $this->_table, $insert );
			return $this->db->insert_id ();
		}

		return FALSE;
	}
	
	/**
	 * Wrapper around CI update function without providing table name
	 * 
	 * @param
	 *        	$data
	 * @param
	 *        	$where
	 * @return mixed
	 */
	public function update($data, $where) {
		$db_columns = $this->db->list_fields ( $this->_table );
		//print_r($db_columns);
		
		if (in_array ( 'updatedDate', $db_columns )) {
			$data ['updatedDate'] = getCurrentDateTime (); // date("Y-m-d H:i:s", time());
		}
		if (in_array ( 'updatedBy', $db_columns )) {
			
			$data ['updatedBy'] = 0;
			if ($this->session->userdata ( 'user_id' )) {
				$data ['updatedBy'] = $this->session->userdata ( 'user_id' );
			}
		}
		
		if (array_key_exists ( 'id', $data )) {
			unset ( $data ['id'] );
		}
			

		$update = array_intersect_key ( $data, array_flip ( $db_columns ) );
		log_message ( 'debug', print_r ( $update, TRUE ) );

		return $this->db->update ( $this->_table, $update, $where );
		echo $this->db->last_query();
		
	}
	/**
	 * Wrapper around CI batch insert function
	 * 
	 * @param
	 *        	$data
	 * @return mixed
	 */
	public function batch_insert($data, $clone_flag = false) {
		if ($clone_flag == false) {
			foreach ( $data as $key => $val ) {
				$data [$key] ['updatedDate'] = date ( "Y-m-d H:i:s", time () );
				$data [$key] ['createdDate'] = date ( "Y-m-d H:i:s", time () );
				
				$data [$key] ['createdBy'] = 0;
				if ($this->session->userdata ( 'user_id' )) {
					$data [$key] ['createdBy'] = $this->session->userdata ( 'user_id' );
				}
				$data [$key] ['updatedBy'] = 0;
				if ($this->session->userdata ( 'user_id' )) {
					$data [$key] ['updatedBy'] = $this->session->userdata ( 'user_id' );
				}
			}
		}
		return $this->db->insert_batch ( $this->_table, $data );
	}
	
	/**
	 * Wrapper around CI batch update function
	 * 
	 * @param
	 *        	$data
	 * @param string $key        	
	 * @return mixed
	 */
	public function batch_update($data, $key = 'id') {
		foreach ( $data as $row ) {
			$row ['updatedDate'] = date ( "Y-m-d H:i:s", time () );
			$row ['updatedBy'] = 0;
			if ($this->session->userdata ( 'user_id' ))
			{
				$row ['updatedBy'] = $this->session->userdata ( 'user_id' );
			}
		}
		return $this->db->update_batch ( $this->_table, $data, $key );
	}
	public function delete($where) {
		if ($where) {
			return $this->db->delete ( $this->_table, $where );
		}
	}
	public function searchBy($columns = NULL, $key, $value) {
		if ($columns != NULL) {
			$this->db->select ( $columns );
		}
		$this->db->like ( $key, $value, 'after' );
		$query = $this->db->get ( $this->_table );
		return $this->fetchAll ( $query );
	}
	public function getSelectDropdownOptions($where_clauses = array(), $orderby = NULL) {
		$key = $this->getKeyName ();
		$val = $this->getValueName ();
		$this->db->select ( $key . ', ' . $val );
		
		if (count ( $where_clauses ) > 0) {
			foreach ( $where_clauses as $k => $v ) {
				if (gettype ( $v ) == 'array') {
					$this->db->where_in ( $k, $v );
				} else {
					$this->db->where ( $k, $v );
				}
			}
		}
		if ($orderby) {
			$this->db->order_by ( $orderby );
		}
		$query = $this->db->get ( $this->_table );
		$options = array (
				'' => NULL_SELECT_OPTION_TEXT 
		);
		foreach ( $query->result () as $row ) {
			$options [$row->$key] = $row->$val;
		}
		
		return $options;
	}
	public function callStoredProcedure($statement, $data = '') {
		// $this->db->reconnect();
		if ($data == '') {
			$data = array ();
		}
		
		$query = $this->db->query ( $statement, $data );
		return $this->fetchAll ( $query );
	}
}