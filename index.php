<?php
// page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
  
// set number of records per page
$records_per_page = 5;
  
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;

// core.php holds pagination variables
include_once 'config/core.php';
  
// retrieve records here
// include database and object files
include_once 'config/database.php';
include_once 'objects/product.php';
include_once 'objects/category.php';
  
// instantiate database and objects
$database = new Database();
$db = $database->getConnection();
  
$product = new Product($db);
$category = new Category($db);
  
// query products
$stmt = $product->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();
// set page header
$page_title = "Read Products";
include_once "layout_header.php";
  
// query products
$stmt = $product->readAll($from_record_num, $records_per_page);
  
// specify the page where paging is used
$page_url = "index.php?";
  
// count total rows - used for pagination
$total_rows=$product->countAll();
  
// read_template.php controls how the product list will be rendered
include_once "read_template.php";
  
// set page footer
include_once "layout_footer.php";
?>