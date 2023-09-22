<pre>
<?php

include('inc.php');
include('functions/func.php');

echo $_SESSION['id'];

$selectQuery="SELECT * FROM carts INNER JOIN products on carts.ProductID=products.id INNER JOIN customers on carts.CustomerID=customers.id WHERE CustomerID=5";

$result=$conn->query($selectQuery);

while($row=$result->fetch_assoc()){
    print_r($row);
}


?>
</pre>


