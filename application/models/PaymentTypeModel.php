<?php
 class PaymentTypeModel extends CI_Model{

    public function insertdb($data){
        return  $this->db->insert('payment_options',$data);
    }  
    public function getAll(){
        
        $query=$this->db->get('payment_options');
        return $query->result();
      }  
      // public function get_payment_with_type()
      // {
      //     $this->db->select('payment_options.*, payment.Id');
      //     $this->db->from('payment_options');
      //     $this->db->join('payment', 'payment.payment_type_id = payment_options.Id', 'left');
      //     $query = $this->db->get();
      
      //     return $query->result_array();
      // }
      public function payments() {
        return $this->hasMany('PaymentModel', 'payment_type_id');
    }

}
?>