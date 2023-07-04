<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Add</title>
    <style>
        .error-message {
            color: red;
        }
    </style>
</head>
<body>
<div class="col-4 d-flex" style="border: 1px solid rgb(198, 198, 198); margin: 50px auto; padding: 20px 30px; border-radius: 20px;">
    <form id="myForm" action="<?php echo base_url('ptstore');?>" method="POST">
        <div class="form-group">
            <label for="TypeOfPayment">Type Of Payment Name</label>
            <input type="text" class="form-control" name="name" id="TypeOfPayment" aria-describedby="emailHelp" placeholder="Enter name">
            <small class="error-message"></small>
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
