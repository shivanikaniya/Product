<?php
class Product
{

    private $conn;
    private $table_name = "Prtab";
    public $id;
    public $name;
    public $price;
    public $image;
    public $category_id;
    public $timestamp;

    public function __construct($db)
    {
        $this->conn = $db;
    }


    function create()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validate name
            $input_name = trim($_POST["name"]);
            if (empty($input_name)) {
                $name_err = "Please enter a name.";
            } elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
                $name_err = "Please enter a valid name.";
            } else {
                $name = $input_name;
            }
            // Validate price
            $input_price = trim($_POST["price"]);
            if (empty($input_price)) {
                $price_err = "Please enter the price amount.";
            } elseif (!ctype_digit($input_price)) {
                $price_err = "Please enter a positive integer value.";
            } else {
                $price = $input_price;
            }
            $input_category = trim($_POST['category_id']);
            if ($input_category == -1) {
                $category_err = "please choose any one";
            } else {
                $category_id = $input_category;
            }
            if (empty($name_err) && empty($price_err) && empty($category_err)) {
                $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, price=:price, category_id=:category_id,image=:image, created=:created";

                $stmt = $this->conn->prepare($query);
                $this->name = htmlspecialchars(strip_tags($this->name));
                $this->price = htmlspecialchars(strip_tags($this->price));
                $this->image = htmlspecialchars(strip_tags($this->image));
                $this->category_id = htmlspecialchars(strip_tags($this->category_id));
                $this->timestamp = date('Y-m-d H:i:s');

                $stmt->bindParam(":name", $this->name);
                $stmt->bindParam(":price", $this->price);
                $stmt->bindParam(":image", $this->image);
                $stmt->bindParam(":category_id", $this->category_id);
                $stmt->bindParam(":created", $this->timestamp);
                if ($stmt->execute()) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }
    function readAll($from_record_num, $records_per_page)
    {
         $image="";
        $query = "SELECT
                    id, name, price, category_id,`image`
                FROM
                    " . $this->table_name . "
                ORDER BY
                    name ASC
                LIMIT
                    {$from_record_num}, {$records_per_page}";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function countAll()
    {
        $query = "SELECT id FROM " . $this->table_name . "";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $num = $stmt->rowCount();
        return $num;
    }
    function readOne()
    {

        $query = "SELECT
                name, price, category_id,image
            FROM
                " . $this->table_name . "
            WHERE
                id = ?
            LIMIT
                0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
        $this->price = $row['price'];
        $this->image = $row['image'];
        $this->category_id = $row['category_id'];
    }
    function update()
    {

        $query = "UPDATE
                " . $this->table_name . "
            SET
                name = :name,
                price = :price,
                image= :image,
                category_id  = :category_id
            WHERE
                id = :id";

        $stmt = $this->conn->prepare($query);

        // posted values
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind parameters
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':id', $this->id);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    function delete()
    {

        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    function uploadPhoto()
    {
        $image = "";
        $result_message = "";

        // now, if image is not empty, try to upload the image
        if ($this->image) {

            // sha1_file() function is used to make a unique file name
            $target_directory = "C:/xampp/htdocs/Assignment4_prod/MyImages/";
            $target_file = $target_directory . $this->image;
            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
            // error message is empty
            $file_upload_error_messages = "";
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                // submitted file is an image
            } else {
                $file_upload_error_messages .= "<div>Submitted file is not an image.</div>";
            }

            // make sure certain file types are allowed
            $allowed_file_types = array("jpg", "jpeg", "png", "gif");
            if (!in_array($file_type, $allowed_file_types)) {
                $file_upload_error_messages .= "<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
            }

            // make sure file does not exist
            if (file_exists($target_file)) {
                $file_upload_error_messages .= "<div>Image already exists. Try to change file name.</div>";
            }

            // make sure submitted file is not too large, can't be larger than 1 MB
            if ($_FILES['image']['size'] > (1024000)) {
                $file_upload_error_messages .= "<div>Image must be less than 1 MB in size.</div>";
            }

            // make sure the 'uploads' folder exists
            // if not, create it
            if (!is_dir($target_directory)) {
                mkdir($target_directory, 0777, true);
            }
            // if $file_upload_error_messages is still empty
            if (empty($file_upload_error_messages)) {
                // it means there are no errors, so try to upload the file
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    // it means photo was uploaded
                } else {
                    $result_message .= "<div class='alert alert-danger'>";
                    $result_message .= "<div>Unable to upload photo.</div>";
                    $result_message .= "<div>Update the record to upload photo.</div>";
                    $result_message .= "</div>";
                }
            }

            // if $file_upload_error_messages is NOT empty
            else {
                // it means there are some errors, so show them to user
                $result_message .= "<div class='alert alert-danger'>";
                $result_message .= "{$file_upload_error_messages}";
                $result_message .= "<div>Update the record to upload photo.</div>";
                $result_message .= "</div>";
            }
        }

        return $result_message;
    }
}
