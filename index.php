<?php
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$records_per_page = 5;
$from_record_num = ($records_per_page * $page) - $records_per_page;
include_once 'database.php';
include_once 'product.php';
include_once 'category.php';
$database = new Database();
$db = $database->getConnection();
$product = new Product($db);
$category = new Category($db);

$stmt = $product->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();

$page_title = "Read Products";
include_once "layout_header.php";

echo "<div class='right-button-margin'>
    <a href='create.php' class='btn btn-default pull-right'>Create Product</a>
</div>";
// display the products if there are any
if ($num > 0) {
    echo "<table class='table table-hover table-responsive table-bordered'>";
    echo "<tr>";
    echo "<th>Product</th>";
    echo "<th>Price</th>";
    echo "<th>Image</th>";
    echo "<th>Category</th>";
    echo "<th>Actions</th>";
    echo "</tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        echo "<tr>";
        echo "<td>{$name}</td>"; 
        echo "<td>{$price}</td>";
        echo "<td>";
        echo  "<img src='{$product->$image}' style='width:200px;' />" ;
    echo "</td>";
        echo "<td>";
        $category->id = $category_id;
        $category->readName();
        echo $category->name;
        echo "</td>";

        echo "<td>";
        echo "<a href='read.php?id={$id}' class='btn btn-primary left-margin'>
                <span class='glyphicon glyphicon-list'></span> Read
            </a>
              
            <a href='update.php?id={$id}' class='btn btn-info left-margin'>
                <span class='glyphicon glyphicon-edit'></span> Edit
            </a>
              
            <a delete-id='{$id}' class='btn btn-danger delete-object'>
                <span class='glyphicon glyphicon-remove'></span> Delete
            </a>";
        echo "</td>";

        echo "</tr>";
    }

    echo "</table>";

    $page_url = "index.php?";

    $total_rows = $product->countAll();

    include_once 'paging.php';
} else {
    echo "<div class='alert alert-info'>No products found.</div>";
}
include_once "layout_footer.php";
