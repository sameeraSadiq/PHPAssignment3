<?php
require('../model/database.php');
include '../view/header.php';

$query = 'SELECT * FROM products';
$statement = $db->prepare($query);
$statement->execute();
$products = $statement->fetchAll();
$statement->closeCursor();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportsPro Technical Support</title>
    <style>
        table,th,td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 2px 10px;
            text-align: left;
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
    <h1>Product List</h1>
    <table>
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Version</th>
            <th>Release Date</th>
        </tr>
        <?php foreach ($products as $product) : ?>
        <tr>
            <td><?php echo $product['productCode']; ?></td>
            <td><?php echo $product['name']; ?></td>
            <td><?php echo $product['version']; ?></td>
            <td><?php echo $product['releaseDate']; ?></td>
            <td><button>Delete</button></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

<a href="./index.php">Add Product</a>

<?php
include '../view/footer.php';
?>