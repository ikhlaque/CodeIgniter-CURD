<?php
class Product_model extends CI_Model {
	
	private $tbl_product= 'tbl_product';
	private $tbl_country= 'tbl_country';
	private $tbl_state = 'tbl_state';
	private $tbl_city = 'tbl_city';
	
	function __construct(){
		parent::__construct();
	}

	function get_dropdown_list_country(){
		$this->db->order_by('id','asc');
		$result = $this->db->get($this->tbl_country);
		$return = array();
		$return = array(0 => 'Select Country');
		if($result->num_rows() > 0) {
			
			foreach($result->result_array() as $row) {
				$return[$row['id']] = $row['country'];
			}
		}

		return $return;
	}

	function get_dropdown_list_state($countryid){
		$this->db->where('countryID', $countryid);
		$result = $this->db->get($this->tbl_state);
		$return = array(0 => 'Select State');

		if($result->num_rows() > 0) {
			
			foreach($result->result_array() as $row) {
				$return[$row['id']] = $row['state'];

			}
		}

		return $return;
	}

	function get_dropdown_list_city($stateid, $countryid){
		$this->db->where('countryID', $countryid);
		$this->db->where('stateID', $stateid);
		$result = $this->db->get($this->tbl_city);
		$return = array(0 => 'Select City');

		if($result->num_rows() > 0) { 
			foreach($result->result_array() as $row) {
				$return[$row['id']] = $row['city'];

			}
		}

		return $return;
	}

	
	function get_paged_list(){
		$this->db->order_by('id','asc');
		return $this->db->get($this->tbl_product);
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->tbl_product);
	}
	
	function save($product){
		$this->db->insert($this->tbl_product, $product);
		return $this->db->insert_id();
	}
	
	function update($id, $product){
		$this->db->where('id', $id);
		$this->db->update($this->tbl_product, $product);
	}
	
	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->tbl_product);
	}
}
?>