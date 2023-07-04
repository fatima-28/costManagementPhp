<?php
 class PaymentModel extends CI_Model{

    public function insertdb($data){
        return  $this->db->insert('payment',$data);
    }  
    public function getAll(){
        
        $query=$this->db->get('payment');
        return $query->result();
      }   
      public function type() {
        return $this->belongsTo('PaymentTypeModel', 'payment_type_id');
    }
    public function currency() {
        return $this->belongsTo('CurrencyModel', 'currency_id');
    }


// currency one  payment many
// payment_options one    payment  many
}
?>