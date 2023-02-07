<?php

  class Dbh {
    private $host = "sql111.byethost5.com";    
    private $user = "b5_33493962";         
    private $pwd = "";              
    private $dbName = "b5_33493962_scandi";     
    public $mistake = 0;

    protected function connect() {
      $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
      $pdo = new PDO($dsn, $this->user, $this->pwd);
      $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      return $pdo;
    }

      
    // function for safe inputs
  public function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }



///////ERROR HANDLERS//////////////////////////////

  public function sku(){

  //checks if SKU is entered
  if (empty($_POST["sku"])) {
    $skuErr = "SKU is required";
    $this->mistake = $this->mistake  + 1;
    echo '<br>';
    echo '<span style="padding-left:50px; color:red">' .  $skuErr . '<br>';
   
    ob_end_flush();
  } else {

    $sku = $this->test_input($_POST["sku"]);

    // checks if name only contains letters, numbers, dashes and whitespace
    if (!preg_match("/^[a-zA-Z0-9-]*$/",$sku)) {
      $skuErr = "Only letters and numbers are allowed for SKU";
        $this->mistake = $this->mistake  + 1;
      echo '<br>';
      echo '<span style="padding-left:50px; color:red">' .  $skuErr . '<br>';
    
    }


    $stmt = $this->connect()->prepare('SELECT sku FROM products5 WHERE sku = ?;');
    $stmt->execute(array($sku));

    //checks if SKU is already used
    if ($stmt->rowCount() > 0) {
      $skuErr = "SKU is already taken, Please Choose unique SKU";
      $this->mistake = $this->mistake  + 1;
      echo '<br>';
      echo '<span style="padding-left:50px; color:red">' .  $skuErr . '<br>';
   
    }


  }
return $this->mistake;
}


public function name(){

if (empty($_POST["name"])) {
  $nameErr = "Name is required";
    $this->mistake = $this->mistake  + 1;
  echo '<br>';
  echo '<span style="padding-left:50px; color:red">' .  $nameErr . '<br>';

} else {

    $name = $this->test_input($_POST["name"]);
  // check if name only contains letters and whitespace
  if (!preg_match("/^[a-zA-Z0-9\s.]*$/",$name)) {
    $nameErr = "Only letters, numbers and white space are allowed for name";
      $this->mistake = $this->mistake  + 1;
    echo '<br>';
    echo '<span style="padding-left:50px; color:red">' .  $nameErr . '<br>';
 
  }
}
return $this->mistake;
}


public function price(){

if (empty($_POST["price"])) {
  $priceErr = "Price is required";
    $this->mistake = $this->mistake  + 1;
  echo '<br>';
  echo '<span style="padding-left:50px; color:red">' .  $priceErr . '<br>';
 
} else {

  $price = $this->test_input($_POST["price"]);
  // check if name only contains letters and whitespace
  if (!preg_match("/^[0-9.]*$/",$price)) {
    $priceErr = "Only numbers are allowed for price";
      $this->mistake = $this->mistake  + 1;
    echo '<br>';
    echo '<span style="padding-left:50px; color:red">' .  $priceErr . '<br>';
   
  }
}
return $this->mistake;
}

public function dvd_size(){

if (empty($_POST["dvd_size"])) {
  $sizeErr = "Size is required";
    $this->mistake = $this->mistake  + 1;
  echo '<br>';
  echo '<span style="padding-left:50px; color:red">' .  $sizeErr . '<br>';
 
} else {

    $size = $this->test_input($_POST["dvd_size"]);
  // check if name only contains letters and whitespace
  if (!preg_match("/^[0-9.]*$/",$size)) {
    $sizeErr = "Only numbers are allowed for dvd size";
      $this->mistake = $this->mistake  + 1;
    echo '<br>';
    echo '<span style="padding-left:50px; color:red">' .  $sizeErr . '<br>';
  
  }
}
return $this->mistake;
}

public function bookweight(){

if (empty($_POST["weight"])) {
  $weightErr = "Book weight is required";
    $this->mistake = $this->mistake  + 1;
  echo '<br>';
  echo '<span style="padding-left:50px; color:red">' .  $weightErr . '<br>';

} else {
  $weight = $this->test_input($_POST["weight"]);
  // check if name only contains letters and whitespace
  if (!preg_match("/^[0-9.]*$/",$weight)) {
    $weightErr = "Only numbers are allowed for book weight";
      $this->mistake = $this->mistake  + 1;
    echo '<br>';
    echo '<span style="padding-left:50px; color:red">' .  $weightErr . '<br>';
  
  }
}
return $this->mistake;
}

public function height(){
if (empty($_POST["height"])) {
  $heightErr = "Furniture height is required";
    $this->mistake = $this->mistake  + 1;
  echo '<br>';
  echo '<span style="padding-left:50px; color:red">' .  $heightErr . '<br>';
 
} else {
  $height = $this->test_input($_POST["height"]);
  // check if name only contains letters and whitespace
  if (!preg_match("/^[0-9.]*$/",$height)) {
    $heightErr = "Only numbers are allowed for Furniture height";
      $this->mistake = $this->mistake  + 1;
    echo '<br>';
    echo '<span style="padding-left:50px; color:red">' .  $heightErr . '<br>';
  
  }
}
return $this->mistake;
}

public function width(){
if (empty($_POST["width"])) {
  $widthErr = "Furniture width is required";
    $this->mistake = $this->mistake  + 1;
  echo '<br>';
  echo '<span style="padding-left:50px; color:red">' .  $widthErr . '<br>';
 
} else {
  $width = $this->test_input($_POST["width"]);
  // check if name only contains letters and whitespace
  if (!preg_match("/^[0-9.]*$/",$width)) {
    $widthErr = "Only numbers are allowed  for width";
      $this->mistake = $this->mistake  + 1;
    echo '<br>';
    echo '<span style="padding-left:50px; color:red">' .  $widthErr . '<br>';
  //  exit();
  }
}
return $this->mistake;
}

public function length(){
if (empty($_POST["length"])) {
  $lengthErr = "Furniture length is required";
    $this->mistake = $this->mistake  + 1;
  echo '<br>';
  echo '<span style="padding-left:50px; color:red">' .  $lengthErr . '<br>';

} else {
  $length = $this->test_input($_POST["length"]);
  // check if name only contains letters and whitespace
  if (!preg_match("/^[0-9.]*$/",$length)) {
    $lengthErr = "Only numbers are allowed for length";
      $this->mistake = $this->mistake  + 1;
    echo '<br>';
    echo '<span style="padding-left:50px; color:red">' .  $lengthErr . '<br>';
  
  }
}
return $this->mistake;
}

  }

?>
