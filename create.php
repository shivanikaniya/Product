<?php
include_once 'database.php';
include_once 'product.php';
include_once 'category.php';
$database = new Database();
$db = $database->getConnection();
$product = new Product($db);
$category = new Category($db);
$page_title = "Create Product";
include_once "layout_header.php";

echo "<div class='right-button-margin'>
        <a href='index.php' class='btn btn-default pull-right'>Read Products</a>
    </div>";

?>
<?php
if ($_POST) {
    $product->name = $_POST['name'];
    $product->price = $_POST['price'];
    $product->category_id = $_POST['category_id'];
    $product->image=!empty($_FILES["image"]["name"])
        ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
    if ($product->create()) {
        echo "<div class='alert alert-success'>Product was created.</div>";
        echo $product->uploadPhoto();
    } else {
        echo "<div class='alert alert-danger'>Unable to create product.</div>";
    }
}
?>
<form onsubmit = "return(validate())";action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data"name="myForm">
    <table class='table table-hover table-responsive table-bordered'>

        <tr>
            <td>Name</td>
            <td><input type='text' name='name' class="name"class='form-control' /> <span id="name_err"></span></td>
        </tr>

        <tr>
            <td>Price</td>
            <td><input type='number' name='price' class='form-control' class="price"/><span id="price_err"></span></td>
        </tr>
        <tr>
            <td>Photo</td>
            <td><input type="file" name="image" /></td>
        </tr>
        <tr>
            <td>Category</td>
            <td>
                <?php
                $stmt = $category->read();
                echo "<select class='form-control'class=' category_id' name='category_id'><span id='category_err'></span>";
                echo "<option>Select category...</option>";

                while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row_category);
                    echo "<option value='{$id}'>{$name}</option>";
                }

                echo "</select>";
                ?>
            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <input type="submit" class="btn btn-primary">
            </td>
        </tr>

    </table>
</form>

<?php

// footer
include_once "layout_footer.php";
?>