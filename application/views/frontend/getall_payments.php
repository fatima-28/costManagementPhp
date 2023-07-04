<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   
    <title>Document</title>
    <style>
        .money{
            color:green;
        }
    </style>
</head>
<body>
<div class="col-3 m-3">
    <select class="form-control" id="exampleFormControlSelect1 " >
        <option>sort by date</option>
        <option> sort by category</option>
        <option> sort by currency</option>
       
      </select>
 </div>
 <div class="col-6 m-3">
 <h1>Payments</h1>
 </div>
<div class="col-10 m-3" >
    <table class="table  table-bordered">
        <thead>
          <tr class="table-info">
          <th scope="col">id</th>
          
            <th scope="col">payment type</th>
            <th scope="col">currency</th>
            <th scope="col">comment</th>
            <th scope="col">income</th>
            <th scope="col">expense</th>   
            <th scope="col">remain</th>
           
          </tr>
        </thead>
        <tbody>

          
          <?php  foreach($payment as $row):?>
          <tr>
          <td><?php  echo $row->Id;?></td>
           
            <td>  
            <?php
      
      $payment_type_id = $row->payment_type_id;
      $payment_type_name = $this->db->select('name')->where('Id', $payment_type_id)->get('payment_options')->row()->name;
      echo $payment_type_name;
      ?>  
        </td>

            <td>   <?php
      $currency_id = $row->currency_id;
      $currency_name = $this->db->select('name')->where('Id', $currency_id)->get('currency')->row()->name;
      echo $currency_name;
      ?></td>
            <td><?php  echo $row->comment;?></td>
          
            <?php if ($row->is_income == 1): ?>
                <td><?php  echo $row->amount;?>
                <span class="money"> <?php
      $currency_id = $row->currency_id;
      $currency_name = $this->db->select('name')->where('Id', $currency_id)->get('currency')->row()->name;
      echo $currency_name;
      ?></span>
            </td>
            <td>0 </td>
  
            <?php endif; ?>
            <?php if ($row->is_income == 0): ?>
                <td>0</td>
                <td><?php  echo $row->amount;?>
               <span class="money"> <?php
      $currency_id = $row->currency_id;
      $currency_name = $this->db->select('name')->where('Id', $currency_id)->get('currency')->row()->name;
      echo $currency_name;
      ?></span></td>
            
  
            <?php endif; ?>
            <td><?php  echo $row->amount;?>
              
           
           
          </tr>
          <?php endforeach;?>
       
        </tbody>
      </table>
</div>
</body>
</html>
