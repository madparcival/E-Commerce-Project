<?php
    include('../inc.php');
    include('../functions/func.php');
    
if(isAdmin()){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
</head>

<body>
    
    <h1>Orders</h1>
    <table class="table table-light table-striped table-hover table-responsive-md table-bordered">
  <thead class="table-dark">
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Order ID</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Products</th>
      <th scope="col">Total Amount</th>
      <th scope="col">Status</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>
 
    <?php 

    $selectQuery="SELECT orders.id,customers.Name AS CustomerName,customers.last_name,Products,Total_Amount,Status,Date FROM `orders` 
    INNER JOIN customers ON orders.CustomerID=customers.id ORDER BY Date";
    $values=mysqli_query($conn,$selectQuery);
    $counter=1;
    while($rows=$values->fetch_assoc()){
      echo '<tr>
      <th scope="row">'.$counter.'</th>
      <td>'.$rows['id'].'</td>
      
      <td>'.$rows['CustomerName'].' '.$rows['last_name'].'</td>
      <td>';
      foreach(json_decode($rows['Products'],true) as $value){
        $productData=getProductRow($conn,$value['product_id']);
        echo $productData['Name'] .',';
      }
      echo '</td><td>₹'.$rows['Total_Amount'].'</td>
      <td id="status" class="text-primary">'.$rows['Status'].'</td>
      <td>'.$rows['Date'].'</td>
      
    </tr>';
    $counter++;
    ?>
    <?php 
  
  } ?>
  </tbody>
</table>
</body>
<script>
  let allStatusTd=document.querySelectorAll('#status')
  for(ele of allStatusTd){
    if(ele.innerText == 'delivered'){
      ele.setAttribute('class','text-success')
    }
  }
</script>
</html>

<?php

}else {
  
  header('location:adminlogin.php'); 
   
 }
 ?>