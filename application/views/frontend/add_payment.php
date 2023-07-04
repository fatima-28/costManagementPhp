<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Add</title>
    <style>
        small{
            color:red;
        }
    </style>
</head>
<body>
<div class="col-4 d-flex " style="border: 1px solid rgb(198, 198, 198); margin: 50px auto; padding: 20px 30px; border-radius: 20px;">
    
    <form id="myForm" action="<?php  echo base_url('pstore');?>" method="POST">
        <div class="form-group">
          <label for="TypeOfPayment">Amount</label>
          <input type="text" class="form-control" name="amount" id="TypeOfPayment" aria-describedby="emailHelp" placeholder="Enter amount">
      <small> <?php echo form_error('amount'); ?></small>
        </div>
   <div class="form-group">
   <label for="TypeOfPayment" class="d-block">Category</label>
   <select name="payment_type_id">
   
    <?php foreach ($types as $type): ?>
    
        <option value="<?php echo $type->Id; ?>"><?php echo $type->name; ?></option>
    <?php endforeach; ?>
</select>
   </div>

   <div class="form-group">
   <label for="TypeOfPayment" class="d-block">Currency</label>
  
   
<select name="currency_id">
    <?php foreach ($currencies as $currency) : ?>
        <option value="<?php echo $currency->Id; ?>"><?php echo $currency->name; ?></option>
    <?php endforeach; ?>

</select>
<div class="form-group">
<label for="is_income">Income/Expense</label> <br>
    <input type="radio" name="is_income" value="1" checked>
  
        <span>Income</span>
   
    <br>
    <input type="radio" name="is_income" value="0">
   
        <span>Expense</span>
    
        
</div>
   </div>
       
        <div class="form-group">
          <label for="TypeOfPayment">Comment</label>
          <input type="text" class="form-control" name="comment" id="TypeOfPayment" aria-describedby="emailHelp" placeholder="Enter comment">
      
        </div>
    
      
        <button type="submit" class="btn btn-primary">Add</button>
      </form>
    
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myForm').submit(function(e) {
            e.preventDefault();

            var form = $(this);

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        if (response.redirect) {
                            window.location.href = response.redirect;
                        }
                    } else {
                        var small = $('small');
                let message=$(response.message).text()
                small.text(message);
                    }
                },
                error: function() {
                    alert('An error occurred while submitting the form.');
                }
            });
        });
    });
</script>
</body>
</html>