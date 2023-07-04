<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CurrencyController extends CI_Controller {
    public function getAll()
	{
        $this->load->model('CurrencyModel');
        $data['currency']=$this->CurrencyModel->getAll();
        $this->load->view('frontend/getall_currency',$data);
    }
    public function add()
	{
		$this->load->view('frontend/add_currency');
    }
    public function store()
	{
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $this->load->library('form_validation');
       
        $this->form_validation->set_rules('name','Name','required');
       
        if ($this->form_validation->run()) {
            $data= [
                'name'=> $this->input->post('name'),
               
               ];
           
             $this->load->model('CurrencyModel','currency');
             $this->currency->insertdb($data);
             $response = array(
                'success' => true,
                'message' => 'Currency added successfully.',
                'redirect' => base_url('getcurrency') 
            );
            // redirect(base_url('getcurrency'));
        }
        else{
            $response = array(
                'success' => false,
                'message' => validation_errors()
            );
          // $this->add();
        }
        header('Content-Type: application/json');
        echo json_encode($response);
       

		
    }
}

