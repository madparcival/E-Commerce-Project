<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<body>
    


<?php
include('inc.php');
include('functions/func.php');


if(isset($_POST['Submit'])){
    $name = $_POST['fname'] ." ".$_POST['lname'] ;
    $Address =$_POST['Address'] .", <br>".$_POST['address2'] .", <br>". $_POST['state'] .", <br>". $_POST['country'];
    $pincode=$_POST['postal'];
    $mail=$_POST['mailid'];


    $updateQuery="UPDATE customers SET last_name='$_POST[lname]', Address='$_POST[Address]', Address2='$_POST[address2]',Country='$_POST[country]',State='$_POST[state]',Pincode='$_POST[postal]'
    WHERE id=$_SESSION[id]";

    $conn->query($updateQuery);

    $productsData=array();

    $orderId=rand(000001,999999);



    ?>


    <div class="summary mx-auto border m-5" style="width:55%" id="OrderSummary">
        <div class="heading mt-4 text-center">
            <p class="h3">Order Summary</p>
        </div>        
        <div class="order d-flex justify-content-center">
            <div class="left p-5 text-start float-start">
                <p><b>Name :</b>Mr/Mrs/Miss:<?php echo $name; ?></h6>
                <p><b>Address :</b><?php echo $Address; ?></p>
                <p><b>Pincode :</b><?php echo $pincode; ?></p>
                <p><b>Email :</b><?php echo $mail; ?></p>
            </div>
            <div class="right float-end">
                <div class="orderImage text-end">
                    <h5><?php echo date('Y-m-d');?></h5>
                    <h5>OrderID:<?php echo $orderId; ?></h5>
                    <img src="files/pageimgs/user-login.png" height="100px" alt="">
                </div>
                <div class="productDetails">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge bg-primary rounded-pill"></span>
                </h4>
                <ul class="list-group mb-3">
                <?php
                    
                    $total=0;
                    foreach($_SESSION['checkoutData'] as $row ){
                        // changing the stock quantity in the products table

                        $updateQuery="UPDATE products SET Stock=$row[Stock]-$row[Quantity] WHERE id=$row[pid];";
                        mysqli_query($conn,$updateQuery);
                        // changing the status in the cart table
                        $updateQuery="UPDATE carts SET Status='Order-Placed' WHERE id=$row[cart_id];";
                        mysqli_query($conn,$updateQuery);

                        // append the productsdata
                        array_push($productsData,array('product_id'=>$row['pid'],'price'=>$row['price'],'quantity'=>$row['Quantity']));
                        $total+=$row['price']*$row['Quantity'];
                ?>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                    <h6 class="my-0"><?php echo $row['Name']?></h6>
                    <small class="text-body-secondary">Rs.<?php echo $row['price']?> x <?php echo $row['Quantity']?>Nos.</small>
                    </div>
                    <span class="text-body-secondary">Rs.<?php echo $row['price']*$row['Quantity'] ?></span>
                </li>
                <?php
                    }
                ?>
                <li class="list-group-item d-flex justify-content-between bg-body-tertiary">
                    <div class="text-warning">
                    <h6 class="my-0">Delivery Charges</h6>
                    <small></small>
                    </div>
                    <span class="text-danger">+Rs.<?php echo $charges=100?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between list-group-item-success">
                    <span>Total (INR)</span>
                    <strong>Rs.<?php echo $total+$charges?></strong>
                </li>
                </ul>
                </div>
            </div>
        </div>
    </div>

    <?php
    $productsData=json_encode($productsData);
    
    // Confirming the Order
    $insertOrder="INSERT INTO `orders`(id,CustomerID,Products,Total_Amount,Status) VALUES($orderId,$_SESSION[id],'$productsData',$total,'order-confirmed')";

    mysqli_query($conn,$insertOrder);
    
    }


// else{
//     header('location:checkout.php');
// }
?>
</body>
<script>
    // import { jsPDF } from "jspdf";
    window.jsPDF=window.jspdf.jsPDF;
    var doc = new jsPDF();

    var elementHTML=document.querySelector('#OrderSummary');

    doc.html(elementHTML,{
        callback:function(doc){
            doc.save('OrderID-<?php echo $orderId?>-Confirmation.pdf');
        },
        x:1,
        y:1,
        width:200,
        windowWidth:1200
    });

</script>

</html>