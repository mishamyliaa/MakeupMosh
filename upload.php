<?php
 
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 
//Create
if (isset($_POST['create'])) {
 
  try {

      $target = "products/".basename($_FILES['image']['name']);
      $stmt = $conn->prepare("INSERT INTO tbl_products_a177409_pt2(fld_product_image) VALUES(:image)");
     
     
      $stmt->bindParam(':image', $image, PDO::PARAM_STR);

      
    $image = $_FILES['image']['name'];
    
    if(move_uploaded_file($_FILES['tmp_name']['name'], $target)){
      $msg = "Image uploaded succesfully";
      $stmt->execute();
    }else{
      $msg = "There was a problem uploading image";
    }
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}

  $conn = null;
?>