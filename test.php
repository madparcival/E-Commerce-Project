<?php
include('inc.php');

if(isset($_POST['stockStatus'])){
  echo 'hello';
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <form method="post" action='test.php'>
    <div class="form-check form-switch">
        <input class="form-check-input" value='1' name="stockStatus" type="checkbox" role="switch" id="flexSwitchCheckDefault">
        <label class="form-check-label" for="flexSwitchCheckDefault">In Stock</label>
    </div>
    <button type="submit" name="submit">click</button>
    </form>
</body>

</html>
