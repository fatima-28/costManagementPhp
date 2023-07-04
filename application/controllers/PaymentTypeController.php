<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PaymentTypeController extends CI_Controller {
    public function getAll()
	{
        $this->load->model('PaymentTypeModel');
        $data['types']=$this->PaymentTypeModel->getAll();
        $this->load->view('frontend/getall_payment_types',$data);
    }
    public function add()
	{
       
		$this->load->view('frontend/add_payment_type');
    }
    public function store()
	{
        $this->load->library('form_validation');
       
        $this->form_validation->set_rules('name','Name','required');
       
        if ($this->form_validation->run()) {
            $data= [
                'name'=> $this->input->post('name'),
                ];
           
             $this->load->model('PaymentTypeModel','payment');
             $this->payment->insertdb($data);
          
             redirect(base_url('gettypes'));
        }
        else{
           $this->add();
        }

    }
}

