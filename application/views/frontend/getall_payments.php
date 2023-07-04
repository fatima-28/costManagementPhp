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
        .hide{
          display:none;
        }
        .show{
          display: table-row;
        }
        body{
          padding-left:40px;
        }
    </style>
</head>
<body>
<h1>Payments</h1>
<div class="row">



<form action="<?php echo base_url('filterdata')?>"  id="myForm" method="POST">
<div class="row">
<div class="col-3 m-3">

<label for="start_date">Start Date:</label>
    <input type="date" name="start_date" id="start_date" required value="2023-07-03"> <br>
    
    <label for="end_date">End Date:</label>
    <input type="date" name="end_date" id="end_date" required value="2023-07-30">
    
</div>
<div class="col-3 m-3">
 <label for="">Filter by Category</label> <br>
 <select name="payment_type_id" class="typeSelect">
   
   <?php foreach ($types as $type): ?>
   
       <option value="<?php echo $type->Id; ?>"><?php echo $type->name; ?></option>
   <?php endforeach; ?>
</select>
 </div>

 <div class="col-3 m-3">
 <label for="">Filter by Currency</label> <br>
 <select name="currency_id" class="currencySelect">
    <?php foreach ($currencies as $currency) : ?>
        <option value="<?php echo $currency->Id; ?>"><?php echo $currency->name; ?></option>
    <?php endforeach; ?>

</select>
 </div>
</div>
<button type="submit"  class="btn btn-success m-3 filter">Filter</button>
</div>

</form>
 
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
            <th scope="col">created date</th>
           
          </tr>
        </thead>
        <tbody>

          
          <?php  foreach($payment as $row):?>
          <tr>
          <td><?php  echo $row->Id;?></td>
           
            <td class="type-name">  
            <?php
      
      $payment_type_id = $row->payment_type_id;
      $payment_type_name = $this->db->select('name')->where('Id', $payment_type_id)->get('payment_options')->row()->name;
      echo $payment_type_name;
      ?>  
        </td>

            <td class="currency-name">   <?php
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
            <td class="datetime"><?php  echo $row->created_date;?>
          </tr>
          <?php endforeach;?>
       
        </tbody>
      </table>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
      <script>
      
    $(document).ready(function() {
      $('#myForm').submit(function(e) {
        let form=$(this);
           e.preventDefault();
           
           let urlEncodedString=form.serialize();
           let urlParams = new URLSearchParams(urlEncodedString);
           let jsonData = {};
           for (const [key, value] of urlParams) {
            jsonData[key] = value;
          }
           let jsonString = JSON.stringify(jsonData);
            console.log(jsonString);  
            $.ajax({
              url: form.attr('action'),
                type: 'POST',
                data: jsonString,
                dataType: 'json',
                success: function(response) {
                  console.log(response);
                 
                },
                error: function(xhr,status,err) {
                  console.log(xhr);
                  console.log(status);
                  console.log(err);
                }
            });
        });
    });
</script>

</div>
</body>
</html>
