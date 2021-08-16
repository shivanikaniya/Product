<?php
if($_POST){
  

    include_once 'database.php';
    include_once 'product.php';
    $database = new Database();
    $db = $database->getConnection();
    $product = new Product($db);
    $product->id = $_POST['object_id'];
    if($product->delete()){
        echo "Object was deleted.";
    }
    else{
        echo "Unable to delete object.";
    }
}
?>
