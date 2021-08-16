<?php
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
include_once 'database.php';
include_once 'product.php';
include_once 'category.php';
$database = new Database();
$db = $database->getConnection();
$product = new Product($db);
$category = new Category($db);

$product->id = $id;
$product->readOne();

$page_title = "Update Product";
include_once "layout_header.php";

echo "<div class='right-button-margin'>
          <a href='index.php' class='btn btn-default pull-right'>Read Products</a>
     </div>";

?>
<?php 
if($_POST){
  
    // set product property values
    $product->name = $_POST['name'];
    $product->price = $_POST['price'];
    $product->category_id = $_POST['category_id'];
    $product->image=!empty($_FILES["image"]["name"])
    ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
  
    // update the product
    if($product->update()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Product was updated.";
            echo $product->uploadPhoto();
        echo "</div>";
    }
    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Unable to update product.";
        echo "</div>";
    }
}
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>

        <tr>
            <td>Name</td>
            <td><input type='text' name='name' value='<?php echo $product->name; ?>' class='form-control' /></td>
        </tr>

        <tr>
            <td>Price</td>
            <td><input type='text' name='price' value='<?php echo $product->price; ?>' class='form-control' /></td>
        </tr>
        <tr>
            <td>Image</td>
            <td><input type='file' name='image' value='<?php echo $product->image; ?>' class='form-control' /></td>
        </tr>
        <tr>
            <td>Category</td>
            <td>
                <?php
                $stmt = $category->read();

                // put them in a select drop-down
                echo "<select class='form-control' name='category_id'>";

                echo "<option>Please select...</option>";
                while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $category_id = $row_category['id'];
                    $category_name = $row_category['name'];

                    // current category of the product must be selected
                    if ($product->category_id == $category_id) {
                        echo "<option value='$category_id' selected>";
                    } else {
                        echo "<option value='$category_id'>";
                    }

                    echo "$category_name</option>";
                }
                echo "</select>";
                ?>
            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Update</button>
            </td>
        </tr>

    </table>
</form>
<?php
include_once "layout_footer.php";
?>
