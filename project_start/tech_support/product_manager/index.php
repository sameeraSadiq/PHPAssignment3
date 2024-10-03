<?php
require('../model/database.php');
include '../view/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportsPro Technical Support</title>
    <style>
        form {
            max-width: 500px;
            overflow: hidden;
        }
        label, input {
            display: inline-block;
            width: 48%;
            margin: 5px 0;
            box-sizing: border-box;
            padding: 5px;
        }

        input[type='submit'] {
            width: 20%;
            float: right;
            margin-right: 15px;
        }

        input[type='submit']::before {
            display: table;
            clear: both;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        a {
            display: inline-block;
            font-weight: 700;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Add Product</h1>
    <form action="add_product_process.php" method="post">
        <label for="">Code:</label>
        <input type="text" name="productCode">

        <label for="">Name:</label>
        <input type="text" name="name">

        <label for="">Version:</label>
        <input type="text" name="version">

        <label for="">Release Date:</label>
        <input type="date" name="releaseDate">

        <input type="submit" value="Add Product">
    </form>

   
    <a href="./product_list.php">View Product List</a>


</body>
</html>

<?php include '../view/footer.php'; ?>