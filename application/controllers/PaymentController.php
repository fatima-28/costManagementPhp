<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PaymentController extends CI_Controller {
    public function getAll()
	{
        $this->load->model('PaymentModel');
        
        $data['payment']=$this->PaymentModel->getAll();
        $data['types'] = $this->show_payments();
        $data['currencies'] =  $this->currencies();
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
                'created_date'=> date('Y-m-d H:i:s'), 
                
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

    public function filterData(){
       
        if (!$this->input->is_ajax_request()) {      
            show_404();
        }
        $start_date = $this->input->post('start_date');
        
     
        $end_date = $this->input->post('end_date');
        $currency_id = $this->input->post('currency_id');
     
       
        $payment_type_id = $this->input->post('payment_type_id');
        $this->load->model('PaymentModel');
        
        $filteredData = $this->PaymentModel->filterAndSortData($start_date,$end_date,$currency_id, $payment_type_id);

        $response = array(
            'success' => true,
            'message' => 'Type added successfully.',
            'redirect' => base_url('getpayments')
        );
        header('Content-Type: application/json');
        echo json_encode($filteredData);
    }
    
}

