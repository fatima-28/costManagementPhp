<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   
    <title>Document</title>
</head>
<body>
 <div class="col-3 m-3">
 <h1>Payment Types</h1>
 </div>
<div class="col-4 m-3" >
    <table class="table  table-bordered">
        <thead>
          <tr class="table-info">
          <th scope="col">id</th>
            <th scope="col">name</th>
           
          </tr>
        </thead>
        <tbody> 
          <?php  foreach($types as $row):?>
          <tr>
          <td><?php  echo $row->Id;?></td>
            <td><?php  echo $row->name;?></td>
           
          </tr>
          <?php endforeach;?>
       
        </tbody>
      </table>
</div>
</body>
</html>
