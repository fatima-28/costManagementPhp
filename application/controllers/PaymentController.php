<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PaymentController extends CI_Controller {
    public function getAll()
	{
        $this->load->model('PaymentModel');
        // $data['types'] = $this->show_payments();
        // $data['currencies'] =  $this->currencies();
        $data['payment']=$this->PaymentModel->getAll();
        $this->load->view('frontend/getall_payments',$data);
    }
  
    public function add()
	{  
        $data['types'] = $this->show_payments();
        $data['currencies'] =  $this->currencies();
        $data['is_income'] = 1; 
        $this->load->view('frontend/add_payment', $data);
		
    }
    public function show_payments() {   
        $this->load->model('PaymentTypeModel');
        $this->load->model('PaymentModel');

        $types = $this->PaymentTypeModel->getAll();
        return $types;
     
    }
    public function currencies() {   
        $this->load->model('CurrencyModel');
        $this->load->model('PaymentModel');
        $currencies = $this->CurrencyModel->getAll();
       return $currencies;

        
    }
    
    public function store()
	{
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $this->load->library('form_validation');
       
        $this->form_validation->set_rules('amount','Amount','required');
        $this->form_validation->set_rules('is_income','Income/Expense','required');
       
        if ($this->form_validation->run()) {
            $data= [
                'amount'=> $this->input->post('amount'),             
                'payment_type_id'=> $this->input->post('payment_type_id'), 
                'currency_id'=> $this->input->post('currency_id'), 
                'comment'=> $this->input->post('comment'), 
                'is_income'=> $this->input->post('is_income'), 
                
               ];
               
           
             $this->load->model('PaymentModel','payment');
             $this->payment->insertdb($data);
          
              $response = array(
                'success' => true,
                'message' => 'Type added successfully.',
                'redirect' => base_url('getpayments')
            );
        } else {
            $response = array(
                'success' => false,
                'message' => validation_errors()
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
       

    }
}

