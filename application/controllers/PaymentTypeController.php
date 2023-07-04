<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PaymentTypeController extends CI_Controller {
    public function getAll()
    {
        $this->load->model('PaymentTypeModel');
        $data['types'] = $this->PaymentTypeModel->getAll();
        $this->load->view('frontend/getall_payment_types', $data);
    }

    public function add()
    {
        $this->load->view('frontend/add_payment_type');
    }

    public function store()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'name' => $this->input->post('name'),
            ];

            $this->load->model('PaymentTypeModel', 'payment');
            $this->payment->insertdb($data);
            $response = array(
                'success' => true,
                'message' => 'Type added successfully.',
                'redirect' => base_url('gettypes')
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
