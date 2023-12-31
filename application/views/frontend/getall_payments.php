<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
 <style>
    .money {
    color: green !important;
}
.hide {
    display: none;
}
.show {
    display: table-row;
}
body {
    padding-left: 40px;
}
form{
  gap:6%
}
.total-ctn{
    color:red;
    font-weight:600;
}
 </style>
</head>
<body>
    <h1>Payments</h1>
    
        <form action="<?php echo base_url('filterdata') ?>" id="myForm" method="POST" class="d-flex">
            
                <div class="form-group">
                    <label for="start_date">Start Date:</label>
                    <input type="date" name="start_date" id="start_date" required value="2023-07-03"> <br>
                    <label for="end_date">End Date:</label>
                    <input type="date" name="end_date" id="end_date" required value="2023-07-30">

                </div>
                <div class="form-group">
                <label for="">Filter by Currency</label> <br>
                    <select name="currency_id" class="currencySelect">
                        <?php foreach ($currencies as $currency) : ?>
                            <option value="<?php echo $currency->Id; ?>"><?php echo $currency->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Filter by Category</label> <br>
                    <select name="payment_type_id" class="typeSelect">
                        <?php foreach ($types as $type): ?>
                            <option value="<?php echo $type->Id; ?>"><?php echo $type->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
               
           <div class="form-group">
           <button type="submit" class="btn btn-success m-3 filter">Filter</button>
           </div>
           
        </form>
     <div class="col-3 card-col d-none" >
     <div class="card" style="width: 18rem;">
  
  <div class="card-body">
    <h5 class="card-title">Totals</h5>
    <span class="card-text">Income:</span> <span class="total-ctn t-income">0</span> <br>
    <span class="card-text">Expense:</span> <span class="total-ctn t-expense">0</span><br>
    <span class="card-text">Remain:</span> <span class="total-ctn t-remain">0</span>
     </div>
</div>
     </div>
    <div class="col-10 m-3">
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
                <?php foreach ($payment as $row): ?>
                    <tr class="infos">
                        <td class="data-id"><?php echo $row->Id; ?></td>
                        <td class="type-name">
                            <?php
                                $payment_type_id = $row->payment_type_id;
                                $payment_type_name = $this->db->select('name')->where('Id', $payment_type_id)->get('payment_options')->row()->name;
                                echo $payment_type_name;
                            ?>  
                        </td>
                        <td class="currency-name">
                            <?php
                                $currency_id = $row->currency_id;
                                $currency_name = $this->db->select('name')->where('Id', $currency_id)->get('currency')->row()->name;
                                echo $currency_name;
                            ?>
                        </td>
                        <td><?php echo $row->comment; ?></td>
                        <?php if ($row->is_income == 1): ?>
                            <td><?php echo $row->amount; ?><span class="money"><?php
                                $currency_id = $row->currency_id;
                                $currency_name = $this->db->select('name')->where('Id', $currency_id)->get('currency')->row()->name;
                                echo $currency_name;
                            ?></span></td>
                            <td>0</td>
                        <?php endif; ?>
                        <?php if ($row->is_income == 0): ?>
                            <td>0</td>
                            <td><?php echo $row->amount; ?><span class="money"><?php
                                $currency_id = $row->currency_id;
                                $currency_name = $this->db->select('name')->where('Id', $currency_id)->get('currency')->row()->name;
                                echo $currency_name;
                            ?></span></td>
                        <?php endif; ?>
                        <td><?php echo $row->amount; ?></td>
                        <td class="datetime"><?php echo $row->created_date; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="alert alert-info hide " role="alert">
        No data found for the filtering criteria!
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
        <script>
         $(document).ready(function() {
                    $('#myForm').submit(function(e) {
                    e.preventDefault();
                    let tbody=document.querySelector("tbody");
                      var form = $(this);
                      let isExist=false;
                      let thead=document.querySelector("thead");
                      let totalIncome=document.querySelector(".t-income");
                      let totalExpense=document.querySelector(".t-expense");
                      let totalRemain=document.querySelector(".t-remain");
                      let cardCol=document.querySelector(".card-col");
                      let alert=document.querySelector(".alert");
                       if (thead.classList.contains("hide")) {
                        cardCol.classList.remove("hide");
                         thead.classList.remove("hide");
                         alert.classList.add("hide");
                       }
                       if (cardCol.classList.contains("d-none")) {
                        cardCol.classList.remove("d-none")
                       }
                       totalIncome.innerHTML=0;
                       totalExpense.innerHTML=0;
                       totalRemain.innerHTML=0;
                    //  console.log(form.serialize());
          
            $.ajax({
              url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                dataType: 'html',
                success: function(response) {
                    
                 let trs=document.querySelectorAll(".infos");
                
                 trs.forEach(item => {
                  item.classList.add("hide");
                 
                 });
                 var jsonData = JSON.parse(response);
                  jsonData.forEach(item => {
                    console.log(item);
                    let dataIds=document.querySelectorAll(".data-id");
                    dataIds.forEach(elem => {
                        if (elem.innerHTML===item.Id) {
                            elem.parentElement.classList.remove("hide");
                            isExist=true;
                            if (item.is_income==1) {
                                totalIncome.innerHTML= parseInt(totalIncome.innerHTML)+parseInt(item.amount);
                                totalExpense.innerHTML=parseInt(totalExpense.innerHTML)+0;
                                totalRemain.innerHTML= parseInt(totalRemain.innerHTML)+parseInt(item.amount);
                            }
                            else{
                                totalExpense.innerHTML= parseInt(totalExpense.innerHTML)+parseInt(item.amount);
                                totalIncome.innerHTML=parseInt(totalIncome.innerHTML)+0;
                                totalRemain.innerHTML= parseInt(totalRemain.innerHTML)+parseInt(item.amount);
                        
                            }
                           
                        }
                       
                    });
                  });
                  if (isExist==false) {
                       
                        thead.classList.add("hide");
                        alert.classList.remove("hide");
                        cardCol.classList.add("hide");

                    }
                 
                },
                error: function(xhr,status,err) {
                 
                  console.log(err);
                }
                  });
                 });
                 });
        </script>
</body>
</html>

