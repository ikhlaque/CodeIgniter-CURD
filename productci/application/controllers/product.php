<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		// load library
		$this->load->library(array('table','form_validation'));
		
		// load helper
		$this->load->helper('url');
		
		// load model
		$this->load->model('Product_model','',TRUE);
	}
	
	function index()
	{
				
		// load data
		$products = $this->Product_model->get_paged_list()->result();
		
		
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No', 'Name', 'Description', 'Actions');
		$i = 0;
		foreach ($products as $product)
		{
			$this->table->add_row(++$i, $product->name, $product->description, 				
				anchor('product/update/'.$product->id,'update',array('class'=>'update')).' / '.
				anchor('product/delete/'.$product->id,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this product?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		// load view
		$this->load->view('productList', $data);
	}
	
	function add()
	{
		// set empty default form field values
		$this->_set_fields();
		
		// set common properties
		$data['title'] = 'Add New product';
		$data['action'] = site_url('product/addProduct');
	

		$data['country_list'] = $this->Product_model->get_dropdown_list_country();


		//echo '<pre>'; print_r($data['country_list']); exit;
	
		// load view
		$this->load->view('productEdit', $data);
	}
	
	function addProduct()
	{
		// set common properties
		$data['title'] = 'Add new product';
		$data['action'] = site_url('product/addProduct');
		

		$data['country_list'] = $this->Product_model->get_dropdown_list_country();
		
		// set empty default form field values
		$this->_set_fields();

		
		// save data
		$product = array('name' => $this->input->post('name'),
						'description' => $this->input->post('description'),
						'country' => $this->input->post('cbcountry'),
						'state' => $this->input->post('cbstate'),
						'city' => $this->input->post('cbcity'));
		$id = $this->Product_model->save($product);
		
		
		redirect('product/index/','refresh');
	
	}
	

	
	function update($id)
	{
	
	
		$this->form_data = new stdClass;		
		// prefill form values
		$product = $this->Product_model->get_by_id($id)->row();
		$this->form_data->id = $id;
		$this->form_data->name = $product->name;
		$this->form_data->description =$product->description;

		$data['selectedcountry'] = $product->country;
		$data['selectedstate'] = $product->state;
		$data['selectedcity'] = $product->city;


		$data['country_list'] = $this->Product_model->get_dropdown_list_country();	
		$data['state_list'] = $this->Product_model->get_dropdown_list_state($data['selectedstate']);
		$data['cities_list'] = $this->Product_model->get_dropdown_list_city($data['selectedstate'], $data['selectedcountry']);

		
		// set common properties
		$data['title'] = 'Update product';
		$data['action'] = site_url('product/updateProduct');
	
	
		// load view
		$this->load->view('productEdit', $data);
	}
	
	function updateProduct()
	{
		// set common properties
		$data['title'] = 'Update product';
		$data['action'] = site_url('product/updateProduct');
	
		
		// set empty default form field values
		$this->_set_fields();

		
		// save data
		$id = $this->input->post('id');
		$product = array('name' => $this->input->post('name'),
					'description' => $this->input->post('description'),
					'country' => $this->input->post('cbcountry'),
					'state' => $this->input->post('cbstate'),
					'city' => $this->input->post('cbcity'));
		$this->Product_model->update($id,$product);
		
		

		redirect('product/index/','refresh');
	}
	
	function delete($id)
	{
		// delete product
		$this->Product_model->delete($id);
		
		// redirect to product list page
		redirect('product/index/','refresh');
	}
	
	// set empty default form field values
	function _set_fields()
	{
		$this->form_data = new stdClass;
		$this->form_data->id = '';
		$this->form_data->name = '';
		$this->form_data->description = '';	
		$this->form_data->country = '';	
		$this->form_data->state = '';		
		$this->form_data->city = '';
	}
	
	
	public function select_validate_country()
	{
		if ($this->input->post('cbcountry') == '')
		{
			$this->form_validation->set_message('select_validate_country', 'Select %s');
			return false;
		}
		else
		{
			return true;
		}
	}
	
	

	function get_state($stateid){
		
		$data['state_list'] = $this->Product_model->get_dropdown_list_state($stateid);
		echo json_encode($data['state_list']);
	}


	function get_cities($stateid, $countryid){
		
		$data['cities_list'] = $this->Product_model->get_dropdown_list_city($stateid, $countryid);
		echo json_encode($data['cities_list']);
	}
}
?>