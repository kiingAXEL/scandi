<?php

 include 'classes/dbh.class.php';
 include 'classes/Product.class.php';

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>View Products</title>
    <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/s.css">
  </head>
  <body>



<div class="top">
<p id="list">Product List</p>
<div id="line"> </div>

</div>


    <form action="add-product.php">
        <input type="submit" value="ADD" class="add" />
    </form>
</div>



  <form action="index.php" method="post">

      <?php
   $testobj = new Product();
 
  $testobj->getProducts5();


       ?>

                   <input type="submit" id="delete-product-btn" name="formSubmit" value="MASS DELETE"  class="btn2"/>
            </form>



</body>
</html>
