<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Add Products</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/s.css">
    <!--CSS stylesheet-->
    <style>


        .box {
          /*  color: #fff;  */
            padding: 20px;
            display: none;
            margin-top: 20px;
        }

        .in {
          /*  color: #fff;  */
            padding: 20px;
            margin-top: 20px;
        }
        .in2 {
          /*  color: #fff;  */
            padding-left: 20px;
            margin-top: 0px;
        }


    /*    .red {
            background: red;
        }

        .green {
            background: green;
        }

        .blue {
            background: blue;
        }
        */
    </style>
    

    <script src=
    "https://code.jquery.com/jquery-1.12.4.min.js">
    </script>

    <script>
        // jQuery functions to hide and show the divs
        $(document).ready(function () {
            $("select").change(function () {
                $(this).find("option:selected")
                       .each(function () {
                    var optionValue = $(this).attr("value");
                    if (optionValue) {
                        $(".box").not("." + optionValue).hide();
                        $("." + optionValue).show();
                    } else {
                        $(".box").hide();
                    }
                });
            }).change();
        });
    </script>

</head>

<body>

  <div class="top">
  <p id="list">Product Add</p>
  <div id="line"> </div>

  </div>


 <?php

include('classes/dbh.class.php');
include 'classes/Product.class.php';


$sku = $name = $price = $size = $height = $width = $lenght = $weight = "";
$skuErr = $nameErr = $priceErr = $sizeErr = $heightErr = $widthErr = $lenghtErr = $weightErr = "";

?>

<div class="form">


<form action="index.php">
    <input type="submit" value="Cancel" class="cancel" />
</form>




  <form  method="POST" id="product_form" action="add-product.php">

  <div class="in">


      <label>SKU </label>
      <input type="text" name="sku" id="sku">* 
      <br><br>
      <label>Name </label>
      <input type="text" name="name" id="name">* 
      


      <br><br>
      <label>Price($) </label>
      <input type="text" name="price" id="price">* 
     
      <br><br>

  </div>


    <div class="in2">
        <!--dropdown list options-->
        <label for="fname">Type Switcher:</label>
        <select id="productType">
            <option>-Choose-</option>
            <option value="DVD">DVD</option>
            <option value="Book">Book</option>
            <option value="Furniture">Furniture</option>

        </select>
    </div>



    <!--divs that hide and show-->
    <!--DVDs-->
    <div class="DVD box">

        <label>Size (MB) </label>
        <input type="text" name="dvd_size" id="size">* 
      
        <br><br>
      Please provide DVD Size
        <br><br>
        <input type="submit" name="submit" value="Save" class="btn" action="index.php">
    </div>



    <!--Books-->
    <div class="Book box">
      <label for="fname">Weight (KG) </label>
      <input type="text" name="weight" id="weight">* 
      <br><br>
      Please provide book weight
        <br><br>
        <input type="submit" name="submit2" value="Save" class="btn" action="index.php">
    </div>

    <!--Furniture-->
    <div class="Furniture box">
      <label>Height (CM) </label>
      <input type="number" name="height" id="height">* 
      <br><br>
      <label>Width (CM)  </label>
      <input type="number" name="width" id="width">* 
      <br><br>
      <label>length (CM) </label>
      <input type="number" name="length" id="length">* 
      <br><br>
      Please provide furniture dimensions
            <br><br>
          <input type="submit" name="submit3" value="Save" class="btn" action="index.php">
    </div>


  </form>
  </div>


    <?php
     $testobj = new Product();
    $testobj->addProduct2();
     ?>


</body>

</html>
