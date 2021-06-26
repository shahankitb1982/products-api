<?php
include("../class/crud.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded");
 
$crud = new Crud();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $data = array();
  parse_str(file_get_contents('php://input'),$data); 

  if (empty($data["name"]) || empty($data["price"])) {
    $result = array("status" => false , "message" => "Name and price are required");
    echo json_encode($result);
    exit;
  }

  $name = trim($data["name"]); 
  $description = trim($data["description"]); 
  $price = trim($data["price"]);  

  if (!preg_match("/^[0-9]+(\.[0-9]{2})?$/", $price)) {
    $result = array("status" => false , "message" => "Invalid price.");
    echo json_encode($result);
    exit; 
  }

  $quantity = trim($data["quantity"]); 

  $name = mysqli_real_escape_string($crud->con, $name);
  $description = mysqli_real_escape_string($crud->con, $description);
  $price = mysqli_real_escape_string($crud->con, $price);
  $quantity = mysqli_real_escape_string($crud->con, $quantity);


  $sql = "insert into products (name,description,price) values ('$name','$description','$price')";
  $res = $crud->create($sql); 


  if ($res > 0) {
    if (!empty($data["quantity"])) {
      $sql = "insert into product_quantity (product_id,quantity) values ('$res','$quantity')";
      $res = $crud->create($sql); 
    }
  	$result = array("status" => true , "message" => "Product Added Successfully...");
  }
  else {
  	$result = array("status" => false , "message" => "Something went wrong...");
  }

  echo json_encode($result);
}
else {
	 $error = array("status" => 405 , "message" => 'Method not allowed...');
	 
  echo json_encode($error);
} 