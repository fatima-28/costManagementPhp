<?php
 class PaymentTypeModel extends CI_Model{

    public function insertdb($data){
        return  $this->db->insert('payment_options',$data);
    }  
    public function getAll(){
        
        $query=$this->db->get('payment_options');
        return $query->result();
      }  
   
      public function payments() {
        return $this->hasMany('PaymentModel', 'payment_type_id');
    }

}
?>