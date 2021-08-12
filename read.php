<?php

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
  
// include database and object files
include_once 'database.php';
include_once 'product.php';
include_once 'category.php';
$database = new Database();
$db = $database->getConnection();
$product = new Product($db);
$category = new Category($db);
$product->id = $id;
$product->readOne();
$page_title = "Read One Product";
include_once "layout_header.php";
  
// read products button
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read Products";
    echo "</a>";
echo "</div>";
// HTML table for displaying a product details
echo "<table class='table table-hover table-responsive table-bordered'>";
  
    echo "<tr>";
        echo "<td>Name</td>";
        echo "<td>{$product->name}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>Price</td>";
        echo "<td>{$product->price}</td>";
    echo "</tr>";  
    echo "<tr>";
        echo "<td>Category</td>";
        echo "<td>";
            // display category name
            $category->id=$product->category_id;
            $category->readName();
            echo $category->name;
        echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Image</td>";
    echo "<td>";
        echo $product->image ? "<img src='C:/xampp/htdocs/Assignment4_prod/{$product->image}' style='width:200px;' />" : "No image found.";
    echo "</td>";
echo "</tr>";
  
echo "</table>";  


// set footer
include_once "layout_footer.php";
?>