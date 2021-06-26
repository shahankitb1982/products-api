<?php
include("../class/crud.php");
header("Access-Control-Allow-Origin: *");
header("Content-type:application/json");

$crud = new Crud(); 

if($_SERVER["REQUEST_METHOD"] == "GET") {

  if (empty($_GET['type'])) {
     $result = array("status" => false , "message" => 'Type parameter is missing.'); 
     echo json_encode($result);
     exit;
  }
  else {
    if ($_GET['type'] != "all") {
       $result = array("status" => false , "message" => 'Type value is missing.'); 
       echo json_encode($result);
       exit;
    }
  }

  $sql = "select p.*, pq.quantity from products p LEFT JOIN product_quantity pq ON p.id = pq.product_id ORDER BY p.id DESC";
  $res = $crud->read($sql);

  $count = mysqli_num_rows($res);

  if ($count > 0) {
    $getdata = array();
	 
    while($row = mysqli_fetch_assoc($res)) { 
	     $getdata[] = $row;
    }
    $result = array("status" => true , "alldata" => $getdata); 
  }
  else {
	 $result = array("status" => false , "message" => 'No Product(s) found...'); 
  }

  echo json_encode($result);
}
else {
	 $error = array("status" => 405 , "message" => 'Method not allowed...');
   echo json_encode($error);
}