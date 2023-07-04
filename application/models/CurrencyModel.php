<?php
 class CurrencyModel extends CI_Model{

    public function insertdb($data){
        return  $this->db->insert('currency',$data);
    }  
    public function getAll(){
        
        $query=$this->db->get('currency');
        return $query->result();
      }  
      public function currencies() {
        return $this->hasMany('PaymentModel', 'currency_id');
    }
}
?>