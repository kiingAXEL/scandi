<?php

class Product extends Dbh {
  

public function getLastId (){

//gets the lastId
$sql = "SELECT MAX(id) as max FROM products5";
$stmt = $this->connect()->query($sql);

$id = $stmt->fetch();
$lastID = $id['max'];

return $lastID;

}


  ///////////////// ADD METHOD ///////////////////////////////////

  public function addProduct2(){

   // adds product to the database
  

    if(isset($_POST['submit'])){

     
      $url = 'index.php';



      $sku= $this->test_input($_POST["sku"]);
      $name= $this->test_input($_POST["name"]);
      $price= $this->test_input($_POST["price"]);
      $size= $this->test_input($_POST["dvd_size"]);

      $e1=$this->sku();
      $e2=$this->name();
      $e3=$this->price();
      $e4=$this->dvd_size();

      $m = $e1+$e2+$e3+$e4;

    //ads product only if there are no errors
    if ($m == 0) {

      $sql = "INSERT INTO products5(sku,product_name,product_price) VALUES (?, ?, ?)";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$sku, $name, $price]);

      $lastID = $this->getLastId();

      $sql2 = "INSERT INTO dvd5(p_id,dvd_size) VALUES (?, ?)";
      $stmt2 = $this->connect()->prepare($sql2);
      $stmt2->execute([$lastID, $size]);


      // clear out the output buffer
     while (ob_get_status())
     {
       ob_end_clean();
     }

      
     header( "Location: $url" );
    }

    // if there are errors exit
    if ($m <> 0)
    { exit(); }

    }

 

    if(isset($_POST['submit2'])){

      ob_start();
      $url = 'index.php';

      $sku= $this->test_input($_POST["sku"]);
      $name= $this->test_input($_POST["name"]);
      $price= $this->test_input($_POST["price"]);
      $weight= $weight = $this->test_input($_POST["weight"]);

      $e1=$this->sku();
      $e2=$this->name();
      $e3=$this->price();
      $e4=$this->bookweight();

      $m = $e1+$e2+$e3+$e4;

      //ads product only if there are no errors
      if ($m == 0) {

      $sql = "INSERT INTO products5(sku,product_name,product_price) VALUES (?, ?, ?)";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$sku, $name, $price]);

      $lastID = $this->getLastId();

      $sql2 = "INSERT INTO book5(p_id,weight) VALUES (?, ?)";
      $stmt2 = $this->connect()->prepare($sql2);
      $stmt2->execute([$lastID, $weight]);

      // clear out the output buffer
      while (ob_get_status())
      {
        ob_end_clean();
      }

     
      header( "Location: $url" );

      }
         // if there are errors exit      
        if ($m <> 0)
            { exit(); }


  }

  ///////////////////////////////////
  //////// ADD FURNITURE ///////////////////

  if(isset($_POST['submit3'])){

    ob_start();
    $url = 'index.php';

    $sku= $this->test_input($_POST["sku"]);
    $name= $this->test_input($_POST["name"]);
    $price= $this->test_input($_POST["price"]);


    $height= $this->test_input($_POST["height"]);
    $width= $this->test_input($_POST["width"]);
    $length= $this->test_input($_POST["length"]);


    $e1=$this->sku();
    $e2=$this->name();
    $e3=$this->price();

    $e4=$this->height();
    $e5=$this->width();
    $e6=$this->length();

    $m= $e1+$e2+$e3+$e4+$e5+$e6;

    //ads product only if there are no errors
    if ($m == 0) {

    $sql = "INSERT INTO products5(sku,product_name,product_price) VALUES (?, ?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$sku, $name, $price]);

    $lastID = $this->getLastId();

    $sql2 = "INSERT INTO furniture5(p_id,furniture_width,furniture_height,furniture_length) VALUES (?, ?, ?, ?)";
    $stmt2 = $this->connect()->prepare($sql2);
    $stmt2->execute([$lastID, $width, $height, $length]);

    // clear out the output buffer
    while (ob_get_status())
    {
      ob_end_clean();
    }

    
    header( "Location: $url" );
    }

    // if there are errors exit 
    if ($m <> 0)
    { exit(); }

  }
  
  }

  ////////////////////////////////////////////////////////////////////
  ///////////////// GET METHOD ///////////////////////////////////

//shows products 
public function getProducts5(){

//gets data from database
$sqld = "SELECT P.* , D.dvd_size, B.weight, F.furniture_width, F.furniture_length, F.furniture_height
FROM products5 P
LEFT OUTER JOIN dvd5 D
ON P.id = D.p_id
LEFT OUTER JOIN book5 B
ON P.id = B.p_id
LEFT OUTER  JOIN furniture5 F
ON P.id = F.p_id
ORDER BY P.id DESC;
";
  $stmt = $this->connect()->query($sqld);

  //displays the data
  while($row = $stmt->fetch()) {

       $w1= $row['sku'];


  echo '<div class="content" >';
  echo '<div class="frame" >';
  echo '<input type="checkbox" class="delete-checkbox" name="formProd[]" value="'.$w1.'"> ';
  echo '<br>';

  $weight = $row['weight'];
  $size = $row['dvd_size'];
  $height = $row['furniture_height'];


  echo $row['sku'] . '<br>';
  echo $row['product_name'] . '<br>';
  echo $row['product_price'] . ' $' . '<br>';

  if (!is_null($size))
  {
  echo 'Size:  ' . $row['dvd_size'] . ' MB' . '<br>';
 }
 if (!is_null($weight))
 {
  echo 'Weight:  ' . $row['weight']  . ' KG' .  '<br>';
}

if (!is_null($height))
{
  echo 'Dimension:  ' . $row['furniture_height'] . 'x' . $row['furniture_width'] . 'x' . $row['furniture_length'];
}

  echo '<br>' . '<br>';
echo '</div>';
echo '</div>';
}


////////////// DELETE ///////////////////////////////////////
        //deletes the data if the checkbox is selected
       if(isset($_POST['formSubmit']))
         {
         $aProd = $_POST['formProd'];
         ob_start();
         $url = 'index.php';


         if(empty($aProd))
             {
    //   		echo("<p>You didn't select any products to delete.</p>\n");
         }
             else
             {
                 $N = count($aProd);

    //       echo("<p>You deleted $N product(s): ");



            }


           for($i=0; $i < $N; $i++)
           {

    


             $sql2 = "DELETE FROM products5 WHERE `products5`.`sku` = '$aProd[$i]'";
             $stmt = $this->connect()->prepare($sql2);
             $stmt->execute();

         }

         // clear out the output buffer
         while (ob_get_status())
         {
           ob_end_clean();
         }

         
         header( "Location: $url" );


       }

}






 }  //end of Class
 ?>
