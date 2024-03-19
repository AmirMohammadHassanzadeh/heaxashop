<?php
include("../init/init.php");
admin_login();
$time = time_zone();
$admin = $_SESSION['admin-inf'];
if (isset($_POST['name']) and isset($_POST['content']) and isset($_POST['price'])) {

    $name = $_POST['name'];
    $content = $_POST['content'];
    $price = $_POST['price'];
    $image = "";
    $product = $_POST['product'] ; 
    if ($_FILES['image']['error'] == 0) {

        $upload_dir = "../upload/";
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir);
        }
        $file_name = $_FILES['image']['tmp_name'];
        $file_path ="../upload/".$_FILES['image']['name'];
        move_uploaded_file($file_name, $file_path);
        $image = "http://localhost/heaxashop/upload/" . $_FILES['image']['name'];

    } else {
        $image = $_POST['image_val'];
    }

    $sql = "INSERT INTO `$product` 
        ( name , content , image , price , create_at , admin_add )
        
        VALUES

        ('$name' , '$content' , '$image' , '$price'  , '$time' , '$admin->username' )
        
          ";

    $result = $connection->exec($sql);

    if ($result) {
        $error = " your product add  ";
    } else {
        $error = " cant add your product ";
    }





}





?>

<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <h1>Add Product</h1>
    <h4>
        <?php echo isset($error) ? "$error" : ''; ?>
    </h4>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="content">Product Content:</label>
            <textarea id="content" name="content" required></textarea>
        </div>

        <div class="form-group">
            <label for="price"> Price:</label>
            <textarea id="price" name="price" ></textarea>
        </div>


        <div class="form-group">
            <label for="image">Product Image:</label>
            <input type="file" id="image" name="image" required>
            <img src="" alt="">
        </div>

        <div class="form-group">
            <form action="">
                <select name="product" id="">
                    <option value="products-men">Men</option>
                    <option value="products-women">Women</option>
                    <option value="products-kid">Kid</option>
                </select>

            </form>
            <input type="submit" value="Add Product">

        </div>
        <input type="hidden" name="iamge_val" value=" <?php echo $image ?> ">
    </form>

</body>

</html>
<title>Add Product</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        padding: 20px;
    }

    h1 {
        text-align: center;
        color: #333;
    }
    h4 {
        text-align: center;
        color: black;
    }

    form {
        width: 500px;
        margin: 0 auto;
        background-color: #fff;
        padding: 50px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }

    label {
        display: block;
        margin-bottom: 10px;
        color: #333;
    }

    input[type="text"],
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        resize: vertical;
    }

    input[type="file"] {
        margin-top: 5px;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: bold;
    }

    .form-group input[type="file"] {
        display: block;
        margin-top: 5px;
    }

    .form-group input[type="file"]::after {
        content: "Choose File";
        display: inline-block;
        background-color: #4CAF50;
        color: #fff;
        padding: 5px 10px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .form-group input[type="file"]::-webkit-file-upload-button {
        visibility: hidden;
    }

    .form-group input[type="file"]:focus+label::after {
        background-color: #45a049;
    }
</style>