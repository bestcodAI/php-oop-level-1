<?php
// set page headers
// get ID of the product to be read
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
  
// include database and object files
include_once 'config/database.php';
include_once 'objects/product.php';
include_once 'objects/category.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare objects
$product = new Product($db);
$category = new Category($db);
  
// set ID property of product to be read
$product->id = $id;
  
// read the details of product to be read
$product->readOne();
$page_title = "Read One Product";
include_once "layout_header.php";
  
// read products button
echo "<div class='right-button-margin'>
    <a href='index.php' class='btn btn-primary pull-right'>
        <span class='glyphicon glyphicon-list'></span> Read Products
    </a>
</div>";

echo "<table class='table table-hover table-responsive table-bordered'>
  
    <tr>
        <td>Name</td>
        <td>{$product->name}</td>
    </tr>
  
    <tr>
        <td>Price</td>
        <td>{$product->price}</td>
    </tr>
  
    <tr>
        <td>Description</td>
        <td>{$product->description}</td>
    </tr>
  
    <tr>
        <td>Category</td>
        <td>";
            // display category name
            $category->id=$product->category_id;
            $category->readName();
            echo $category->name;
        echo "</td>
    </tr>
  
</table>";

  
// set footer
include_once "layout_footer.php";
?>
