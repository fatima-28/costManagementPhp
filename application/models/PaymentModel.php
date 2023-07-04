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

    public function filterAndSortData($startDate,$endDate,$currencyId, $typeId)
    {


        if (($startDate!==null)&&($endDate!==null)) {
           
        $this->db->where('created_date >', $startDate);
        $this->db->where('created_date <', $endDate);
        
        
        }
      
        
       
        if (!empty($currencyId)) {
            $this->db->where('currency_id', $currencyId);
        }
        if (!empty($typeId)) {
            $this->db->where('payment_type_id', $typeId);
        }

       
        $query = $this->db->get('payment');
        $filteredData = $query->result();

        return $filteredData;
    }

    
}
?>